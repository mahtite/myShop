@extends('layouts.master')
@section('title','احراز هویت')
@section('content')
    <main class="profile-user-page default">
        <div class="container">
            <div class="row">
                <div class="profile-page col-xl-9 col-lg-8 col-md-12 order-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-12">
                                <h1 class="title-tab-content">اطلاعات شخصی</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                         <div class="col-sm-12 col-md-6">

                                        <p>
                                            <span class="title">نام و نام خانوادگی :</span>
                                            <span>{{ $user->name }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">پست الکترونیک :</span>
                                            <span>{{ $user->email }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">شماره تلفن همراه:</span>
                                            <span>{{ $user->phone }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">کد ملی :</span>
                                            <span>-</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">دریافت خبرنامه :</span>
                                            <span>بله</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <p>
                                            <span class="title">شماره کارت :</span>
                                            <span>-</span>
                                        </p>
                                    </div>
                                    <div class="col-12 text-center">
                                        <!--<a href="profile-additional-info.html" class="btn-link-border form-account-link">
                                            ویرایش اطلاعات شخصی
                                        </a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-12">
                                <h1 class="title-tab-content">لیست آخرین علاقمندی ها</h1>
                            </div>
                            <div class="content-section default">
                                <div class="row">
                                    <div class="col-12">
                                        @if ($favorites->count() > 0 )
                                        @foreach($favorites as $favorite)
                                        <div class="profile-recent-fav-row">
                                            <a href="/products/{{ $favorite->product->id }}" class="profile-recent-fav-col profile-recent-fav-col-thumb">
                                                @php
                                                    $gallery=\App\Models\Gallery::where('product_id',$favorite->product->id)->first();
                                                @endphp
                                                <img src="/{{ $gallery->img }}" class="img-fluid" alt="{{ $favorite->product->title }}">
                                            </a>
                                            <div class="profile-recent-fav-col profile-recent-fav-col-title">
                                                <a href="/products/{{ $favorite->product->id }}">
                                                    <h4 class="profile-recent-fav-name">
                                                        {{ $favorite->product->title}}
                                                    </h4>
                                                </a>
                                                <div class="profile-recent-fav-price"></div>
                                            </div>
                                            <div class="profile-recent-fav-col profile-recent-fav-col-actions">

                                                <form method="post" action="{{ route('deleteFavorite',$favorite->product_id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-action btn-action-remove">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                            <h1 class="text-empty" style="text-align: center">موردی برای نمایش وجود ندارد!</h1>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="profile-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-1">
                    <div class="profile-box">
                        <div class="profile-box-header">
                            <div class="profile-box-avatar">
                                <img src="/front/assets/img/svg/user.svg" alt="">
                            </div>
                            <button data-toggle="modal" data-target="#myModal" class="profile-box-btn-edit">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <!-- Modal Core -->
                            <div class="modal-share modal-width-custom modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">تغییر نمایه کاربری شما</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="profile-avatars default text-center">
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/user.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-1.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-2.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-3.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-4.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-5.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-6.svg"></img>
                                                </li>
                                                <li>
                                                    <img class="profile-avatars-item" src="front/assets/img/svg/avatar-7.svg"></img>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Core -->
                        </div>
                       @include('layouts.profile-sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection
