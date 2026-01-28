@extends('web.layouts.master')
@section('title', __('navbar.error'))
@section('content')

    <style>
        .error-premium-section {
            padding: 100px 0;
            background: #fff;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-content-box {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
        .error-visual {
            position: relative;
            margin-bottom: 40px;
        }
        .error-code-bg {
            font-size: 15rem;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #004aad 0%, #00d2ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
        .error-image {
            max-width: 100%;
            height: auto;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 20px 30px rgba(0,74,173,0.15));
        }
        .error-text-box h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 15px;
        }
        .error-text-box p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 30px;
        }
        .btn-go-home {
            background: linear-gradient(135deg, #004aad 0%, #00d2ff 100%);
            color: white !important;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,74,173,0.2);
            border: none;
        }
        .btn-go-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0,74,173,0.3);
        }
        
        @media (max-width: 768px) {
            .error-code-bg { font-size: 8rem; }
            .error-text-box h2 { font-size: 1.8rem; }
            .error-premium-section { padding: 60px 20px; }
        }
    </style>

    <!--Page Title (Premium Breadcrumb)-->
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Halaman Tidak Ditemukan</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li>Kesalahan 404</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Error Content -->
    <section class="error-premium-section">
        <div class="container">
            <div class="error-content-box">
                <div class="error-visual">
                    <div class="error-code-bg">404</div>
                    <img src="{{ asset('web/images/resource/error-img.png') }}" alt="Error 404" class="error-image">
                </div>
                
                <div class="error-text-box">
                    @php
                        $section_error = \App\Models\Section::section('error');
                    @endphp
                    
                    @if(isset($section_error))
                        <h2>{{ $section_error->title }}</h2>
                        <div class="text mb-4">{!! $section_error->description !!}</div>
                    @else
                        <h2>Ups! Halaman Tidak Ditemukan</h2>
                        <p>Maaf, halaman yang Anda cari mungkin telah dihapus, berganti nama, atau sedang tidak tersedia untuk sementara waktu.</p>
                    @endif
                    
                    <a href="{{ route('home') }}" class="btn-go-home">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection