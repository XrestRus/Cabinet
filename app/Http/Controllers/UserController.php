<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $request->user()->isAdmin() ? $this->users->getAllForAdmin() : $this->users->getAllForEmployee();

        return Inertia::render(
            "User/Index",
            compact("users")
        );
    }

    public function show(User $user)
    {
        return Inertia::render(
            "User/Show",
            compact("user")
        );
    }

    public function pay(User $user)
    {
        $this->users->pay($user, 100);

        return redirect()->back();
    }

    public function create(Request $request)
    {
        $roles = $request->user()->isAdmin() ? Role::all() : null;

        return Inertia::render(
            "User/Add", compact("roles")
        );
    }

    public function store(CreateUserRequest $request)
    {
        $request->validated();

        $request->photo = $this->users->setImage($request->file('photo')) ?? $request->photo;

        $this->users->create($request);

        return redirect("/user");
    }

    public function edit(Request $request, User $user)
    {
        $roles = $request->user()->isAdmin() ? Role::all() : null;

        return Inertia::render(
            "User/Edit",
            compact("user", "roles")
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated();

        $request->photo = $this->users->setImage($request->file('photo')) ?? $request->photo;
        $request->role = $request->user()->isAdmin() ? $request->role['id'] : $request->user()->role;

        $this->users->update($user, $request);

        return redirect()->route(
            "user.show",
            ['user' => $user]
        );
    }

    public function destroy(User $user)
    {
        $this->users->delete($user);

        return redirect()->route("user.index");
    }
}
