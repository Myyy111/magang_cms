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

    <!--Page Title-->
    <section class="page-title">
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
        <div class="page-title-bottom-shape"></div>
    </section>
    <!--End Page Title-->


    @php
        $section_services = \App\Models\Section::section('services');
    @endphp
    @if(count($services) > 0 && isset($section_services))
    <!-- Services Section -->
    <section class="services-section style-four" style="background-image: url({{ asset('web/images/background/services-bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-title centered">
                        <h2>{{ $section_services->title }}</h2>
                        <div class="text">{!! $section_services->description !!}</div>
                        <div class="yellow-separator centered"></div>
                    </div> 
                </div>
            </div>   
            <div class="row clearfix">

                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <!-- Service Card Premium -->
                    <div class="service-card-premium wow fadeInDown">
                        <div class="image-box">
                            <img src="{{ asset('uploads/service/'.$service->image_path) }}" alt="{{ $service->title }}"/>
                        </div>
                        <div class="lower-content">
                            <h3><a href="{{ route('service.single', $service->slug) }}">{{ $service->title }}</a></h3>
                            <div class="text">{!! str_limit(strip_tags($service->short_desc), 120, ' ...') !!}</div>
                            <a href="{{ route('service.single', $service->slug) }}" class="blog-read-more">
                                {{ __('common.read_more') }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!--End Services Section -->
    @endif


    @php
        $section_process = \App\Models\Section::section('process');
    @endphp
    @if(count($processes) > 0 && isset($section_process))
    <!--Feautred Section -->
    <section class="feautred-section style-two" style="background-image: url({{ asset('web/images/background/process-bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-title left">
                        <h2>{{ $section_process->title }}</h2>
                        <div class="text">{!! $section_process->description !!}</div>
                        <div class="yellow-separator left"></div>
                    </div>
                </div>
            </div>
            <div class="featured-box row clearfix">
                @foreach($processes as $key => $process)
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ ($key + 1) * 200 }}ms">
                    <div class="inner-box">
                        <div class="title-box">
                            <h4><span class="numbe-post">{{ $key + 1 }}</span>{{ $process->title }}</h4>
                        </div>
                        <div class="lower-content">
                            <div class="text">{!! $process->description !!}</div> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End Feautred Section -->
    @endif

@endsection