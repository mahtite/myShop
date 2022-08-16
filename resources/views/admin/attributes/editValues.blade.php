@extends('admin.layouts.master')
@section('title','ویرایش مقدار ')
@section('content')
    <div class="row">
        <div class="col-xl-6 box-margin height-card">
            <div class="card card-body">
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach( $errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form method="post" action="{{ route('update.values',$attributeValue->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="exampleInputEmail111">نام مقدار</label>
                                <input type="text" class="form-control" value="{{ old('value',$attributeValue->value) }}" name="value"  id="exampleInputEmail111" >
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
