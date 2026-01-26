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
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!--Checkout Section-->
    <section class="checkout-section" style="padding: 80px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <!-- Data Karyawan -->
                <div class="col-lg-7 col-md-12">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h4 class="mb-0" style="color: #004aad; font-weight: 700;">Data Pemesan</h4>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <form action="{{ route('ecommerce.process') }}" method="POST"> 
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_name" class="form-label font-weight-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="customer_name" required style="height: 50px; border-radius: 8px;">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="customer_id_num" class="form-label font-weight-bold">NIP / ID Karyawan</label>
                                        <input type="text" class="form-control" name="customer_id_num" required style="height: 50px; border-radius: 8px;">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="customer_contact" class="form-label font-weight-bold">Nomor WhatsApp</label>
                                        <input type="text" class="form-control" name="customer_contact" required style="height: 50px; border-radius: 8px;">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_unit" class="form-label font-weight-bold">Unit Kerja / Divisi</label>
                                        <input type="text" class="form-control" name="customer_unit" required style="height: 50px; border-radius: 8px;">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="shipping_address" class="form-label font-weight-bold">Alamat Pengiriman (Opsional jika internal)</label>
                                        <textarea class="form-control" name="shipping_address" rows="3" style="border-radius: 8px;"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn-premium w-100 mt-3" style="border: none;">Proses Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="col-lg-5 col-md-12">
                     <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h4 class="mb-0" style="color: #004aad; font-weight: 700;">Ringkasan Pesanan</h4>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <ul class="list-group list-group-flush mb-3">
                                @php 
                                    $subtotal = 0; 
                                    $total_shipping = 0;
                                    $shipping_per_item = 20000;
                                @endphp
                                @foreach($cart as $id => $details)
                                    @php 
                                        $subtotal += $details['price'] * $details['quantity'];
                                        $product = \App\Models\Product::find($details['product_id']);
                                        $item_shipping = ($product && $product->is_free_ongkir) ? 0 : $shipping_per_item;
                                        $total_shipping += $item_shipping;
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div>
                                            <h6 class="my-0">{{ $details['title'] }}</h6>
                                            @if(isset($details['variants']) && count($details['variants']) > 0)
                                                <small class="text-muted d-block">
                                                    @foreach($details['variants'] as $attr => $val)
                                                        {{ $attr }}: {{ $val }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </small>
                                            @endif
                                            <small class="text-muted">{{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }}</small>
                                            @if($product && $product->is_free_ongkir)
                                                <br><span class="badge badge-success" style="font-size: 10px; background: #1dd1a1; color: #000;">Gratis Ongkir</span>
                                            @endif
                                        </div>
                                        <span class="text-muted">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                                
                                <li class="list-group-item d-flex justify-content-between px-0" style="border-top: 1px solid #eee;">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0" style="border-top: none; padding-top: 0;">
                                    <span>Ongkos Kirim</span>
                                    <span style="color: {{ $total_shipping == 0 ? '#1dd1a1' : 'inherit' }}; font-weight: {{ $total_shipping == 0 ? '800' : 'normal' }};">
                                        {{ $total_shipping == 0 ? 'Gratis' : 'Rp '.number_format($total_shipping, 0, ',', '.') }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0" style="background: transparent; border-top: 2px dashed #eee;">
                                    <span style="font-size: 18px; font-weight: bold;">Total (IDR)</span>
                                    <strong style="font-size: 18px; color: #004aad;">Rp {{ number_format($subtotal + $total_shipping, 0, ',', '.') }}</strong>
                                </li>
                            </ul>

                            <!-- Hidden values for the form -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.querySelector('form[action="{{ route('ecommerce.process') }}"]');
                                    const shippingInput = document.createElement('input');
                                    shippingInput.type = 'hidden';
                                    shippingInput.name = 'shipping_cost';
                                    shippingInput.value = '{{ $total_shipping }}';
                                    form.appendChild(shippingInput);
                                });
                            </script>

                            <div class="alert alert-info border-0" role="alert" style="background: #ecf6ff; color: #004aad;">
                                <i class="fas fa-info-circle mr-2"></i> Pembayaran akan diproses sesuai mekanisme internal perusahaan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
