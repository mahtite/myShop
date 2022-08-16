<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {

        /* $this->seo()
             ->setTitle('لاراول لرن')
             ->setDescription('دوره آموزشی پروژه محور هیولای لارول .......');*/

        $productsN=Product::latest()->get();
        $productsView=Product::orderBy('view','desc')->get();


        $productCategory = Category::with('products')->findOrFail(1);
        $productCategory = $productCategory->products;


        $productCategoryLaptop = Category::with('products')->findOrFail(2);
        $productCategoryLaptop = $productCategoryLaptop->products;

        /*****************************************************************************/

        //$sales = DB::table('orders')
        //  ->select("products.id", "products.title",DB::raw('COUNT(orders.*) as product_id'))
        // ->leftJoin('products','orders.product_id','=','products.id')
        //->groupBy('product_id')
        // ->having('product_id', '>', 1)
        // ->havingRaw('COUNT(product_id) > 1')
        // ->orderBy('product_id','desc')
        //->get();

        /**********************************************************************************/

        $sales=DB::table('order_product')
            ->leftJoin('products','order_product.product_id','=','products.id')
            ->groupBy('product_id')
            ->havingRaw('COUNT(product_id) > 1')
            ->orderBy('product_id','desc')
            ->get();
       // return view('home');
        return view('home',compact('productsN','sales','productsView','productCategory','productCategoryLaptop'));

    }


}
