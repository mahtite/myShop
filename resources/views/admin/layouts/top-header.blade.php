<header class="top-header-area d-flex align-items-center justify-content-between">
    <div class="left-side-content-area d-flex align-items-center">
        <!-- Mobile Logo -->
        <div class="mobile-logo mr-3 mr-sm-4">
            <a href="/"><img src="/admin/img/core-img/small-logo.png" alt="آرم موبایل"></a>
        </div>

        <!-- Triggers -->
        <div class="ecaps-triggers mr-1 mr-sm-3">
            <div class="menu-collasped" id="menuCollasped">
                <i class="zmdi zmdi-menu"></i>
            </div>
            <div class="mobile-menu-open" id="mobileMenuOpen">
                <i class="zmdi zmdi-menu"></i>
            </div>
        </div>

        <!-- Left Side Nav -->

    </div>

    <div class="right-side-navbar d-flex align-items-center justify-content-end">
        <!-- Mobile Trigger -->
        <div class="right-side-trigger" id="rightSideTrigger">
            <i class="ti-align-left"></i>
        </div>

        <!-- Top Bar Nav -->
        <ul class="right-side-content d-flex align-items-center">
            <!-- Full Screen Mode -->
            <li class="full-screen-mode ml-1">
                <a href="javascript:" id="fullScreenMode"><i class="zmdi zmdi-fullscreen"></i></a>
            </li>

            <li class="nav-item dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/admin/img/member-img/1.png" alt=""></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- User Profile Area -->
                    <div class="user-profile-area">
                        <div class="user-profile-heading">
                            <!-- Thumb -->
                            <div class="profile-img">
                                <img class="chat-img mr-2" src="/admin/img/member-img/1.png" alt="">
                            </div>
                            <!-- Profile Text -->
                            <div class="profile-text">
                                @php
                                    use App\Models\User;
                                    use Illuminate\Support\Facades\Auth;
                                    $user=Auth::user();
                                    $user=User::where('id',$user->id)->first();
                                @endphp
                                <h6>{{ $user->name }}</h6>
                            </div>
                        </div>
                        <a href="{{ route('profile') }}" class="dropdown-item"><i class="zmdi zmdi-account profile-icon bg-primary" aria-hidden="true"></i> پروفایل من</a>

                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti-unlink profile-icon bg-warning" aria-hidden="true"></i>
                                خروج از سیستم
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
