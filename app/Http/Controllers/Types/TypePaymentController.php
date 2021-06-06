<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\TypePaymentRequest;
use App\Models\Type__payment;
use App\Models\Type__transaction;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class TypePaymentController extends Controller
{
    public function index()
    {
        $payments = Type__payment::all();
        $types = Type__transaction::all();

        return Inertia::render("Types/Payment/Index", compact("payments", "types"));
    }

    public function store(TypePaymentRequest $request)
    {
        $request->validated();

        Type__payment::create([
            "title" => $request->title,
            "type_transaction_id" => $request->type_transaction['id']
        ]);

        return redirect()->route("payment.type.index");
    }

    public function update(TypePaymentRequest $request, int $id)
    {
        $request->validated();

        Type__payment::find($id)->update([
            "title" => $request->title,
            "type_transaction_id" => $request->type_transaction['id']
        ]);

        return redirect()->route("payment.type.index");
    }

    public function destroy(int $id)
    {
        Type__payment::destroy($id);

        return redirect()->route("payment.type.index");
    }
}
