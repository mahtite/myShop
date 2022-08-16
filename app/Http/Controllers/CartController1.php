<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController1 extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        //$cart = $request->session()->get('cart');

        $carts=Cart::where('user_id',auth()->user()->id)->get();
        return view('cart',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product=Product::findOrFail($request->product_id);

        //$cart = $request->session()->get('cart');
        //dd($cart);

        $isCart=Cart::where('user_id',auth()->user()->id)->first();
        //dd($isCart['quantity']);
        $basket= Basket::where('user_id',auth()->user()->id)->where('isActive','=',1)->first();
        if(isset($basket))
        {
            $basket_id=$basket->id;

            Basket::where('user_id',auth()->user()->id)->update([
                'price' =>  ($request->quantity * $product->price) + $basket->price
            ]);
        }
        else
        {
            $basket=Basket::create([
                'user_id'=>auth()->user()->id,
                'price'=>$product->price * $request->quantity
            ]);
            $basket_id=$basket->id;
        }

        Cart::create([
            'user_id'=>auth()->user()->id,
            'product_id'=>$request->product_id,
            'basket_id'=>$basket_id,
            'quantity'=>$request->quantity,
            'values_id'=>$request->values_id
        ]);
        toast()->info('محصول به سبد خرید اضافه شد');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param Cart $cart
     * @return void
     */
    public function destroy(Cart $cart)
    {
        $basket= Basket::where('user_id',auth()->user()->id)->where('isActive','=',1)->first();

        if($cart->product->quantity== 1 ){
            Basket::where('user_id',auth()->user()->id)->update([
                'price'=>$basket->price - $cart->product->price
            ]);
        }
        else
        {
            Basket::where('user_id',auth()->user()->id)->update([
                'price'=> $basket->price-($cart->quantity * $cart->product->price)
            ]);
        }

        $cart->delete();
        // Basket::where('isActive',1)->where('user_id',auth()->user()->id)->delete();
        return back();
    }


    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity)
        {
            //$cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;

            //session()->put('cart', $cart);
            //session()->flash('success', 'Cart updated successfully');
        }
    }
}
