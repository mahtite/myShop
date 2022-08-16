@extends('admin.layouts.master')
@section('title','ایجاد کاربر جدید')
@section('content')
    <div class="col-xl-6 box-margin height-card">
        <div class="card card-body">
            <h4 class="card-title">افزودن کاربر</h4>
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach( $errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail111">نام کاربری</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail111" placeholder="نام">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail12">آدرس ایمیل</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail12" placeholder="ایمیل">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword11">کلمه عبور</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword11" placeholder="رمز عبور">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword12">کلمه عبور</label>
                            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword12" placeholder="تکرار رمز عبور">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">ثبت اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
