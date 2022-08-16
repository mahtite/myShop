<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('can:orders-all,user')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return view('admin.orders.all',compact('orders'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return void
     */
    public function destroy(Order $order)
    {
        $order->delete();
        Basket::where('id',$order->basket_id)->where('user_id',auth()->user()->id)->delete();
        toast()->info('حذف انجام شد');
        return back();
    }

    public function invoiceShow($id)
    {
        $carts=Cart::where('basket_id',$id)->get();
        //dd($carts);
        $isOrders=Order::where('basket_id',$id)->where('delivery',0)->first();

        $basket_id=$id;
        return view('admin.orders.invoice',compact('carts','isOrders','basket_id'));
    }

    public function invoiceStatus($id)
    {

        //dd($id);
        $orders=Order::where('basket_id',$id)->first();
        //dd($Orders);
        $orders->update([
            'delivery'=>1
        ]);
        return back();
    }

    public function copy($id)
    {
       // dd($id);
        $carts=Cart::where('basket_id',$id)->first();
        //dd($carts);
        $newCart = $carts->replicate();
        $newCart->created_at = Carbon::now();
        $newCart->save();
        return back();
    }
}
