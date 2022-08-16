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
                    <form method="post" action="{{ route('products.update',['product'=>$product->id]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام محصول</label>
                            <input type="text" class="form-control" value="{{ old('title' , $product->title) }}" name="title"  id="exampleInputEmail111" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail12">متن محصول</label>
                            <input type="text" class="form-control" value="{{ old('text' ,$product->text) }}"  name="text" id="exampleInputEmail12" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">موجودی</label>
                            <input type="text" class="form-control" value="{{ old('amount' ,$product->amount) }}" name="amount" id="exampleInputPassword11">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword12">قیمت</label>
                            <input type="text" class="form-control" value="{{ old('price' ,$product->price) }}" name="price" id="exampleInputPassword12" >
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
