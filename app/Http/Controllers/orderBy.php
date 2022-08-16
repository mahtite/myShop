<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

trait orderBy
{
    public function search(Request $request)
    {

        if ($request->get('search'))
        {
            $search = $request->get('search');

            $categories = Category::all();

            $products = Product:: where('title', 'like', '%' . $search . '%')->get();
            $productsV =  Product:: where('title', 'like', '%' . $search . '%')->orderby('view', 'desc')->get();
            $productsN =  Product:: where('title', 'like', '%' . $search . '%')->orderby('id','desc')->get();
            $productsP_a =  Product:: where('title', 'like', '%' . $search . '%')->orderBy('price', 'asc')->get();
            $productsP_d = Product:: where('title', 'like', '%' . $search . '%')->orderBy('price', 'desc')->get();


            if (count($products) > 0)
            {

                return view('productsall', compact('products','productsV','productsN','productsP_a','productsP_d', 'categories'));
            }
            else {

                $products = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')->where('name', 'LIKE', "%$search%")
                    ->select('products.id', 'products.title', 'products.price')
                    ->get();

                $productsV=Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')->where('name', 'LIKE', "%$search%")
                    ->select('products.id', 'products.title', 'products.price')
                    ->orderby('view', 'desc')->get();


                $productsN=Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')->where('name', 'LIKE', "%$search%")
                    ->select('products.id', 'products.title', 'products.price')
                    ->orderby('id', 'desc')->get();


                $productsP_a =Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')->where('name', 'LIKE', "%$search%")
                    ->select('products.id', 'products.title', 'products.price')
                    ->orderBy('price', 'asc')->get();

                $productsP_d =Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')->where('name', 'LIKE', "%$search%")
                    ->select('products.id', 'products.title', 'products.price')
                    ->orderBy('price', 'desc')->get();


                return view('productsall', compact('products','productsN','productsV','productsP_a','productsP_d', 'categories'));

            }
        }
        else {
            return back();
        }
    }

}
