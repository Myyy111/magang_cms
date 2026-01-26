@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('faqs');
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
                    <h1>{{ __('navbar.faqs') }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        @if(isset($current_category))
                            <li><a href="{{ route('faqs') }}">{{ __('navbar.faqs') }}</a></li>
                            <li>{{ $current_category->title }}</li>
                        @else
                            <li>{{ __('navbar.faqs') }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    @php
        $section_faqs = \App\Models\Section::section('faqs');
    @endphp
    @if(isset($section_faqs))
    <!--FAQs Section-->
    <section class="faq-section-premium" style="background: #f8fafc; padding: 100px 0;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="sec-title centered">
                        <h2 style="font-size: 32px; font-weight: 900; color: #001f3f;">{{ $section_faqs->title }}</h2>
                        <div class="yellow-separator centered" style="width: 50px; height: 5px; background: #f8be14; margin: 15px auto; border-radius: 10px;"></div>
                        <div class="text" style="color: #000; font-size: 16px;">{!! $section_faqs->description !!}</div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Sidebar Category -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="faq-sidebar-premium" style="background: #fff; padding: 25px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; position: sticky; top: 100px;">
                        <h3 style="font-size: 18px; font-weight: 800; color: #001f3f; margin-bottom: 20px;">Kategori FAQ</h3>
                        <div class="faq-cat-list" style="display: flex; flex-direction: column; gap: 8px;">
                            <a href="{{ route('faqs') }}" class="faq-cat-pill {{ !request()->route('slug') ? 'active' : '' }}">
                                <span class="text">Semua Pertanyaan</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            @foreach($faq_categories as $faq_category)
                            <a href="{{ route('faqs.category', $faq_category->slug) }}" class="faq-cat-pill {{ (request()->route('slug') && isset($current_category) && $current_category->id == $faq_category->id) ? 'active' : '' }}">
                                <span class="text">{{ $faq_category->title }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- FAQ Accordions -->
                <div class="accordion-column col-lg-8 col-md-12 col-sm-12">
                    <div class="premium-accordion-wrapper">
                        @foreach($faqs as $key => $faq)
                        <div class="faq-item-premium mb-3" style="background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); overflow: hidden;">
                            <div class="faq-header-premium" onclick="toggleFaq(this)" style="padding: 20px 25px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.3s;">
                                <h4 style="font-size: 16px; font-weight: 700; color: #001f3f; margin: 0; line-height: 1.5;">{{ $faq->title }}</h4>
                                <div class="faq-icon-box" style="width: 30px; height: 30px; border-radius: 50%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #000; transition: all 0.3s;">
                                    <i class="fas fa-plus" style="font-size: 12px;"></i>
                                </div>
                            </div>
                            <div class="faq-body-premium" style="max-height: 0; overflow: hidden; transition: all 0.4s cubic-bezier(0,1,0,1);">
                                <div style="padding: 0 25px 25px; color: #000; font-size: 15px; line-height: 1.7;">
                                    {!! $faq->description !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .faq-cat-pill {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 18px;
            border-radius: 12px;
            text-decoration: none !important;
            color: #000 !important;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .faq-cat-pill:hover {
            background: #f1f5f9;
            color: #f8be14 !important;
        }
        .faq-cat-pill.active {
            background: #f8be14;
            color: #000 !important;
        }
        .faq-cat-pill i {
            font-size: 11px;
            opacity: 0.5;
        }
        .faq-cat-pill.active i {
            opacity: 1;
        }

        .faq-item-premium.active {
            border-color: #f8be14 !important;
            box-shadow: 0 10px 25px rgba(248,190,20,0.08) !important;
        }
        .faq-item-premium.active .faq-header-premium {
            background: #fafbfc;
        }
        .faq-item-premium.active .faq-icon-box {
            background: #f8be14 !important;
            color: #000 !important;
            transform: rotate(45deg);
        }
    </style>

    <script>
        function toggleFaq(el) {
            const item = el.parentElement;
            const body = item.querySelector('.faq-body-premium');
            const isActive = item.classList.contains('active');
            
            // Close all others
            document.querySelectorAll('.faq-item-premium').forEach(i => {
                i.classList.remove('active');
                i.querySelector('.faq-body-premium').style.maxHeight = '0';
            });
            
            if (!isActive) {
                item.classList.add('active');
                body.style.maxHeight = '1000px';
            }
        }
    </script>
    @endif


    @php
        $section_clients = \App\Models\Section::section('clients');
    @endphp
    @if(count($clients) > 0 && isset($section_clients))
    <!--Clients Section-->
    <section class="clients-section style-two">
        <div class="container">
            <div class="sponsors-outer">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @foreach($clients as $client)
                    <li class="slide-item"><figure class="image-box"><a href="{{ $client->link }}" target="_blank"><img src="{{ asset('uploads/client/'.$client->image_path) }}" alt="{{ $client->title }}"></a></figure></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--End Clients Section-->
    @endif

@endsection