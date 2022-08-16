@extends('admin.layouts.master')
@section('title','ایجاد تصویر جدید')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">افزودن تصویر</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام محصول</label>
                            <select name="product" class="form-control" >
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail111">تصویر محصول</label>
                            <input type="file" class="form-control" name="img"  id="exampleInputEmail111" >
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">ثبت اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
