@extends('web.layouts.master')

@section('title', $title)

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="product">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $product->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($product->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('ecommerce.show', $product->slug) }}"/>
    <meta property='og:image' content="{{ (strpos($product->image_path, 'http') === 0) ? $product->image_path : asset('uploads/product/'.$product->image_path) }}"/>
    @endif
@endsection

@section('content')

    <style>
        /* Tokopedia Reference Styling */
        .product-detail-container {
            padding: 20px 0 80px;
            background: #fff;
            font-family: 'Open Sans', 'Inter', sans-serif;
        }
        
        /* Breadcrumb Clean Style */
        .breadcrumb-minimal {
            background: transparent;
            padding: 10px 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: rgba(0,0,0,0.54);
        }
        .breadcrumb-minimal a { color: #004aad; font-weight: 600; text-decoration: none; }
        .breadcrumb-minimal span { color: rgba(0,0,0,0.38); }

        /* Left: Gallery */
        .gallery-sticky {
            position: sticky;
            top: 100px;
        }
        .main-image-frame {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }
        .main-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Center: Main Info */
        .product-main-header {
            margin-bottom: 24px;
        }
        .product-main-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 28px;
            color: rgba(0,0,0,0.85);
            margin-bottom: 8px;
        }
        .product-stats {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: rgba(0,0,0,0.54);
            margin-bottom: 16px;
        }
        .stat-item { display: flex; align-items: center; gap: 4px; }
        .stat-item .star-icon { color: #ffb400; font-size: 12px; }
        .stat-value { color: rgba(0,0,0,0.85); font-weight: 700; }

        .product-price-section {
            border-top: 1px solid #efefef;
            border-bottom: 1px solid #efefef;
            padding: 16px 0;
            margin-bottom: 24px;
        }
        .price-current {
            font-size: 32px;
            font-weight: 800;
            color: rgba(0,0,0,0.85);
            display: block;
        }
        .price-original {
            font-size: 14px;
            color: rgba(0,0,0,0.38);
            text-decoration: line-through;
            margin-top: 4px;
        }

        .product-tabs-minimal {
            border-bottom: 1px solid #efefef;
            margin-bottom: 20px;
            display: flex;
            gap: 32px;
        }
        .tab-minimal {
            padding: 12px 0;
            font-size: 16px;
            font-weight: 700;
            color: rgba(0,0,0,0.54);
            cursor: pointer;
            position: relative;
        }
        .tab-minimal.active { color: #004aad; }
        .tab-minimal.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background: #004aad;
            border-radius: 4px;
        }

        .product-description-content {
            font-size: 14px;
            line-height: 22px;
            color: rgba(0,0,0,0.7);
        }

        /* Right: Sidebar Purchase */
        .purchase-sidebar-wrapper {
            position: sticky;
            top: 100px;
        }
        .purchase-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: #fff;
        }
        .purchase-card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            color: rgba(0,0,0,0.85);
        }
        .qty-selector-minimal {
            display: flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 4px;
            width: fit-content;
        }
        .qty-btn-min {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            border: none;
            border-radius: 6px;
            font-weight: 800;
            color: #004aad;
            cursor: pointer;
        }
        .qty-input-min {
            width: 48px;
            text-align: center;
            border: none;
            font-weight: 700;
            font-size: 14px;
        }

        .btn-tokped-green {
            background: #f8be14; /* Site Accent Yellow */
            color: #000 !important;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-tokped-green:hover {
            background: #e5af12;
            transform: translateY(-2px);
        }
        .btn-tokped-outline {
            background: #fff;
            color: #f8be14 !important;
            border: 2px solid #f8be14;
            border-radius: 8px;
            padding: 12px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        .btn-tokped-outline:hover { 
            background: #f8be14; 
            color: #000 !important;
        }

        .subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        .subtotal-label { color: rgba(0,0,0,0.54); font-size: 14px; }
        .subtotal-value { font-size: 18px; font-weight: 800; color: rgba(0,0,0,0.85); }

        /* Mobile Bottom Bar (Tokopedia Style) */
        @media (max-width: 991px) {
            .purchase-sidebar-wrapper {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                top: auto;
            }
            .purchase-card {
                border-radius: 16px 16px 0 0;
                box-shadow: 0 -8px 24px rgba(0,0,0,0.12);
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 16px 20px calc(16px + env(safe-area-inset-bottom));
                background: #fff;
            }
            .purchase-card-title, .hide-mobile-tokped, .subtotal-row { display: none !important; }
            
            .mobile-price-preview {
                flex: 1;
                min-width: 100px;
            }
            .mobile-price-preview .label { 
                font-size: 11px; 
                color: rgba(0,0,0,0.54); 
                display: block;
                margin-bottom: 2px;
            }
            .mobile-price-preview .val { 
                font-size: 15px; 
                font-weight: 800; 
                color: #004aad; 
                white-space: nowrap;
            }

            #formTokped {
                display: flex;
                flex: 2.5;
                gap: 8px;
                margin: 0;
            }

            .btn-tokped-green, .btn-tokped-outline {
                width: 100%;
                margin-bottom: 0 !important;
                padding: 10px 4px !important;
                font-size: 12px !important;
                height: 42px;
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                white-space: nowrap;
            }
            .product-detail-container { padding-bottom: 140px; }
        }
    </style>

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>E-Commerce</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('ecommerce.index') }}">E-Commerce</a></li>
                        <li>Detail Produk</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <div class="product-detail-container">
        <div class="container">

            <div class="row">
                <!-- Column 1: Gallery -->
                <div class="col-lg-4 col-md-5">
                    <div class="gallery-sticky">
                        <div class="main-image-frame">
                             @if($product->image_path && $product->image_path != 'noimage.jpg')
                                 @if(strpos($product->image_path, 'http') === 0)
                                     <img src="{{ $product->image_path }}" alt="{{ $product->title }}">
                                 @else
                                     <img src="{{ asset('uploads/product/'.$product->image_path) }}" alt="{{ $product->title }}">
                                 @endif
                             @else
                                 <img src="https://via.placeholder.com/800x800?text=No+Image" alt="{{ $product->title }}">
                             @endif
                        </div>
                    </div>
                </div>

                <!-- Column 2: Info Content -->
                <div class="col-lg-5 col-md-7">
                    <div class="product-main-header">
                        <h1 class="product-main-title">{{ $product->title }}</h1>
                        <div class="product-stats">
                            <div class="stat-item">
                                Terjual <span class="stat-value">{{ number_format($product->total_sales ?? 0, 0, ',', '.') }}+</span>
                            </div>
                            <span>•</span>
                            <div class="stat-item">
                                <i class="fas fa-star star-icon"></i>
                                <span class="stat-value">{{ $product->average_rating ?? '0.0' }}</span>
                                ({{ number_format($product->rating_count ?? 0, 0, ',', '.') }} rating)
                            </div>
                        </div>
                    </div>

                    <div class="product-price-section">
                        <span class="price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @if($product->price_before_discount)
                        <span class="price-original">Rp {{ number_format($product->price_before_discount, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="product-tabs-minimal">
                        <div class="tab-minimal active" onclick="switchTab(this, 'detail')">Detail</div>
                        <div class="tab-minimal" onclick="switchTab(this, 'reviews')">Ulasan ({{ count($product->reviews) }})</div>
                    </div>

                    <div id="tab-detail" class="tab-content-premium">
                        <div style="margin-bottom: 10px; color: rgba(0,0,0,0.54);">Kondisi: <span style="color: rgba(0,0,0,0.85); font-weight: 700;">Baru</span></div>
                        <div style="margin-bottom: 15px; color: rgba(0,0,0,0.54);">Min. Pemesanan: <span style="color: rgba(0,0,0,0.85); font-weight: 700;">1 Buah</span></div>
                        <div class="rich-text-desc">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <div id="tab-reviews" class="tab-content-premium" style="display: none;">
                        <div class="reviews-list mb-5">
                            @forelse($product->reviews as $review)
                            <div class="review-item" style="border-bottom: 1px solid #eee; padding: 15px 0;">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong style="color: #001f3f;">{{ $review->customer_name }}</strong>
                                    <div style="color: #ffb400;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p style="font-size: 14px; color: #64748b; margin-bottom: 5px;">{{ $review->comment }}</p>
                                <small style="color: #b0b0b0;">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            @empty
                            <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                            @endforelse
                        </div>

                        <!-- Add Review Form -->
                        <div class="add-review-box" style="background: #f8fafc; padding: 20px; border-radius: 12px;">
                            <h4 style="font-size: 16px; font-weight: 800; margin-bottom: 15px;">Tulis Ulasan</h4>
                            <form action="{{ route('ecommerce.review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="customer_name" class="form-control" placeholder="Nama Anda" required style="border-radius: 8px;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="rating" class="form-control" required style="border-radius: 8px;">
                                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                            <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                            <option value="3">⭐⭐⭐ (Cukup)</option>
                                            <option value="2">⭐⭐ (Kurang)</option>
                                            <option value="1">⭐ (Sangat Kurang)</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control" placeholder="Komentar Anda..." rows="3" style="border-radius: 8px;"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn-premium" style="font-size: 13px; padding: 10px 20px; border: none;">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Purchase Sidebar -->
                <div class="col-lg-3">
                    <div class="purchase-sidebar-wrapper">
                        <div class="purchase-card">
                            <h3 class="purchase-card-title">Atur Jumlah & Varian</h3>
                            
                            <form action="{{ route('ecommerce.add_to_cart') }}" method="POST" id="formTokped">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="finalQtyTokped" value="1">

                                <!-- Variants Selection -->
                                @if(count($product->variants) > 0)
                                    @foreach($product->variants->groupBy('attribute_name') as $attr_name => $variants)
                                    <div class="variant-group mb-3">
                                        <label style="font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px; display: block;">{{ $attr_name }}</label>
                                        <div class="variant-options" style="display: flex; flex-wrap: wrap; gap: 8px;">
                                            @foreach($variants as $index => $variant)
                                            <label class="variant-btn" style="cursor: pointer;">
                                                <input type="radio" name="variants[{{ $attr_name }}]" value="{{ $variant->id }}" class="d-none variant-radio" {{ $index == 0 ? 'checked' : '' }} data-extra="{{ $variant->price_extra }}" onchange="updatePrice()">
                                                <span class="variant-label-styled">{{ $variant->attribute_value }}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                @endif

                                <style>
                                    .variant-label-styled {
                                        padding: 6px 12px;
                                        border: 1px solid #e2e8f0;
                                        border-radius: 8px;
                                        font-size: 13px;
                                        font-weight: 600;
                                        transition: all 0.2s;
                                        display: inline-block;
                                    }
                                    .variant-radio:checked + .variant-label-styled {
                                        border-color: #004aad;
                                        background: #ecf3ff;
                                        color: #004aad;
                                    }
                                </style>
                                
                                <div class="hide-mobile-tokped">
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div class="qty-selector-minimal">
                                            <button type="button" class="qty-btn-min" onclick="updateQtyTokped(-1)">-</button>
                                            <input type="text" value="1" id="qtyTokped" class="qty-input-min" readonly>
                                            <button type="button" class="qty-btn-min" onclick="updateQtyTokped(1)">+</button>
                                        </div>
                                        <div style="font-size: 13px; color: rgba(0,0,0,0.54);">Stok: <span style="font-weight: 700;">{{ $product->stock ?? 50 }}</span></div>
                                    </div>

                                    <div class="subtotal-row">
                                        <span class="subtotal-label">Subtotal</span>
                                        <span class="subtotal-value" id="subtotalTokped">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <div class="mobile-price-preview d-lg-none">
                                    <span class="label">Total Harga</span>
                                    <span class="val" id="mobileSubtotal">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>

                                <button type="submit" name="action" value="cart" class="btn-tokped-green">
                                    <i class="fas fa-plus"></i> Keranjang
                                </button>
                                <button type="submit" name="action" value="checkout" class="btn-tokped-outline">
                                    Beli Langsung
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations (Tokopedia style "Pilihan Lain") -->
    <section style="background: #fcfdfe; padding: 60px 0; border-top: 1px solid #efefef;">
        <div class="container">
            <h2 style="font-size: 18px; font-weight: 800; color: rgba(0,0,0,0.85); margin-bottom: 24px;">Rekomendasi Untukmu</h2>
            <div class="row">
                @foreach($related_products as $related)
                <div class="col-6 col-lg-2 col-md-4 mb-4">
                    <div style="background: #fff; border-radius: 8px; border: 1px solid #efefef; overflow: hidden; height: 100%; transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                        <a href="{{ route('ecommerce.show', $related->slug) }}" style="display: block; aspect-ratio: 1;">
                            @if(strpos($related->image_path, 'http') === 0)
                                <img src="{{ $related->image_path }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('uploads/product/'.$related->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </a>
                        <div style="padding: 8px;">
                            <h3 style="font-size: 13px; color: rgba(0,0,0,0.85); font-weight: 400; line-height: 18px; margin-bottom: 4px; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                {{ $related->title }}
                            </h3>
                            <div style="font-size: 14px; font-weight: 700; color: rgba(0,0,0,0.85); margin-bottom: 4px;">Rp {{ number_format($related->price, 0, ',', '.') }}</div>
                            <div style="font-size: 11px; color: rgba(0,0,0,0.54); display: flex; align-items: center; gap: 4px;">
                                <i class="fas fa-star" style="color: #ffb400; font-size: 9px;"></i> {{ $related->average_rating ?? '0.0' }} | Terjual {{ number_format($related->total_sales ?? 0, 0, ',', '.') }}+
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        const basePrice = {{ $product->price }};

        function switchTab(el, target) {
            document.querySelectorAll('.tab-minimal').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            
            document.getElementById('tab-detail').style.display = 'none';
            document.getElementById('tab-reviews').style.display = 'none';
            document.getElementById('tab-' + target).style.display = 'block';
        }

        function updatePrice() {
            let extra = 0;
            document.querySelectorAll('.variant-radio:checked').forEach(radio => {
                extra += parseFloat(radio.dataset.extra);
            });
            
            const qty = parseInt(document.getElementById('qtyTokped').value);
            const total = (basePrice + extra) * qty;
            
            const formatted = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            const subtotalEl = document.getElementById('subtotalTokped');
            const mobileSubtotalEl = document.getElementById('mobileSubtotal');
            
            if(subtotalEl) subtotalEl.innerText = formatted;
            if(mobileSubtotalEl) mobileSubtotalEl.innerText = formatted;
        }

        function updateQtyTokped(val) {
            const qtyInput = document.getElementById('qtyTokped');
            const finalQtyInput = document.getElementById('finalQtyTokped');
            
            let qty = parseInt(qtyInput.value);
            qty = Math.max(1, qty + val);
            
            qtyInput.value = qty;
            finalQtyInput.value = qty;
            updatePrice();
        }

        // Initialize price on load if there are variants
        document.addEventListener('DOMContentLoaded', function() {
            updatePrice();
        });
    </script>

@endsection


