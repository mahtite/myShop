@extends('admin.layouts.master')
@section('title','مدیریت محصولات')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">مدیریت محصولات</h4>
                                <a href="{{ route('products.create') }}" class="btn btn-success">ایجاد محصول جدید</a>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  نام محصول </th>
                                        <th> متن محصول</th>
                                        <th>قیمت</th>
                                        <th>موجودی</th>
                                        <th>تعداد بازدید</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($products)>0)
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->text }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->amount }}</td>
                                            <td>{{ $product->view }}</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('products.destroy',['product'=>$product->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                               <a href="{{ route('products.edit',['product'=>$product->id]) }}" class="btn btn-primary">ویرایش</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="page">
                                   {{ $products->links() }}
                                </div>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
@endsection
