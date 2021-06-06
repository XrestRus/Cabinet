<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\User;
use App\Models\Payment;
use App\Models\Type__payment;
use App\Repositories\PaymentRepository;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    protected $payments;

    public function __construct(PaymentRepository $payments)
    {
        $this->payments = $payments;
    }

    public function index(Request $request)
    {
        $users = $request->user()->isAdmin() ? User::all() : null;
        $type_payments = $request->user()->isAdmin() ? Type__payment::all() : null;
        $payments = $this->payments->getGroupByUser($request->id);

        return Inertia::render("Payment/Index",
            compact("payments", "users", "type_payments")
        );
    }

    public function store(PaymentRequest $request)
    {
        $request->validated();

        $this->payments->create($request);

        return redirect()->route("payment.group.show", [
            'user' => $request->user['id'],
            'month' => $request->month,
            'year' => $request->year
        ]);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $request->validated();

        $this->payments->update($payment, $request);

        return redirect()->route("payment.group.show", [
            'user' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year
        ]);
    }

    public function destroy(Request $request, Payment $payment)
    {
        $this->payments->delete($payment);

        return redirect()->route("payment.group.show", [
            'user' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year
        ]);
    }

    public function show_group(Request $request, User $user, int $year, int $month)
    {
        $selectedUser = $user;
        $users = $request->user()->isAdmin() ? User::all() : null;
        $type_payments = $request->user()->isAdmin() ? Type__payment::all() : null;
        $payments = $this->payments->showGroupToDate($user, $year, $month);

        return Inertia::render("Payment/ShowGroup",
            compact("selectedUser", "payments", "month", "year", "type_payments", "users"));
    }

    public function remove_group(User $user, int $year, int $month)
    {
        $this->payments->deleteGroupToDate($user, $year, $month);

        return redirect()->route('payment.index', [ 'id' => $user->id ]);
    }

    public function loadPdf(User $user, int $year, int $month)
    {
        $payments = $this->payments->showGroupToDate($user, $year, $month);
        $payments_accrual = $this->payments->filterByTransaction($payments, 2);
        $payments_retention = $this->payments->filterByTransaction($payments, 1);

        $pdf = PDF::loadView(
            'pdf.payment',
            compact('user', 'payments', 'payments_accrual', 'payments_retention', 'year', 'month')
        );

        return $pdf->download('payment.pdf');
    }
}

