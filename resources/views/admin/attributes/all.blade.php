@extends('admin.layouts.master')
@section('title','مدیریت ویژگی ها')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">مدیریت ویژگی ها</h4>
                                <a href="{{ route('attributes.create') }}" class="btn btn-success">ایجاد ویژگی جدید</a>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  نام ویژگی  </th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($attributes as $attribute)
                                        <tr>
                                            <td>{{ $attribute->name }}</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('attributes.destroy',['attribute'=>$attribute->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                               <a href="{{ route('attributes.edit',['attribute'=>$attribute->id]) }}" class="btn btn-primary">ویرایش</a>
                                                <a href="{{ route('get.values',['attribute'=>$attribute->id]) }}" class="btn btn-success">افزودن مقدار</a>

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
