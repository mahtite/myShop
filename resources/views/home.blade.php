@extends('layouts.master')
@section('title','فروشگاه')
@section('content')
    <main class="main default">
        <div class="container">
            <!-- banner -->
            <!--<div class="row banner-ads">
                <div class="col-12">
                    <section class="banner">
                        <a href="#">
                            <img src="front/assets/img/banner/banner.jpg" alt="">
                        </a>
                    </section>
                </div>
            </div>-->
            <!-- banner -->
            <div class="row">
                <aside class="sidebar col-12 col-lg-3 order-2 order-lg-1">
                    <div class="sidebar-inner default">
                        <div class="widget-banner widget card">
                            <a href="#" target="_top">
                                <img class="img-fluid" src="front/assets/img/banner/1455.jpg" alt="">
                            </a>
                        </div>
                        <div class="widget-services widget card">
                            <div class="row">
                                <div class="feature-item col-12">
                                    <a href="#" target="_blank">
                                        <img src="front/assets/img/svg/return-policy.svg">
                                    </a>
                                    <p>ضمانت برگشت</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a href="#" target="_blank">
                                        <img src="front/assets/img/svg/payment-terms.svg">
                                    </a>
                                    <p>پرداخت درمحل</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a href="#" target="_blank">
                                        <img src="front/assets/img/svg/delivery.svg">
                                    </a>
                                    <p>تحویل اکسپرس</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a href="#" target="_blank">
                                        <img src="front/assets/img/svg/origin-guarantee.svg">
                                    </a>
                                    <p>تضمین بهترین قیمت</p>
                                </div>
                                <div class="feature-item col-6">
                                    <a href="#" target="_blank">
                                        <img src="front/assets/img/svg/contact-us.svg">
                                    </a>
                                    <p>پشتیبانی 24 ساعته</p>
                                </div>
                            </div>
                        </div>
                        <div class="widget-suggestion widget card">
                            <header class="card-header">
                                <h3 class="card-title">پیشنهاد لحظه ای</h3>
                            </header>
                            <div id="progressBar">
                                <div class="slide-progress"></div>
                            </div>
                            <div id="suggestion-slider" class="owl-carousel owl-theme">
                                <div class="item">
                                    <a href="#">
                                        <img src="front/assets/img/product/692674-200x200.jpg" class="w-100" alt="">
                                    </a>
                                    <h3 class="product-title">
                                        <a href="#"> لپ تاپ ۱۵ اینچی ایسوس مدل FX503VD - A </a>
                                    </h3>
                                    <div class="price">
                                        <span class="amount">5,700,000<span>تومان</span></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="front/assets/img/product/e75a73-200x200.jpg" class="w-100" alt="">
                                    </a>
                                    <h3 class="product-title">
                                        <a href="#"> لپ تاپ ۱۳ اینچی اپل مدل MacBook Pro MLH12 همراه با تاچ بار
                                        </a>
                                    </h3>
                                    <div class="price">
                                        <del><span class="amount">10,300,000<span>تومان</span></span></del>
                                        <span class="amount">1,099,000<span>تومان</span></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="front/assets/img/product/482250-200x200.jpg" class="w-100" alt="">
                                    </a>
                                    <h3 class="product-title">
                                        <a href="#"> لپ تاپ ۱۵ اینچی اپل مدل ۲۰۱۷ MacBook Pro MPTT2 همراه با
                                            تاچ
                                            بار </a>
                                    </h3>
                                    <div class="price">
                                        <del><span class="amount">16,800,000<span>تومان</span></span></del>
                                        <span class="amount">16,286,000<span>تومان</span></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <img src="front/assets/img/product/19a2cc-200x200.jpg" class="w-100" alt="">
                                    </a>
                                    <h3 class="product-title">
                                        <a href="#"> لپ تاپ ۱۳ اینچی اپل مدل MacBook Air MQD32 2017 </a>
                                    </h3>
                                    <div class="price">
                                        <del><span class="amount">6,000,000<span>تومان</span></span></del>
                                        <span class="amount">5,746,000<span>تومان</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_blank">
                                <img class="img-fluid" src="front/assets/img/banner/1000001422.jpg" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_blank">
                                <img class="img-fluid" src="front/assets/img/banner/side-banner-01.jpeg" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_top">
                                <img class="img-fluid" src="front/assets/img/banner/1000001322.jpg" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_blank">
                                <img class="img-fluid" src="front/assets/img/banner/1000001442.jpg" alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_blank">
                                <img class="img-fluid"
                                     src="front/assets/img/banner/8d546388-29d7-4733-871f-2d84a3012cc227_21_1_6.jpeg"
                                     alt="">
                            </a>
                        </div>
                        <div class="widget-banner widget card">
                            <a href="#" target="_blank">
                                <img class="img-fluid" src="front/assets/img/banner/1000001422.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </aside>
                <div class="col-12 col-lg-9 order-1 order-lg-2">

                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card" style="margin-top: 40px">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>پرفروش ترین محصولات</span>
                                    </h3>
                                    <a href="/products" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($sales as $product)
                                        <div class="item">
                                            <a href="/products/{{ $product->id }}">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}"
                                                     class="img-fluid" alt="">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="#">{{ $product->title }}</a>
                                            </h2>
                                            <div class="price">
                                                <div class="text-center">
                                                    <ins><span>{{ number_format($product->price) }}<span>تومان</span></span></ins>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>جدیدترین محصولات</span>
                                    </h3>
                                    <a href="/products" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($productsN as $product)

                                        <div class="item">
                                            <a href="/products/{{ $product->id }}">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="#">{{ $product->title }}</a>
                                            </h2>
                                            <div class="price">
                                                <ins><span>{{ number_format($product->price) }}<span>تومان</span></span></ins>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>پر بازدید ترین محصولات</span>
                                    </h3>
                                    <a href="/products" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($productsView as $product)

                                        <div class="item">
                                            <a href="/products/{{ $product->id }}">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="#">{{ $product->title }}</a>
                                            </h2>
                                            <div class="price">
                                                <ins><span>{{ number_format($product->price) }}<span>تومان</span></span></ins>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span>موبایل و لوازم جانبی</span>
                                    </h3>
                                    <a href="/products" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($productCategory as $products)
                                        <div class="item">
                                            <a href="/products/{{ $products->id }}">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$products->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $products->title }}">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="#">{{ $products->title }}</a>
                                            </h2>
                                            <div class="price">
                                                <ins><span>{{ number_format($products->price) }}<span>تومان</span></span></ins>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <h3 class="card-title">
                                        <span> لپ تاپ</span>
                                    </h3>
                                    <a href="/products" class="view-all">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme">
                                    @foreach($productCategoryLaptop as $productsL)
                                        <div class="item">
                                            <a href="/products/{{ $productsL->id }}">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$productsL->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $productsL->title }}">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="#">{{ $productsL->title }}</a>
                                            </h2>
                                            <div class="price">
                                                <ins><span>{{ number_format($productsL->price) }}<span>تومان</span></span></ins>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection
