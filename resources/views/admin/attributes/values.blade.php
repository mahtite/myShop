@extends('admin.layouts.master')
@section('title','ایجاد مقدار جدید')
@section('content')
    <div class="row">
        <div class="col-xl-6 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">افزودن مقدار برای ویژگی ({{ $attribute->name }})</h4>
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach( $errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form method="post" action="{{ route('post.values') }}">
                            @csrf
                            <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">

                            <div class="form-group">
                                <label for="exampleInputEmail111">نام مقدار</label>
                                <input type="text" class="form-control" value="{{ old('value') }}" name="value"  id="exampleInputEmail111" >
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">ثبت اطلاعات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 box-margin height-card">
            <div class="card card-body">
                <h4 class="card-title">مقادیر برای ویژگی ({{ $attribute->name }})</h4>
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  آیدی مقدار  </th>
                                        <th>  نام مقدار  </th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($values as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->value }}</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('delete.values' ,['attributeValue'=>$value->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                                <a href="{{ route('edit.values',['attributeValue'=>$value->id]) }}" class="btn btn-primary">ویرایش</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            </div>
        </div>
    </div>
@endsection
