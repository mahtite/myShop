@extends('admin.layouts.master')
@section('title','مدیریت گالری')

@section('content')

    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">مدیریت گالری</h4>
                                <a href="{{ route('gallery.create') }}" class="btn btn-success">ایجاد گالری جدید</a>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  نام محصول  </th>
                                        <th>  تصویر محصول  </th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($galleries)>0)
                                    @foreach($galleries as $gallery)
                                        <tr>
                                            <td>{{ $gallery->product->title }}</td>
                                            <td>
                                                <img src="/{{ $gallery->img }}" width="80px">
                                            </td>
                                            <td class="d-flex">
                                                <form method="" action="#">
                                                  <!--csrf
                                                    method('delete')-->
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                                &nbsp;
                                               <a href="{{ route('gallery.edit',['gallery'=>$gallery->id]) }}" class="btn btn-primary">
                                                   <i class="fa fa-edit"></i>
                                               </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="page">
                            {{ $galleries->links() }}
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
