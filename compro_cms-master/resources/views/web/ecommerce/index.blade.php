@extends('web.layouts.master')
@section('title', $title)
@section('content')

    <style>
        /* Responsive Grid & Card Enhancements */
        .ecommerce-card-premium {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }
        .ecommerce-card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }
        .product-col-responsive {
            transition: all 0.3s ease;
        }

        @media (max-width: 576px) {
            .services-section {
                padding: 30px 0 !important;
            }
            .ecommerce-grid {
                margin-left: -8px !important;
                margin-right: -8px !important;
            }
            .product-col-responsive {
                padding-left: 8px !important;
                padding-right: 8px !important;
                margin-bottom: 16px !important;
            }
            .ecommerce-card-premium {
                min-height: auto !important;
                border-radius: 12px !important;
            }
            .ecommerce-image-box {
                height: 170px !important;
            }
            .ecommerce-lower-content {
                padding: 12px 10px !important;
            }
            .product-title-premium {
                font-size: 13px !important;
                line-height: 1.4 !important;
                min-height: 36px !important; /* Forces 2-line height consistency */
                margin-bottom: 6px !important;
            }
            .price-main {
                font-size: 15px !important;
                font-weight: 800 !important;
            }
            .price-before {
                font-size: 11px !important;
            }
            .rating-box {
                font-size: 11px !important;
                margin-bottom: 4px !important;
            }
            .product-desc-premium {
                display: none !important; /* Hide description on mobile for cleaner look */
            }
            .detail-btn-box {
                display: none !important; /* Hide button on mobile, card is clickable */
            }
            .card-link-overlay {
                position: absolute;
                inset: 0;
                z-index: 5;
            }
            .badge-gajian, .badge-ongkir {
                font-size: 8px !important;
                padding: 2px 5px !important;
            }
            .discount-tag {
                top: 8px !important;
                left: 8px !important;
                font-size: 9px !important;
                padding: 3px 6px !important;
            }
            .preorder-tag {
                top: 8px !important;
                right: 8px !important;
                font-size: 8px !important;
                padding: 2px 6px !important;
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
                    <h1>E-Commerce</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        @if(isset($current_category))
                            <li><a href="{{ route('ecommerce.index') }}">E-Commerce</a></li>
                            <li>{{ $current_category->title }}</li>
                        @else
                            <li>E-Commerce</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Modern E-Commerce Layout -->
    <section class="ecommerce-main-section" style="background: #fcfdfe; padding: 60px 0;">
        <div class="container">
            <!-- Header Section -->
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 style="font-size: 28px; font-weight: 900; color: #001f3f; margin-bottom: 8px;">Katalog Produk</h2>
                    <p style="color: #64748b; font-size: 15px;">Temukan perangkat bisnis terbaik untuk produktivitas Anda.</p>
                </div>
                <div class="col-md-6 d-none d-md-flex justify-content-end">
                    <div style="background: #fff; padding: 10px 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 500;">Menampilkan {{ $products->firstItem() }}-{{ $products->lastItem() }} dari {{ $products->total() }} produk</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Advanced Sidebar Filters -->
                <div class="col-lg-3">
                    <div class="ecommerce-sidebar-premium" style="background: #fff; border-radius: 20px; border: 1px solid #eef2f6; overflow: hidden; position: sticky; top: 100px; margin-bottom: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02);">
                        <div style="padding: 25px; border-bottom: 1px solid #f1f5f9; background: #fafbfc;">
                            <h4 style="font-size: 16px; font-weight: 800; color: #001f3f; margin: 0; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-sliders-h" style="color: #004aad;"></i> Filter Produk
                            </h4>
                        </div>
                        
                        <div style="padding: 25px;">
                            <form action="{{ route('ecommerce.index') }}" method="GET" id="filterForm">
                                <!-- Search -->
                                <div class="filter-group mb-4">
                                    <label style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block;">Cari Nama</label>
                                    <div style="position: relative;">
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: ProBook..." style="width: 100%; height: 45px; padding: 0 15px 0 40px; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; background: #f8fafc; transition: all 0.3s;">
                                        <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
                                    </div>
                                </div>

                                <!-- Categories -->
                                <div class="filter-group mb-4">
                                    <label style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block;">Pilih Kategori</label>
                                    <div class="category-pills" style="display: flex; flex-direction: column; gap: 8px;">
                                        <a href="{{ route('ecommerce.index') }}" class="cat-pill {{ !request('category') ? 'active' : '' }}">
                                            <span class="icon"><i class="fas fa-th-large"></i></span>
                                            <span class="text">Semua Produk</span>
                                        </a>
                                        @foreach($categories as $category)
                                            <a href="{{ route('ecommerce.index', ['category' => $category->slug]) }}" class="cat-pill {{ request('category') == $category->slug ? 'active' : '' }}">
                                                <span class="icon"><i class="fas fa-laptop"></i></span>
                                                <span class="text">{{ $category->title }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Sorting -->
                                <div class="filter-group mb-4">
                                    <label style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block;">Urutkan Berdasarkan</label>
                                    <select name="sort" class="form-control" style="border-radius: 12px; height: 48px; border: 1px solid #e2e8f0; background: #f8fafc; font-weight: 500; appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23004aad%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 15px top 50%; background-size: 12px auto;">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru Dirilis</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Terendah ke Tinggi</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Terendah</option>
                                    </select>
                                </div>

                                <button type="submit" class="filter-submit-btn" style="width: 100%; border: none; height: 50px; border-radius: 12px; font-weight: 800; font-size: 15px; letter-spacing: 0.5px; background: #f8be14; color: #000; box-shadow: 0 6px 15px rgba(248,190,20,0.2); transition: all 0.3s ease; cursor: pointer;">Terapkan Filter</button>

                                <style>
                                    .filter-submit-btn:hover {
                                        background: #eab308;
                                        transform: translateY(-2px);
                                        box-shadow: 0 8px 20px rgba(248,190,20,0.3);
                                    }
                                </style>
                                
                                @if(request()->anyFilled(['search', 'category', 'sort']))
                                    <a href="{{ route('ecommerce.index') }}" style="display: block; text-align: center; margin-top: 15px; font-size: 13px; color: #ff2d55; font-weight: 700; text-decoration: none;">Bersihkan Filter</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Product Grid Area -->
                <div class="col-lg-9">
                    <div class="row ecommerce-grid g-4" id="productGrid">
                        @forelse($products as $product)
                            <div class="col-6 col-md-4 col-lg-4 product-item-container">
                                <div class="modern-card-tokped shadow-hover h-100" style="background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative;">
                                    
                                    <!-- Mobile Click Overlay -->
                                    <a href="{{ route('ecommerce.show', $product->slug) }}" class="card-mobile-link d-md-none" style="position: absolute; inset: 0; z-index: 10;"></a>

                                    <!-- Top Badges -->
                                    <div class="card-badge-top" style="position: absolute; top: 12px; left: 12px; z-index: 5; display: flex; flex-direction: column; gap: 5px;">
                                        @if($product->discount_percent)
                                            <div style="background: #ff2d55; color: #fff; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 6px; box-shadow: 0 4px 10px rgba(255,45,85,0.2);">{{ $product->discount_percent }}% OFF</div>
                                        @endif
                                        @if($product->is_preorder)
                                            <div style="background: #001f3f; color: #fff; font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 6px; backdrop-filter: blur(4px);">Pre-Order</div>
                                        @endif
                                    </div>

                                    <!-- Image Area -->
                                    <div class="card-img-wrapper" style="position: relative; aspect-ratio: 1; overflow: hidden; background: #f8fafc;">
                                        @if(strpos($product->image_path, 'http') === 0)
                                            <img src="{{ $product->image_path }}" class="main-img" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                                        @else
                                            <img src="{{ asset('uploads/product/'.$product->image_path) }}" class="main-img" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                                        @endif
                                        
                                        <!-- Bottom Image Badges -->
                                        <div style="position: absolute; bottom: 8px; left: 8px; right: 8px; display: flex; gap: 4px;">
                                            @if($product->is_gajian_sale)
                                                <div style="background: #10ac84; color: #fff; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 4px;">GAJIAN SALE</div>
                                            @endif
                                            @if($product->is_free_ongkir)
                                                <div style="background: #1dd1a1; color: #000; font-size: 9px; font-weight: 900; padding: 3px 6px; border-radius: 4px; display: flex; align-items: center; gap: 3px;"><i class="fas fa-truck" style="font-size: 8px;"></i> BEBAS ONGKIR</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Content Area -->
                                    <div class="card-content-desc" style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column;">
                                        <h3 style="font-size: 14px; font-weight: 600; color: #1e293b; line-height: 1.5; margin-bottom: 8px; min-height: 42px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            <a href="{{ route('ecommerce.show', $product->slug) }}" style="color: inherit; text-decoration: none;">{{ $product->title }}</a>
                                        </h3>

                                        <div style="margin-bottom: 8px;">
                                            <div style="font-size: 16px; font-weight: 800; color: #004aad;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                            @if($product->price_before_discount)
                                                <div style="font-size: 11px; color: #94a3b8; text-decoration: line-through;">Rp {{ number_format($product->price_before_discount, 0, ',', '.') }}</div>
                                            @endif
                                        </div>

                                        <div style="display: flex; align-items: center; gap: 5px; font-size: 12px; color: #64748b; margin-top: auto;">
                                            <i class="fas fa-star" style="color: #ffb400;"></i>
                                            <span style="font-weight: 700; color: #334155;">{{ $product->average_rating ?? '4.9' }}</span>
                                            <span>| Terjual {{ number_format($product->total_sales ?? 0, 0, ',', '.') }}+</span>
                                        </div>

                                        <!-- Admin Actions / Quick Add (Optional) -->
                                        <div class="card-actions mt-3 d-none d-md-block">
                                            <a href="{{ route('ecommerce.show', $product->slug) }}" class="btn-modern-outline" style="display: block; text-align: center; padding: 10px; border-radius: 10px; font-size: 13px; font-weight: 700; text-decoration: none; border: 1.5px solid #f8be14; color: #f8be14; transition: all 0.2s;">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div style="font-size: 64px; color: #e2e8f0; margin-bottom: 20px;"><i class="fas fa-search"></i></div>
                                <h3 style="font-weight: 700; color: #001f3f;">Produk Tidak Ditemukan</h3>
                                <p style="color: #64748b;">Coba cari dengan kata kunci lain atau bersihkan filter.</p>
                                <a href="{{ route('ecommerce.index') }}" class="btn-premium mt-3" style="display: inline-block; padding: 12px 30px;">Tampilkan Semua</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Modern Pagination -->
                    @if($products->hasPages())
                        <div class="pagination-wrapper mt-5 d-flex justify-content-center">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Premium Styles -->
    <style>
        .cat-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            text-decoration: none !important;
            color: #64748b !important;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .cat-pill:hover {
            background: #f8fafc;
        }
        .cat-pill.active {
            background: #ecf3ff;
            color: #004aad !important;
        }
        .cat-pill .icon {
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            font-size: 12px;
        }
        .cat-pill.active .icon {
            background: #004aad;
            color: #fff;
        }
        
        .modern-card-tokped:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: #cbd5e1 !important;
        }
        .modern-card-tokped:hover .main-img {
            transform: scale(1.1);
        }
        .btn-modern-outline:hover {
            background: #f8be14;
            color: #000 !important;
        }

        @media (max-width: 576px) {
            .ecommerce-main-section { padding: 30px 0 !important; }
            .col-6.product-item-container { padding: 8px !important; }
            .modern-card-tokped { border-radius: 12px !important; }
            .card-content-desc { padding: 10px !important; }
            .card-content-desc h3 { font-size: 12px !important; min-height: 36px !important; margin-bottom: 5px !important; }
            .card-content-desc .price-box div { font-size: 14px !important; }
        }
    </style>

@endsection

