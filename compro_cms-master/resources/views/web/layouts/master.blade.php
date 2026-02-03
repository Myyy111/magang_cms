<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('web.layouts.partials.head')
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner"></div>
    </div>

    @include('web.layouts.partials.header')
    @include('web.layouts.partials.mobile_menu')

    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->

    @include('web.layouts.partials.subscribe')

    @include('web.layouts.partials.footer')

</div>

@include('web.layouts.partials.scripts')

</body>
</html>
