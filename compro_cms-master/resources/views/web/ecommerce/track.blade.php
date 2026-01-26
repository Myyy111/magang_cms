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
                    <!-- Search Box -->
                    <div class="card shadow-sm border-0 mb-5">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-4" style="color: #004aad; font-weight: 700;">Lacak Pesanan Anda</h3>
                            <p class="mb-4 text-muted">Masukkan Nomor Pesanan (Order ID) yang Anda terima di email untuk melihat status terkini.</p>
                            
                            <form action="{{ route('ecommerce.track') }}" method="GET" class="d-flex justify-content-center">
                                <div class="input-group" style="max-width: 500px;">
                                    <input type="text" name="order_number" class="form-control form-control-lg" placeholder="Contoh: ORD-6790C4..." value="{{ request('order_number') }}" required style="border-radius: 50px 0 0 50px; border: 2px solid #eee; border-right: none; padding-left: 25px;">
                                    <button class="btn btn-premium" type="submit" style="border-radius: 0 50px 50px 0; padding: 0 30px;">Lacak <i class="fas fa-search ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(isset($order))
                    <!-- Order Result -->
                    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h5 class="mb-1 text-muted">Nomor Pesanan</h5>
                                <h3 style="color: #004aad; font-weight: 800;">{{ $order->order_number }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="mb-1 text-muted">Tanggal Pesanan</p>
                                <h6 class="font-weight-bold">{{ $order->created_at->format('d M Y, H:i') }}</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-4">
                            
                            <!-- Status Steps -->
                            <div class="track-steps my-5">
                                <div class="d-flex justify-content-between position-relative">
                                    <!-- Progress Bar Line -->
                                    <div class="position-absolute" style="top: 15px; left: 0; width: 100%; height: 4px; background: #eee; z-index: 1;"></div>
                                    <div class="position-absolute" style="top: 15px; left: 0; width: {{ $order->status == 'completed' ? '100%' : ($order->status == 'paid' ? '50%' : '0%') }}; height: 4px; background: #2ecc71; z-index: 1; transition: width 0.5s ease;"></div>

                                    <!-- Step 1: Pending -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border-radius: 50%; background: {{ $order->status == 'pending' || $order->status == 'paid' || $order->status == 'completed' ? '#2ecc71' : '#eee' }}; color: white;">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                        <div class="step-label font-weight-bold {{ $order->status == 'pending' ? 'text-primary' : '' }}">Pesanan Diterima</div>
                                        @if($order->status == 'pending') <small class="text-primary d-block mt-1">Menunggu Pembayaran</small> @endif
                                    </div>
                                    
                                    <!-- Step 2: Processing/Paid -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border-radius: 50%; background: {{ $order->status == 'paid' || $order->status == 'completed' ? '#2ecc71' : '#eee' }}; color: white;">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <div class="step-label font-weight-bold {{ $order->status == 'paid' ? 'text-primary' : '' }}">Pembayaran Dikonfirmasi</div>
                                         @if($order->status == 'paid') <small class="text-primary d-block mt-1">Sedang Diproses</small> @endif
                                    </div>

                                    <!-- Step 3: Completed -->
                                    <div class="step-item text-center position-relative" style="z-index: 2; flex: 1;">
                                        <div class="step-icon d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border-radius: 50%; background: {{ $order->status == 'completed' ? '#2ecc71' : '#eee' }}; color: white;">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="step-label font-weight-bold {{ $order->status == 'completed' ? 'text-primary' : '' }}">Selesai</div>
                                    </div>
                                </div>
                            </div>

                            <hr style="border-top: 2px dashed #eee;">

                            <!-- Order Details -->
                            <h5 class="font-weight-bold mb-3 mt-4" style="color: #004aad;">Rincian Produk</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead style="background: #f1faff;">
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                @if($item->product)
                                                {{ $item->product->title }}
                                                @else
                                                Produk Dihapus
                                                @endif
                                            </td>
                                            <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-right font-weight-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="border-top: 2px solid #eee;">
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold pt-3" style="font-size: 18px;">Total Bayar</td>
                                            <td class="text-right font-weight-bold pt-3" style="color: #004aad; font-size: 18px;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded h-100">
                                        <h6 class="font-weight-bold mb-2">Info Pemesan</h6>
                                        <p class="mb-1"><strong>Nama:</strong> {{ $order->customer_name }}</p>
                                        <p class="mb-1"><strong>Kontak:</strong> {{ $order->customer_contact }}</p>
                                        <p class="mb-0"><strong>Unit:</strong> {{ $order->customer_unit }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <div class="bg-light p-3 rounded h-100">
                                        <h6 class="font-weight-bold mb-2">Alamat Pengiriman</h6>
                                        <p class="mb-0">{{ $order->shipping_address ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--End Track Section-->

@endsection
