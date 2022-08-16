@extends('admin.layouts.master')
@section('title','مدیریت کاربران')

@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">مدیریت کاربران</h4>

                                <!----------------------------Search------------------------>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <input type="text" class="form-controller" id="search" name="search"></input>
                                        </div>
                                        <table class="table x table-striped dt-responsive" style="display: none">
                                            <thead >
                                            <tr>
                                                <th>ردیف</th>
                                                <th> نام</th>
                                                <th>تلفن</th>
                                                <th>ایمیل</th>
                                            </tr>
                                            </thead>
                                            <tbody class="tbody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!----------------------------Search------------------------>

                                <a href="{{ route('users.create') }}" class="btn btn-success">ایجاد کاربر جدید</a>

                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>ایمیل</th>
                                        <th>وضعیت ایمیل</th>
                                        <th>نقش کاربری</th>
                                        <th>شماره تماس</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->email_verified_at)
                                                    <span class="btn btn-success">فعال</span>
                                                @else
                                                     <span class="btn btn-danger">غیر فعال</span>
                                               @endif
                                            </td>
                                            <td>
                                                @if($user->is_admin)
                                                    <span class=" btn btn-success">مدیر</span>
                                                @elseif($user->is_operator)
                                                    <span class="btn btn-primary">اپراتور</span>
                                                @else
                                                    <span class="btn btn-danger">کاربر عادی</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('users.destroy',['user'=>$user->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                               <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-primary">ویرایش</a>
                                                <a href="{{ route('users.roles',['user'=>$user->id]) }}" class="btn btn-success">دسترسی</a>

                                            </td>
                                        </tr>
                                        @php
                                            $i++
                                        @endphp
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

@section('script')
    <script type="text/javascript">

        $('#search').on('keyup',function(){

            $value=$(this).val();

            if($value .length >0)
            {

                $.ajax({
                    type: 'get',
                    url: '',
                    data: {'search': $value},
                    success: function (data)
                    {


                        $(".x").css("display","inline-table");
                        $('.tbody').html(data);
                    }
                });
            }
            else
            {
                $('.x').css("display","none");
            }
        })


    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection
