<!DOCTYPE html>
<html lang="fa">

@include('layouts.head')

<body class="index-page sidebar-collapse">

<!-- responsive-header -->
@include('layouts.nav')
<!-- responsive-header -->

<div class="wrapper default">

    <!-- header -->
   @include('layouts.main-header')
    <!-- header -->

   @yield('content')

  @include('layouts.footer')
</div>

@include('sweet::alert')

</body>

</html>
