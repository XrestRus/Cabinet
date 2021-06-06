<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Repositories\User\UserRepository;
use App\Repositories\VacationRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vacation;
use App\Models\User;

class VacationController extends Controller
{
    protected $vacations;
    protected $users;

    public function __construct(VacationRepository $vacations, UserRepository $users)
    {
        $this->vacations = $vacations;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $request->user()->isAdmin() ? User::all() : null;
        $vacations = $this->vacations->getVacationsByUser($request->id);

        return Inertia::render("Vacation/Index", compact("users", "vacations"));
    }

    public function store(VacationRequest $request)
    {
        $request->validated();

        $this->vacations->create($request);

        return redirect()->route('vacation.index');
    }

    public function update(VacationRequest $request, Vacation $vacation)
    {
        $request->validated();

        $this->vacations->update($vacation, $request);

        return redirect()->route('vacation.index');
    }


    public function destroy(Vacation $vacation)
    {
        $this->vacations->delete($vacation);

        return redirect()->route('vacation.index');
    }
}
