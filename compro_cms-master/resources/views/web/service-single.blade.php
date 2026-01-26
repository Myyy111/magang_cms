@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('services');
@endphp
@if(isset($header))

    @section('title', $service->title)

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
    <meta property='og:title' content="{{ $service->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($service->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('service.single', $service->slug) }}"/>
    <meta property='og:image' content="{{ asset('uploads/service/'.$service->image_path) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('service.single', $service->slug) }}" />
    <meta name="twitter:title" content="{{ $service->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($service->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/service/'.$service->image_path) }}" />
    @endif
@endsection

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
                        <li><a href="{{ route('services') }}">{{ __('navbar.services') }}</a></li>
                        <li>{{ __('navbar.service-detail') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    @if(isset($service))
    <!--Sidebar Page Container-->
    <div class="sidebar-page-container" style="background: #f8fafc; padding: 100px 0;">
        <div class="container">
            <div class="row clearfix">
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar service-sidebar-premium wow fadeInLeft" style="position: sticky; top: 100px;">
                        <div class="sidebar-widget categories-premium p-4" style="background: #fff; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
                            <h3 style="font-size: 18px; font-weight: 800; color: #001f3f; margin-bottom: 20px;">Layanan Kami</h3>
                            <ul class="cat-list list-unstyled mb-0">
                                @foreach($service_lists as $service_list)
                                <li class="mb-2">
                                    <a href="{{ route('service.single', $service_list->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center p-3 rounded @if($service_list->id == $service->id) bg-yellow-premium shadow-sm @else text-dark @endif" style="transition: all 0.3s ease; font-weight: 700; font-size: 14px; @if($service_list->id == $service->id) background: #f8be14; color: #000 !important; @endif">
                                        {{ $service_list->title }}
                                        <i class="fas fa-chevron-right" style="font-size: 10px; opacity: 0.5;"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
                
                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="service-detail-premium-box wow fadeInRight" style="background: #fff; padding: 40px; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
                        <div class="inner-box">
                            <div class="image-box mb-4" style="border-radius: 20px; overflow: hidden; height: 400px;">
                                <img src="{{ asset('uploads/service/'.$service->image_path) }}" alt="{{ $service->title }}" style="width: 100%; height: 100%; object-fit: cover;"/>
                            </div>
                            <h2 style="font-size: 32px; font-weight: 900; color: #001f3f; margin-bottom: 25px;">{{ $service->title }}</h2>
                            <div class="text" style="color: #000; font-size: 17px; line-height: 1.9;">
                                {!! $service->description !!}
                            </div>
                        </div> 

                        <div class="mt-5 pt-4 border-top">
                            @php
                                $page_quote = \App\Models\PageSetup::page('get-quote');
                                $page_contact = \App\Models\PageSetup::page('contact-us');
                            @endphp
                            @if(isset($page_quote))
                            <a href="{{ route('get-quote') }}" class="btn-yellow-premium" style="display: inline-block; padding: 15px 35px; background: #f8be14; color: #000; font-weight: 800; border-radius: 12px; text-decoration: none; box-shadow: 0 6px 15px rgba(248,190,20,0.2); transition: all 0.3s;">{{ __('navbar.get_quote') }} <i class="fas fa-arrow-right ms-2"></i></a>
                            @elseif(isset($page_contact))
                            <a href="{{ route('contact') }}" class="btn-yellow-premium" style="display: inline-block; padding: 15px 35px; background: #f8be14; color: #000; font-weight: 800; border-radius: 12px; text-decoration: none; box-shadow: 0 6px 15px rgba(248,190,20,0.2); transition: all 0.3s;">{{ __('common.get_start') }} <i class="fas fa-arrow-right ms-2"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-yellow-premium:hover {
            background: #eab308 !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(248,190,20,0.3) !important;
        }
        .cat-list a:hover {
            background: #f8fafc;
            color: #f8be14 !important;
        }
    </style>
    @endif

@endsection