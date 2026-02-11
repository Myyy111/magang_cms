@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<style>
    .order-card {
        border-radius: 15px;
        transition: all 0.3s ease;
        border: 1px solid #eef2f7;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .badge-soft-primary {
        background-color: #e0e7ff;
        color: #4338ca;
    }
</style>

<!-- Start Content-->
<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route($route.'.index') }}" class="btn btn-soft-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Jadwal
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-primary py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius: 12px 12px 0 0;">
                    <h4 class="header-title mb-0 text-white" style="font-weight: 700;">Daftar Order: {{ $schedule }}</h4>
                    <span class="badge badge-light px-3 py-2" style="font-size: 0.9rem;">{{ $orders->count() }} Total Order</span>
                </div>
                <div class="card-body px-4 pb-4 bg-light-soft">
                  
                    @forelse($orders as $order)
                    <div class="card order-card mb-4 shadow-sm bg-white">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <!-- Order Info -->
                                <div class="col-lg-3 border-right">
                                    <div class="mb-2">
                                        <small class="text-uppercase text-muted font-weight-bold" style="letter-spacing: 0.5px; font-size: 10px;">Order Number</small>
                                        <h5 class="mb-0 text-primary" style="font-weight: 700;">#{{ $order->order_number }}</h5>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-uppercase text-muted font-weight-bold" style="letter-spacing: 0.5px; font-size: 10px;">NPP / NIP</small>
                                        <div class="text-dark font-weight-600 mb-1">{{ $order->npp ?: ($order->customer_id_num ?: '-') }}</div>
                                        <div class="d-flex flex-wrap gap-1" style="gap: 5px;">
                                            <span class="badge badge-soft-primary" style="font-size: 10px;">KDKR: {{ $order->kdkr ?? '-' }}</span>
                                            <span class="badge badge-soft-success" style="font-size: 10px;">KDKC: {{ $order->kdkc ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <small class="text-uppercase text-muted font-weight-bold" style="letter-spacing: 0.5px; font-size: 10px;">Status</small>
                                        <div class="mt-1">
                                            @if($order->status == 'completed')
                                                <span class="badge badge-success px-2 py-1">Selesai</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge badge-info px-2 py-1">Menunggu Dismantel</span>
                                            @else
                                                <span class="badge badge-warning px-2 py-1">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Barang / Items -->
                                <div class="col-lg-5 border-right px-lg-4">
                                    <small class="text-uppercase text-muted font-weight-bold d-block mb-2" style="letter-spacing: 0.5px; font-size: 10px;">Barang Pesanan</small>
                                    <div class="item-list">
                                        @foreach($order->items as $item)
                                        <div class="d-flex align-items-center mb-2 p-2 rounded" style="background: #f8fafc; border: 1px solid #f1f5f9;">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="rounded bg-white p-1 shadow-xs" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-laptop text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 font-weight-bold" style="font-size: 0.85rem;">{{ $item->product->title ?? 'Produk' }}</h6>
                                                <small class="text-muted">Jumlah: {{ $item->quantity }} unit</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Documents / Action -->
                                <div class="col-lg-4 pl-lg-4">
                                    <small class="text-uppercase text-muted font-weight-bold d-block mb-3" style="letter-spacing: 0.5px; font-size: 10px;">Surat Pernyataan / Dokumen</small>
                                    
                                    <div class="d-flex flex-column gap-2">
                                        @if($order->esign_path)
                                            <a href="{{ route('ecommerce.download_pdf', $order->id) }}" target="_blank" class="btn btn-outline-success btn-sm mb-2 text-left">
                                                <i class="fas fa-file-pdf mr-2"></i> Lihat Full E-Surat Pernyataan (PDF)
                                            </a>
                                        @elseif($order->signed_document_path)
                                            <a href="{{ asset('uploads/documents/' . $order->signed_document_path) }}" target="_blank" class="btn btn-outline-info btn-sm mb-2 text-left">
                                                <i class="fas fa-file-pdf mr-2"></i> Lihat Scan Dokumen
                                            </a>
                                        @else
                                            <div class="alert alert-warning py-2 mb-2" style="font-size: 11px;">
                                                <i class="fas fa-exclamation-triangle mr-1"></i> Dokumen belum diunggah
                                            </div>
                                        @endif

                                        <div class="mt-3">
                                            <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="d-flex gap-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-success btn-block" {{ $order->status == 'completed' ? 'disabled' : '' }}>
                                                    <i class="fas fa-check-circle mr-1"></i> Tandai Selesai Dismantel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <img src="{{ asset('dashboard/images/no-data.svg') }}" style="width: 150px; opacity: 0.5;" class="mb-3">
                        <h5 class="text-muted">Tidak ada order dalam jadwal ini</h5>
                    </div>
                    @endforelse

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    
</div> <!-- container -->

@endsection
