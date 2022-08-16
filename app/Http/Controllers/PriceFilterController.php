<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PriceFilterController extends Controller
{
    public function productshop(Request $request)
    {
        #Get minimum and maximum price to set in price filter range
        $min_price = Product::min('price');
        $max_price = Product::max('price');
        //dd('Minimum Price value in DB->'.$min_price,'Maximum Price value in DB->'.$max_price);

        #Get filter request parameters and set selected value in filter
        $filter_min_price = $request->min_price;
        $filter_max_price = $request->max_price;

        #Get products according to filter
        if($filter_min_price && $filter_max_price){
            if($filter_min_price >0 && $filter_max_price >0)
            {

                $categories = Category::all();
                $products = Product::select('id','title','text','price')->whereBetween('price',[$filter_min_price,$filter_max_price])->get();
                $productsV = Product::select('id','title','text','price')->whereBetween('price',[$filter_min_price,$filter_max_price])->orderby('view','desc')->paginate(4);
                $productsN = Product::select('id','title','text','price')->whereBetween('price',[$filter_min_price,$filter_max_price])->latest()->get();
                $productsP_a = Product::select('id','title','text','price')->whereBetween('price',[$filter_min_price,$filter_max_price])->orderby('price','asc')->get();
                $productsP_d = Product::select('id','title','text','price')->whereBetween('price',[$filter_min_price,$filter_max_price])->orderby('price','desc')->get();
            }
        }
        #Show default product list in Blade file
        else{
            $categories = Category::all();

            $products = Product::select('id','title','text','price')->get();
            $productsV = Product::select('id','title','text','price')->orderby('view','desc')->get();
            $productsN = Product::select('id','title','text','price')->latest()->get();
            $productsP_a = Product::select('id','title','text','price')->orderby('price','asc')->get();
            $productsP_d = Product::select('id','title','text','price')->orderby('price','desc')->get();


        }
      //  return view('productsall',compact('products','min_price','max_price','filter_min_price','filter_max_price'));

        return view('productsall',compact('products','categories','productsV','productsN','productsP_a','productsP_d','min_price','max_price','filter_min_price','filter_max_price'));

    }
}
