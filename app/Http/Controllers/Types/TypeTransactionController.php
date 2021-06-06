<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\TypeTransactionRequest;
use App\Models\Type__transaction;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class TypeTransactionController extends Controller
{
    public function index()
    {
        $transactions = Type__transaction::all();

        return Inertia::render("Types/Transaction/Index", compact("transactions"));
    }

    public function store(TypeTransactionRequest $request)
    {
        $request->validated();

        Type__transaction::create([
            "title" => $request->title,
        ]);

        return redirect()->route("transaction.type.index");
    }

    public function update(TypeTransactionRequest $request, int $id)
    {
        $request->validated();

        Type__transaction::find($id)->update([
            "title" => $request->title,
        ]);

        return redirect()->route("transaction.type.index");
    }

    public function destroy(int $id)
    {
        Type__transaction::destroy($id);

        return redirect()->route("transaction.type.index");
    }
}
