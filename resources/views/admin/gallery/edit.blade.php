@extends('admin.layouts.master')
@section('title','ویرایش تصاویر ')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">ویرایش تصاویر</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('gallery.update',['gallery'=>$gallery->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="img">انتخاب تصویر</label>
                            <input type="file" class="form-control"  name="img" id="img" >
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">ویرایش </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
