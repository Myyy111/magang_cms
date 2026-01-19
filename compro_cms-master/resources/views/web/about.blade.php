@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('about-us');
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

@section('content')

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <!-- Floating Elements for Premium Feel -->
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container">
                <div class="title-box">
                    <h1>{{ __('navbar.about') }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li>{{ __('navbar.about') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    @if(isset($about) || count($counters) > 0)
    <!-- About Section (Matched with Homepage Premium Style) -->    
    <section class="about-section-premium">
        <div class="container">
            @if(isset($about))
            <div class="row align-items-center g-5">
                <!-- Left Column: Content -->
                <div class="col-lg-6 col-md-12 mb-5 mb-lg-0 wow fadeInLeft">
                    <div class="about-title-wrapper start mb-4" style="text-align: left !important;">
                        <h2 style="color: #000000 !important; font-size: 42px !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $about->title }}</h2>
                    </div>
                    <div class="about-text">
                        <div style="color: #000000 !important; font-size: 17px; line-height: 1.8; font-family: 'Inter', sans-serif;">
                            {!! $about->description !!}
                        </div>
                        <style>
                            .about-text p, .about-text span, .vision-mission-box .text, .vision-mission-box p, .vision-mission-box li {
                                color: #000000 !important;
                                opacity: 1 !important;
                            }
                        </style>
                    </div>
                </div>

                <!-- Right Column: Vision & Mission -->
                <div class="col-lg-6 col-md-12 wow fadeInRight">
                    <div class="row g-4">
                        @if(isset($about->mission_title))
                        <div class="col-12">
                            <div class="vision-mission-box">
                                <h3 style="color: #000000 !important; font-weight: 800; font-size: 24px;"><i class="fas fa-bullseye"></i> {{ $about->mission_title }}</h3>
                                <div class="text" style="color: #000000 !important;">{!! $about->mission_desc !!}</div>
                            </div>
                        </div>
                        @endif
                        @if(isset($about->vision_title))
                        <div class="col-12">
                            <div class="vision-mission-box">
                                <h3 style="color: #000000 !important; font-weight: 800; font-size: 24px;"><i class="fas fa-eye"></i> {{ $about->vision_title }}</h3>
                                <div class="text" style="color: #000000 !important;">{!! $about->vision_desc !!}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Counters Section (Premium) -->
            @if(count($counters) > 0)
            <div class="fun-fact-section-premium mt-5">
                <div class="row g-4">
                    @foreach($counters as $counter)
                    <!--Column-->
                    <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                        <div class="counter-card-premium h-100" style="background: #fff; padding: 40px 20px; border-radius: 20px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.02); transition: transform 0.3s ease;">
                            <div class="count-box">
                                <div class="count" style="font-size: 50px; font-weight: 800; color: #082d49; line-height: 1; margin-bottom: 15px;">
                                    <span class="count-text" data-speed="5000" data-stop="{{ $counter->value }}">0</span>
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
    <!--End About Section --> 
    @endif

    @php
        $section_whyus = \App\Models\Section::section('why-us');
    @endphp
    @if(isset($section_whyus) || isset($about->video_id))
    <!--Why Choose Us Section (Matched Style) -->
    <section class="why-choose-us py-5" style="background: #ffffff;">
        <div class="container">
            <div class="row align-items-center g-5">
                @if(!empty($about->video_id))
                 <!--Image Column-->
                <div class="col-lg-6 col-md-12 col-sm-12 wow fadeInLeft">
                    <div class="video-box-wrapper" style="position: relative; border-radius: 30px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.1);">
                        <div class="ratio ratio-16x9">
                          <iframe src="https://www.youtube.com/embed/{{ $about->video_id }}?rel=0" allowfullscreen style="border: none;"></iframe>
                        </div>
                    </div>
                </div>
                @endif


                @if(count($chooses) > 0 && isset($section_whyus))
                <div class="col-lg-6 col-md-12 col-sm-12 wow fadeInRight">
                    <div class="inner-column">
                        <div class="sec-title left mb-4">
                            <h2 style="color: #000000 !important; font-size: 42px !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $section_whyus->title }}</h2>
                            <div class="my-3 rounded" style="width: 60px; height: 3px; background: #f1c40f; display: block !important; margin: 0 !important;"></div>
                        </div>
                        <div class="mb-4" style="color: #000000 !important; line-height: 1.8; font-size: 16px;">{!! $section_whyus->description !!}</div>
                        <ul class="list-unstyled mb-5">
                            @foreach($chooses as $choose)
                            <li class="mb-3 d-flex align-items-center" style="font-weight: 600; color: #000000 !important;">
                                <i class="fas fa-check-circle me-3" style="color: #1DD1A1; font-size: 20px;"></i>
                                {{ $choose->title }}
                            </li>
                            @endforeach
                        </ul>

                        @php
                            $page_quote = \App\Models\PageSetup::page('get-quote');
                            $page_contact = \App\Models\PageSetup::page('contact-us');
                        @endphp
                        @if(isset($page_quote))
                        <a href="{{ route('get-quote') }}" class="btn-premium">{{ __('navbar.get_quote') }} <i class="fas fa-arrow-right ms-2"></i></a>
                        @elseif(isset($page_contact))
                        <a href="{{ route('contact') }}" class="btn-premium">{{ __('common.get_start') }} <i class="fas fa-arrow-right ms-2"></i></a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!--End Why Choose Us Section -->
    @endif


    @php
        $section_team = \App\Models\Section::section('team');
    @endphp
    @if(count($members) > 0 && isset($section_team))
    <!-- Team Section (Matched Style) -->
    <section class="team-section-premium py-5" style="background: #fbfcfe;">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp">
                <h2 style="color: #000000 !important; font-size: 42px !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $section_team->title }}</h2>
                <div class="yellow-separator centered"></div>
                <div style="color: #666666 !important; max-width: 800px; margin: 0 auto; font-size: 16px;">{!! $section_team->description !!}</div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($members as $member)
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                    <!-- Team Card Premium (Clickable) -->
                    <div class="blog-card-premium team-card-clickable" 
                         style="border-radius: 20px; cursor: pointer;"
                         data-bs-toggle="modal" 
                         data-bs-target="#teamModal{{ $member->id }}"
                         onclick="openTeamModal({{ $member->id }})">
                        <div class="blog-image-wrapper" style="height: 300px; position: relative;">
                            <img src="{{ asset('uploads/member/'.$member->image_path) }}" alt="{{ $member->title }}" style="object-fit: cover;">
                            <!-- Hover Overlay -->
                            <div class="team-card-overlay">
                                <i class="fas fa-eye" style="font-size: 32px; color: white;"></i>
                                <p style="color: white; margin-top: 10px; font-weight: 600;">Lihat Profil</p>
                            </div>
                        </div>
                        <div class="blog-content-premium text-center">
                            <h3 class="mb-1">{{ $member->title }}</h3>
                            <p class="mb-3">
                                {{ $member->designation ? $member->designation->title : '' }}
                            </p>
                            <div class="d-flex justify-content-center gap-2">
                                @if(isset($member->facebook))
                                <a href="{{ $member->facebook }}" class="btn-premium p-2" style="width: 35px; height: 35px; min-width: auto; border-radius: 10px;" onclick="event.stopPropagation();"><i class="fab fa-facebook-f" style="font-size: 14px;"></i></a>
                                @endif
                                @if(isset($member->linkedin))
                                <a href="{{ $member->linkedin }}" class="btn-premium p-2" style="width: 35px; height: 35px; min-width: auto; border-radius: 10px;" onclick="event.stopPropagation();"><i class="fab fa-linkedin-in" style="font-size: 14px;"></i></a>
                                @endif
                                @if(isset($member->instagram))
                                <a href="{{ $member->instagram }}" class="btn-premium p-2" style="width: 35px; height: 35px; min-width: auto; border-radius: 10px;" onclick="event.stopPropagation();"><i class="fab fa-instagram" style="font-size: 14px;"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Team Member Modals (Premium BRI-Style Redesign) -->
    @foreach($members as $member)
    <div class="modal fade team-profile-modal" id="teamModal{{ $member->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Custom Close Button -->
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" data-dismiss="modal">
                        <i class="far fa-times-circle"></i> Close
                    </button>

                    <div class="row g-5">
                        <!-- Photo Column -->
                        <div class="col-md-5">
                            <div class="member-photo-wrapper">
                                <img src="{{ asset('uploads/member/'.$member->image_path) }}" alt="{{ $member->title }}" class="member-photo">
                            </div>

                            <!-- Social Media (Added subtly under photo) -->
                            @if($member->facebook || $member->linkedin || $member->instagram || $member->twitter)
                            <div class="d-flex gap-3 justify-content-center mt-4">
                                @if($member->facebook)
                                <a href="{{ $member->facebook }}" target="_blank" style="color: #4B5563; font-size: 18px;"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" style="color: #4B5563; font-size: 18px;"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if($member->instagram)
                                <a href="{{ $member->instagram }}" target="_blank" style="color: #4B5563; font-size: 18px;"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($member->twitter)
                                <a href="{{ $member->twitter }}" target="_blank" style="color: #4B5563; font-size: 18px;"><i class="fab fa-twitter"></i></a>
                                @endif
                            </div>
                            @endif
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
                                <div class="history-content" style="color: #434e5a; line-height: 1.8; font-size: 15px;">
                                    <ul class="history-list">
                                        @foreach(explode("\n", str_replace("\r", "", $member->career_history)) as $career)
                                            @if(trim($career))
                                                <li style="margin-bottom: 8px; position: relative;">{{ trim($career) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if($member->education_history)
                            <div class="info-block">
                                <span class="section-title">Riwayat Pendidikan</span>
                                <div class="history-content" style="color: #434e5a; line-height: 1.8; font-size: 15px;">
                                    <ul class="history-list">
                                        @foreach(explode("\n", str_replace("\r", "", $member->education_history)) as $edu)
                                            @if(trim($edu))
                                                <li style="margin-bottom: 8px; position: relative;">{{ trim($edu) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if($member->description)
                            <div class="info-block">
                                <span class="section-title">Tentang</span>
                                <p style="color: #434e5a; line-height: 1.8; font-size: 15px;">{!! nl2br(e($member->description)) !!}</p>
                            </div>
                            @endif

                            <!-- Contact Information -->
                            @if($member->email || $member->phone || $member->whatsapp || $member->website)
                            <div class="contact-info">
                                <div class="d-flex flex-wrap gap-4">
                                    @if($member->email)
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-envelope" style="color: var(--primary-blue);"></i>
                                        <a href="mailto:{{ $member->email }}" style="color: #4B5563; text-decoration: none; font-size: 14px;">{{ $member->email }}</a>
                                    </div>
                                    @endif
                                    @if($member->whatsapp)
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" target="_blank" style="color: #4B5563; text-decoration: none; font-size: 14px;">{{ $member->whatsapp }}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
    function openTeamModal(memberId) {
        // Optional: Add analytics or other actions when modal opens
        console.log('Opening profile for member ID:', memberId);
    }
    </script>
    <!--End Team Section -->
    @endif


    @php
        $section_process = \App\Models\Section::section('process');
    @endphp
    @if(count($processes) > 0 && isset($section_process))
    <!--Process Section (Matched Style) -->
    <section class="process-section py-5" style="background: #ffffff;">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp">
                <h2 style="color: #000000 !important; font-size: 42px !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $section_process->title }}</h2>
                <div class="yellow-separator centered"></div>
                <div style="color: #666666 !important; max-width: 800px; margin: 0 auto; font-size: 16px;">{!! $section_process->description !!}</div>
            </div>
            
            <div class="row g-4 justify-content-center">
                @foreach($processes as $key => $process)
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ ($key + 1) * 150 }}ms">
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
    @if(count($clients) > 0 && isset($section_clients))
    <!--Clients Section (Matched Style)-->
    <section class="clients-section-premium py-5" style="background: #fbfcfe; border-top: 1px solid rgba(0,0,0,0.05);">
        <div class="container">
            <div class="sec-title centered mb-5 wow fadeInUp">
                <h2 style="color: #000000 !important; font-size: 42px !important; font-weight: 900 !important; font-family: 'Inter', sans-serif !important; letter-spacing: -0.02em !important; margin-bottom: 15px !important; display: block;">{{ $section_clients->title }}</h2>
                <div class="yellow-separator centered"></div>
                <div style="color: #666666 !important; max-width: 800px; margin: 0 auto; font-size: 16px;">{!! $section_clients->description !!}</div>
            </div>
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
    <!--End Clients Section-->
    @endif

@endsection