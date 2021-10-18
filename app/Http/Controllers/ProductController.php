<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Http\Resources\{ProductCollection,ProductResource};
use Illuminate\Http\Request;
use Session;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        return response()->json(new ProductCollection(Product::all()), 200);

        // return view('home');

    }
    /**
     * Display a listing of the resource on web app.
     *
     */
    public function home()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProductResource
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only([
            'name', 'descreption', 'discount', 'Weight', 'price','country','category_id','discount_id','shipping', 'rate','vat'
        ]));

        // return new productResource($product);
        return response()->json(new ProductResource($product), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
         // return new ProductResource($Product);
        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product ->update($request->only([
            'name', 'descreption', 'discount', 'Weight', 'price','country_id','category_id','discount_id'
        ]));

        // return new ProductResource($product);
        return response()->json(new ProductResource($product), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
         return response()->json(null, 204);
    }

    
    /**
     * Add product to cart.
     *
     */
    // public function addToCart(Request $request)
    // {
    //     // $user = Auth::user()->name;

    //    $cart = new Cart;
    //    $cart->product_id =$request->product_id;
    //    $cart->user_id = Auth::user()->id;
    //    $cart->save();
    //    return redirect('/home');

    // }


    // static public function cartItems(Type $var = null)
    // {
    //     if(Auth::user()){
    //         $userId = Auth::user()->id;
    //         return Cart::where('user_id', $userId)->count();
    //     }
       
    // }
}
