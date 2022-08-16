<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{
    public function getToken(Request $request)
    {
        $request->session()->reflash();
        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }
        return view('token.auth');
    }

    public function postToken(Request $request)
    {
        $request->validate([
            'token'=>'required'
        ]);

        if(! $request->session()->has('auth'))
        {
            return redirect(route('login'));
        }

        $user=User::FindOrFail($request->session()->get('auth.user_id'));
        $status=ActiveCode::verifyCode($request->token,$user);
        if(! $status){
            return redirect(route('login'));
        }
        if(auth()->loginUsingId($user->id,$request->session()->get('auth.remember'))){
            $user->activeCodes()->delete();
            return redirect('/profile');
        }
        return redirect(route('login'));
    }
}
