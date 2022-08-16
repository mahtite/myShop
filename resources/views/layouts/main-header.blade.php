<header class="main-header default">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4 col-5">
                <div class="logo-area default">
                    <a href="#">
                        <img src="front/assets/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-8 col-7">
                <div class="search-area default">
                    <form action="{{ route('search') }}" class="search" method="get" role="search">
                        <input type="search" placeholder="نام کالا و یا دسته مورد نظر خود را جستجو کنید…" name="search">
                        <button type="submit"><img src="/front/assets/img/search.png" alt=""></button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                @if(auth()->check())
                    <div class="user-login dropdown">
                        <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown"
                           id="navbarDropdownMenuLink1">
                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            @php
                                 $qty=\Illuminate\Support\Facades\DB::table("carts")->where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");
                                 session()->put('qty',$qty);
                            @endphp
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">

                            <div class="dropdown-item">
                                <a  class="btn btn-success"  href="{{ route('profile') }}">پروفایل من</a>
                            </div>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <div class="dropdown-item">
                                     <button type="submit" class="btn btn-danger" >خروج</button>
                                </div>
                            </form>
                        </ul>
                    </div>
                @else
                    <div class="user-login dropdown">
                    <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown"
                       id="navbarDropdownMenuLink1">
                        ورود / ثبت نام
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <div class="dropdown-item">
                            <a class="btn btn-info" href="{{ route('login') }}">ورود به تاپ کالا</a>
                        </div>
                        <div class="dropdown-item font-weight-bold">
                            <span>کاربر جدید هستید؟</span> <a class="register" href="{{ route('register') }}">ثبت‌نام</a>
                        </div>
                    </ul>
                </div>
                @endif
                <div class="cart dropdown">


                        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink1">

                            @if(session()->has('qty'))
                            <span class="badge" style="background: #ef5661;top: -7px;left: -2px;">
                               {{ session()->get('qty') }}
                            </span>
                            @else
                                <span class="" style="display: none"></span>
                            @endif
                            <i class="now-ui-icons shopping_cart-simple"></i>
                            سبد خرید
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                            @if(auth()->user())
                                @php
                                   $sumPrice=0;
                                   $qty=0;
                                   $carts=\App\Models\Cart::where('user_id',auth()->user()->id)->get();
                                  // $qty=\Illuminate\Support\Facades\DB::table("carts")->where('status',1)->where('user_id',auth()->user()->id)->get()->sum("quantity");
                                @endphp
                                <div class="basket-header">
                                    <div class="basket-total">
                                        <span>مبلغ کل خرید:</span>
                                        @foreach($carts as $cart)
                                            @php
                                                $products=\Illuminate\Support\Facades\DB::table('products')->where('id',$cart->product_id)->first();
                                                $isBasketx=$cart->basket_id;
                                                $isBasketx=\Illuminate\Support\Facades\DB::table('baskets')->where('id',$isBasketx)->where('isActive',1)->first();
                                            @endphp
                                            @if($isBasketx)
                                                @php
                                                    $sumPrice+= $cart->quantity == 1 ? $products->price : $cart->quantity * $products->price;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <span> {{ number_format($sumPrice) }}</span>
                                        <span> تومان</span>
                                    </div>
                                </div>
                                @foreach($carts as $cart)
                                @php
                                    $productsx=\Illuminate\Support\Facades\DB::table('products')->where('id',$cart->product_id)->first();
                                    $isBasket=$cart->basket_id;
                                    $isBasket=\Illuminate\Support\Facades\DB::table('baskets')->where('id',$isBasket)->where('isActive',1)->first();
                                @endphp
                                @if(isset($isBasket))
                                    <ul class="basket-list">
                                        <li>

                                            <div  class="basket-item">
                                                <form method="post" action="{{ route('carts.destroy',$cart->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="basket-item-remove"></button>
                                                </form>
                                                <div class="basket-item-content">
                                                    <div class="basket-item-image">
                                                        @php
                                                            $gallery=\App\Models\Gallery::where('product_id',$productsx->id)->first();
                                                        @endphp
                                                        <img alt="" src="\{{ $gallery->img }}">
                                                    </div>
                                                    <div class="basket-item-details">
                                                        <div class="basket-item-title">
                                                            {{ $productsx->title }}
                                                        </div>
                                                        <div class="basket-item-params">
                                                            <div class="basket-item-props">
                                                                <span> {{ $cart->quantity }}عدد</span>
                                                                <span> {{ $cart->values->value }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <a href="{{ route('carts.index') }}" class="basket-submit">مشاهده سبد خرید</a>
                                @endif
                            @endforeach

                                @empty($isBasketx)
                                    <div class="bas-foo">
                                       سبد خرید شما خالی می باشد
                                    </div>
                                @endif

                            @else
                                @empty($isBasketx)
                                    <div class="basket-header">
                                        <div class="basket-total">
                                            <span>مبلغ کل خرید:</span>
                                            <span>0 تومان</span>
                                        </div>
                                    </div>

                                    <div class="bas-foo">
                                            سبد خرید شما خالی می باشد
                                    </div>
                                @endif
                            @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <nav class="main-menu">
        <div class="container">
            <ul class="list float-right">
                <li class="list-item list-item-has-children mega-menu mega-menu-col-5">
                    <a class="nav-link" href="#">کالای دیجیتال</a>
                    <ul class="sub-menu nav">
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">لوازم
                                جانبی گوشی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">کیف و کاور گوشی</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پاور بانک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">هندزفری،هدفون</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پایه نگهدارنده گوشی</a>
                                </li>
                                <li class="list-item list-item-has-children">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">گوشی موبایل</a>
                                    <ul class="sub-menu nav">
                                        <li class="list-item">
                                            <a class="nav-link" href="#">آیفون اپل</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="nav-link" href="#">هوآوی</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">ساعت هوشمند</a>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">اسپیکر بلوتوث و با سیم</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">موبایل</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">LG</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nokia</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link" href="#">تبلت
                                و کتابخوان</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Acer</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Amazon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">دوربین</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Canon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Casio</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nikon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">کامپیوتر و تجهیزات
                                جانبی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">هارد دیسک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">نمایشگر</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">مادر بورد</a></li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پردازنده</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">کارت گرافیک</a>
                                </li>
                            </ul>
                        </li>
                        <img src="front/assets/img/1636.png" alt="">
                    </ul>
                </li>
                <li class="list-item list-item-has-children mega-menu mega-menu-col-5">
                    <a class="nav-link" href="#">آرایشی،بهداشت و سلامت</a>
                    <ul class="sub-menu nav">
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">لوازم
                                جانبی گوشی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">کیف و کاور گوشی</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پاور بانک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">هندزفری،هدفون</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پایه نگهدارنده گوشی</a>
                                </li>
                                <li class="list-item list-item-has-children">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">گوشی
                                        موبایل</a>
                                    <ul class="sub-menu nav">
                                        <li class="list-item">
                                            <a class="nav-link" href="#">آیفون اپل</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="nav-link" href="#">هوآوی</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">ساعت
                                        هوشمند</a>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">اسپیکر
                                        بلوتوث و با سیم</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">موبایل</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">LG</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nokia</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link" href="#">تبلت
                                و کتابخوان</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Acer</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Amazon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">دوربین</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Canon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Casio</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nikon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">کامپیوتر و تجهیزات
                                جانبی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">هارد دیسک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">نمایشگر</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">مادر بورد</a></li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پردازنده</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">کارت گرافیک</a>
                                </li>
                            </ul>
                        </li>
                        <img src="front/assets/img/1636.png" alt="">
                    </ul>
                </li>
                <li class="list-item list-item-has-children mega-menu mega-menu-col-5">
                    <a class="nav-link" href="">خودرو،ابزار و اداری</a>
                    <ul class="sub-menu nav">
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">لوازم
                                جانبی گوشی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">کیف و کاور گوشی</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پاور بانک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">هندزفری،هدفون</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پایه نگهدارنده گوشی</a>
                                </li>
                                <li class="list-item list-item-has-children">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">گوشی
                                        موبایل</a>
                                    <ul class="sub-menu nav">
                                        <li class="list-item">
                                            <a class="nav-link" href="#">آیفون اپل</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="nav-link" href="#">هوآوی</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">ساعت
                                        هوشمند</a>
                                </li>
                                <li class="list-item">
                                    <i class="now-ui-icons arrows-1_minimal-left"></i><a
                                        class="main-list-item nav-link" href="#">اسپیکر
                                        بلوتوث و با سیم</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="main-list-item nav-link"
                                                                                 href="#">موبایل</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">LG</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nokia</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link" href="#">تبلت
                                و کتابخوان</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Acer</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Amazon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Apple</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">ASUS</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">HTC</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Samsung</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">دوربین</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">Canon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Casio</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Nikon</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">Sony</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-item list-item-has-children">
                            <i class="now-ui-icons arrows-1_minimal-left"></i><a class="nav-link"
                                                                                 href="#">کامپیوتر و تجهیزات
                                جانبی</a>
                            <ul class="sub-menu nav">
                                <li class="list-item">
                                    <a class="nav-link" href="#">هارد دیسک</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">نمایشگر</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">مادر بورد</a></li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">پردازنده</a>
                                </li>
                                <li class="list-item">
                                    <a class="nav-link" href="#">کارت گرافیک</a>
                                </li>
                            </ul>
                        </li>
                        <img src="front/assets/img/1636.png" alt="">
                    </ul>
                </li>
                <li class="list-item">
                    <a class="nav-link" href="#">مد و پوشاک</a>
                </li>
                <li class="list-item">
                    <a class="nav-link" href="#">خانه و آشپزخانه</a>
                </li>
                <li class="list-item">
                    <a class="nav-link" href="#">کتاب،لوازم تحریر</a>
                </li>
                <li class="list-item">
                    <a class="nav-link" href="#">ورزش و سفر</a>
                </li>
                <li class="list-item">
                    <a class="nav-link" href="#">وسایل نقلیه و صنعتی</a>
                </li>
                <li class="list-item amazing-item">
                    <a class="nav-link" href="#" target="_blank">شگفت‌انگیزها</a>
                </li>

                <li class="list-item amazing-item">
                    <a class="nav-link" href="/" target="_blank">صفحه اصلی</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
