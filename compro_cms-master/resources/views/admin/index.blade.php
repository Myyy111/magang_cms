@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    body { background-color: #fcfcfd; color: #334155; }
    .content-page { background: #fcfcfd; }
    
    /* Minimal Stats Cards */
    .premium-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s ease;
        height: 100%;
        overflow: hidden;
    }
    .premium-card:hover { transform: translateY(-2px); border-color: #cbd5e1; }
    
    .card-stat-main { padding: 1.75rem; position: relative; }
    .card-stat-main.border-left-primary { border-left: 4px solid #3b82f6; }
    .card-stat-main.border-left-success { border-left: 4px solid #10b981; }
    
    .stat-label { font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: #64748b; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .stat-value { font-size: 1.85rem; font-weight: 700; color: #0f172a; line-height: 1; margin-bottom: 0; }
    .stat-icon { position: absolute; right: 20px; top: 1.75rem; font-size: 1.5rem; color: #cbd5e1; opacity: 0.5; }
    .border-left-primary .stat-icon { color: var(--accent); opacity: 0.15; font-size: 3rem; right: 10px; top: 1rem; }
    .border-left-success .stat-icon { color: var(--success); opacity: 0.15; font-size: 3rem; right: 10px; top: 1rem; }

    /* Secondary Grid Cards (Minimalist with Color) */
    .stat-grid-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .stat-grid-card:hover { border-color: #cbd5e1; background: #fcfcfd; transform: translateY(-2px); }
    
    .icon-box {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        margin-right: 1.25rem;
        flex-shrink: 0;
    }
    .icon-box.blue { background: #eff6ff; color: #3b82f6; }
    .icon-box.rose { background: #fff1f2; color: #f43f5e; }
    .icon-box.indigo { background: #eef2ff; color: #6366f1; }
    .icon-box.amber { background: #fffbeb; color: #f59e0b; }
    .icon-box.emerald { background: #ecfdf5; color: #10b981; }
    .icon-box.purple { background: #f5f3ff; color: #8b5cf6; }

    .grid-label { font-size: 0.75rem; font-weight: 500; color: #64748b; margin-bottom: 0.1rem; }
    .grid-value { font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0; }
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
                                @if(auth()->user()->role == 'teknisi')
                                    <p class="text-muted mb-0 mt-1">Sistem operasional berjalan optimal. Selamat bekerja dan pantau jadwal Anda hari ini.</p>
                                @else
                                    <p class="text-muted mb-0 mt-1">Sistem CMS Anda berjalan optimal. Ada <b>{{ number_format($total_orders) }} pesanan</b> yang perlu Anda pantau hari ini.</p>
                                @endif
                            </div>
                         </div>
                         @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                         <div class="text-right d-none d-lg-block">
                             <a href="{{ route('admin.order.index') }}" class="btn btn-dark px-4 py-2" style="border-radius: 12px; font-weight: 700;">
                                 <i class="fas fa-list-ul mr-2"></i> Kelola Pesanan
                             </a>
                         </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Highlight Stats -->
    <div class="row mb-5">
        <div class="col-xl-6 col-lg-6 mb-4 mb-xl-0">
            <div class="premium-card">
                <div class="card-stat-main border-left-primary">
                    <p class="stat-label">Volume Pesanan</p>
                    <h2 class="stat-value">{{ number_format($total_orders, 0, ',', '.') }} <small style="font-size: 0.9rem; color: #94a3b8; font-weight: 400;">Transaksi</small></h2>
                    <div class="mt-2">
                        <span class="badge badge-info">
                            <i class="fas fa-chart-line mr-1"></i> Aktifitas Terbaru
                        </span>
                    </div>
                    <i class="fas fa-shopping-bag stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="premium-card">
                <div class="card-stat-main border-left-success">
                    <p class="stat-label">Pendapatan Bersih</p>
                    <h2 class="stat-value"><span style="font-size: 1rem; color: #94a3b8; font-weight: 400;">IDR</span> {{ number_format($total_revenue, 0, ',', '.') }}</h2>
                    <div class="mt-2">
                        <span class="badge badge-success">
                            <i class="fas fa-shield-alt mr-1"></i> Data Terverifikasi
                        </span>
                    </div>
                    <i class="fas fa-wallet stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
    <!-- Secondary Stats Grid -->
    <div class="d-flex align-items-center mb-4">
        <h5 class="font-weight-bold mb-0" style="color: #64748b; font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase;">NAVIGASI KONTEN</h5>
    </div>
    
    <div class="row">
        @php
            $stats = [
                ['label' => 'Blog & Artikel', 'value' => $articles, 'icon' => 'fas fa-pen-nib', 'color' => 'blue', 'url' => route('admin.article.index')],
                ['label' => 'Portofolio Pekerjaan', 'value' => $portfolios, 'icon' => 'fas fa-layer-group', 'color' => 'rose', 'url' => route('admin.portfolio.index')],
                ['label' => 'Layanan Bisnis', 'value' => $services, 'icon' => 'fas fa-rocket', 'color' => 'indigo', 'url' => route('admin.service.index')],
                ['label' => 'Pusat Bantuan (FAQ)', 'value' => $faqs, 'icon' => 'fas fa-comment-dots', 'color' => 'amber', 'url' => route('admin.faq.index')],
                ['label' => 'Personel Tim', 'value' => count($members), 'icon' => 'fas fa-user-friends', 'color' => 'emerald', 'url' => route('admin.member.index')],
                ['label' => 'Jaringan Mitra', 'value' => $clients, 'icon' => 'fas fa-handshake', 'color' => 'purple', 'url' => route('admin.client.index')],
                ['label' => 'Kotak Masuk', 'value' => $contacts, 'icon' => 'fas fa-envelope', 'color' => 'blue', 'url' => route('admin.contact.index')],
                ['label' => 'Daftar Langganan', 'value' => $subscribers, 'icon' => 'fas fa-bolt', 'color' => 'rose', 'url' => route('admin.subscriber.index')],
            ];
        @endphp
 
        @foreach($stats as $stat)
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ $stat['url'] }}" class="text-decoration-none">
                <div class="stat-grid-card border-0">
                    <div class="icon-box {{ $stat['color'] }}">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="grid-label">{{ $stat['label'] }}</p>
                        <h4 class="grid-value">{{ $stat['value'] }}</h4>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
