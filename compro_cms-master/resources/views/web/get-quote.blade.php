@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('get-quote');
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
    <section class="page-title" style="background-image: url(https://cmsdutasolusi.co.id/web/images/background/page-title.jpg);">
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Minta Penawaran</h1>
                    <p style="color: white; font-size: 18px; margin-top: 10px;">Get a quote in just 30 minutes</p>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li>Ajukan Penawaran</li>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Quote Section -->
    <section class="contact-section" style="background: #f8f9fa; padding: 100px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="inner-column" style="background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
                        
                        <div class="sec-title centered">
                            <h2 style="font-weight: 800; color: #0A3D62;">Ajukan Penawaran Sekarang</h2>
                            <div class="separater" style="margin: 20px auto;"></div>
                            <div class="text">Silakan lengkapi formulir di bawah ini untuk mendapatkan penawaran terbaik dari kami sesuai kebutuhan Anda.</div>
                        </div>

                        <div class="contact-form mt-5">
                            <form id="whatsapp-quote-form" method="post" action="{{ route('get-quote.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="font-weight-bold">Nama Lengkap *</label>
                                        <input type="text" name="name" placeholder="Masukan nama lengkap Anda" required style="border-radius: 10px; border: 1px solid #ddd; padding: 12px 20px;">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="font-weight-bold">Alamat Email *</label>
                                        <input type="email" name="email" placeholder="contoh@email.com" required style="border-radius: 10px; border: 1px solid #ddd; padding: 12px 20px;">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="font-weight-bold">No. Telepon / WhatsApp *</label>
                                        <input type="text" name="phone" placeholder="0812xxxx" required style="border-radius: 10px; border: 1px solid #ddd; padding: 12px 20px;">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="font-weight-bold">Nama Perusahaan (Opsional)</label>
                                        <input type="text" name="company" placeholder="Nama instansi atau perusahaan" style="border-radius: 10px; border: 1px solid #ddd; padding: 12px 20px;">
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold">Alamat Kantor / Domisili *</label>
                                        <input type="text" name="address" placeholder="Masukan alamat lengkap" required style="border-radius: 10px; border: 1px solid #ddd; padding: 12px 20px;">
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold" style="display: block; margin-bottom: 15px;">Pilih Layanan yang Dibutuhkan *</label>
                                        <div class="row">
                                            @foreach($services as $service)
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="custom-control custom-checkbox p-3" style="background: #fdfdfd; border: 1px solid #eee; border-radius: 10px; transition: all 0.3s;">
                                                    <input type="checkbox" name="services[]" class="custom-control-input" value="{{ $service->title }}" id="service-{{ $service->id }}">
                                                    <label class="custom-control-label" for="service-{{ $service->id }}" style="cursor: pointer; padding-left: 10px;">{{ $service->title }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="font-weight-bold">Detail Kebutuhan Penawaran *</label>
                                        <textarea name="message" placeholder="Tuliskan detail permintaan penawaran Anda di sini..." required style="height: 150px; border-radius: 15px; border: 1px solid #ddd; padding: 15px 20px;"></textarea>
                                    </div>

                                    <div class="form-group col-lg-12 text-center mt-4">
                                        <button class="btn-premium" type="submit" style="padding: 16px 50px; font-size: 18px; border: none; cursor: pointer;">
                                            Kirim via WhatsApp <i class="fab fa-whatsapp" style="margin-left: 10px; font-size: 22px;"></i>
                                        </button>
                                        <p class="mt-3 text-muted small">Pesanan akan otomatis dialihkan ke WhatsApp Admin kami</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('whatsapp-quote-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = form.querySelector('[name="name"]').value;
                const email = form.querySelector('[name="email"]').value;
                const phone = form.querySelector('[name="phone"]').value;
                const company = form.querySelector('[name="company"]').value || '-';
                const address = form.querySelector('[name="address"]').value;
                const message = form.querySelector('[name="message"]').value;
                
                // Get checked services
                const checkedServices = [];
                form.querySelectorAll('input[name="services[]"]:checked').forEach(cb => {
                    checkedServices.push(cb.value);
                });
                const servicesText = checkedServices.length > 0 ? checkedServices.join(', ') : '-';
                
                const targetPhone = '6281188022717'; 
                
                const waMessage = `Halo Admin CMS Duta Solusi,

Saya tertarik untuk mengajukan *Permintaan Penawaran*. Berikut adalah detail kebutuhan saya:

*Informasi Klien:*
• Nama: *${name}*
• Email: ${email}
• No. HP/WA: ${phone}
• Perusahaan: ${company}
• Alamat: ${address}

*Layanan yang Dibutuhkan:*
${servicesText}

*Detail Pesan:*
"${message}"

Mohon dapat segera diproses dan memberikan penawaran terbaik. Terima kasih.`;
                
                const waUrl = `https://wa.me/${targetPhone}?text=${encodeURIComponent(waMessage)}`;
                window.open(waUrl, '_blank');
            });
        }
    });
    </script>

@endsection