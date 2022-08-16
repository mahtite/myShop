@extends('admin.layouts.master')
@section('title','ویرایش کاربر ')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">ویرایش کاربر</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('users.update',['user'=>$user->id]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام کاربری</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail111" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail12">آدرس ایمیل</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail12" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">کلمه عبور</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword11">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword12">کلمه عبور</label>
                            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword12">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
