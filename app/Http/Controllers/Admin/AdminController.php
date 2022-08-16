<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        /*if(!Auth::user())
        {
            return redirect(); // add your desire URL in redirect function
        }*/
        $this->middleware(['auth','verified','auth.admin']);
    }

    public function index(){
        //$user=Auth::user()->id;
        $user=Auth::user();
        $user=User::where('id',$user->id)->first();
        return view('admin.index',compact('user'));
    }
}
