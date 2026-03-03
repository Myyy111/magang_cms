@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('portfolio');
@endphp
@if(isset($header))

    @section('title', $portfolio->title)

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
    <meta property='og:title' content="{{ $portfolio->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($portfolio->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('portfolio.single', $portfolio->slug) }}"/>
    <meta property='og:image' content="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $portfolio->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($portfolio->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}" />
    @endif
@endsection

@section('content')

    {{-- Page Title (Premium Cut) --}}
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        <div class="container">
            <div class="inner-container">
                <div class="title-box">
                    <h1>{{ $portfolio->title }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li><a href="{{ route('portfolios') }}">Portfolio</a></li>
                        <li>{{ $portfolio->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if(isset($portfolio))
    {{-- Portfolio Detail Section --}}
    <section class="project-details-section">
        <div class="project-detail">
            <div class="container">

                {{-- Featured Image --}}
                <div class="upper-box">
                    <figure class="image">
                        <a href="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}" class="lightbox-image" data-fancybox="images">
                            <img src="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                        </a>
                    </figure>
                </div>

                {{-- Content Row --}}
                <div class="lower-content">
                    <div class="row clearfix">

                        {{-- Left Column: Main Text --}}
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <h2>{{ $portfolio->title }}</h2>

                                {{-- Category badges --}}
                                @if($portfolio->categories->count() > 0)
                                <div class="mb-4">
                                    @foreach($portfolio->categories as $cat)
                                    <span class="category-badge-p">{{ $cat->title }}</span>
                                    @endforeach
                                </div>
                                @endif

                                <div class="portfolio-description">
                                    {!! $portfolio->description !!}
                                </div>

                                @if(!empty($portfolio->video_id))
                                <div class="embed-responsive embed-responsive-16by9 mt-5" style="border-radius:24px; overflow:hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $portfolio->video_id }}?rel=0" allowfullscreen></iframe>
                                </div>
                                @endif

                                {{-- Action Buttons --}}
                                @php
                                    $page_quote = \App\Models\PageSetup::page('get-quote');
                                    $page_contact = \App\Models\PageSetup::page('contact-us');
                                @endphp
                                <div class="portfolio-action-btns">
                                    <a href="{{ route('portfolios') }}" class="btn-back-portfolio">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Portfolio
                                    </a>
                                    @if(isset($page_quote))
                                    <a href="{{ route('get-quote') }}" class="btn-cta-portfolio">{{ __('navbar.get_quote') }}</a>
                                    @elseif(isset($page_contact))
                                    <a href="{{ route('contact') }}" class="btn-cta-portfolio">{{ __('common.get_start') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Side Info --}}
                        <div class="info-column col-lg-4 col-md-12 col-sm-12 mt-5 mt-lg-0">
                            <div class="sidebar-card">
                                <h4 style="font-size:20px; font-weight:800; color:#001f3f; margin-bottom:25px; padding-bottom:15px; border-bottom:2px solid #f3f4f6; display:flex; align-items:center; gap:10px;">
                                    <i class="fas fa-info-circle text-accent" style="font-size:18px;"></i> Informasi Proyek
                                </h4>
                                
                                <ul style="list-style:none; padding:0; margin:0;">
                                    @if($portfolio->categories->count() > 0)
                                    <li>
                                        <span class="label-text">Kategori</span>
                                        <span class="value-text">{{ $portfolio->categories->pluck('title')->join(', ') }}</span>
                                    </li>
                                    @endif
                                    
                                    @if(!empty($portfolio->link))
                                    <li>
                                        <span class="label-text">Proyek</span>
                                        <a href="{{ $portfolio->link }}" target="_blank" class="value-text" style="color:#004aad; text-decoration:none;">
                                            Lihat Proyek <i class="fas fa-external-link-alt" style="font-size:11px; margin-left:5px;"></i>
                                        </a>
                                    </li>
                                    @endif
                                    
                                    @if(!empty($portfolio->video_id))
                                    <li>
                                        <span class="label-text">Video</span>
                                        <a href="https://www.youtube.com/watch?v={{ $portfolio->video_id }}" target="_blank" class="value-text" style="color:#ef4444; text-decoration:none; display:flex; align-items:center; gap:8px;">
                                            <i class="fab fa-youtube"></i> YouTube
                                        </a>
                                    </li>
                                    @endif
                                </ul>

                                {{-- Share Section --}}
                                <div class="mt-5 pt-4" style="border-top:1px solid #f3f4f6;">
                                    <p style="font-size:12px; font-weight:800; color:#9ca3af; margin-bottom:15px; text-transform:uppercase; letter-spacing:1.5px;">Bagikan Proyek</p>
                                    <div style="display:flex; gap:12px;">
                                        <a href="https://wa.me/?text={{ urlencode($portfolio->title . ' - ' . route('portfolio.single', $portfolio->slug)) }}" target="_blank" class="share-icon-btn" style="background:#25d366;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('portfolio.single', $portfolio->slug)) }}&title={{ urlencode($portfolio->title) }}" target="_blank" class="share-icon-btn" style="background:#0077b5;">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('portfolio.single', $portfolio->slug)) }}" target="_blank" class="share-icon-btn" style="background:#1877f2;">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Related Portfolios Section --}}
    @if(isset($related_portfolios) && $related_portfolios->count() > 0)
    <section style="padding: 100px 0; background: #fcfdfe; position:relative;">
        <div class="container">
            <div class="sec-title text-center mb-5">
                <span style="font-size:14px; font-weight:800; color:#004aad; text-transform:uppercase; letter-spacing:2px; display:block; margin-bottom:10px;">Eksplorasi Lainnya</span>
                <h2 style="font-size:36px !important; font-weight:900 !important; color:#001f3f !important;">Portfolio Terkait</h2>
            </div>
            
            <div class="row">
                @foreach($related_portfolios as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <a href="{{ route('portfolio.single', $item->slug) }}" style="text-decoration:none; display:block;">
                        <div style="border-radius:24px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.06); transition:all 0.4s ease; background:#ffffff; border:1px solid rgba(0,0,0,0.04);"
                             onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 50px rgba(0,74,173,0.1)';"
                             onmouseout="this.style.transform=''; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.06)';">
                            <div style="height:240px; overflow:hidden; position:relative;">
                                <img src="{{ asset('uploads/portfolio/'.$item->image_path) }}" alt="{{ $item->title }}"
                                     style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;"
                                     onmouseover="this.style.transform='scale(1.1)'"
                                     onmouseout="this.style.transform=''">
                                @if($item->categories->count() > 0)
                                <div style="position:absolute; top:20px; left:20px; background:rgba(255,255,255,0.9); padding:5px 15px; border-radius:100px; font-size:10px; font-weight:800; color:#004aad; text-transform:uppercase; letter-spacing:1px; backdrop-filter:blur(5px);">
                                    {{ $item->categories->first()->title }}
                                </div>
                                @endif
                            </div>
                            <div style="padding:25px 30px;">
                                <h5 style="font-size:18px; font-weight:800; color:#001f3f; margin-bottom:10px; line-height:1.4;">{{ $item->title }}</h5>
                                <div style="color:var(--accent-yellow); font-size:13px; font-weight:700; display:flex; align-items:center; gap:8px;">
                                    Lihat Detail <i class="fas fa-arrow-right" style="font-size:10px;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection