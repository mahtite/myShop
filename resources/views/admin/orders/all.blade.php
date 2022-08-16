@extends('admin.layouts.master')
@section('title','لیست سفارشات')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست سفارشات</h4>
                                <a href="{{ route('charts') }}">پرفروشترین محصولات رو نمودار</a>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>  شماره </th>
                                        <th>  کد سفارش </th>
                                        <th>  نام کاربر </th>
                                        <th>  وضعیت پرداخت</th>
                                        <th>  وضعیت ارسال</th>
                                        <th>  مبلغ سفارش </th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                      $i= 1;
                                    @endphp
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>
                                                @if($order->status =='paid')
                                                    <span class="badge badge-success">پرداخت شده</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->delivery ==0)
                                                    <span class="badge badge-danger">درحال پردازش</span>
                                                @else
                                                    <span class="badge badge-success">تحویل شده</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($order->price) }} تومان</td>
                                            <td class="d-flex">
                                                <form method="post" action="{{ route('orders.destroy',['order'=>$order->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('آیا برای حذف اطمینان دارید؟')">حذف</button>
                                                </form>
                                               <a href="{{ route('invoiceShow',$order->basket_id) }}" class="btn btn-primary">نمایش فاکتور</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
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
