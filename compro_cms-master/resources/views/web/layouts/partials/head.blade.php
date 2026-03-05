<!-- Meta Tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

@if(isset($setting))
<!-- App Title -->
<title>@yield('title') | {{ $setting->title }}</title>

<!-- App favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/uploads/setting/'.$setting->favicon_path) }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('/uploads/setting/'.$setting->favicon_path) }}" type="image/x-icon">

@yield('top_meta_tags')
@endif


@if(empty($setting))
<!-- App Title -->
<title>@yield('title')</title>
@endif


<!-- Social Meta Tags -->
<link rel="canonical" href="{{ route('home') }}">
@yield('social_meta_tags')


<!-- Stylesheets -->
<link href="{{ asset('web/css/bootstrap.css') }}" rel="stylesheet">
@if($livechat->status == 1)
<link href="{{ asset('web/css/floating-wpp.min.css') }}" rel="stylesheet">
@endif
<link href="{{ asset('web/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('web/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('web/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('web/css/kategori-tab.css') }}" rel="stylesheet">
<link href="{{ asset('web/css/premium_override.css?v=' . time()) }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


<!-- Custom Style -->
@if(isset($setting->custom_css))
<style type="text/css">
    {!! strip_tags($setting->custom_css) !!}
</style>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function scrollTeam(id, distance) {
        const container = document.getElementById('carousel-' + id);
        container.scrollBy({ left: distance, behavior: 'smooth' });
    }
</script>
    
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Custom Premium Fixes for Mobile -->
    <style>
        /* Fix swipe pada owl carousel di mobile */
        .owl-carousel, .owl-stage-outer, .owl-stage {
            touch-action: pan-y !important;
            -ms-touch-action: pan-y !important;
        }
        /* Memastikan gambar slider muncul & responsif */
        .banner-carousel .slide-item img, 
        .recent-portfolio-carousal .image img {
            width: 100% !important;
            height: auto !important;
            object-fit: cover !important;
        }
    </style>

    @yield('scripts')
