<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function home()
    {
        $user=Auth::user();
        $user=User::where('id',$user->id)->first();

        $favorites=Favorite::where('user_id',$user->id)->limit(2)->latest()->get();

        return view('profile.home',compact('user','favorites'));
    }

    public function twofactorauth()
    {
        return view('profile.twofactor');
    }

    public function sendtwofactorauth(Request $request)
    {
        $data=$request->validate([
            'type'=>'required|in:off,sms',
            'phone'=>['required_unless:type,off',Rule::unique('users','phone')->ignore($request->user()->id)]
        ]);
        //return $data;

        if($data['type']=='sms')
        {
            if($request->user()->phone != $data['phone'])
            {
                $code=ActiveCode::generateCode($request->user());
                $request->session()->flash('phone',$data['phone']);
                //return $code;
                return redirect(route('phoneVerify'));
            }
            else
            {
                //return redirect(route('phoneVerify'));
                $request->user()->update([
                    'two_factor_type'=>'sms'
                ]);
            }
            return back();
        }
        if($data['type']=='off'){

            $request->user()->update([
                'two_factor_type'=>'off'
            ]);
            return back();
        }
    }


    public function getPhoneVerify(Request $request)
    {
        $request->session()->reflash();
        return view('profile.phoneverify');
    }

    public function postPhoneVerify(Request $request)
    {
        $data=$request->validate([
            'token'=>'required'
        ]);

       $status=ActiveCode::verifyCode($request->token,$request->user());
       if($status){
           $request->user()->activeCodes()->delete();
           $request->user()->update([
               'two_factor_type'=>'sms',
               'phone'=>$request->session()->get('phone')
           ]);
           return back();
       }
       else
       {
           alert()->error('خطا','کد نادرست است')->persistent('متوجه شدم');
           return redirect(route('twofactor'));
       }
    }

    public function orders()
    {
        $user=Auth::user();
        $orders=Order::where('user_id',$user->id)->first();
        //dd($orders);
        if(isset($orders)){
            $carts=Cart::where('basket_id',$orders->basket_id)->get();
        }
        else
        {
            return back()->withErrors(['msg', 'سفارش خالی می باشد']);
        }
        return view('profile.orders',compact('orders','carts'));
    }
}
