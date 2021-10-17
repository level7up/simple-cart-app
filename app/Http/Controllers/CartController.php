<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Http\Resources\{ProductCollection,ProductResource};
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId =Auth::user()->id;
        // $items = Cart::where('user_id', $userId)->get();
        // $products = Product::all();

        $products = DB::table('carts')
        ->join('products','carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $userId)
        ->select('products.*')
        ->get();
        $sum = DB::table('carts')
        ->join('products','carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $userId)
        ->sum('products.price');
       
        return view('cart',['products'=>$products],['sum'=>$sum]);
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
    /**
     * Add product to cart.
     *
     */
    public function addToCart(Request $request)
    {
        // $user = Auth::user()->name;

       $cart = new Cart;
       $cart->product_id =$request->product_id;
       $cart->user_id = Auth::user()->id;
       $cart->save();
       return redirect('/home');

    }

    /**
     * Cart Counter
     * 
     */
    static public function cartItems(Type $var = null)
    {
        if(Auth::user()){
            $userId = Auth::user()->id;
            return Cart::where('user_id', $userId)->count();
        }
    }
}
