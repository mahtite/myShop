<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    use orderBy;

    protected function filter(Request $request)
    {
        return $this->search($request);
    }



    public function showStatus(Request $request)
    {

        $categories = Category::all();
        $products = DB::table('Products')->where('status',$request->status)
            ->paginate(4);

        $productsV = Product::where('status',$request->status)->orderby('view', 'desc')->paginate(4);
        $productsN = Product::where('status',$request->status)->latest()->paginate(4);
        $productsP_a = Product::where('status',$request->status)->orderBy('price', 'asc')->paginate(4);
        $productsP_d = Product::where('status',$request->status)->orderBy('price', 'desc')->paginate(4);


        if (count($products) > 0) {
            return view('productsall', compact('products', 'productsN', 'productsV', 'productsP_a', 'productsP_d', 'categories'))->render();
        }
        else
        {
            return back();
        }
    }
}
