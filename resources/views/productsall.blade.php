@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="/front/assets/css/productAll.css">
@endsection

@section('content')

    <main class="search-page default">
        <div class="container">
            <div class="row">
                <aside class="sidebar-page col-12 col-sm-12 col-md-4 col-lg-3 order-1">

                   <div class="box">
                        <div class="box-header">جستجو در نتایج:</div>
                        <div class="box-content">
                            <div class="ui-input ui-input--quick-search">
                                <input type="text" id="searchproduct" name="search" class="ui-input-field ui-input-field--cleanable"
                                       placeholder="نام محصول مورد نظر را بنویسید…">
                                <span class="ui-input-cleaner"></span>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">جستجو براساس قیمت:</div>
                        <div class="box-content">
                            <!-- filter by price start -->
                            <form action="{{route('product.shop')}}" method="POST">
                                @csrf
                                <div class="mall-property">
                                    @php
                                         use App\Models\Product;
                                           $min_price = Product::min('price');
                                           $max_price = Product::max('price');
                                    @endphp
                                    <div class="mall-slider-handles" data-start="" data-end="{{ $filter_max_price ?? $max_price }}" data-min="{{ $min_price}}" data-max="{{ $max_price }}" data-target="price" style="width: 90%"></div>

                                    <div class="row filter-container-1">
                                        <div class="col-md-4">
                                            <input data-min="price" id="skip-value-lower" name="min_price" style="display: none" >
                                        </div>
                                        <div class="col-md-4">
                                            <input data-max="price" id="skip-value-upper" name="max_price" style="display: none" >
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-sm">جستجو</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- filter by price end -->
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">
                            <div class="box-toggle" data-toggle="collapse" href="#collapseExample1" role="button"
                                 aria-expanded="true" aria-controls="collapseExample1">
                                دسته بندی نتایج
                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="collapse show" id="collapseExample1">
                                <div class="ui-input ui-input--quick-search">
                                        <input type="text" id="searchcate" class="ui-input-field ui-input-field--cleanable"
                                               placeholder="نام دسته بندی مورد نظر را بنویسید…" value="" name="search">
                                        <span class="ui-input-cleaner"></span>
                                    </div>
                                <div class="filter-option">

                                        @foreach($categories as $category)
                                            <div class="checkbox">
                                                <input type="checkbox"  id="{{ $category->id }}" name="search" class="proCate" value=" {{ $category->name }}" >
                                                <label for="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-content">
                            @php
                                $product=\App\Models\Product::where('status',1)->first();
                            @endphp
                                <label class="switch">
                                <input data-id="" id="switch" class="" name="search" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            <label for="switch" style="vertical-align: sub">فقط کالاهای موجود</label>
                        </div>
                    </div>

                </aside>
                <div class="col-12 col-sm-12 col-md-8 col-lg-9 order-2">
                    <div class="breadcrumb-section default">
                        <ul class="breadcrumb-list">
                            <li>
                                <a href="/">
                                    <span>فروشگاه اینترنتی تاپ کالا</span>
                                </a>
                            </li>
                            <li><span>جستجوی موبایل</span></li>
                        </ul>
                    </div>
                    <div class="listing default ">
                        @if(count($products)>0)
                            <div class="listing-counter ">
                                {{ count($products) }}
                                کالا</div>
                        @else
                            <div class="listing-counter ">0</div>
                        @endif
                        <div class="listing-header default">
                            <ul class="listing-sort nav nav-tabs justify-content-center" role="tablist"
                                data-label="مرتب‌سازی بر اساس :">
                                <li>
                                    <a class="active" data-toggle="tab" href="#related" role="tab"
                                       aria-expanded="false">مرتبط‌ترین</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#most-view" role="tab"
                                       aria-expanded="false">پربازدیدترین</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#new" role="tab" aria-expanded="true">جدیدترین</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#most-seller" role="tab"
                                       aria-expanded="false">پرفروش‌ترین‌</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#down-price" role="tab"
                                       aria-expanded="false">ارزان‌ترین</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#top-price" role="tab"
                                       aria-expanded="false">گران‌ترین</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content default text-center" >

                            <div class="tab-pane  active" id="related" role="tabpanel" aria-expanded="true">

                                <div class="container no-padding-right ">
                                    @if ($products->count() > 0 )
                                        <ul class="row listing-items" >
                                        @foreach($products as $product)
                                                <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                                    <div class="product-box">
                                                        <a class="product-box-img" href="/products/{{ $product->id }}">
                                                            @php
                                                                $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                            @endphp
                                                            <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}"></a>
                                                        <div class="product-box-content">
                                                            <div class="product-box-content-row">
                                                                <div class="product-box-title">
                                                                    {{ $product->title }}
                                                                </div>
                                                            </div>
                                                            <div class="product-box-row product-box-row-price">
                                                                <div class="price">
                                                                    <div class="price-value">
                                                                        <div class="price-value-wrapper">
                                                                            {{ number_format($product->price) }} <span
                                                                                class="price-currency">تومان</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                    </ul>
                                    @else
                                        <span class="" style="font-size: 20px;
                                            text-align: center;
                                            margin: 42px auto 20px;
                                            display: block;
                                            color: #979797;">
                                                محصول یافت نشد
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="most-view" role="tabpanel" aria-expanded="false">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">
                                        @foreach($productsV as $product)
                                            <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                                <div class="product-box">
                                                    <a class="product-box-img" href="/products/{{ $product->id }}">
                                                        @php
                                                            $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                        @endphp
                                                        <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}"></a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                {{ $product->title }}
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    <div class="price-value-wrapper">
                                                                        {{ number_format($product->price) }} <span
                                                                            class="price-currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="new" role="tabpanel" aria-expanded="false">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">
                                        @foreach($productsN as $product)
                                            <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                                <div class="product-box">
                                                    <a class="product-box-img" href="/products/{{ $product->id }}">
                                                        @php
                                                            $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                        @endphp
                                                        <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}"></a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                {{ $product->title }}
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    <div class="price-value-wrapper">
                                                                        {{ number_format($product->price) }} <span
                                                                            class="price-currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="most-seller" role="tabpanel" aria-expanded="false">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">

                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="down-price" role="tabpanel" aria-expanded="false">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">
                                        @foreach($productsP_a as $product)
                                            <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                                <div class="product-box">
                                                    <a class="product-box-img" href="/products/{{ $product->id }}">
                                                        @php
                                                            $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                        @endphp
                                                        <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}"></a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                {{ $product->title }}
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    <div class="price-value-wrapper">
                                                                        {{ number_format($product->price) }} <span
                                                                            class="price-currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="top-price" role="tabpanel" aria-expanded="false">
                                <div class="container no-padding-right">
                                    <ul class="row listing-items">
                                        @foreach($productsP_d as $product)
                                            <li class="col-xl-3 col-lg-4 col-md-6 col-12 no-padding">
                                                <div class="product-box">
                                                    <a class="product-box-img" href="/products/{{ $product->id }}">
                                                        @php
                                                            $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                                        @endphp
                                                        <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}"></a>
                                                    <div class="product-box-content">
                                                        <div class="product-box-content-row">
                                                            <div class="product-box-title">
                                                                {{ $product->title }}
                                                            </div>
                                                        </div>
                                                        <div class="product-box-row product-box-row-price">
                                                            <div class="price">
                                                                <div class="price-value">
                                                                    <div class="price-value-wrapper">
                                                                        {{ number_format($product->price) }} <span
                                                                            class="price-currency">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                            <div class="pager default text-center">
                                <ul class="pager-items">
                                    <li>
    {{--{{ $products->withQueryString()->links() }}--}}
                                    </li>
                                </ul>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection

@section('script')

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="/front/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>


    <script>

        $(function() {
            $('.switch').change(function() {

                var status = $("#switch").prop('checked') == true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    url: '/status/show',
                    data: {'status': status},
                    success: function(data){
                        window.location = "/status/show?status="+status;
                    }
                });
            })
        });

        $(document).ready(function ()
        {
            /***SelectCheckbox***/
            $(".proCate").on('click',function (e)
            {
                if($(this).is(':checked'))
                {
                    var name=$(this).val().trim();
                    $.ajax({
                        type: 'GET',
                        url:'/productsSearch/',
                        data: {'search':name},

                        success: function(response)
                        {
                            window.location = "/productsSearch?search="+name;
                        },
                        error: function(error)
                        {
                            console.log(error);
                        }
                    });
                }

            })

            /****SearchProductName****/
            $('#searchproduct').on('keyup',function(){

                var proName=$(this).val();
                if(proName.length >0)
                {
                    $.ajax({
                        type: 'get',
                        url: '/productsSearch/',
                        data: {'search': proName},
                        success: function (data) {
                            window.location = '/productsSearch?search='+proName
                        },
                        error: function(error)
                        {
                            console.log(error);
                        }
                    });
                }
            })

            /*****SearchCateName****/
            $('#searchcate').on('keyup',function(){

                var catName=$(this).val();
                if(catName .length >0)
                {
                    $.ajax({
                        type: 'get',
                        url: '/productsSearch/',
                        data: {'search': catName},

                        success: function (response)
                        {
                            window.location = '/productsSearch?search='+catName
                        },
                        error: function(error)
                        {
                            console.log(error);
                        }
                    });
                }
            })

        })
    </script>

    <!---------------------------------->

    <script>
        $(function () {
            var $propertiesForm = $('.mall-category-filter');
            var $body = $('body');
            $('.mall-slider-handles').each(function () {
                var el = this;
                console.log(el);
                noUiSlider.create(el, {
                    start: [el.dataset.start, el.dataset.end],
                    connect: true,
                    tooltips: true,
                    range: {
                        min: [parseInt(el.dataset.min)],
                        max: [parseInt(el.dataset.max)]
                    },
                    pips: {
                        mode: 'range',
                        density: 20
                    }
                }).on('change', function (values) {
                    $('[data-min="' + el.dataset.target + '"]').val(values[0])
                    $('[data-max="' + el.dataset.target + '"]').val(values[1])
                    $propertiesForm.trigger('submit');
                });
            })
        })
    </script>

@endsection
