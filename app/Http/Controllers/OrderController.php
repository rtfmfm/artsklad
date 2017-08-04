<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProduct;
use App\Cart;
use App\User;
use Auth;
use DB;
use Validator;


class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return "aaaa";
    }


    public function show($id)
    {
        //
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
            // dump($product);
            // die;
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
