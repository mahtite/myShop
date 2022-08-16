@extends('admin.layouts.master')
@section('title','ایجاد محصول جدید')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">افزودن محصول</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام محصول</label>
                            <input type="text" class="form-control" value="{{ old('title') }}" name="title"  id="exampleInputEmail111" >
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail111">دسته بندی محصول</label>
                            <select class="form-control" name="categories[]" multiple>
                               @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail12">متن محصول</label>
                            <input type="text" class="form-control" value="{{ old('text') }}"  name="text" id="exampleInputEmail12" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">موجودی</label>
                            <input type="text" class="form-control" value="{{ old('amount') }}" name="amount" id="exampleInputPassword11">
                        </div>

                        <div class="form-group">
                            <label for="img"> گالری تصاویر</label>
                            <input type="file" class="form-control"  name="images[]" multiple id="img"  onchange="javascript:updateList()">
                        </div>
                        <!--<p>Selected files:</p>
                        <div id="fileList"></div>-->

                        <div class="form-group">
                            <label for="exampleInputPassword12">قیمت</label>
                            <input type="text" class="form-control" value="{{ old('price') }}" name="price" id="exampleInputPassword12" >
                        </div>

                        <div class="form-group">
                            @foreach($attributes as $attribute)
                                <label for="{{ $attribute->id }}">{{ $attribute->name }}</label>
                                <select name="attributeValues[]"  id="{{ $attribute->id }}" class="form-control" multiple>
                                    @foreach($attributeValues as $attributeValue)
                                        @if($attribute->id == $attributeValue->attribute_id)
                                            <option value="{{ $attribute->id }}-{{ $attributeValue->id }}">{{ $attributeValue->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword12">متا تایتل</label>
                            <input type="text" class="form-control" value="{{ old('metaTitle') }}" name="metaTitle" id="exampleInputPassword12" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword12">متا دسکریپشن</label>
                            <input type="text" class="form-control" value="{{ old('metaDescriptoin') }}" name="metaDescriptoin" id="exampleInputPassword12" >
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">ثبت اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        updateList = function() {
            var input = document.getElementById('img');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML = '<ul>'+children+'</ul>';
        }
    </script>
@endsection
