@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('contact-us');
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
            <div class="inner-container">
                <div class="title-box wow fadeInUp">
                    <h1>{{ __('navbar.contact') }}</h1>
                </div>
                <div class="bread-crumb wow fadeInUp" data-wow-delay="0.2s">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li>{{ __('navbar.contact') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-title-bottom-shape"></div>
    </section>
    <!--End Page Title-->

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">

                @php
                    $section_mail = \App\Models\Section::section('mail');
                @endphp
                @if(isset($section_mail))
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-12 col-sm-12 wow fadeInLeft">
                     <div class="sec-title left mb-4">
                        <h2 class="fw-bold" style="color: #0A3D62 !important; font-size: 36px !important;">{{ $section_mail->title }}</h2>
                        <div class="my-3 rounded" style="width: 60px; height: 3px; background: #f1c40f; display: block !important; margin: 0 !important;"></div>
                        <div class="text-muted">{!! $section_mail->description !!}</div>
                    </div>
                    <div class="inner-column">
                        <!-- Message Display logic omitted for brevity, keeping existing markers -->
                        <div class="text-center">
                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                {{ Session::get('success') }}
                            </div>
                            @endif

                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                {{ Session::get('error') }}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>

                        <!-- Contact Form -->
                        <div class="contact-form">
                            <form id="whatsapp-contact-form" method="post" action="{{ route('contact.send') }}" accept-charset="utf-8">
                                @csrf
                                <div class="row g-4">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <input type="text" name="name" placeholder="{{ __('contact.your_name') }}" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12">
                                        <input type="text" name="phone" placeholder="{{ __('contact.phone_no') }}" value="{{ old('phone') }}">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12">
                                        <input type="email" name="email" placeholder="{{ __('contact.email_address') }}" value="{{ old('email') }}" required>
                                    </div>
                                    
                                    <div class="form-group col-lg-6 col-md-12">
                                        <input type="text" name="subject" placeholder="{{ __('contact.subject') }}" value="{{ old('subject') }}" required>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12">
                                        <textarea name="message" placeholder="{{ __('contact.your_massage') }}" rows="5" required>{{ old('message') }}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-lg-12 col-md-12">
                                        <button class="btn-premium" type="submit" name="submit-form">
                                            {{ __('contact.send') }} <i class="fab fa-whatsapp ms-2"></i>
                                        </button>
                                    </div> 
                                </div>
                            </form>
                        </div>
                        @if(isset($setting->google_map))
                        <!-- Map Below Form -->
                        <div class="map-wrapper mt-5 wow fadeInUp" data-wow-delay="0.3s" style="border-radius: 25px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05);">
                            <div class="ratio ratio-21x9" style="min-height: 350px;">
                                {!! strip_tags($setting->google_map, '<iframe>') !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @php
                    $section_contact = \App\Models\Section::section('contact');
                @endphp
                @if(isset($setting) && isset($section_contact))
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-12 col-sm-12 wow fadeInRight">
                    <div class="sec-title left mb-4">
                        <h2 class="fw-bold" style="color: #0A3D62 !important; font-size: 36px !important;">{{ $section_contact->title }}</h2>
                        <div class="my-3 rounded" style="width: 60px; height: 3px; background: #f1c40f; display: block !important; margin: 0 !important;"></div>
                    </div>
                    <div class="inner-column">
                        <ul class="contact-info">
                            <li> 
                                <i class="fas fa-envelope"></i> 
                                <div>
                                    <span>{{ __('contact.email') }}</span>
                                    <a href="mailto:{{ $setting->email_one }}">{{ $setting->email_one }}</a>
                                    @if(isset($setting->email_two))<br><a href="mailto:{{ $setting->email_two }}">{{ $setting->email_two }}</a>@endif
                                </div>
                            </li>
                            <li> 
                                <i class="fab fa-whatsapp"></i>  
                                <div>
                                    <span>{{ __('contact.phone') }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_one) }}" target="_blank">{{ $setting->phone_one }}</a>
                                    @if(isset($setting->phone_two))<br><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_two) }}" target="_blank">{{ $setting->phone_two }}</a>@endif
                                </div>
                            </li>
                            @if(isset($setting->office_hours))
                            <li>
                                <i class="fas fa-clock"></i> 
                                <div>
                                    <span>{{ __('contact.office_time') }}</span>
                                    {!! strip_tags($setting->office_hours) !!}
                                </div>
                            </li>
                            @endif
                            <li>
                                <i class="fas fa-map-marker-alt"></i> 
                                <div>
                                    <span>{{ __('contact.address') }}</span>
                                    {{ $setting->contact_address }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!--End Contact Section -->


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('whatsapp-contact-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = form.querySelector('[name="name"]').value;
                const phone = form.querySelector('[name="phone"]').value || '-';
                const email = form.querySelector('[name="email"]').value;
                const subject = form.querySelector('[name="subject"]').value;
                const message = form.querySelector('[name="message"]').value;
                
                const targetPhone = '6281188022717'; 
                
                const waMessage = `Halo Admin CMS Duta Solusi,

Perkenalkan, nama saya *${name}*. Saya ingin mengajukan pertanyaan/konsultasi terkait *${subject}*.

Berikut adalah detail informasi saya:
• *Email:* ${email}
• *Telepon:* ${phone}

*Pesan:*
"${message}"

Mohon informasi lebih lanjut mengenai hal tersebut. Terima kasih atas bantuannya.`;
                
                const waUrl = `https://wa.me/${targetPhone}?text=${encodeURIComponent(waMessage)}`;
                
                // Buka WhatsApp di tab baru
                window.open(waUrl, '_blank');
            });
        }
    });
    </script>

@endsection