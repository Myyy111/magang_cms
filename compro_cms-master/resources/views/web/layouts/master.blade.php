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

    <!-- Mobile Menu Backdrop -->
    <div id="mobileMenuBackdrop" style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999998; display: none; opacity: 0; transition: opacity 0.4s ease;"></div>

    <!-- Fullscreen Mobile Menu Sidebar -->
    <div id="premiumMobileMenu" style="position: fixed !important; top: 0 !important; right: 0 !important; width: 75% !important; height: 100vh !important; background-color: #ffffff !important; z-index: 999999 !important; display: flex !important; flex-direction: column !important; align-items: stretch !important; justify-content: flex-start !important; padding: 80px 25px 40px !important; transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); overflow-y: auto !important; box-shadow: -10px 0 30px rgba(0,0,0,0.1) !important;">
        <button id="closePremiumMenu" style="position: absolute !important; top: 20px !important; right: 20px !important; background: #f1f5f9 !important; border: none !important; color: #001f3f !important; font-size: 24px !important; cursor: pointer !important; width: 40px !important; height: 40px !important; border-radius: 50% !important; display: flex !important; align-items: center !important; justify-content: center !important; z-index: 1000001 !important;">&times;</button>
        
        <div class="mobile-nav-group" style="display: flex !important; flex-direction: column !important; width: 100% !important; gap: 0 !important;">
            <a href="{{ url('/') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">BERANDA</a>
            <a href="{{ url('/#team') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">TIM</a>
            <a href="{{ route('about') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">TENTANG KAMI</a>
            
            <div class="mobile-has-sub" style="border-bottom: 1px solid #f1f5f9 !important;">
                <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 15px 0 !important;">
                    <a href="{{ route('services') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; flex-grow: 1 !important;">LAYANAN</a>
                    <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-services-premium', this)" style="background: #f1f5f9 !important; border: none !important; color: #001f3f !important; width: 35px !important; height: 35px !important; border-radius: 8px !important; display: flex !important; align-items: center !important; justify-content: center !important;">
                        <i class="fas fa-chevron-down" style="font-size: 12px !important;"></i>
                    </button>
                </div>
                <div id="submenu-services-premium" style="display: none; flex-direction: column !important; gap: 5px !important; padding: 0 0 15px 15px !important;">
                     @foreach($service_subnavs as $service_nav)
                     <a href="{{ route('service.single', $service_nav->slug) }}" style="color: #475569 !important; font-size: 16px !important; text-decoration: none !important; display: block !important; padding: 6px 0 !important; font-weight: 500 !important;">{{ $service_nav->title }}</a>
                     @endforeach
                </div>
            </div>

            <a href="{{ route('portfolios') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">PORTOFOLIO</a>
            
            <div class="mobile-has-sub" style="border-bottom: 1px solid #f1f5f9 !important;">
                <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 15px 0 !important;">
                    <a href="{{ route('blogs') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; flex-grow: 1 !important;">INFO TERKINI</a>
                    <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-blogs-premium', this)" style="background: #f1f5f9 !important; border: none !important; color: #001f3f !important; width: 35px !important; height: 35px !important; border-radius: 8px !important; display: flex !important; align-items: center !important; justify-content: center !important;">
                        <i class="fas fa-chevron-down" style="font-size: 12px !important;"></i>
                    </button>
                </div>
                <div id="submenu-blogs-premium" style="display: none; flex-direction: column !important; gap: 5px !important; padding: 0 0 15px 15px !important;">
                     @foreach($article_subnavs as $article_nav)
                     <a href="{{ route('blog.category', $article_nav->slug) }}" style="color: #475569 !important; font-size: 16px !important; text-decoration: none !important; display: block !important; padding: 6px 0 !important; font-weight: 500 !important;">{{ $article_nav->title }}</a>
                     @endforeach
                </div>
            </div>

            <div class="mobile-has-sub" style="border-bottom: 1px solid #f1f5f9 !important;">
                <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 15px 0 !important;">
                    <a href="{{ route('ecommerce.index') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; flex-grow: 1 !important;">E-COMMERCE</a>
                    <button class="mobile-submenu-toggle" onclick="toggleSubmenu('submenu-ecommerce-premium', this)" style="background: #f1f5f9 !important; border: none !important; color: #001f3f !important; width: 35px !important; height: 35px !important; border-radius: 8px !important; display: flex !important; align-items: center !important; justify-content: center !important;">
                        <i class="fas fa-chevron-down" style="font-size: 12px !important;"></i>
                    </button>
                </div>
                <div id="submenu-ecommerce-premium" style="display: none; flex-direction: column !important; gap: 5px !important; padding: 0 0 15px 15px !important;">
                     <a href="{{ route('ecommerce.index') }}" style="color: #475569 !important; font-size: 16px !important; text-decoration: none !important; display: block !important; padding: 6px 0 !important; font-weight: 500 !important;">Daftar Produk</a>
                     <a href="{{ route('ecommerce.cart') }}" style="color: #475569 !important; font-size: 16px !important; text-decoration: none !important; display: block !important; padding: 6px 0 !important; font-weight: 500 !important;">Keranjang Belanja</a>
                     <a href="{{ route('ecommerce.track') }}" style="color: #475569 !important; font-size: 16px !important; text-decoration: none !important; display: block !important; padding: 6px 0 !important; font-weight: 500 !important;">Cek Status Pesanan</a>
                </div>
            </div>

            <a href="{{ route('faqs') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">FAQS</a>
            <a href="{{ route('contact') }}" style="color: #001f3f !important; font-size: 18px !important; font-weight: 700 !important; text-decoration: none !important; padding: 15px 0 !important; border-bottom: 1px solid #f1f5f9 !important; display: block !important;">KONTAK KAMI</a>
        </div>

        <div style="padding-top: 25px !important; margin-bottom: 30px !important;">
            <a href="{{ route('get-quote') }}" class="header-cta-btn" style="width: 100% !important; justify-content: center !important; background-color: #f8be14 !important; color: #000000 !important; font-size: 15px !important; padding: 15px !important; border-radius: 10px !important; font-weight: 800 !important; display: flex !important; box-shadow: 0 10px 20px rgba(248, 190, 20, 0.2) !important;">
                Ajukan Penawaran <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('premiumHeader');
            const openBtn = document.getElementById('openMobileMenu');
            const closeBtn = document.getElementById('closePremiumMenu');
            const overlay = document.getElementById('premiumMobileMenu');
            const backdrop = document.getElementById('mobileMenuBackdrop');
            const mobileLinks = document.querySelectorAll('.mobile-nav-group a');

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
                backdrop.style.display = 'block';
                setTimeout(() => {
                    backdrop.style.opacity = '1';
                }, 10);
                document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
            });

            function closeMenu() {
                overlay.style.transform = 'translateX(100%)';
                backdrop.style.opacity = '0';
                setTimeout(() => {
                    backdrop.style.display = 'none';
                }, 400);
                document.body.style.overflow = ''; // Restore scrolling
            }

            closeBtn.addEventListener('click', closeMenu);
            backdrop.addEventListener('click', closeMenu);
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
