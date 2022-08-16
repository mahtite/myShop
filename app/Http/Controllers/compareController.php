<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class compareController extends Controller
{


    public function compareProduct(Request $request,Product $product)
    {
           $product = Product::findOrFail($product->id);
           $products = Product::all();
           $categories = $product->categories()->get();
           return view('compare', compact('product', 'products', 'categories'));
    }


    public function getProduct($id)
    {
        $product=Product::find($id);
        $categories = $product->categories()->first();
        $img = Gallery::where('product_id', $product->id)->first();

        $data = ['output' => $product, 'pic' => $img, 'cat' => $categories];
        return response()->json($data);
    }

}
