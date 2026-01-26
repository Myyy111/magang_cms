@extends('web.layouts.master')
@section('title', $title)
@section('content')
    <style>
        .cart-container {
            padding: 40px 0 80px;
            background: #f4f7fa;
            min-height: 600px;
        }
        .cart-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .cart-item-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            background: #f0f0f0;
        }
        .item-title {
            font-size: 18px;
            font-weight: 700;
            color: #001f3f;
            margin-bottom: 5px;
            display: block;
            text-decoration: none !important;
        }
        .item-price {
            font-size: 16px;
            font-weight: 800;
            color: #004aad;
        }
        .qty-box {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: fit-content;
        }
        .qty-btn {
            background: #f8fafc;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #004aad;
            cursor: pointer;
            transition: all 0.2s;
        }
        .qty-input-new {
            width: 45px;
            border: none;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            height: 32px;
        }
        .btn-remove {
            color: #ef4444;
            background: transparent;
            border: none;
            font-size: 13px;
            font-weight: 600;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        .summary-box {
            position: sticky;
            top: 100px;
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .summary-title {
            font-size: 20px;
            font-weight: 800;
            color: #001f3f;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #4b5563;
            font-weight: 500;
        }
        .summary-total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #f1f5f9;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 800;
            color: #000;
        }
        .btn-checkout-box {
            margin-top: 25px;
        }
        .btn-yellow-premium {
            background: #f8be14 !important;
            color: #000 !important;
            border-radius: 12px !important;
            font-weight: 800 !important;
            padding: 15px 20px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px;
            text-decoration: none !important;
            box-shadow: 0 4px 15px rgba(248, 190, 20, 0.3);
            transition: all 0.3s;
            border: none;
            width: 100%;
        }
        .btn-yellow-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(248, 190, 20, 0.4);
        }
        .empty-cart-box {
            padding: 80px 20px;
            text-align: center;
        }
        .empty-cart-icon {
            font-size: 80px;
            color: #004aad;
            opacity: 0.2;
            margin-bottom: 25px;
        }
    </style>

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Keranjang Belanja</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('ecommerce.index') }}">E-Commerce</a></li>
                        <li>Keranjang</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="cart-container">
        <div class="container">
            @if(is_array($cart) && count($cart) > 0)
                <div class="row">
                    <!-- Left Column: Items -->
                    <div class="col-lg-8">
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <div class="cart-card wow fadeInUp">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if($details['image_path'] && $details['image_path'] != 'noimage.jpg')
                                            @if(strpos($details['image_path'], 'http') === 0)
                                                <img src="{{ $details['image_path'] }}" class="cart-item-img" alt="{{ $details['title'] }}"/>
                                            @else
                                                <img src="{{ asset('uploads/product/'.$details['image_path']) }}" class="cart-item-img" alt="{{ $details['title'] }}"/>
                                            @endif
                                        @else
                                            <img src="https://via.placeholder.com/200x200?text=Produk" class="cart-item-img" alt="No Image"/>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('ecommerce.show', \App\Models\Product::find($details['product_id'])->slug ?? '') }}" class="item-title">{{ $details['title'] }}</a>
                                        <div class="item-price">Rp {{ number_format($details['price'], 0, ',', '.') }}</div>
                                        
                                        @if(isset($details['variants']) && count($details['variants']) > 0)
                                            <div class="item-variants mt-1" style="font-size: 12px; color: #64748b;">
                                                @foreach($details['variants'] as $attr => $val)
                                                    <span class="badge badge-light" style="font-weight: 500; background: #f1f5f9; color: #334155;">{{ $attr }}: {{ $val }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <!-- Remove -->
                                            <form action="{{ route('ecommerce.cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn-remove" onclick="return confirm('Hapus produk dari keranjang?')">
                                                    <i class="far fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>

                                            <!-- Qty Controls -->
                                            <form action="{{ route('ecommerce.cart.update') }}" method="POST" class="qty-box">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="button" class="qty-btn" onclick="updateQtyDirectly(this, -1)">-</button>
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="qty-input-new" readonly min="1">
                                                <button type="button" class="qty-btn" onclick="updateQtyDirectly(this, 1)">+</button>
                                                <input type="submit" style="display:none;" id="submit-{{ $id }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="text-left mt-4 mb-4">
                            <a href="{{ route('ecommerce.index') }}" style="color: #004aad; font-weight: 700; text-decoration: none;">
                                <i class="fas fa-arrow-left"></i> Lanjut Belanja
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Summary -->
                    <div class="col-lg-4">
                        <div class="summary-box">
                            <h3 class="summary-title">Ringkasan Belanja</h3>
                            
                            <div class="summary-row">
                                <span>Subtotal ({{ count($cart) }} barang)</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Pengiriman</span>
                                <span style="font-style: italic; font-size: 13px;">Dihitung saat checkout</span>
                            </div>

                            <div class="summary-total">
                                <span>Total Harga</span>
                                <span style="color: #004aad;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <div class="btn-checkout-box">
                                <a href="{{ route('ecommerce.checkout') }}" class="btn-yellow-premium">
                                    Beli Sekarang 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart-box">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2 style="font-weight: 800; color: #001f3f; margin-bottom: 10px;">Wah, keranjangmu kosong</h2>
                    <p style="color: #64748b; font-size: 16px; margin-bottom: 30px;">Yuk, isi dengan produk-produk impianmu!</p>
                    <a href="{{ route('ecommerce.index') }}" class="btn-yellow-premium" style="max-width: 250px; margin: 0 auto;">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function updateQtyDirectly(btn, delta) {
            const input = btn.parentNode.querySelector('.qty-input-new');
            let val = parseInt(input.value) + delta;
            if (val < 1) val = 1;
            input.value = val;
            
            // Auto-submit after small delay
            btn.parentNode.closest('form').submit();
        }
    </script>
@endsection


