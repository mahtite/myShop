<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes=Attribute::all();
        return  view('admin.attributes.all',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        Attribute::create($request->all());

        $attributes=Attribute::all();
        toast()->success('ثبت ویژگی با موفقیت انجام شد');
        return  view('admin.attributes.all',compact('attributes'));
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
     * @param Attribute $attribute
     * @return void
     */
    public function edit(Attribute $attribute)
    {
        return  view('admin.attributes.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate(['name'=>'required']);
       $attribute->update($request->all());

        $attributes=Attribute::all();
        toast()->success('ویرایش ویژگی با موفقیت انجام شد');
        return  view('admin.attributes.all',compact('attributes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return void
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        toast()->success(' ویژگی با موفقیت حذف شد');
        return back();
    }

    public function getValues(Attribute $attribute)
    {
        $values=AttributeValue::where('attribute_id',$attribute->id)->get();
        return  view('admin.attributes.values',compact('attribute','values'));
    }

    public function postValues(Request $request)
    {
        $request->validate(['value' =>'required']);
        AttributeValue::create($request->all());
        toast()->success('ثبت با موفقیت انجام شد');
        return back();
    }

    public function editValue(AttributeValue $attributeValue)
    {
        return  view('admin.attributes.editValues',compact('attributeValue'));
    }
    public function updateValue(Request $request,AttributeValue $attributeValue)
    {
        $request->validate(['value'=>'required']);
        $attributeValue->update($request->all());

        $attributeValues=AttributeValue::all();
        toast()->success('ویرایش با موفقیت انجام شد');
        return  view('admin.attributes.editValues',compact('attributeValue','attributeValues'));
    }


    public function deleteValue(AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        toast()->success('حذف با موفقیت انجام شد');
        return back();
    }

}
