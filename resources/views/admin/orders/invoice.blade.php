@extends('admin.layouts.master')
@section('title','نمایش فاکتور')
@section('content')

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                               @if(isset($isOrders))

                                    <div class="col-sm-12 col-xs-12">
                                        <form method="post" action="{{ route('invoice.Status',$basket_id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success mr-2">تغییر وضعیت سفارشات </button>
                                        </form>
                                        <button type="submit" class="btn btn-info mr-2">پرینت اطلاعات </button>
                                        <a href="{{ route('infoCopy',$basket_id) }}" class="btn btn-warning mr-2">کپی اطلاعات </a>
                                    </div>
                                @endif

                            <div class="table-responsive mb-4">
                                <table class="table m-0">
                                    <thead>
                                    <tr>

                                        <th class="py-3">
                                            نام کاربر
                                        </th>

                                        <th class="py-3">
                                           نام محصول
                                        </th>
                                        <th class="py-3">
                                            تعداد
                                        </th>
                                        <th class="py-3">
                                            قیمت
                                        </th>
                                        <th class="py-3">
                                            مبلغ کل
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td class="py-3">
                                               {{ $cart->user->name }}
                                            </td>
                                            <td class="py-3">
                                                {{ $cart->product->title }}
                                            </td>
                                            <td class="py-3">
                                                @if($cart->quantity==1)
                                                    1
                                                @else
                                                {{ $cart->quantity }}
                                               @endif
                                            </td>
                                            <td class="py-3">
                                               {{ number_format($cart->product->price) }} تومان
                                            </td>
                                            <td class="py-3">
                                                @if($cart->quantity==1)
                                                    {{ $cart->product->price }} تومان
                                                @else
                                                    {{ $cart->product->price * $cart->quantity }}تومان
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $('.btn-info').click(function () {
            window.print();
        })
    </script>
@endsection
