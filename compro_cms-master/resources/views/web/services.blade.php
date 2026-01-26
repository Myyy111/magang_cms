@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('services');
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
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ __('navbar.services') }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li>{{ __('navbar.services') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    @php
        $section_services = \App\Models\Section::section('services');
    @endphp
    @if(count($services) > 0 && isset($section_services))
    <!-- Services Section -->
    <section class="services-section-premium" style="background: #fcfdfe; padding: 100px 0;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="sec-title centered">
                        <h2 style="font-size: 32px; font-weight: 900; color: #000; margin-bottom: 15px;">{{ $section_services->title }}</h2>
                        <div class="yellow-separator centered" style="width: 50px; height: 5px; background: #f8be14; margin: 0 auto 20px; border-radius: 10px;"></div>
                        <div class="text" style="color: #000; font-size: 16px; max-width: 800px; margin: 0 auto;">{!! $section_services->description !!}</div>
                    </div> 
                </div>
            </div>   
            <div class="row clearfix g-4">

                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- Service Card Premium -->
                    <div class="service-card-modern shadow-hover" style="background: #fff; border-radius: 20px; border: 1px solid #f1f5f9; height: 100%; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;">
                        <div class="image-box" style="height: 250px; overflow: hidden; position: relative;">
                            <img src="{{ asset('uploads/service/'.$service->image_path) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"/>
                        </div>
                        <div class="lower-content" style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                            <h3 style="margin-bottom: 15px; font-size: 20px; font-weight: 800; line-height: 1.4;">
                                <a href="{{ route('service.single', $service->slug) }}" style="color: #001f3f; text-decoration: none; transition: color 0.3s;">{{ $service->title }}</a>
                            </h3>
                            <div class="text" style="color: #000; font-size: 15px; line-height: 1.7; margin-bottom: 25px; flex-grow: 1;">
                                {!! str_limit(strip_tags($service->short_desc), 110, ' ...') !!}
                            </div>
                            <a href="{{ route('service.single', $service->slug) }}" class="btn-read-more-premium" style="display: flex; align-items: center; gap: 10px; font-weight: 800; color: #004aad; text-decoration: none; font-size: 14px; transition: gap 0.3s;">
                                {{ __('common.read_more') }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>

    <style>
        .service-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
            border-color: #f8be14 !important;
        }
        .service-card-modern:hover img {
            transform: scale(1.1);
        }
        .service-card-modern:hover h3 a {
            color: #f8be14 !important;
        }
        .btn-read-more-premium:hover {
            gap: 15px !important;
            color: #f8be14 !important;
        }
    </style>
    <!--End Services Section -->
    @endif


@endsection