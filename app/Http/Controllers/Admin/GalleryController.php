<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleries=Gallery::orderby('id','desc')->paginate(3);
        //$galleries=Gallery::simplePaginate(2);
        return view('admin.gallery.all',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::all();
        return view('admin.gallery.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->hasFile('img'))
        {

        $request->validate([
           'product'=>'required',
           'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500']);

        $image = $request->img;
        $product = $request->product;

        $extension = $image->getClientOriginalExtension();
        $originalname = $image->getClientOriginalName();
        $originalname = md5($originalname . microtime()) . substr($originalname, -5, 5);
        $path = $image->move('uploads\products', $originalname);

        $imgProdct = Gallery::create([
            'product_id' => $product,
            'img' => $path
        ]);
    }

        $galleries=Gallery::latest()->paginate(3);
        toast()->info(' تصویر محصول  با موفقیت ایجاد شد');
        return view('admin.gallery.all',compact('galleries'));
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
     * @param Gallery $gallery
     * @return void
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Gallery $gallery
     * @return void
     */
    public function update(Request $request, Gallery $gallery)
    {
         $request->validate([
            'img'=>'nullable'
        ]);

        if (request()->hasFile('img'))
        {
            $request->validate([
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $image = $request->img;
            $extension = $image->getClientOriginalExtension();
            $originalname = $image->getClientOriginalName();
            $originalname = md5($originalname . microtime()) . substr($originalname, -5, 5);
            $path = $image->move('uploads\products', $originalname);
            unlink($gallery->img);

            $gallery->update([
                'img' => $path
            ]);
        }


        toast()->success('تصویر با موفقیت ویرایش شد');
        //$galleries=Gallery::latest()->paginate(3);
       // return view('admin.gallery.all', compact('galleries'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Gallery $gallery
     * @return void
     */
    public function destroy(Gallery $gallery)
    {
       /* unlink($gallery->img);
        $gallery->delete();
        toast()->success('حذف  انجام شد');
        return back();*/

    }
}
