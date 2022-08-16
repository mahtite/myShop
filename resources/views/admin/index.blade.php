@extends('admin.layouts.master')
@section('title','داشبورد')
@section('content')
    <div class="main-content">
        <div class="dashboard-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="dashboard-header-title mb-3">
                            <h5 class="mb-0 font-weight-bold">داشبورد</h5>
                            <p class="mb-0 font-weight-bold">به پنل مدیریت خوش آمدید.</p>
                        </div>
                    </div>
                    <!-- Dashboard Info Area -->
                    <div class="col-6">
                        <div class="dashboard-infor-mation d-flex flex-wrap align-items-center mb-3">
                            <div class="dashboard-clock ltr">
                                <span>آخرین زمان ورود: {{ $user->updated_at }}</span><br>
                                <ul class="d-flex align-items-center justify-content-end">
                                    <li id="hours">12</li>
                                    <li>:</li>
                                    <li id="min">10</li>
                                    <li>:</li>
                                    <li id="sec">14</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
