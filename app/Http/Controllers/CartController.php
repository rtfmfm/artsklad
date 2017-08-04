<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\User;
use Auth;
use DB;
use Validator;
use Session;

class CartController extends Controller
{
    public function index()
    {
        //
    }


    public function create()
    {
         
    }


    public function store(Request $request)
    {
        $input = $request->all();
        Validator::make($input, ['qty' => ['integer']]);
        $prod_id = $request->id;
        $user_id = Auth::user()->id;
        $qty = $request->qty;
        $id=Cart::select('id')->where('product_id',$prod_id)->where('user_id',$user_id)->first();


        if (!empty($id)) { 
            if ($qty == 0) {
                $line = Cart::findOrFail($id);
                DB::table('carts')->where('id', $id->id)->delete();
                $notification_message = 'Продуктът беше премахнат от количката';           
            } else {
                $line = Cart::findOrFail($id);
                DB::table('carts')->where('id', $id->id)->update(['qty' => $request->qty]);
                $notification_message = 'Този продукт вече е наличен в количката. Количеството бе обновено';
            }
        } else {
            if ($qty > 0) {
                Cart::create([
                    'user_id' => $user_id,
                    'product_id' => $prod_id,
                    'qty' => $qty,
                ]);
                $notification_message = 'Продуктът беше добавен в количката';

            }
        }

        // app('App\Http\Controllers\ProductController')->filterResults();
        $cart_items = Cart::where('user_id', Auth::user()->id)->count();
        session()->put('cart_items', $cart_items);


        $notification = array(
            'message' => $notification_message, 
            'alert-type' => 'success'
        );

        return back()->with($notification);
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
        DB::table('carts')->where('id', $id)->delete();
        $cart_items = Cart::where('user_id', Auth::user()->id)->count();
        session()->put('cart_items', $cart_items);

        $notification = array(
            'message' => 'Записът е изтрит', 
            'alert-type' => 'success'
        );

        return redirect()->route('preview')->with($notification); 

    }

    public function preview(){

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $articles_qty = Cart::where('user_id', Auth::user()->id)->sum('qty');
        $products_count = $carts->count();

        $old_amount = 0;
        foreach ($carts as $row) {
            $new_amount = $row->qty * $row->product->price;
            $old_amount = $old_amount + $new_amount;
        }


        return view('orders.preview', compact('carts', 'products_count', 'articles_qty', 'old_amount'));
    }

}
