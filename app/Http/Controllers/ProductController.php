<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products=Product::where('status',1)->paginate(4);
        $productsV=Product::orderBy('view','desc')->paginate(4);
        $productsN=Product::latest()->paginate(4);
        $productsP_a=Product::orderBy('price','asc')->paginate(4);
        $productsP_d=Product::orderBy('price','desc')->paginate(4);

        $sales=DB::table('order_product')
            ->leftJoin('products','order_product.product_id','=','products.id')
            ->groupBy('product_id')
            ->havingRaw('COUNT(product_id) > 1')
            ->orderBy('product_id','desc')
            ->get();


        $categories=Category::all();

        return view('productsall',compact('products','productsV','productsN','productsP_a','productsP_d','sales','categories'));

    }

    public function singleProduct(Product $product)
    {
        $this->seo()
            ->setTitle($product->metaTitle)
            ->setDescription($product->metaDescription);
        $categories=$product->categories()->get();

         $attributes=Attribute::all();
         $attributesV= $sales=DB::table('attribute_product')
            ->leftJoin('attributevalues','attribute_product.values_id','=','id')
            ->where('product_id',$product->id)
            ->get();

        $product->increment('view');

        $attributeValues=AttributeValue::where('attribute_id','1')->get();
        $comments=$product->comments()->where('approved','1')->get();
        return view('product-single',compact('product','comments','categories','attributes','attributeValues','attributesV'));
    }

    public function addFavoriteProduct(Product $product,Request $request)
    {


        $product=Product::findOrFail($request->product_id);
        // $products=Product::all();
        $countF=Favorite::countFavoriteList($request->product_id);

        if (auth()->check())
        {
            if($countF ==0 )
            {
                $favorites= Favorite::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->id
                ]);

                return response()->json(['success' => 's']);
            }
            else
            {
                return response()->json(['error'=>'err']);
            }
        }
        else {
            return back();
        }
    }

}
