<?php

namespace App\Http\Controllers\Store;

use App\Http\Requests\Store\OrderRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $orders = null;

        if ($request->id) $orders = Order::where('user_id', $request->id)->get();
        else $orders = Order::all();

        return Inertia::render("Store/Order/Index", compact("orders", "users"));
    }

    public function show(int $id)
    {
        $products = User::find($id)
            ->products()
            ->join('type__orders', 'type__orders.id', '=', 'orders.state')
            ->select('products.*','type__orders.title as state')
            ->get();

        return Inertia::render("Store/Order/Show", compact("products"));
    }

    public function store(OrderRequest $request)
    {
        $product = Product::find($request->product_id);
        $user = User::find($request->user_id);
        $offset = $user->money - $product->price;

        if ($offset < 0) {
            return redirect()->back();
        }

        $request->validated();

        Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'date' => date('Y-m-d')
        ]);

        $user->update([
            "money" => $offset
        ]);

        return redirect()->back();
    }

    public function success($id)
    {
        Order::find($id)->update(['state' => 3]);

        return redirect()->back();
    }

    public function cancel($id)
    {
        $u = Order::find($id);
        $u->update(['state' => 2]);
        $u->save();

        $product = Product::find($u->product_id);
        $user = User::find($u->user_id);
        $offset = $user->money + $product->price;

        $user->update([
            "money" => $offset
        ]);

        return redirect()->back();
    }

}
