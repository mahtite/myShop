@extends('admin.layouts.master')
@section('title','نظرات تایید نشده')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">نظرات تایید نشده</h4>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  نام نظر دهنده </th>
                                        <th> متن نظر</th>
                                        <th>مربوط به</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>{{ $comment->text }}</td>
                                            <td>
                                                @if($comment->commentable_type=='App\Models\Product')
                                                    محصولات
                                                @endif
                                            </td>
                                            <td>
                                                @if($comment->approved =='1')
                                                <span class="btn btn-success">تایید شده</span>
                                                @else
                                                <span class="btn btn-danger">تایید نشده</span>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('comments.destroy',['comment'=>$comment->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
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
