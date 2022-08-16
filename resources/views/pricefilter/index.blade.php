<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Price nouislider-filter cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.css" integrity="sha512-MKxcSu/LDtbIYHBNAWUQwfB3iVoG9xeMCm32QV5hZ/9lFaQZJVaXfz9aFa0IZExWzCpm7OWvp9zq9gVip/nLMg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js" integrity="sha512-T5Bneq9hePRO8JR0S/0lQ7gdW+ceLThvC80UjwkMRz+8q+4DARVZ4dqKoyENC7FcYresjfJ6ubaOgIE35irf4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .mall-slider-handles{
            margin-top: 50px;
        }
        .filter-container-1{
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }
        /*.filter-container-1 input{
            border: 1px solid #ddd;
            width: 100%;
            text-align: center;
            height: 30px;
            border-radius: 5px;
        }*/
        .filter-container-1 button{
            background: #51a179;
            color:#fff;
            padding: 5px 20px;
        }
        .filter-container-1 button:hover{
            background: #2e7552;
            color:#fff;
        }

    </style>
</head>
<body>
<div class="container">
    <h4>Product Price Filter Example in Laravel | 8Bityard.com</h4>
    <div class="row">
        <div class="col-3">
            <!-- filter by price start -->
            <div class="widget mercado-widget filter-widget price-filter">
                <h5 class="widget-title">Filter By Price</h5>
                <form action="{{route('product.shop')}}" method="POST">
                    @csrf
                    <div class="mall-property">
                        <div class="mall-property__label">
                            Price
                            <a class="mall-property__clear-filter js-mall-clear-filter" href="javascript:;" data-filter="price" style="">
                            </a>
                        </div>
                        <div class="mall-slider-handles" data-start="{{ $filter_min_price ?? $min_price }}" data-end="{{ $filter_max_price ?? $max_price }}" data-min="{{ $min_price}}" data-max="{{ $max_price }}" data-target="price" style="width: 100%">
                        </div>
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
            </div>
            <!-- filter by price end -->
        </div>
        <div class="col-9">
            <!-- show default products list start-->
            <div class="row">
                @php
                   // $products=\App\Models\Product::all();
                @endphp
                @if ($products->count() > 0 )
                    @foreach($products as $product)

                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid3">
                                <div class="product-image3">

                                    <a href="/products/{{ $product->id }}">
                                        @php
                                            $gallery=\App\Models\Gallery::where('product_id',$product->id)->first();
                                        @endphp

                                        <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $product->title }}">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">{{ $product->title }}</h3>
                                    <div class="price">
                                         {{ number_format($product->price) }}تومان
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>No Product Found.!</h2>
                @endif
            </div>
            <!-- show default products list end-->
            <div>
            </div>
        </div>

        <div class="pager default text-center">
            <ul class="pager-items">
                <li>
                    {{ $products->withQueryString()->links() }}
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
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
</html>
