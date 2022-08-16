<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeProduct;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','auth.admin']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $products=Product::orderby('id','desc')->paginate(4);
        return view('admin.products.all',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $attributes=Attribute::all();
        $attributeValues=AttributeValue::all();
        return  view('admin.products.create',compact('categories','attributes','attributeValues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id']=auth()->user()->id;
        $data=$request->validate([
            'title' => 'required|min:3',
            'text' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'categories'=>'required',
            'attributeValues'=>'required',
            'user_id'=>'required',
            'metaTitle'=>'nullable',
            'metaDescription'=>'nullable',
            'images'=>'required',
            'images.*'=>'image | max:200'
        ]);

        $product = Product::create($data);

        if ($request->hasfile('images'))
        {
            $images=$request->file('images');
            foreach ($images as $image) {
                $extension =$image->getClientOriginalExtension();
                $fileName =$image->getClientOriginalName();
                $originalname = md5($fileName . microtime()) . substr($fileName, -5, 5);
                $path = $image->move('uploads\products', $originalname);
                Gallery::create([
                    'product_id' => $product->id,
                    'img'=>$path
                ]);
            }
        }

        $product->categories()->sync($data['categories']);

        $attributeValues = $request->attributeValues;

        $data=[];
        foreach ($attributeValues as $attributeValue) {
            $add = [];
            $attributeForProduct = explode('-', $attributeValue);
                //$c=$product->attributes()->attach($attributeForProduct[0], ['values_id' => $attributeForProduct[1]]);
            $add['attribute_id'] = $attributeForProduct[0];
            $add['values_id'] =$attributeForProduct[1];

            $data[] = $add ;
           }
        $product->attributes()->sync($data );

        $products=Product::latest()->paginate(4);
        toast()->info('محصول جدید با موفقیت ایجاد شد');
        return view('admin.products.all',compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,Request $request)
    {

        $categories=Category::all();
        $attributes=Attribute::all();
        $attributeValues=AttributeValue::all();
        return  view('admin.products.edit' ,compact('product','categories','attributes','attributeValues'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'text' => 'required',
            'amount' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'img' => 'nullable'
        ]);

      /*  if (request()->hasFile('img') && request('img') != '')
        {
             $request->validate([
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
             $image = $request->img;
            $extension = $image->getClientOriginalExtension();
            $originalname = $image->getClientOriginalName();
            $originalname=md5($originalname . microtime()) . substr($originalname, -5, 5);
            $path = $image->move('uploads\products', $originalname);
            unlink($product->img);

            $attributeValues = $request->attributeValues;
            $product->update($data);
            foreach ($attributeValues as $attributeValue)
            {
                $attributeForProduct = explode('-', $attributeValue);
                //dd($attributeForProduct);
                $product->attributes()->sync([$attributeForProduct[0] => ['values_id' => $attributeForProduct[1]]]);
            }
            $product->categories()->sync($data['categories']);
            $product->update([
                'img' => $path
            ]);
        }*/
      //  else
       // {

        $product->update($data);
        $product->categories()->sync($data['categories']);

        //$products = Product::latest()->paginate(4);

        toast()->success('ویرایش محصول با موفقیت انجام شد');
        return back();
       // return view('admin.products.all', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        $gallery=Gallery::where('product_id',$product->id)->get();
        foreach ($gallery as $g){
            $g->delete();
            unlink($g->img);
        }
        $product->delete();
        toast()->success('حذف محصول با موفقیت انجام شد');
        return back();
    }
}
