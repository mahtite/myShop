<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\PurchaseFailedException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

use Exception;
use SoapFault;

class PurchaseController extends Controller
{
    public function purchase($id)
    {
        $user=Auth::user();
        $basket=Basket::findOrFail($id);
        $basketExist=Order::where('user_id',Auth::id())->where('basket_id',$basket->id)->first();
        if($basketExist){
            return 'این سبد قبلا پرداخت شده است';
        }

        try{
            $invoice=new Invoice();
            $invoice->amount($basket->price);
            $invoice->detail('موبایل کاربر',$user->mobile);
            $paymentId=md5(uniqid());
            $transaction=Transaction::create([
                'user_id'=>$user->id,
                'basket_id'=>$basket->id,
                'paid'=>$invoice->getAmount(),
                'invoice_details'=>$invoice,
                'payment_id'=>$paymentId
            ]);
            $callbackUrl=route('payment.product.result',[$basket->id,'payment_id'=>$paymentId]);
            $payment=Payment::callbackUrl($callbackUrl);
            $payment->config('description',$user->name);
            $payment->purchase($invoice,function ($driver,$transactionId) use ($transaction){
                $transaction->transaction_id=$transactionId;
                $transaction->save();
            });
            return $payment->pay()->render();
        }
        catch (Exception|PurchaseFailedException|SoapFault $e){
            $transaction->transaction_result=[
                $e->getMessage(),
                $e->getCode()
            ];
            $transaction->status=Transaction::STATUS_FAILED;
            $transaction->save();
           return "خطایی در پرداخت بوجود آمد ";
        }
    }

    public function result(Request $request, $id)
    {
        $basket=Basket::findOrFail($id);

        if($request->missing('payment_id')){
            return 'خطایی در پرداخت بوجود آمد';
        }

        $transaction=Transaction::where ('payment_id',$request->payment_id)->first();
        //dd($transaction);
        if(empty($transaction)){
            return 'خطایی در پرداخت بوجود آمد';
        }

        if($transaction->user_id !== Auth::id()){
            return 'خطایی در پرداخت بوجود آمد';
        }
        if($basket->id !== $transaction ->basket_id){
            return 'خطایی در پرداخت بوجود آمد';
        }

        if($transaction -> status !== Transaction::STATUS_PENDING){
            return 'خطایی در پرداخت بوجود آمد';
        }

    try{

            $receipt=Payment::amount($transaction->paid)
                ->transactionId($transaction->transaction_id)
                ->verify();
            $transaction->transaction_result=$receipt;
            $transaction->status=Transaction::STATUS_SUCCESS;
            $transaction->save();
            $user=Auth::user();
            $order=Order::create([
                'user_id'=>$user->id,
                'basket_id'=>$basket->id,
                'price'=>$basket->price,
                'status'=>'paid',
            ]);

        $products=Cart::where('basket_id',$basket->id)->where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
        $order->products()->attach($products);

          $basket->update(['isActive' => 0]);
          $cart=Cart::where('basket_id',$basket->id)->where('user_id',Auth::user()->id);
          $cart->update(['status' =>0]);


          return 'پرداخت با موفقیت انجام شد';
        }
        catch (Exception|InvalidPaymentException $e){
            if($e->getCode()<0){
                $transaction->status=Transaction::STATUS_FAILED;
                $transaction->transaction_result=[
                    'message'=>$e->getMessage(),
                    'code'=>$e->getCode()
                ];
                $transaction->save();
            }
            return 'خطایی در پرداخت بوجود آمد';
        }
    }
}
