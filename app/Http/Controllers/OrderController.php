<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProduct;
use App\User;
use App\Cart;
use Auth;
use DB;


class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('client_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_rows = OrderProduct::where('order_id', $id)->get();

        $articles_qty = OrderProduct::where('order_id', $id)->sum('qty');
        $products_count = $order_rows->count();

        $old_amount = 0;
        foreach ($order_rows as $row) {
            $new_amount = $row->qty * $row->price;
            $old_amount = $old_amount + $new_amount;
        }

        return view('orders.show', compact('order_rows', 'articles_qty', 'products_count', 'old_amount', 'order'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {   
       
    }

    public function createorder()
    {
        $order_id = Order::create([
            'client_id' => auth()->id(),
            'status' => 1,
        ]);

        $products = Cart::where('user_id', auth()->id())->get();
        foreach ($products as $product) {
            $row = Product::where('id', $product->id)->first();
            OrderProduct::create([
                'order_id' => $order_id->id,
                'art' => $row->art,
                'name' => $row->name,
                'produser' => $row->produser,
                'unit' => $row->unit,
                'category' => $row->groop1,
                'fasovka' => $row->fasovka,
                'price' => $row->price,
                'qty' => $product->qty,
            ]);
            DB::table('carts')->where('id', $product->id)->delete();
        }
        session()->forget('cart_items');
        session()->forget('filters');
        return view('orders.success');

    }

}
