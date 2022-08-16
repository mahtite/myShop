<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    use TwoFactorType;

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback(Request $request)
    {

       try
        {
            $googleUser=Socialite::driver('google')->stateless()->user();
            //dd($googleUser);
            $user=User::where('email',$googleUser->email)->first();
            if(!$user)
            {
                $user=User::create([
                    'name'=>$googleUser->name,
                    'email'=>$googleUser->email,
                    'password'=>bcrypt(Str::random(16))
                ]);

                auth()->loginUsingId($user->id);
                return redirect('/');
            }
            else
                {
                auth()->loginUsingId($user->id);
                return $this->LoggedIn($request, $user) ?: redirect(route('login'));
            }

           /* if($user)
            {
                auth()->loginUsingId($user->id);
                //dd($googleUser->email);
            }
            else
            {
                $newUser=User::create([
                    'name'=>$googleUser->name,
                    'email'=>$googleUser->email,
                    'password'=>bcrypt(Str::random(16))
                ]);
                auth()->loginUsingId($newUser->id);
            }
            return redirect('/');*/
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
}
