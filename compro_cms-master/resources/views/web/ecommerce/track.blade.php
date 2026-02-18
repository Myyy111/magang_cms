@extends('web.layouts.master')
@section('title', $title)
@section('content')

    <style>
        /* Button Hover Animation */
        .btn-search-animated {
            transition: all 0.3s ease;
        }
        .btn-search-animated:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 74, 173, 0.4) !important;
            filter: brightness(1.1);
        }
        .btn-search-animated:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(0, 74, 173, 0.3) !important;
        }
        
        /* Mobile Optimization for Track Page */
        @media (max-width: 768px) {
            .track-section {
                padding: 40px 0 !important;
            }
            .card-body {
                padding: 30px 20px !important;
            }
            .track-section h3 {
                font-size: 22px !important;
            }
            .page-title-premium h1 {
                font-size: 28px !important;
            }
            
            /* Breadcrumb Fix */
            .bread-crumb ul li {
                font-size: 13px !important;
                margin-right: 5px !important;
            }
            .bread-crumb ul li:after {
                margin: 0 5px !important;
            }

            /* Search Form Mobile */
            .track-form-container {
                flex-direction: column;
            }
            .track-form-container .input-group {
                display: flex;
                flex-direction: column;
                gap: 15px;
                background: transparent !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            .track-form-container input {
                border-radius: 12px !important;
                border-right: 2px solid #eee !important;
                text-align: center;
                height: 55px !important;
                padding: 0 20px !important;
                width: 100% !important;
            }
            .track-form-container .btn-premium {
                border-radius: 12px !important;
                width: 100% !important;
                height: 55px !important;
                margin: 0 !important;
                justify-content: center;
                font-weight: 700;
                box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3) !important;
            }

            /* Responsive Status Steps */
            .track-steps {
                margin: 30px 0 !important;
            }
            .step-label {
                font-size: 11px !important;
                line-height: 1.2;
                margin-top: 5px;
            }
            .step-icon {
                width: 30px !important;
                height: 30px !important;
                font-size: 12px !important;
            }
            
            /* Table Mobile Fixes */
            .table-responsive {
                border: 0;
            }
            .table thead {
                display: none;
            }
            .table tbody tr {
                display: block;
                border-bottom: 1px solid #eee;
                padding: 15px 0;
            }
            .table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 5px 0 !important;
                text-align: right !important;
                border: none !important;
            }
            .table tbody td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                color: #555;
            }
            .table tfoot tr {
                display: block;
                padding: 15px 0;
            }
            .table tfoot td {
                display: flex;
                justify-content: space-between;
                padding: 0 !important;
                border: none !important;
            }
            .tfoot-total-label {
                display: none !important;
            }
        }
    </style>

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
                        <li>Status Pesanan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!--Track Section-->
    <section class="track-section" style="padding: 80px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if(!isset($order))
                    <!-- Clean Search Box -->
                    <div class="search-container text-center px-3" style="padding: 40px 0;">
                        <div class="search-box-clean mx-auto" style="max-width: 600px;">
                            <form action="{{ route('ecommerce.track') }}" method="GET">
                                <div class="input-group-clean d-flex align-items-center bg-white shadow-sm p-1" style="border-radius: 50px; border: 1px solid #e8ecef;">
                                    <div class="search-icon px-3 text-muted">
                                        <i class="fas fa-search" style="font-size: 16px;"></i>
                                    </div>
                                    <input type="text" name="order_number" class="form-control border-0 shadow-none py-3 px-2" placeholder="Masukkan Nomor Pesanan Anda..." value="{{ old('order_number', $old_order_number ?? '') }}" required style="background: transparent; font-size: 14px; color: #666;">
                                    <button class="btn btn-search-animated px-3 py-2 mr-1" type="submit" style="border-radius: 50px; font-weight: 600; letter-spacing: 0.2px; background: #004aad; color: white; border: none; box-shadow: 0 2px 8px rgba(0, 74, 173, 0.3); font-size: 13px;">
                                        <i class="fas fa-search mr-1"></i>Lacak
                                    </button>
                                </div>
                                <p class="mt-3 mb-0 text-muted" style="font-size: 13px;">Contoh: <span style="color: #e74c3c; font-weight: 600;">ORD-[ID_PESANAN]</span>. Nomor ini ada di kuitansi Anda.</p>
                            </form>
                        </div>
                    </div>
                    @endif

                    @if(isset($order))
                    <!-- Integrated Search + Order Result -->
                    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp" style="border-radius: 15px;">
                        <!-- Integrated Search Header -->
                        <div class="card-header bg-gradient text-white border-0 p-4" style="background: linear-gradient(135deg, #004aad 0%, #0066cc 100%); border-radius: 15px 15px 0 0;">
                            <form action="{{ route('ecommerce.track') }}" method="GET" class="mb-3">
                                <div class="input-group-modern d-flex align-items-center bg-white shadow-sm p-1" style="border-radius: 100px;">
                                    <div class="icon-box px-3 text-muted">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <input type="text" name="order_number" class="form-control border-0 shadow-none py-3" placeholder="Cari pesanan lain..." value="{{ request('order_number') }}" required style="background: transparent; font-size: 14px;">
                                    <button class="btn btn-search-animated px-4 py-2 mr-1" type="submit" style="border-radius: 100px; font-weight: 600; font-size: 13px; background: #004aad; color: white; border: none; box-shadow: 0 2px 8px rgba(0, 74, 173, 0.3);">
                                        <i class="fas fa-search mr-1"></i>Lacak
                                    </button>
                                </div>
                            </form>
                            
                            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                <div>
                                    <small class="d-block mb-1" style="opacity: 0.9; font-size: 12px;">Nomor Pesanan</small>
                                    <h4 class="mb-0 font-weight-bold">{{ $order->order_number }}</h4>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-light px-3 py-2" style="font-size: 12px;">
                                        <i class="far fa-calendar-alt mr-1"></i> {{ $order->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-4 py-3">
                            
                            <!-- Status Steps (Slim Version) -->
                            <div class="track-steps mb-4 mt-2">
                                <div class="d-flex justify-content-between position-relative">
                                    <!-- Progress Bar Line -->
                                    <div class="position-absolute" style="top: 15px; left: 12.5%; width: 75%; height: 3px; background: #eee; z-index: 1;"></div>
                                    <div class="position-absolute" style="top: 15px; left: 12.5%; width: {{ $order->status == 'completed' ? '75%' : ($order->status == 'processing' ? '50%' : ($order->status == 'paid' ? '25%' : '0%')) }}; height: 3px; background: #2ecc71; z-index: 1; transition: width 0.5s ease;"></div>

                                    <!-- Step 1 -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-1" style="width: 30px; height: 30px; border-radius: 50%; background: {{ in_array($order->status, ['pending', 'paid', 'processing', 'completed']) ? '#2ecc71' : '#eee' }}; color: white; font-size: 12px;">
                                            <i class="fas fa-shopping-basket"></i>
                                        </div>
                                        <div class="step-label font-weight-bold" style="font-size: 10px; color: {{ in_array($order->status, ['pending', 'paid', 'processing', 'completed']) ? '#333' : '#999' }};">Pesanan<br>Diterima</div>
                                    </div>
                                    
                                    <!-- Step 2 -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-1" style="width: 30px; height: 30px; border-radius: 50%; background: {{ in_array($order->status, ['paid', 'processing', 'completed']) ? '#2ecc71' : '#eee' }}; color: white; font-size: 12px;">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div class="step-label font-weight-bold" style="font-size: 10px; color: {{ in_array($order->status, ['paid', 'processing', 'completed']) ? '#333' : '#999' }};">Pembayaran<br>Dikonfirmasi</div>
                                    </div>

                                    <!-- Step 3 -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-1" style="width: 30px; height: 30px; border-radius: 50%; background: {{ in_array($order->status, ['processing', 'completed']) ? '#2ecc71' : '#eee' }}; color: white; font-size: 12px;">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="step-label font-weight-bold" style="font-size: 10px; color: {{ in_array($order->status, ['processing', 'completed']) ? '#333' : '#999' }};">Jadwal<br>Dismentel</div>
                                        @if($order->status == 'processing' && $order->dismantel_schedule) 
                                            <div class="badge badge-primary mt-1" style="font-size: 9px; padding: 2px 5px;">{{ $order->dismantel_schedule }}</div>
                                        @endif
                                    </div>

                                    <!-- Step 4 -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-1" style="width: 30px; height: 30px; border-radius: 50%; background: {{ $order->status == 'completed' ? '#2ecc71' : '#eee' }}; color: white; font-size: 12px;">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="step-label font-weight-bold" style="font-size: 10px; color: {{ $order->status == 'completed' ? '#333' : '#999' }};">Selesai</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row no-gutters bg-light rounded p-3 mb-3" style="font-size: 13px;">
                                <div class="col-md-6 border-right pr-md-3">
                                    <h6 class="font-weight-bold mb-2 text-primary" style="font-size: 13px;"><i class="fas fa-user-circle mr-1"></i> Data Pemesan</h6>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Nama:</span>
                                        <span class="font-weight-600">{{ $order->customer_name }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Unit:</span>
                                        <span class="font-weight-600 text-right" style="max-width: 150px;">{{ str_replace(['(Lihat Detail)', 'Lihat Detail'], '', $order->customer_unit) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 pl-md-3 mt-3 mt-md-0">
                                    <h6 class="font-weight-bold mb-2 text-primary" style="font-size: 13px;"><i class="fas fa-shopping-bag mr-1"></i> Ringkasan Order</h6>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted">Item:</span>
                                        <span class="font-weight-600">{{ $order->items->sum('quantity') }} Produk</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Total Bayar:</span>
                                        <span class="font-weight-bold text-success">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" style="max-height: 200px; overflow-y: auto; border: 1px solid #eee; border-radius: 8px;">
                                <table class="table table-sm table-hover mb-0" style="font-size: 13px;">
                                    <thead class="bg-white sticky-top">
                                        <tr>
                                            <th class="border-top-0 px-3">Produk</th>
                                            <th class="text-center border-top-0">Qty</th>
                                            <th class="text-right border-top-0 px-3">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td class="px-3 py-2">{{ $item->product ? $item->product->title : 'Produk Dihapus' }}</td>
                                            <td class="text-center py-2">{{ $item->quantity }}</td>
                                            <td class="text-right px-3 py-2">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($order->signed_document_path)
                            <div class="mt-4 p-3 bg-light rounded d-flex align-items-center justify-content-center" style="border: 1px solid #2ecc71;">
                                <span class="text-success font-weight-bold"><i class="fas fa-check-circle me-2"></i> Dokumen Surat Pernyataan sudah kami terima.</span>
                            </div>
                            @endif

                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--End Track Section-->

@endsection
