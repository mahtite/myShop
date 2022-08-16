@extends('layouts.master')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/front/assets/css/cart.css">
@endsection
@section('content')

    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="cart-page-content col-xl-9 col-lg-8 col-md-12 order-1">
                    <div class="cart-page-title">
                        <h1>سبد خرید</h1>
                    </div>
                    <div class="table-responsive checkout-content default">
                        <table class="table table-striped" id="cart">

                            <thead>
                            <tr>
                                <td>محصول</td>
                                <td>قیمت</td>
                                <td>تعداد</td>
                                <td></td>
                                <td>جمع کل</td>
                                <td></td>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                $sumPrice=0;
                                $qty=0;
                            @endphp
                            @foreach($carts as $cart)
                                @php
                                    $products=\Illuminate\Support\Facades\DB::table('products')->where('id',$cart->product_id)->first();
                                     $isBasket=$cart->basket_id;
                                     $isBasket=\Illuminate\Support\Facades\DB::table('baskets')->where('id',$isBasket)->where('isActive',1)->first();
                                @endphp
                                @if(isset($isBasket))
                                    <tr class="checkout-item" data-id="{{ $cart->id }}">
                                        @php
                                            $sumPrice+= $cart->quantity == 1 ? $products->price : $cart->quantity * $products->price;
                                            $qty=\Illuminate\Support\Facades\DB::table("carts")->where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");
                                            $gallery=\App\Models\Gallery::where('product_id',$products->id)->first();

                                        @endphp
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="\{{ $gallery->img }}" alt="">
                                                </div>
                                                <div class="col-md-9">
                                                    <h3 class="checkout-title">
                                                        {{ $products->title }}
                                                    </h3>
                                                    رنگ
                                                    {{ $cart->values->value }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ number_format($products->price) }}تومان
                                        </td>


                                           <form method="post" action="{{ route('carts.update',$cart->id) }}">
                                                @csrf
                                                @method('patch')
                                                   <td>
                                                    <div class="qty">
                                                        <input type="number" value="{{ $cart->quantity }}" id="" min="1" step="1" class=" quantity update-cart"  name="quantity"/>
                                                    </div>
                                                   </td>
                                                   <td>
                                                    <button class="btn-primary btn-edit" title="بروزرسانی">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                    </button>
                                                   </td>
                                                   <td>
                                                       {{ $cart->quantity == 1 ? number_format($products->price) : number_format($cart->quantity * $products->price )  }} تومان
                                                   </td>
                                            </form>

                                        <td>
                                            <form method="post" action="{{ route('carts.destroy',$cart->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn-danger checkout-btn-remove" title="حذف"></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                            @empty($isBasket)

                                <div class="txtmessage">سبد خرید خالی می باشد</div>
                            @endif
                        </table>
                    </div>
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside">
                        <div class="checkout-summary">
                            <div class="checkout-summary-main">
                                <ul class="checkout-summary-summary">
                                    <li><span>({{ $qty }})کالا
                                            مبلغ کل
                                        </span><span>{{ number_format($sumPrice) }} تومان</span></li>
                                    <li>
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>وابسته به آدرس<span class="wiki wiki-holder"><span
                                                    class="wiki-sign"></span>
                                                    <div class="wiki-container js-dk-wiki is-right">
                                                        <div class="wiki-arrow"></div>
                                                        <p class="wiki-text">
                                                            هزینه ارسال مرسولات می‌تواند وابسته به شهر و آدرس گیرنده
                                                            متفاوت باشد. در
                                                            صورتی که هر
                                                            یک از مرسولات حداقل ارزشی برابر با ۱۰۰هزار تومان داشته باشد،
                                                            آن مرسوله
                                                            بصورت رایگان
                                                            ارسال می‌شود.<br>
                                                            "حداقل ارزش هر مرسوله برای ارسال رایگان، می تواند متغیر
                                                            باشد."
                                                        </p>
                                                    </div>
                                                </span></span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value">
                                        <span class="checkout-summary-price-value-amount">{{ number_format($sumPrice) }}</span>تومان
                                    </div>


                                    @php
                                        $basket=\Illuminate\Support\Facades\DB::table('baskets')->where('user_id',auth()->user()->id)->where('isActive','=',1)->first();
                                        if(isset($basket)){
                                    @endphp
                                    <a href="{{ route('payment.product',$basket->id) }}" class="selenium-next-step-shipping">
                                        @php
                                            }else{
                                        @endphp
                                        <a  class="selenium-next-step-shipping" style="opacity: .4;">
                                            @php
                                                }
                                            @endphp

                                            <div class="parent-btn">
                                                <button class="dk-btn dk-btn-info">
                                                    ادامه ثبت سفارش
                                                    <i class="now-ui-icons shopping_basket"></i>
                                                </button>
                                            </div>
                                        </a>
                                        <div>
                                            <span>
                                                کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی
                                                را تکمیل
                                                کنید.
                                            </span>
                                            <span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                                <div class="wiki-container is-right">
                                                    <div class="wiki-arrow"></div>
                                                    <p class="wiki-text">
                                                        محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش
                                                        برای شما رزرو
                                                        می‌شوند. در
                                                        صورت عدم ثبت سفارش، تاپ کالا هیچگونه مسئولیتی در قبال تغییر
                                                        قیمت یا موجودی
                                                        این کالاها
                                                        ندارد.
                                                    </p>
                                                </div>
                                            </span>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-feature-aside">
                            <ul>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-guarantee">
                                    هفت روز
                                    ضمانت تعویض
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-cash">
                                    پرداخت در محل با
                                    کارت بانکی
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-express">
                                    تحویل اکسپرس
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection

    @section('script')

        <script src="/front/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
        <script src="/front/assets/js/cart.js" type="text/javascript"></script>
        <script>
           /* $(".update-cart").on('change',function (e) {

                e.preventDefault();

                var ele = $(this);

                $.ajax({
                    url: 'update-cart',
                    method: "patch",
                    data: {
                        _token: ' csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error:function (error) {
                        console.log(error);
                    }
                });
            });*/
        </script>
    @endsection


