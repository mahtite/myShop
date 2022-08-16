<?php

namespace App\Http\Controllers;

use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Basket;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Sodium\increment;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->check()) {
            $carts = Cart::where('user_id', auth()->user()->id)->get();
            return view('cart', compact('carts'));
        }
        return back();
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

        $isCart = Cart::where('user_id', auth()->user()->id)->where('values_id',$request->values_id)
            ->where('product_id',$product->id)->first();

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

        if(isset($isCart)){
            $qty=$isCart['quantity'];
            $cart = Cart::where('user_id', auth()->user()->id)->where('values_id',$request->values_id)
                ->where('product_id',$product->id)->update([
               'quantity' => $request->quantity + $qty
           ]);
        }
        else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'basket_id' => $basket_id,
                'quantity' => $request->quantity,
                'values_id' => $request->values_id
            ]);
        }
        $qty=\Illuminate\Support\Facades\DB::table("carts")->where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");

        if ( !is_null($qty) )
        {
            session()->put('qty', $qty);
        }

       // toast()->info('محصول به سبد خرید اضافه شد');
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
     * @param \Illuminate\Http\Request $request
     * @param Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cart $cart)
    {
        $sump=0;
        $cart = Cart::findOrFail($cart->id);
        $cart->update([
            'quantity'    => $request->quantity ,
        ]);


        $basket= Basket::where('user_id',auth()->user()->id)->where('isActive','=',1)->first();
        $cartsx = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($cartsx as $carts)
        {
            $sump += $carts->quantity * $carts->product->price;
        }
        $basket->update([
            'price'=> $sump
        ] );

        $qty=Cart::where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");
        session()->put('qty',$qty);
        return  back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Cart $cart
     * @param Request $request
     * @return void
     */
    public function destroy(Cart $cart,Request $request)
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

        $cart= Cart::where('id',$cart->id)->where('user_id',auth()->user()->id)->delete();


        $qty=Cart::where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");
        session()->put('qty',$qty);
        $cart=Cart::where('user_id',auth()->user()->id)->get();
        if(count($cart) == 0)
        {
            $basket->delete();
        }

        return back();
    }
}
