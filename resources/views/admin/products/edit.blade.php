@extends('admin.layouts.master')
@section('title','ویرایش محصول ')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">ویرایش محصول</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('products.update',['product'=>$product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام محصول</label>
                            <input type="text" class="form-control" value="{{ old('title' , $product->title) }}" name="title"  id="exampleInputEmail111" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail111">دسته بندی محصول</label>
                            <select class="form-control" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id,$product->categories()->pluck('id')->toArray())? 'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail12">متن محصول</label>
                            <input type="text" class="form-control" value="{{ old('text' ,$product->text) }}"  name="text" id="exampleInputEmail12" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">موجودی</label>
                            <input type="text" class="form-control" value="{{ old('amount' ,$product->amount) }}" name="amount" id="exampleInputPassword11">
                        </div>

                      <!--  <div class="form-group">
                            <label for="img">تصویر</label>
                            <input type="file" class="form-control"  name="img" id="img">
                        </div>-->

                        <div class="form-group">
                            <label for="exampleInputPassword12">قیمت</label>
                            <input type="text" class="form-control" value="{{ old('price' ,$product->price) }}" name="price" id="exampleInputPassword12" >
                        </div>

                        <div class="form-group">
                            @foreach($attributes as $attribute)
                                <label for="{{ $attribute->id }}">{{ $attribute->name }}</label>
                                <select name="attributeValues[]"  id="{{ $attribute->id }}" class="form-control" multiple>
                                    @foreach($attributeValues as $attributeValue)
                                        @if($attribute->id == $attributeValue->attribute_id)
                                            <option value="{{ $attribute->id }}-{{ $attributeValue->id }}" }}   {{ in_array($attributeValue->id,$product->attributesP()->pluck('values_id')->toArray())? 'selected':'' }} >{{ $attributeValue->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endforeach
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
