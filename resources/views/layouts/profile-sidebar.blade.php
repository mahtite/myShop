<div class="profile-box-username">
    {{ \Illuminate\Support\Facades\Auth::user()->name }}
</div>
<div class="profile-box-tabs">
    <a href="{{ route('password.request') }}" class="profile-box-tab profile-box-tab-access">
        <i class="now-ui-icons ui-1_lock-circle-open"></i>
        تغییر رمز
    </a>

    <form method="post" action="{{ route('logout') }}" style="display: inline-block">
        @csrf
            <button type="submit" class="logoutuser" >
                <i class="now-ui-icons media-1_button-power"></i>
                خروج از حساب
            </button>
    </form>

</div>
</div>
<div class="responsive-profile-menu show-md">
    <div class="btn-group">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-navicon"></i>
            حساب کاربری شما
        </button>
        <div class="dropdown-menu dropdown-menu-right text-right">
            <a href="profile.html" class="dropdown-item active-menu">
                <i class="now-ui-icons users_single-02"></i>
                پروفایل
            </a>
            <a href="{{ route('orders') }}" class="dropdown-item">
                <i class="now-ui-icons shopping_basket"></i>
                همه سفارش ها
            </a>
            <!--<a href="profile-orders-return.html" class="dropdown-item">
                <i class="now-ui-icons files_single-copy-04"></i>
                درخواست مرجوعی
            </a>-->
            <a href="{{ route('favoritesList') }}" {{ request()->is('favoritesList')? 'class= active':'' }}>

            <i class="now-ui-icons ui-2_favourite-28"></i>
                لیست علاقمندی ها
            </a>
            <!--<a href="profile-personal-info.html" class="dropdown-item">
                <i class="now-ui-icons business_badge"></i>
                اطلاعات شخصی
            </a>-->
        </div>
    </div>
</div>
<div class="profile-menu hidden-md">
    <div class="profile-menu-header">حساب کاربری شما</div>
    <ul class="profile-menu-items">
        <li>
            <a href="{{ route('profile') }}" {{ request()->is('profile')? 'class= active':'' }}>
                <i class="now-ui-icons users_single-02"></i>
                پروفایل
            </a>
        </li>
        <li>
            <a href="{{ route('orders') }}" class="dropdown-item">
                <i class="now-ui-icons shopping_basket"></i>
                همه سفارش ها
            </a>
        </li>
        <!--<li>
            <a href="profile-orders-return.html">
                <i class="now-ui-icons files_single-copy-04"></i>
                درخواست مرجوعی
            </a>
        </li>-->
        <li>
            <a href="{{ route('favoritesList') }}" {{ request()->is('profile/favoritesList')? 'class= active':'' }}>
                <i class="now-ui-icons ui-2_favourite-28"></i>
                لیست علاقمندی ها
            </a>
        </li>
        <!--<li>
            <a href="profile-personal-info.html">
                <i class="now-ui-icons business_badge"></i>
                اطلاعات شخصی
            </a>
        </li>-->
        <li>
            <a href="{{ route('twofactor') }}" {{ request()->is('profile/twofactor')? 'class= active':'' }}>
                <i class="now-ui-icons business_badge"></i>
               احراز هویت دو مرحله ای
            </a>
        </li>

        <li>
            <a href="/">
                <i class="fa fa-laptop"></i>
               صفحه اصلی
            </a>
        </li>
    </ul>
</div>
