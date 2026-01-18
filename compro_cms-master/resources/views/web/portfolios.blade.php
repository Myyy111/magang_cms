@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('portfolio');
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

    <!--Page Title-->
    <section class="page-title">
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ __('navbar.portfolios') }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li>{{ __('navbar.portfolios') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-title-bottom-shape"></div>
    </section>
    <!--End Page Title-->


    @php
        $section_portfolio = \App\Models\Section::section('portfolio');
    @endphp
    @if(count($portfolios) > 0 && isset($section_portfolio))
    <!--Gallery Section-->
    <section class="gallery-section">
        <!--Sortable Masonry-->
        <div class="sortable-masonry">
            <div class="container">
                <div class="sec-title centered">
                    <h2>{{ $section_portfolio->title }}</h2>
                    <div class="yellow-separator centered"></div>
                    <div class="text">{!! $section_portfolio->description !!}</div>
                </div>
                <!--Filter-->
                <div class="filters row clearfix">
                    <ul class="portfolio-filter-premium filter-tabs filter-btns clearfix">
                        <li class="active filter" data-role="button" data-filter=".all">{{ __('common.all') }}</li>
                        @foreach($portfolio_categories as $portfolio_category)
                        <li class="filter" data-role="button" data-filter=".{{ $portfolio_category->slug }}">{{ $portfolio_category->title }}</li>
                        @endforeach
                    </ul>
                </div>
            
                <div class="row clearfix items-container">
                    
                    @foreach($portfolios as $portfolio)
                    <!--Default Portfolio Item-->
                    <div class="mix masonry-item all 
                        @foreach($portfolio->categories as $category)
                            {{ $category->slug }} 
                        @endforeach
                     col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="portfolio-card-premium">
                            <div class="image-box">
                                <img src="{{ asset('uploads/portfolio/'.$portfolio->image_path) }}" alt="{{ $portfolio->title }}">
                                <!--Overlay Box-->
                                <div class="overlay-box">
                                    <div class="content">
                                        <div class="tags">
                                            @foreach($portfolio->categories as $category)
                                                <span>{{ $category->title }}</span>{{ !$loop->last ? ' | ' : '' }}
                                            @endforeach
                                        </div>
                                        <h3><a href="{{ route('portfolio.single', $portfolio->slug) }}">{{ $portfolio->title }}</a></h3>
                                        <a href="{{ route('portfolio.single', $portfolio->slug) }}" class="blog-read-more mt-2" style="color: var(--accent-yellow) !important;">
                                            {{ __('common.read_more') }} <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--End Gallery Section-->
    @endif

@endsection