@extends('web.layouts.master')
@section('title', $title)
@section('content')

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('ecommerce.index') }}">E-Commerce</a></li>
                        <li>Success</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!--Success Section-->
    <section class="success-section" style="padding: 100px 0; background: #fff;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="font-size: 80px; color: #2ecc71; margin-bottom: 30px;">
                        <i class="far fa-check-circle"></i>
                    </div>
                    <h2 style="margin-bottom: 20px; font-weight: 700; color: #333;">Terima Kasih!</h2>
                    <h4 style="margin-bottom: 30px; line-height: 1.6;">Pesanan Anda <strong>{{ $order->order_number }}</strong> berhasil dibuat.</h4>
                    
                    <p style="margin-bottom: 40px; font-size: 16px; color: #666;">
                        Kami telah menerima pesanan Anda. Tim kami akan segera memprosesnya dan menghubungi Anda melalui WhatsApp di nomor <strong>{{ $order->customer_contact }}</strong> untuk konfirmasi dan mekanisme pembayaran selanjutnya.
                    </p>

                    <div class="btn-box">
                        <a href="{{ route('ecommerce.index') }}" class="btn-premium">Kembali ke Katalog</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
