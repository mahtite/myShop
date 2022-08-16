@extends('admin.layouts.master')
@section('title','ویرایش دسترسی ')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ویرایش دسترسی </h4>
                                @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach( $errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="{{ route('permissions.update',['permission'=>$permission->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="exampleInputEmail111">نام دسترسی</label>
                                            <input type="text" class="form-control" value="{{ $permission->name }}" name="name"  id="exampleInputEmail111" >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail111">توضیح دسترسی</label>
                                            <input type="text" class="form-control" value="{{ $permission->description }}" name="description"  id="exampleInputEmail111" >
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">ویرایش اطلاعات</button>
                                    </form>
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->

                    <div class="col-6 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست دسترسی ها</h4>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  نام دسترسی  </th>
                                        <th>  توضیح دسترسی  </th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->description }}</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('permissions.destroy',['permission'=>$permission->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                                <a href="{{ route('permissions.edit',['permission'=>$permission->id]) }}" class="btn btn-primary">ویرایش</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
@endsection
