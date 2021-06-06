<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\RoleRequest;
use App\Models\Role;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return Inertia::render("Role/Index", compact("roles"));
    }

    public function store(RoleRequest $request)
    {
        $request->validated();
        $pdf = $request->hasFile('pdf_path') 
            ? $request->file('pdf_path')->store('roles') 
            : $request->pdf_path;

        Role::create([
            'title' => $request->title,
            'pdf_path' => $pdf,
        ]);

        return redirect()->route('role.index');
    }

    public function show_pdf(int $id) 
    {
        $role = Role::find($id);

        return Inertia::render("Role/Show", compact("role"));
    }

    public function update(RoleRequest $request, int $id)
    {   
        $request->validated();
        $pdf = $request->hasFile('pdf_path') 
            ? $request->file('pdf_path')->store('roles') 
            : $request->pdf_path;

        Role::find($id)->update([
            'title' => $request->title,
            'pdf_path' => $pdf,
        ]);

        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        Role::destroy($id);
       
        return redirect()->route('role.index');
    }
}
