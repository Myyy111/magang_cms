@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('home');
@endphp
@if(isset($header))

    @section('title', $header->meta_title)

    @section('top_meta_tags')
    @if(isset($header->meta_description))
    <meta name="description" content="{!! str_limit(strip_tags($header->meta_description), 160, ' ...') !!}">
    @else
    <meta name="description" content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}">
    @endif

    @if(isset($header->meta_keywords))
    <meta name="keywords" content="{!! strip_tags($header->meta_keywords) !!}">
    @else
    <meta name="keywords" content="{!! strip_tags($setting->keywords) !!}">
    @endif
    @endsection

@endif

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="website">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $setting->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('home') }}"/>
    <meta property='og:image' content="{{ asset('/uploads/setting/'.$setting->logo_path) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('home') }}" />
    <meta name="twitter:title" content="{{ $setting->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('/uploads/setting/'.$setting->logo_path) }}" />
    @endif
@endsection


@section('content')

    @if(count($sliders) > 0)
    <!-- Banner Section - BRI Inspired Enterprise Concept -->
    <section class="banner-section hero-enterprise-style">
        
        <div class="carousel-column">
            <div class="carousel-outer">
                <div class="banner-carousel owl-carousel owl-theme">
                    @foreach($sliders as $slider)
                    <!-- Slide Item -->
                    <div class="slide-item" style="--mobile-bg-image: url('{{ asset('uploads/slider/'.$slider->image_path) }}')">
                        <div class="container h-100">
                            <div class="row align-items-center h-100">
                                <!-- Content Column -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="hero-content-box">

                                        <h1 class="wow fadeInUp" data-wow-delay="0.3s">
                                            @php
                                                $words = explode(' ', $slider->title);
                                                $lastWord = array_pop($words);
                                                $mainWords = implode(' ', $words);
                                            @endphp
                                            {{ $mainWords }} <span class="text-accent">{{ $lastWord }}</span>
                                        </h1>
                                        <div class="text-description wow fadeInUp" data-wow-delay="0.5s">
                                            <p>{!! strip_tags($slider->description) !!}</p>
                                        </div>
                                        <div class="hero-cta-group wow fadeInUp" data-wow-delay="0.7s">
                                            <a href="https://wa.me/6281188022717" target="_blank" class="btn-whatsapp-hero">
                                                <i class="fab fa-whatsapp me-2"></i> Hubungi Kami
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image Column -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="hero-showcase-container wow fadeInRight" data-wow-delay="0.9s">
                                        <div class="main-mockup-wrapper">
                                            <img src="{{ asset('uploads/slider/'.$slider->image_path) }}" alt="{{ $slider->title }}" class="hero-main-img" loading="eager">
                                            <!-- Floating Card 1 -->
                                            <div class="floating-data-card card-top">
                                                <div class="icon-box"><i class="fas fa-chart-line"></i></div>
                                                <div class="details">
                                                    <span class="label">{{ $setting->hero_stat_1_label ?? 'Growth' }}</span>
                                                    <span class="value">{{ $setting->hero_stat_1_value ?? '+24%' }}</span>
                                                </div>
                                            </div>
                                            <!-- Floating Card 2 -->
                                            <div class="floating-data-card card-bottom">
                                                <div class="icon-box"><i class="fas fa-shield-alt"></i></div>
                                                <div class="details">
                                                    <span class="label">{{ $setting->hero_stat_2_label ?? 'Security' }}</span>
                                                    <span class="value">{{ $setting->hero_stat_2_value ?? 'Verified' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>



                <!-- Custom Navigation Lines (BRI Style) -->
                <div class="hero-nav-lines"></div>
            </div>
        </div>
    </section>
    <!-- End Banner Section -->
    @endif

    @php
    $section_team = \App\Models\Section::section('team');
    $kategoriList = [
        'Komisaris' => 'komisaris',
        'Direksi' => 'direksi',
        'Head Unit' => 'head_unit',
    ];
@endphp

@if(count($members) > 0 && isset($section_team))
    <!-- Team Section (Vue 2 Implementation) -->
    <div id="team-section-root"></div>
    <script>
        window.TEAM_MEMBERS = {!! json_encode($members->map(function($member) {
            return [
                'id' => $member->id,
                'name' => $member->title,
                'role' => $member->designation ? $member->designation->title : '',
                'image' => $member->image_path,
                'kategori' => $member->kategori,
                'description' => $member->description,
                'email' => $member->email,
                'phone' => $member->phone,
                'whatsapp' => $member->whatsapp,
                'website' => $member->website,
                'facebook' => $member->facebook,
                'linkedin' => $member->linkedin,
                'instagram' => $member->instagram,
                'twitter' => $member->twitter,
            ];
        })) !!};
    </script>
    <script src="{{ asset('js/team_section_app.js') }}?v={{ time() }}"></script>

    <!-- Team Member Modals (Premium BRI-Style Redesign) -->
    @foreach($members as $member)
    <div class="modal fade team-profile-modal" id="teamModal{{ $member->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Custom Close Button -->
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" data-dismiss="modal">
                        <i class="far fa-times-circle"></i> Close
                    </button>

                    <div class="row g-4">
                        <!-- Photo Column -->
                        <div class="col-md-5">
                            <div class="member-photo-wrapper">
                                <img src="{{ asset('uploads/member/'.$member->image_path) }}" alt="{{ $member->title }}" class="member-photo" loading="lazy">
                            </div>

                            <!-- Social Media removed for BRI Style parity -->
                        </div>

                        <!-- Info Column -->
                        <div class="col-md-7">
                            <h2 class="member-name">{{ $member->title }}</h2>
                            <p class="member-designation">
                                {{ $member->designation ? $member->designation->title : '' }}
                            </p>
                            
                            @if($member->career_history)
                            <div class="info-block">
                                <span class="section-title">Riwayat Pekerjaan</span>
                                <div class="history-content">
                                    <ul class="history-list">
                                        @foreach(explode("\n", str_replace("\r", "", $member->career_history)) as $career)
                                            @php $trimmedCareer = trim($career); @endphp
                                            @if($trimmedCareer && strtolower($trimmedCareer) != 'riwayat pekerjaan')
                                                <li>{{ $trimmedCareer }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if($member->education_history)
                            <div class="info-block">
                                <span class="section-title">Riwayat Pendidikan</span>
                                <div class="history-content">
                                    <ul class="history-list">
                                        @foreach(explode("\n", str_replace("\r", "", $member->education_history)) as $edu)
                                            @php $trimmedEdu = trim($edu); @endphp
                                            @if($trimmedEdu && strtolower($trimmedEdu) != 'riwayat pendidikan')
                                                <li>{{ $trimmedEdu }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if($member->description)
                            <div class="info-block">
                                <span class="section-title">Tentang</span>
                                <p>{!! nl2br(e($member->description)) !!}</p>
                            </div>
                            @endif

                            <!-- Contact Info removed for BRI Style parity -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
    (function() {
        // Polling to attach listeners and attributes to dynamically rendered cards
        setInterval(function() {
            const cards = document.querySelectorAll('.card-inner:not([data-click-ready])');
            cards.forEach(function(card) {
                const nameEl = card.querySelector('.member-name');
                if (nameEl && window.TEAM_MEMBERS) {
                    const name = nameEl.innerText.trim().toLowerCase();
                    const member = window.TEAM_MEMBERS.find(m => m.name.trim().toLowerCase() === name);
                    
                    if (member) {
                        card.setAttribute('data-click-ready', 'true');
                        card.style.cursor = 'pointer';
                        
                        // Add Bootstrap attributes for native triggering
                        const modalId = '#teamModal' + member.id;
                        card.setAttribute('data-toggle', 'modal');
                        card.setAttribute('data-target', modalId);
                        card.setAttribute('data-bs-toggle', 'modal');
                        card.setAttribute('data-bs-target', modalId);
                        
                        // Direct click handler with movement threshold to prevent swipe conflict
                        let isMoving = false;
                        let startX, startY;

                        card.onmousedown = card.ontouchstart = function(e) {
                            isMoving = false;
                            startX = (e.touches ? e.touches[0].clientX : e.clientX);
                            startY = (e.touches ? e.touches[0].clientY : e.clientY);
                        };

                        card.onmousemove = card.ontouchmove = function(e) {
                            if (!startX) return;
                            const curX = (e.touches ? e.touches[0].clientX : e.clientX);
                            const curY = (e.touches ? e.touches[0].clientY : e.clientY);
                            if (Math.abs(curX - startX) > 5 || Math.abs(curY - startY) > 5) {
                                isMoving = true;
                            }
                        };

                        card.onclick = function(e) {
                            if (isMoving) {
                                e.preventDefault();
                                return false;
                            }
                            if (!document.querySelector('.modal-backdrop')) {
                                try {
                                    if (window.jQuery && window.jQuery.fn.modal) {
                                        window.jQuery(modalId).modal('show');
                                    } else if (window.bootstrap && window.bootstrap.Modal) {
                                        const modalEl = document.querySelector(modalId);
                                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                                    }
                                } catch (err) {
                                    console.log('Manual modal trigger failed');
                                }
                            }
                        };
                    }
                }
            });
        }, 500);

        // CLEAN & ROBUST CSS INJECTION
        const style = document.createElement('style');
        style.textContent = `
            /* 1. Base Card Alignment & Shape */
            .team-section-wrapper .card-inner,
            #team-section-root .card-inner {
                height: 480px !important;
                border-radius: 20px !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
                background: #103652 !important;
                border: 1px solid rgba(255,255,255,0.1) !important;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
                transition: all 0.3s ease !important;
            }

            @media (max-width: 768px) {
                /* Hero Section Mobile Fix */
                .banner-section.hero-enterprise-style {
                    padding: 0 !important;
                    min-height: 70vh !important;
                    height: auto !important;
                }
                .banner-carousel .owl-nav {
                    display: none !important; /* Hide navigation arrows on mobile */
                }
                .hero-enterprise-style .slide-item {
                    padding-top: 100px !important;
                    padding-bottom: 40px !important;
                    min-height: 70vh !important;
                }

                .hero-content-box {
                    text-align: left !important;
                    padding: 0 20px !important;
                    position: relative;
                    z-index: 5;
                }
                .hero-content-box h1 {
                    font-size: 34px !important;
                    line-height: 1.1 !important;
                    margin-bottom: 20px !important;
                    color: #ffffff !important; /* Teks putih agar pop-out */
                    /* Multi-layered shadow agar terbaca di background terang/gelap */
                    text-shadow: 2px 2px 10px rgba(0,0,0,0.8), 0 0 5px rgba(0,0,0,1) !important;
                }
                .hero-content-box .text-accent {
                    color: #f8be14 !important;
                    text-shadow: 1px 1px 5px rgba(0,0,0,0.8) !important;
                }
                .hero-content-box .text-description p {
                    font-size: 16px !important;
                    color: #ffffff !important;
                    font-weight: 700 !important;
                    line-height: 1.6 !important;
                    /* Kontras maksimal ala subtitle film (terbaca di background apapun) */
                    text-shadow: 1px 1px 10px rgba(0,0,0,1), 0 0 5px rgba(0,0,0,1) !important;
                    text-align: left !important;
                    margin: 0 !important;
                }
                .hero-cta-group {
                    text-align: left !important;
                    margin-top: 25px !important;
                    padding-left: 0 !important; /* Hapus padding tambahan agar sejajar teks */
                }
                .btn-whatsapp-hero {
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    gap: 12px !important; /* Jarak icon & teks lebih lega */
                    padding: 16px 36px !important;
                    font-size: 15px !important;
                }
                .hero-showcase-container {
                    margin-top: 25px !important;
                    padding: 0 !important; /* Hilangkan padding agar gambar full-width */
                    position: relative;
                    z-index: 5;
                }
                .floating-data-card {
                    display: none !important; /* Hide cards on mobile to prevent clutter */
                }
                .hero-main-img {
                    max-width: 100% !important; /* Diperbesar maksimal */
                    width: 100% !important;
                    margin: 0 auto !important;
                    border-radius: 20px !important;
                    min-height: auto !important;
                }

                /* Team Section Mobile Fix */
                .team-section-wrapper .card-inner,
                #team-section-root .card-inner {
                    height: auto !important;
                    min-height: 380px !important;
                    margin-bottom: 15px !important;
                }
                .team-section-wrapper .image-wrapper,
                #team-section-root .image-wrapper {
                    height: 260px !important;
                }
                #team-section-root .member-name {
                    font-size: 18px !important;
                }
                #team-section-root .member-role {
                    font-size: 12px !important;
                }
                .team-section-wrapper .card-content,
                #team-section-root .card-content {
                    height: auto !important;
                    padding: 12px !important;
                }

                /* Hide Navigation Arrows on Mobile Team Section */
                .team-section-wrapper .nav-container,
                .team-section-wrapper .nav-btn,
                #team-section-root .nav-container,
                #team-section-root .nav-btn {
                    display: none !important;
                    visibility: hidden !important;
                }
            }

            #team-section-root .card-container:hover .card-inner {
                transform: translateY(-8px) !important;
                border-color: #1DD1A1 !important;
                background: #16466b !important;
            }

            /* Photo Area */
            .team-section-wrapper .image-wrapper,
            #team-section-root .image-wrapper {
                height: 340px !important;
                position: relative !important;
                overflow: hidden !important;
            }

            .card-image {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                object-position: top !important;
            }

            /* Content Area */
            .card-content,
            .team-section-wrapper .card-content,
            #team-section-root .card-content {
                padding: 15px !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                text-align: center !important;
            }

            #team-section-root .member-name {
                color: #ffffff !important;
                font-size: 20px !important;
                font-weight: 700 !important;
                margin-bottom: 5px !important;
            }

            #team-section-root .member-role {
                color: #1DD1A1 !important;
                font-size: 13px !important;
                font-weight: 600 !important;
                text-transform: uppercase !important;
            }

            /* Modal Fixes */
            .btn-close-custom { z-index: 100000 !important; cursor: pointer !important; }
            .modal-backdrop { z-index: 1040 !important; }
            .team-profile-modal { z-index: 1050 !important; }
        `;
        document.head.appendChild(style);
    })();
    </script>
@endif



            <!-- About Section (Premium Redesign) -->
            <section id="about" class="about-section-premium">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Left Column: Content -->
                        <div class="col-lg-6 col-md-12 mb-5 mb-lg-0 wow fadeInLeft">
                            <div class="about-title-wrapper start mb-4">
                                <h2 class="section-title-premium-dynamic" style="color: #000000 !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">Tentang Kami</h2>
                                <div class="yellow-separator"></div>
                            </div>
                            <div class="about-text">
                                <p style="color: #000000 !important;">
                                    PT CMS Duta Solusi merupakan anak Perusahaan BPJS Kesehatan yang didirikan berdasarkan ketetapan Menteri Hukum Republik Indonesia Nomor AHU-0020776.AH.01.02.Tahun 2025. Kami berfokus pada penyediaan solusi digital dan layanan profesional yang handal.
                                </p>
                                <p style="color: #000000 !important;">
                                    Dengan komitmen menjadi mitra strategis yang andal, kami membantu klien mewujudkan efisiensi kerja, kualitas layanan, serta daya saing yang berkelanjutan di era digital.
                                </p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('about') }}" class="btn-premium">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Right Column: Vision & Mission -->
                        <div class="col-lg-6 col-md-12 wow fadeInRight">
                            <div class="row g-4">
                                <!-- Mission -->
                                <div class="col-12">
                                    <div class="vision-mission-box">
                                        <h3 style="color: #000000 !important;"><i class="fas fa-bullseye"></i> Misi Kami</h3>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-3 d-flex align-items-start">
                                                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                                                <span style="color: #000000 !important; text-align: justify !important;">Kolaborasi strategis untuk percepatan bisnis dan transfer knowledge.</span>
                                            </li>
                                            <li class="mb-3 d-flex align-items-start">
                                                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                                                <span style="color: #000000 !important; text-align: justify !important;">Nilai tambah melalui otomasi bisnis dan efisiensi biaya.</span>
                                            </li>
                                            <li class="d-flex align-items-start">
                                                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                                                <span style="color: #000000 !important; text-align: justify !important;">Layanan prima yang berorientasi pada kepuasan pelanggan.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Vision -->
                                <div class="col-12">
                                    <div class="vision-mission-box">
                                        <h3 style="color: #000000 !important;"><i class="fas fa-eye"></i> Visi Kami</h3>
                                        <p class="mb-0" style="color: #000000 !important; text-align: justify !important;">
                                            Menjadi Perusahaan yang inovatif, kolaboratif dan mampu memberikan nilai tambah bagi investor, mitra dan pelanggan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Counters Section (Premium) -->
                    @if(count($counters) > 0)
                    <div class="fun-fact-section-premium mt-5">
                        <div class="row g-4">
                            @foreach($counters as $counter)
                            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                                <div class="counter-card-premium h-100" style="background: #fff; padding: 40px 20px; border-radius: 20px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.02); transition: transform 0.3s ease;">
                                    <div class="count-box">
                                        <div class="count" style="font-size: 50px; font-weight: 800; color: #082d49; line-height: 1; margin-bottom: 15px;">
                                            <span class="count-text" data-speed="3000" data-stop="{{ $counter->value }}">0</span>
                                        </div>
                                        <div class="separater" style="width: 40px; height: 4px; background: #f1c40f; margin: 0 auto 20px auto; border-radius: 2px;"></div>
                                        <h4 class="counter-title" style="font-size: 14px; font-weight: 700; color: #000000; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0;">{{ $counter->title }}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </section>




   @php
    $section_services = \App\Models\Section::section('services');
@endphp
@if(count($services) > 0 && isset($section_services))
<!-- Services Section (Redesigned with Quick Cards style) -->
<section id="services" class="services-section py-4">
    <div class="container">
        <div class="sec-title centered mb-4" style="text-align: center !important; opacity: 1 !important; visibility: visible !important; transform: none !important; position: relative !important; z-index: 10 !important;">
            <h2 class="fw-bold section-title-premium-dynamic" style="color: #000000 !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; opacity: 1 !important; visibility: visible !important; background: transparent !important; -webkit-text-fill-color: initial !important; -webkit-background-clip: border-box !important; display: block;">{{ $section_services->title }}</h2>
            <div class="yellow-separator centered"></div>
            <p class="mt-3" style="max-width: 800px; margin-left: auto; margin-right: auto; color: #1a1a1a !important; font-weight: 500 !important; font-size: 16px !important; line-height: 1.8 !important; font-family: 'Inter', sans-serif !important; opacity: 1 !important; visibility: visible !important;">{!! strip_tags($section_services->description) !!}</p>
        </div>
        
        <div class="services-carousel owl-carousel owl-theme">
            @foreach($services as $service)
            <div class="item px-2">
                <a href="{{ route('service.single', $service->slug) }}" class="quick-card-item">
                    <div class="quick-card-image-wrapper">
                        @if($service->image_path)
                            <img src="{{ asset('uploads/service/'.$service->image_path) }}" class="quick-card-image" alt="{{ $service->title }}">
                        @else
                            <div class="quick-card-icon" style="font-size: 30px; color: var(--primary-blue);">
                                <i class="fas fa-cube"></i>
                            </div>
                        @endif
                    </div>
                    <h3 class="quick-card-title">{{ $service->title }}</h3>
                    <p class="quick-card-desc">{!! \Illuminate\Support\Str::limit(strip_tags($service->short_desc), 80) !!}</p>
                    <span class="mt-auto pt-3" style="color: var(--accent-green); font-weight: 600; font-size: 14px;">Selengkapnya <i class="fas fa-chevron-right ms-1"></i></span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif



    @php
        $section_portfolio = \App\Models\Section::section('portfolio');
    @endphp
    @if(count($portfolios) > 0 && isset($section_portfolio))
    <!-- Gallery Section (Premium Redesign) -->
    <section id="portfolio" class="portfolio-section-premium">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp" style="text-align: center !important;">
                <h2 class="fw-bold section-title-premium-dynamic" style="color: #000000 !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $section_portfolio->title }}</h2>
                <div class="yellow-separator centered"></div>
                <p class="mt-3" style="max-width: 800px; margin-left: auto; margin-right: auto; color: #666666 !important; font-weight: 400 !important; font-size: 16px !important; line-height: 1.8 !important; font-family: 'Inter', sans-serif !important;">{!! strip_tags($section_portfolio->description) !!}</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($portfolios as $portfolio)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    <a href="{{ route('portfolio.single', $portfolio->slug) }}" class="portfolio-card d-block text-decoration-none">
                        <div class="portfolio-image-wrapper">
                            <img src="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                            <div class="portfolio-overlay">
                                <h3>{{ $portfolio->title }}</h3>
                                <span class="btn-premium py-2 px-4 mt-3 rounded-pill" style="font-size: 14px; width: fit-content; display: inline-block; margin-right: auto;">Detail Proyek</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            @php
                $page_portfolio = \App\Models\PageSetup::page('portfolio');
            @endphp
            @if(isset($page_portfolio))
            <div class="load-more-btn text-center mt-5">
                <a href="{{ route('portfolios') }}" class="btn-premium">View All Projects <i class="fas fa-th ms-2"></i></a>
            </div>
            @endif
        </div>
    </section>
    <!--End Gallery Section-->
    @endif


    @php
        $section_testimonials = \App\Models\Section::section('testimonials');
    @endphp
    @if(count($testimonials) > 0 && isset($section_testimonials))
    <!-- Testimonial Section (Premium Redesign) -->
    <section class="testimonial-section-premium">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp">
                <h2 class="text-white">{{ $section_testimonials->title }}</h2>
                <div class="yellow-separator centered"></div>
                <div class="text-white-50 mt-3" style="max-width: 700px; margin-left: auto; margin-right: auto;">{!! $section_testimonials->description !!}</div>
            </div>

            <div class="testimonial-carousel owl-carousel owl-theme">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-card-premium">
                    <div class="testimonial-quote-icon">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <div class="testimonial-text-premium">
                        {!! $testimonial->description !!}
                    </div>
                    <div class="testimonial-author-premium">
                        <img src="{{ asset('uploads/testimonial/'.$testimonial->image_path) }}" alt="{{ $testimonial->title }}">
                        <h5>{{ $testimonial->title }}</h5>
                        <p>{{ $testimonial->designation }}@if(isset($testimonial->organization)), {{ $testimonial->organization }}@endif</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End Testimonial Section-->
    @endif


    @php
        $section_blog = \App\Models\Section::section('blog');
        $blog_title = $section_blog ? $section_blog->title : 'Berita & Artikel Terbaru';
        $blog_desc = $section_blog ? $section_blog->description : 'Ikuti informasi terbaru, tips, dan update seputar dunia digital dan layanan kami.';
    @endphp
    
    @if(count($articles) > 0)
    <!-- News Section (Premium Redesign) -->
    <section id="blog" class="blog-section-premium" style="padding: 60px 0;">
        <div class="container">
            <div class="sec-title centered mb-4 wow fadeInUp">
                <h2 class="fw-bold section-title-premium-dynamic" style="color: #000000 !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important;">{{ $blog_title }}</h2>
                <div class="yellow-separator centered"></div>
                <p class="mt-3" style="max-width: 800px; margin-left: auto; margin-right: auto; color: #666666 !important; font-weight: 400 !important; font-size: 16px !important; line-height: 1.8 !important; font-family: 'Inter', sans-serif !important;">{!! strip_tags($blog_desc) !!}</p>
            </div>

            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    <div class="blog-card-premium">
                        <div class="blog-image-wrapper">
                            @if($article->image_path)
                                <img src="{{ asset('uploads/article/'.$article->image_path) }}" alt="{{ $article->title }}">
                            @endif
                            <div class="blog-date-badge">
                                {{ date('d M, Y', strtotime($article->created_at)) }}
                            </div>
                        </div>
                        <div class="blog-content-premium">
                            <h3><a href="{{ route('blog.single', $article->slug) }}" class="text-decoration-none text-dark">{{ str_limit(strip_tags($article->title), 60, ' ...') }}</a></h3>
                            <p>{!! str_limit(strip_tags($article->description), 120, ' ...') !!}</p>
                            <a href="{{ route('blog.single', $article->slug) }}" class="blog-read-more">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('blogs') }}" class="btn-premium" style="padding: 15px 40px;">Lihat Semua Berita</a>
            </div>
        </div>
    </section>
    <!--End News Section -->
    @endif


    @php
        $section_process = \App\Models\Section::section('process');
        $process_title = $section_process ? $section_process->title : 'Langkah Kerja Kami';
        $process_desc = $section_process ? $section_process->description : 'Proses profesional yang terukur untuk menjamin kualitas setiap proyek yang kami tangani.';
    @endphp
    @if(count($processes) > 0)
    <!-- Process Section (Premium Redesign) -->
    <section class="process-section py-5" style="background: #fcfdfe;">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp">
                <h2 class="fw-bold section-title-premium-dynamic" style="color: #000000 !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important;">{{ $process_title }}</h2>
                <div class="yellow-separator centered"></div>
                <p class="mt-3" style="max-width: 800px; margin-left: auto; margin-right: auto; color: #666666 !important; font-weight: 400 !important; font-size: 16px !important; line-height: 1.8 !important; font-family: 'Inter', sans-serif !important;">{!! strip_tags($process_desc) !!}</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($processes as $key => $process)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ ($key + 1) * 150 }}ms">
                    <div class="process-card-premium text-center p-4 h-100" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); transition: all 0.3s ease;">
                        <div class="process-number mb-3" style="width: 50px; height: 50px; background: #f1c40f; color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: 800; font-size: 20px;">
                            {{ $key + 1 }}
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--primary-blue);">{{ $process->title }}</h4>
                        <div class="text-muted" style="font-size: 14.5px;">{!! $process->description !!}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End Process Section -->
    @endif



    @php
        $section_clients = \App\Models\Section::section('clients');
    @endphp
    <!-- Clients Section (Restored Carousel Animation) -->
    <section class="clients-section-premium py-5" style="background: #fff;">
        <div class="container">
            <div class="sponsors-outer wow fadeInUp">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @foreach($clients as $client)
                    <li class="slide-item">
                        <div class="client-logo-wrapper text-center">
                            @if($client->image_path)
                                <img src="{{ asset('uploads/client/'.$client->image_path) }}" alt="{{ $client->title }}" style="max-width: 180px; height: auto;">
                            @else
                                <div class="p-3" style="background: #f8fafc; border-radius: 12px; font-weight: 700; color: #64748b;">
                                    {{ $client->title }}
                                </div>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <style>
        /* Portfolio and Section Title adjustments if needed */
    </style>
  @section('scripts')
    <!-- Slider Initialization Fix for Mobile -->
    <script>
        $(document).ready(function () {
            // Re-initialize main banner for premium experience
            if ($('.banner-carousel').length) {
                $('.banner-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    margin: 0,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 7000,
                    smartSpeed: 800,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: true,
                    responsive: {
                        0: { dots: true, nav: false },
                        768: { dots: true, nav: false }
                    }
                });
            }

            // Sponsors/Clients Carousel Fix
            if ($('.sponsors-carousel').length) {
                $('.sponsors-carousel').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: false,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    mouseDrag: true,
                    touchDrag: true,
                    responsive: {
                        0: { items: 2 },
                        600: { items: 3 },
                        1000: { items: 5 }
                    }
                });
            }

            // Team/Members Tab Activation
            var triggerTabList = [].slice.call(document.querySelectorAll('#teamTab button'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            });
        });
    </script>
@endsection

@endsection
