<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function sendcomment(Request $request)
    {
        //dd($request->all());
        $request->validate(['text'=>'required']);
        $request['user_id']=auth()->user()->id;
        $c= Comment::create($request->all());
        //dd($c);
        return back();
    }
}
