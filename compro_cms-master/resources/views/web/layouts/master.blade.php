<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
    <link href="{{ asset('web/css/premium_override.css') }}" rel="stylesheet">
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

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


</head>
<script src="{{ asset('web/js/jquery.js') }}"></script>
<script src="{{ asset('web/js/owl.js') }}"></script>

@yield('scripts')
<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Modern Premium Header -->
    <header class="main-header-premium" id="premiumHeader">
        <div class="nav-container">
            <!-- Logo -->
            <div class="logo-box">
                <a href="{{ route('home') }}">
                    @if(isset($setting))
                    <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
                    @else
                    <img src="https://cmsdutasolusi.co.id/uploads/setting/CMS logo web transparant_1752657853.png" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
                    @endif
                </a>
            </div>

            <!-- Main Navigation -->
            <nav class="premium-nav">
                <a href="{{ url('/') }}" class="premium-nav-link">BERANDA</a>
                <a href="{{ url('/#team') }}" class="premium-nav-link">TIM</a>
                <a href="{{ route('about') }}" class="premium-nav-link">TENTANG KAMI</a>
                
                <!-- Layanan Mega Menu -->
                <div class="premium-nav-item has-mega-menu">
                    <a href="{{ route('services') }}" class="premium-nav-link">LAYANAN <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                    <div class="mega-menu-wrapper">
                        <div class="mega-menu-container">
                            <div class="mega-menu-row">
                                @php
                                    $serviceChunks = $service_subnavs->chunk(ceil($service_subnavs->count() / 3));
                                @endphp
                                @foreach($serviceChunks as $chunk)
                                <div class="mega-menu-col">
                                    <ul class="mega-menu-list">
                                        @foreach($chunk as $service_nav)
                                        <li><a href="{{ route('service.single', $service_nav->slug) }}">{{ $service_nav->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('portfolios') }}" class="premium-nav-link">PORTOFOLIO</a>

                <!-- Info Terkini Mega Menu -->
                <div class="premium-nav-item has-mega-menu">
                    <a href="{{ route('blogs') }}" class="premium-nav-link">INFO TERKINI <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                    <div class="mega-menu-wrapper">
                        <div class="mega-menu-container">
                            <div class="mega-menu-row">
                                @php
                                    $footerSlugs = ['finance', 'hrga', 'berita-insight-cms'];
                                    $mainCategories = $article_subnavs->whereNotIn('slug', $footerSlugs);
                                    $footerCategories = $article_subnavs->whereIn('slug', $footerSlugs);
                                    $articleChunks = $mainCategories->chunk(ceil($mainCategories->count() / 3));
                                @endphp
                                @foreach($articleChunks as $chunk)
                                <div class="mega-menu-col">
                                    <ul class="mega-menu-list">
                                        @foreach($chunk as $article_nav)
                                        <li><a href="{{ route('blog.category', $article_nav->slug) }}">{{ $article_nav->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            <!-- Bottom section of Mega Menu -->
                            @if($footerCategories->count() > 0)
                            <div class="mega-menu-footer">
                                <div class="mega-menu-row">
                                    @foreach($footerCategories as $footer_nav)
                                    <div class="mega-menu-col">
                                        <a href="{{ route('blog.category', $footer_nav->slug) }}" class="footer-link">{{ $footer_nav->title }}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- E-Commerce Mega Menu -->
                <div class="premium-nav-item has-mega-menu">
                    <a href="{{ route('ecommerce.index') }}" class="premium-nav-link">E-COMMERCE <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                    <div class="mega-menu-wrapper">
                        <div class="mega-menu-container">
                            <div class="mega-menu-row">
                                <div class="mega-menu-col">
                                    <ul class="mega-menu-list">
                                        <li><a href="{{ route('ecommerce.index') }}">Daftar Produk</a></li>
                                        <li><a href="{{ route('ecommerce.cart') }}">Keranjang Belanja</a></li>
                                        <li><a href="{{ route('ecommerce.track') }}">Cek Status Pesanan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('faqs') }}" class="premium-nav-link">FAQS</a>
                <a href="{{ route('contact') }}" class="premium-nav-link">KONTAK KAMI</a>
            </nav>

            <!-- Header CTA -->
            <div class="header-cta-wrapper">
                <a href="{{ route('get-quote') }}" class="header-cta-btn">
                    Ajukan Penawaran <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="mobile-nav-toggle" id="openMobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Fullscreen Mobile Menu -->
    <div id="mobileMenuOverlay" style="position: fixed; inset: 0; background: #0A3D62; z-index: 10000; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding-top: 100px; gap: 20px; transform: translateX(100%); transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1); overflow-y: auto;">
        <button id="closeMobileMenu" style="position: absolute; top: max(30px, env(safe-area-inset-top)); right: 30px; background: none; border: none; color: white; font-size: 32px; cursor: pointer; z-index: 10001;">&times;</button>
        
        <a href="{{ url('/') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">BERANDA</a>
        <a href="{{ url('/#team') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">TIM</a>
        <a href="{{ route('about') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">TENTANG KAMI</a>
        <a href="{{ route('services') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">LAYANAN</a>
        
        <!-- Mobile Submenu Services -->
        <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-services', this)" style="background: none; border: none; color: white; margin-top: -15px; margin-bottom: 5px;">
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="submenu-services" style="display: none; flex-direction: column; gap: 12px; text-align: center; margin-bottom: 15px;">
             @foreach($service_subnavs as $service_nav)
             <a href="{{ route('service.single', $service_nav->slug) }}" style="color: #cbd5e1; font-size: 18px; text-decoration: none; display: block;">{{ $service_nav->title }}</a>
             @endforeach
        </div>
        <a href="{{ route('portfolios') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">PORTOFOLIO</a>
        <a href="{{ route('blogs') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">INFO TERKINI</a>

        <!-- Mobile Submenu Blogs -->
        <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-blogs', this)" style="background: none; border: none; color: white; margin-top: -15px; margin-bottom: 5px;">
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="submenu-blogs" style="display: none; flex-direction: column; gap: 12px; text-align: center; margin-bottom: 15px;">
             @foreach($article_subnavs as $article_nav)
             <a href="{{ route('blog.category', $article_nav->slug) }}" style="color: #cbd5e1; font-size: 18px; text-decoration: none; display: block;">{{ $article_nav->title }}</a>
             @endforeach
        </div>
        <a href="{{ route('ecommerce.index') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">E-COMMERCE</a>
        
        <!-- Mobile Submenu E-Commerce -->
        <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-ecommerce', this)" style="background: none; border: none; color: white; margin-top: -15px; margin-bottom: 5px;">
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="submenu-ecommerce" style="display: none; flex-direction: column; gap: 12px; text-align: center; margin-bottom: 15px;">
             <a href="{{ route('ecommerce.index') }}" style="color: #cbd5e1; font-size: 18px; text-decoration: none; display: block;">Daftar Produk</a>
             <a href="{{ route('ecommerce.cart') }}" style="color: #cbd5e1; font-size: 18px; text-decoration: none; display: block;">Keranjang Belanja</a>
             <a href="{{ route('ecommerce.track') }}" style="color: #cbd5e1; font-size: 18px; text-decoration: none; display: block;">Cek Status Pesanan</a>
        </div>
        <a href="{{ route('faqs') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">FAQS</a>
        <a href="{{ route('contact') }}" class="mobile-nav-item" style="color: white; font-size: 28px; font-weight: 600; text-decoration: none;">KONTAK KAMI</a>
        
        <a href="{{ route('get-quote') }}" class="header-cta-btn" style="margin-top: 20px; background: #1DD1A1; color: #0A3D62 !important;">
            Ajukan Penawaran <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('premiumHeader');
            const openBtn = document.getElementById('openMobileMenu');
            const closeBtn = document.getElementById('closeMobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');
            const mobileLinks = document.querySelectorAll('.mobile-nav-item');

            // Scroll Logic
            function handleScroll() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            window.addEventListener('scroll', handleScroll);
            handleScroll(); // Initial check

            // Mobile Menu Logic
            openBtn.addEventListener('click', () => {
                overlay.style.transform = 'translateX(0)';
            });

            function closeMenu() {
                overlay.style.transform = 'translateX(100%)';
            }

            closeBtn.addEventListener('click', closeMenu);
            mobileLinks.forEach(link => link.addEventListener('click', closeMenu));
            
            // Scroll to Top Logic
            const scrollBtn = document.querySelector('.scroll-to-top');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollBtn.style.display = 'flex';
                } else {
                    scrollBtn.style.display = 'none';
                }
            });

            if(scrollBtn) {
                scrollBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });

        // Mobile Submenu Toggle
        function toggleSubmenu(id, btn) {
            const submenu = document.getElementById(id);
            const icon = btn.querySelector('i');
            
            if (submenu.style.display === 'none') {
                submenu.style.display = 'flex';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                submenu.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }
    </script>
    <!--End Main Header -->


    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->


    @php
        $section_subscribe = \App\Models\Section::section('subscribe');
    @endphp
    @if(isset($section_subscribe))
    <!--Subscribe Section-->
    <section class="subscribe-section">
        <div class="container wow fadeInUp">
            <div class="row clearfix">
                <!--Form Column-->
                <div class="title-column col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <h2>{{ $section_subscribe->title }}</h2>
                    <div class="text">{!! $section_subscribe->description !!}</div>
                    <div class="icon-box">
                        <span class="icon flaticon-mail"></span>
                    </div>
                </div>
                <!--Form Column-->
                <div class="form-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="subscribe-form">
                            <form method="post" action="{{ route('subscribe') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="{{ __('contact.email_address') }}" required>
                                    <button type="submit" class="theme-btn"><i class="fab fa-telegram-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Subscribe Section-->
    @endif

    <!-- Main Footer -->
    <footer class="main-footer" style="background-image: url({{ asset('web/images/background/footer-bg.jpg') }});">
        <div class="container wow fadeInUp">
            <!--Widgets Section-->
            <div class="widgets-section">
                @if(isset($setting))
                <div class="footer-logo-top">
                    <a href="{{ route('home') }}"><img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo"></a>
                </div>
                @endif

                <div class="row clearfix">
                    <div class="big-column col-xl-8 col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <!--Footer Column (Contact Info)-->
                            <div class="footer-column col-lg-7 col-md-12 col-sm-12">
                                <div class="footer-widget about-widget">
                                    @if(isset($setting))
                                    <div class="widget-content">
                                        <ul class="footer-contact-list">
                                            <li>
                                                <i class="far fa-map"></i>
                                                <div class="contact-detail">
                                                    <span class="label">{{ __('contact.address') }}:</span>
                                                    <span class="value">{{ $setting->contact_address }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone-volume" style="color: var(--accent-yellow);"></i>
                                                <div class="contact-detail">
                                                    <span class="label">{{ __('contact.phone') }}:</span>
                                                    <span class="value">
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_one) }}" target="_blank">{{ $setting->phone_one }}</a>@if(isset($setting->phone_two)), <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_two) }}" target="_blank">{{ $setting->phone_two }}</a> @endif
                                                    </span>
                                                </div>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope" style="color: var(--accent-yellow);"></i>
                                                <div class="contact-detail">
                                                    <span class="label">{{ __('contact.email') }}:</span>
                                                    <span class="value">
                                                        <a href="mailto:{{ $setting->email_one }}">{{ $setting->email_one }}</a>@if(isset($setting->email_two)), <br> <a href="mailto:{{ $setting->email_two }}">{{ $setting->email_two }}</a> @endif
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if(count($pages) > 0)
                            <!--Footer Column (Links)-->
                            <div class="footer-column col-lg-5 col-md-12 col-sm-12">
                                <div class="footer-widget links-widget ps-lg-4">
                                    <h2 class="widget-title">{{ __('common.footer_links') }}</h2>
                                    <div class="widget-content">
                                        <ul class="list">
                                            @foreach($pages as $key => $page)
                                            <li><a href="{{ route('page.single', $page->slug) }}">{{ $page->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if(count($recents) > 0)
                    <div class="big-column col-xl-4 col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <!--Footer Column-->
                            <div class="footer-column col-lg-12 col-md-12 col-sm-12">
                                <div class="footer-widget recent-posts">
                                    <h2 class="widget-title">{{ __('common.recent_posts') }}</h2>
                                     <!--Footer Column-->
                                    <div class="widget-content">
                                        <div class="item">
                                            @foreach($recents as $key => $recent)
                                            @if($key <= 1)
                                            <div class="post">
                                                <div class="thumb">
                                                    <a href="{{ route('blog.single', $recent->slug) }}">
                                                        <img src="{{ asset('uploads/article/'.$recent->image_path) }}" alt="{{ $recent->title }}">
                                                    </a>
                                                </div>
                                                <div class="post-info">
                                                    <span class="post-date">{{ date('M d, Y', strtotime($recent->created_at)) }}</span>
                                                    <h4><a href="{{ route('blog.single', $recent->slug) }}">{!! str_limit(strip_tags($recent->title), 45, ' ...') !!}</a></h4>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-container clearfix">
                    <div class="copyright-text">© 2026 PT CMS Duta Solusi. All rights reserved.</div>
                    <div class="social-links">
                        <ul class="social-icon-two">
                            @if(isset($social->facebook))
                            <li><a href="{{ $social->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if(isset($social->twitter))
                            <li><a href="{{ $social->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if(isset($social->instagram))
                            <li><a href="{{ $social->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if(isset($social->linkedin))
                            <li><a href="{{ $social->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif
                            @if(isset($social->pinterest))
                            <li><a href="{{ $social->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                            @endif
                            @if(isset($social->youtube))
                            <li><a href="{{ $social->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            @endif
                            @if(isset($social->skype))
                            <li><a href="skype:{{ $social->skype }}?chat" target="_blank"><i class="fab fa-skype"></i></a></li>
                            @endif
                            @if(isset($social->whatsapp))
                            <li><a href="https://wa.me/{{ str_replace(' ', '', $social->whatsapp) }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Main Footer -->



</div>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-angle-double-up"></span></div>

    <script src="{{ asset('web/js/jquery.js') }}"></script>
    <script src="{{ asset('web/js/popper.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('web/js/owl.js') }}"></script>
    <script src="{{ asset('web/js/wow.js') }}"></script>
    <script src="{{ asset('web/js/appear.js') }}"></script>
    <script src="{{ asset('web/js/isotope.js') }}"></script>
    <script src="{{ asset('web/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('web/js/mixitup.js') }}"></script>
    @if($livechat->status == 1)
    <script src="{{ asset('web/js/floating-wpp.min.js') }}"></script>
    @endif
    <script src="{{ asset('web/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>


    <!-- @if($livechat->status == 1) -->

    <!-- <div id="whatspp_live"></div>

    <script type="text/javascript">
        (function($) {
        "use strict";
          $('#whatspp_live').floatingWhatsApp({
            phone: '{{ $livechat->whatsapp_no }}', //WhatsApp Business phone number International format
            headerTitle: '{{ $livechat->whatsapp_title }}', //Popup Title
            popupMessage: '{{ $livechat->whatsapp_greeting }}', //Popup Message
            showPopup: true, //Enables popup display
            buttonImage: '<img src="{{ asset('web/images/social/whatsapp.png') }}">', //Button Image
            headerColor: '{{ $livechat->whatsapp_color }}', //headerColor: 'crimson', //Custom header color
            backgroundColor: 'transparent', //backgroundColor: 'crimson', //Custom background button color
            position: "right"
          });
        })(jQuery);
    </script>
    @endif -->


    @if($livechat->status == 0)
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script type="text/javascript">
        (function($) {
        "use strict";

            window.fbAsyncInit = function() {
              FB.init({
                xfbml            : true,
                version          : 'v8.0'
              });
            };

            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        })(jQuery);
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
        attribution=setup_tool
        page_id="{{ $livechat->facebook_id }}"
        theme_color="{{ $livechat->facebook_color }}"
        logged_in_greeting="{{ $livechat->facebook_greeting_in }}"
        logged_out_greeting="{{ $livechat->facebook_greeting_out }}">
    </div>
    @endif

</body>
</html>
