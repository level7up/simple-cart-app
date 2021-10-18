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
        $carts = Cart::where('user_id', $userId)->get();
        // $products = Product::all();

        $products = DB::table('carts')
        ->join('products','carts.product_id',  'products.id')
        ->select('products.*','carts.id as cart_id')
        ->where('carts.user_id', $userId)
        ->get();
         
       if($products->count()>0){
        $sum = DB::table('carts')
        ->join('products','carts.product_id', '=', 'products.id')
        ->where('carts.user_id', $userId)
        ->sum('products.price');

       
        return view('carts.index',['products'=>$products],['sum'=>$sum], ['carts'=>$carts]);
       }else{
           return view('carts.empty');
       }
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

    public function remove($id)
    {
        Cart::destroy($id);
        return redirect('cart');
    }


    public function checkout(Type $var = null)
    {
        $userId =Auth::user()->id;
        $carts = Cart::where('user_id', $userId)->get();

        $products = DB::table('carts')
        ->join('products','carts.product_id',  'products.id')
        ->select('products.*','carts.id as cart_id')
        ->where('carts.user_id', $userId)
        ->get();
        
        

        if($products->count()>0){
            $subtotal = DB::table('carts')
                ->join('products','carts.product_id', '=', 'products.id')
                ->where('carts.user_id', $userId)
                ->sum('products.price');
            $total_shipping = DB::table('carts')
                ->join('products','carts.product_id', '=', 'products.id')
                ->where('carts.user_id', $userId)
                ->sum('products.shipping');

            $vat = DB::table('carts')
                ->join('products','carts.product_id', '=', 'products.id')
                ->where('carts.user_id', $userId)
                ->sum('products.vat');


            // 2 top discount
            $top = [1,2];
            $tops_count  = DB::table('carts')
                ->join('products','carts.product_id',  'products.id')
                ->select('products.*','carts.id as cart_id')
                ->where('carts.user_id', $userId)
                ->where('category_id','<=',2)
                ->count();
            $jaket = DB::table('carts')
                    ->join('products','carts.product_id', '=', 'products.id')
                    ->where('carts.user_id', $userId)
                    ->where('category_id','=',5)
                    ->sum('price');
            
            if($jaket){
                if($tops_count>=2){
                    $jaket_discount=($jaket * 50/100);
                }else{
                    $jaket_discount = 0;
                    $jaket = 0;
                }
            }

            // Shoes Discount
            $shoes = DB::table('carts')
                    ->join('products','carts.product_id', '=', 'products.id')
                    ->where('carts.user_id', $userId)
                    ->where('category_id','=',3)
                    ->sum('price');
            if($shoes){
                $shoes_discount = ($shoes * 10/100);
            }else{
                $shoes_discount = 0;
            }
                // return $shoes;
            //shipping discount
            if($products->count()>1){
            number_format($shipping_discount = ($total_shipping*10/100),2) ;
            }
            else{
                $shipping_discount = 0;
            }
            $total_discount= $shipping_discount+$shoes_discount+$jaket_discount;
            if($total_discount>0){
                $cond = true;
            }else{
                $cond = false;
            }
            //TOTAL_PRICE
            $total = ($subtotal+$vat+$total_shipping)-($shipping_discount+$shoes_discount+$jaket_discount);
            return view('carts.checkout', compact('products','subtotal','shipping_discount','vat','total_shipping', 'jaket_discount', 'shoes_discount', 'total', 'cond'));
       }else{
           return view('carts.empty');
       }
    }
}
