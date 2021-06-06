<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\ProductRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return Inertia::render("Store/Index", compact("products"));
    }

    public function store(ProductRequest $request)
    {
        $request->validated();
        $photo = $request->hasFile('photo') 
            ? $request->file('photo')->store('products') 
            : $request->photo;

        Product::create([
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price,
            "photo" => $photo,
        ]);

        return redirect()->back();
    }

    public function update(ProductRequest $request, $id)
    {         
        $request->validated();
        $photo = $request->hasFile('photo') 
            ? $request->file('photo')->store('products') 
            : $request->photo;

        Product::find($id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price,
            "photo" => $photo,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Product::find($id)->delete($id);
       
        return redirect()->back();
    }
}
