<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\TypeMarkRequest;
use App\Models\Type__mark;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class TypeMarkController extends Controller
{
    public function index()
    {
        $marks = Type__mark::all();

        return Inertia::render("Types/Mark/Index", compact("marks"));
    }

    public function store(TypeMarkRequest $request)
    {   
        $request->validated();

        Type__mark::create([
            "code" => $request->code,
            "title" => $request->title
        ]);

        return redirect()->route("mark.type.index");
    }

    public function update(TypeMarkRequest $request, int $id)
    {
        $request->validated();
        
        Type__mark::find($id)->update([
            "code" => $request->code,
            "title" => $request->title
        ]);

        return redirect()->route("mark.type.index");
    }

    public function destroy(int $id)
    {
        Type__mark::destroy($id);

        return redirect()->route("mark.type.index");
    }
}
