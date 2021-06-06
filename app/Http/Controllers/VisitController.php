<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visit;
use App\Models\Type__mark;
use Barryvdh\DomPDF\Facade as PDF;
use Inertia\Inertia;

class VisitController extends Controller
{
    protected $visits;

    public function __construct(VisitRepository $visits)
    {
        $this->visits = $visits;
    }

    public function index(Request $request)
    {
        $users = $this->visits->getAllByUsers($request->date);
        $marks = Type__mark::all();

        return Inertia::render("Visit/Index", compact("users", 'marks'));
    }

    public function show(Request $request, User $user)
    {
        $user = $this->visits->getByUser($user, $request->date);

        return Inertia::render("Visit/Show", ['user' => $user, 'date' => $request->date]);
    }

    public function store(VisitRequest $request)
    {
        $request->validated();

        $this->visits->create($request);

        return redirect()->route("visit.index", ['date' => $request->date]);
    }

    public function update(VisitRequest $request, Visit $visit)
    {
        $request->validated();

        $this->visits->update($visit, $request);

        return redirect()->route("visit.index", ['date' => $request->date]);
    }

    public function loadPdf(Request $request, User $user)
    {
        $user = $this->visits->getByUser($user, $request->date);

        $pdf = PDF::loadView(
            'pdf.visit',
            ["date" => $request->date, "user" => $user]
        )->setPaper('a4', 'landscape');

        return $pdf->download('visit.pdf');

    }

}
