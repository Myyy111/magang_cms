@extends('web.layouts.master')

@section('title', $title)

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="product">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $product->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($product->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('ecommerce.show', $product->slug) }}"/>
    <meta property='og:image' content="{{ asset('uploads/product/'.$product->image_path) }}"/>
    @endif
@endsection

@section('content')

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Detail Produk</h1>
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

    <!--Product Detail Section-->
    <section class="product-details" style="padding: 80px 0 0;">
        <div class="container">
            <div class="row">
                <!-- Image Column -->
                <div class="col-lg-6 col-md-12 mb-5">
                    <div class="image-box" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); position: sticky; top: 100px;">
                        @if($product->image_path && $product->image_path != 'noimage.jpg')
                        <img src="{{ asset('uploads/product/'.$product->image_path) }}" alt="{{ $product->title }}" style="width: 100%; height: auto; display: block;" />
                        @else
                        <img src="https://via.placeholder.com/800x800?text=No+Image" alt="{{ $product->title }}" style="width: 100%; height: auto; display: block;" />
                        @endif
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-lg-6 col-md-12">
                    <div class="product-info-box pl-lg-4">
                        <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 15px; line-height: 1.2;">{{ $product->title }}</h2>
                        
                        <div class="price-box mb-4">
                            <h3 style="color: #004aad; font-size: 28px; font-weight: 800;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </h3>
                        </div>

                        <div class="text mb-5" style="font-size: 16px; line-height: 1.8; color: #666;">
                            {!! $product->description !!}
                        </div>

                        <!-- Purchase Action Box -->
                        <div class="purchase-box p-4" style="background: #fff; border: 1px solid #eee; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                           <form action="{{ route('ecommerce.add_to_cart') }}" method="POST" id="addToCartForm">
                               @csrf
                               <input type="hidden" name="product_id" value="{{ $product->id }}">
                               
                               <!-- Qty & Stock -->
                               <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                                   <div class="d-flex align-items-center mb-2 mb-sm-0">
                                       <span class="mr-3 font-weight-bold text-dark">Jumlah:</span>
                                       <div class="quantity-box d-flex align-items-center" style="border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; height: 45px;">
                                           <button type="button" class="btn btn-light" onclick="updateQty(-1)" style="border: none; height: 100%; width: 40px; font-weight: bold; font-size: 18px;">-</button>
                                           <input type="number" name="quantity" id="quantityInput" value="1" min="1" style="border: none; text-align: center; width: 60px; height: 100%; font-weight: bold; font-size: 16px; -moz-appearance: textfield;" onchange="updateSubtotal()">
                                           <button type="button" class="btn btn-light" onclick="updateQty(1)" style="border: none; height: 100%; width: 40px; font-weight: bold; font-size: 18px;">+</button>
                                       </div>
                                   </div>
                                   <div class="stock-info">
                                       <span class="badge badge-warning text-white p-2" style="font-size: 14px; background-color: #f8be14;">Stok Tersedia: {{ $product->stock ?? 50 }}</span>
                                   </div>
                               </div>

                               <!-- Subtotal -->
                               <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded" style="background: #f8f9fa;">
                                   <span style="font-size: 16px; font-weight: 600; color: #555;">Subtotal</span>
                                   <h3 class="font-weight-bold mb-0" style="color: #004aad; font-size: 24px;" id="subtotalDisplay">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                               </div>

                               <!-- Buttons -->
                               <div class="d-flex w-100 mt-3">
                                   <div class="w-50 pr-2">
                                       <button type="submit" name="action" value="cart" class="btn-premium w-100" style="padding: 12px; border-radius: 50px; background: #f8be14; border: none; font-weight: 700; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                           <i class="fas fa-shopping-cart mr-2"></i> +KERANJANG
                                       </button>
                                   </div>
                                   <div class="w-50 pl-2">
                                       <button type="submit" name="action" value="checkout" class="btn-outline-premium w-100" style="padding: 12px; border-radius: 50px; border: 2px solid #f8be14; color: #f8be14; background: white; font-weight: 700; transition: all 0.3s; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                           BELI LANGSUNG
                                       </button>
                                   </div>
                               </div>
                           </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Related Products Section-->
    <section class="related-products" style="padding: 80px 0; background-color: #fcfcfc; margin-top: 50px;">
        <div class="container">
            <div class="sec-title centered mb-5">
                <h2>Produk Lainnya</h2>
                <div class="yellow-separator centered" style="width: 40px; height: 4px; background: #f8be14; margin: 15px auto; border-radius: 2px;"></div>
            </div>
            
            <div class="row">
                @foreach($related_products as $related)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <!-- Product Card Premium -->
                    <div class="service-card-premium" style="min-height: 450px; display: flex; flex-direction: column; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s ease;">
                        <div class="image-box" style="height: 250px; overflow: hidden; position: relative;">
                            @if($related->image_path && $related->image_path != 'noimage.jpg')
                            <img src="{{ asset('uploads/product/'.$related->image_path) }}" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: all 0.5s ease;"/>
                            @else
                            <img src="https://via.placeholder.com/800x800?text=No+Image" alt="{{ $related->title }}" style="width: 100%; height: 100%; object-fit: cover;"/>
                            @endif
                        </div>
                        <div class="lower-content p-4" style="flex-grow: 1; display: flex; flex-direction: column;">
                            <h3 style="margin-bottom: 10px; min-height: 54px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 27px; font-size: 18px;">
                                <a href="{{ route('ecommerce.show', $related->slug) }}" style="color: #1a1a1a;">{{ $related->title }}</a>
                            </h3>
                            
                            <h4 style="color: #004aad; font-weight: 800; margin-bottom: 15px; font-size: 20px;">
                                Rp {{ number_format($related->price, 0, ',', '.') }}
                            </h4>
                            
                            <div style="margin-top: auto;">
                                <a href="{{ route('ecommerce.show', $related->slug) }}" class="btn-premium text-center d-block" style="border-radius: 6px;">
                                    Detail Produk <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        const price = {{ $product->price }};
        
        function updateQty(change) {
            const input = document.getElementById('quantityInput');
            let newValue = parseInt(input.value) + change;
            if (newValue < 1) newValue = 1;
            input.value = newValue;
            updateSubtotal();
        }

        function updateSubtotal() {
            const input = document.getElementById('quantityInput');
            let qty = parseInt(input.value);
            if (qty < 1) qty = 1;
            
            const subtotal = price * qty;
            const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(subtotal).replace('Rp', 'Rp ');
            
            document.getElementById('subtotalDisplay').innerText = formatted;
        }
    </script>

@endsection
