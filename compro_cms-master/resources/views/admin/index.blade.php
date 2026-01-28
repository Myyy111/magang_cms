@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    body { background-color: #f8fafc; color: #1e293b; }
    .content-page { background: #f8fafc; }
    
    /* Main Stats Cards */
    .premium-card {
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--card-shadow);
        position: relative;
    }
    .premium-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
    
    .card-stat-main { padding: 2.5rem; color: white; height: 100%; border-radius: 1.25rem; position: relative; overflow: hidden; }
    .card-stat-main.bg-primary { background: var(--primary-gradient); }
    .card-stat-main.bg-success { background: var(--success-gradient); }
    
    .stat-label { font-size: 0.875rem; text-transform: uppercase; font-weight: 700; opacity: 0.9; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .stat-value { font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 0; }
    .stat-icon { position: absolute; right: -15px; bottom: -15px; font-size: 6rem; opacity: 0.12; transform: rotate(-15deg); }

    /* Secondary Grid Cards */
    .stat-grid-card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.75rem;
        display: flex;
        align-items: center;
        border: 1px solid rgba(226, 232, 240, 0.6);
        transition: all 0.3s ease;
    }
    .stat-grid-card:hover { border-color: #3b82f6; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); transform: translateY(-3px); }
    
    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-right: 1.5rem;
        flex-shrink: 0;
    }
    .bg-soft-blue { background-color: #eff6ff; color: #3b82f6; }
    .bg-soft-purple { background-color: #f5f3ff; color: #8b5cf6; }
    .bg-soft-emerald { background-color: #ecfdf5; color: #10b981; }
    .bg-soft-amber { background-color: #fffbeb; color: #f59e0b; }
    .bg-soft-rose { background-color: #fff1f2; color: #f43f5e; }
    .bg-soft-indigo { background-color: #eef2ff; color: #6366f1; }

    .grid-label { font-size: 0.75rem; font-weight: 600; color: #64748b; margin-bottom: 0.25rem; }
    .grid-value { font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-bottom: 0; }
</style>
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-none" style="background: transparent;">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between p-4 bg-white shadow-sm" style="border-radius: 20px; border: 1px solid #f1f5f9;">
                         <div class="d-flex align-items-center">
                            <div class="mr-4 d-none d-md-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #eff6ff; border-radius: 20px;">
                                <i class="fas fa-crown text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h1 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0;">Selamat Siang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                                <p class="text-muted mb-0 mt-1">Sistem CMS Anda berjalan optimal. Ada <b>{{ number_format($total_orders) }} pesanan</b> yang perlu Anda pantau hari ini.</p>
                            </div>
                         </div>
                         <div class="text-right d-none d-lg-block">
                             <a href="{{ route('admin.order.index') }}" class="btn btn-primary px-4 py-2" style="border-radius: 12px; font-weight: 700;">
                                 <i class="fas fa-list-ul mr-2"></i> Kelola Pesanan
                             </a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Highlight Stats -->
    <div class="row mb-5">
        <div class="col-xl-6 col-lg-6 mb-4 mb-xl-0">
            <div class="premium-card">
                <div class="card-stat-main bg-primary shadow-lg">
                    <p class="stat-label">Volume Pesanan</p>
                    <h2 class="stat-value">{{ number_format($total_orders, 0, ',', '.') }} <small style="font-size: 1rem; opacity: 0.8; font-weight: 400;">Transaksi</small></h2>
                    <div class="mt-3">
                        <span class="badge badge-light p-1 px-2" style="background: rgba(255,255,255,0.25); border: none; font-weight: 600; color: white;">
                            <i class="fas fa-chart-line mr-1"></i> Aktifitas Terbaru
                        </span>
                    </div>
                    <i class="fas fa-shopping-bag stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="premium-card">
                <div class="card-stat-main bg-success shadow-lg">
                    <p class="stat-label">Pendapatan Bersih</p>
                    <h2 class="stat-value"><span style="font-size: 1.25rem; font-weight: 400;">IDR</span> {{ number_format($total_revenue, 0, ',', '.') }}</h2>
                    <div class="mt-3">
                        <span class="badge badge-light p-1 px-2" style="background: rgba(255,255,255,0.25); border: none; font-weight: 600; color: white;">
                            <i class="fas fa-shield-alt mr-1"></i> Data Terverifikasi
                        </span>
                    </div>
                    <i class="fas fa-wallet stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Grid -->
    <div class="d-flex align-items-center mb-4">
        <div style="width: 4px; height: 24px; background: #3b82f6; border-radius: 10px; margin-right: 12px;"></div>
        <h5 class="font-weight-bold mb-0" style="color: #0f172a; font-size: 1.1rem;">NAVIGASI KONTEN</h5>
    </div>
    
    <div class="row">
        @php
            $stats = [
                ['label' => 'Blog & Artikel', 'value' => $articles, 'icon' => 'fas fa-pen-nib', 'class' => 'bg-soft-blue', 'url' => route('admin.article.index')],
                ['label' => 'Portofolio Pekerjaan', 'value' => $portfolios, 'icon' => 'fas fa-layer-group', 'class' => 'bg-soft-rose', 'url' => route('admin.portfolio.index')],
                ['label' => 'Layanan Bisnis', 'value' => $services, 'icon' => 'fas fa-rocket', 'class' => 'bg-soft-indigo', 'url' => route('admin.service.index')],
                ['label' => 'Pusat Bantuan (FAQ)', 'value' => $faqs, 'icon' => 'fas fa-comment-dots', 'class' => 'bg-soft-amber', 'url' => route('admin.faq.index')],
                ['label' => 'Personel Tim', 'value' => count($members), 'icon' => 'fas fa-user-friends', 'class' => 'bg-soft-emerald', 'url' => route('admin.member.index')],
                ['label' => 'Jaringan Mitra', 'value' => $clients, 'icon' => 'fas fa-handshake', 'class' => 'bg-soft-purple', 'url' => route('admin.client.index')],
                ['label' => 'Kotak Masuk', 'value' => $contacts, 'icon' => 'fas fa-envelope', 'class' => 'bg-soft-blue', 'url' => route('admin.contact.index')],
                ['label' => 'Daftar Langganan', 'value' => $subscribers, 'icon' => 'fas fa-bolt', 'class' => 'bg-soft-rose', 'url' => route('admin.subscriber.index')],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ $stat['url'] }}" class="text-decoration-none">
                <div class="stat-grid-card border-0 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="icon-box {{ $stat['class'] }}" style="border-radius: 16px;">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="grid-label" style="font-weight: 600; letter-spacing: 0;">{{ $stat['label'] }}</p>
                        <h4 class="grid-value" style="font-weight: 800;">{{ $stat['value'] }}</h4>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
