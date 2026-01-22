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
                        <li>{{ $title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- E-Commerce Section -->
    <section class="services-section style-four" style="background: #ffffff; padding: 80px 0;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-title centered">
                        <h2>E-Commerce</h2>
                        <div class="yellow-separator centered" style="width: 30px; height: 4px; background: #f8be14; margin: 15px auto; border-radius: 2px;"></div>
                        <div class="text">Daftar produk eksklusif untuk kebutuhan Anda.</div>
                    </div> 
                </div>
            </div>   
            <div class="row clearfix">

                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <!-- Product Card Premium -->
                    <div class="service-card-premium wow fadeInDown" style="min-height: 480px; display: flex; flex-direction: column;">
                        <div class="image-box" style="height: 250px; overflow: hidden; position: relative;">
                            @if($product->image_path && $product->image_path != 'noimage.jpg')
                            <img src="{{ asset('uploads/product/'.$product->image_path) }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: all 0.5s ease;"/>
                            @else
                            <img src="https://via.placeholder.com/800x800?text=No+Image" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover;"/>
                            @endif
                        </div>
                        <div class="lower-content" style="flex-grow: 1; display: flex; flex-direction: column;">
                            <h3 style="margin-bottom: 10px; min-height: 54px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; line-height: 27px;"><a href="{{ route('ecommerce.show', $product->slug) }}">{{ $product->title }}</a></h3>
                            
                            <h4 style="color: #004aad; font-weight: 800; margin-bottom: 15px; font-size: 20px;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </h4>

                            <div class="text" style="flex-grow: 1;">
                                {!! str_limit(strip_tags($product->description), 100, ' ...') !!}
                            </div>
                            
                            <div style="margin-top: 20px;">
                                <a href="{{ route('ecommerce.show', $product->slug) }}" class="btn-premium" style="width: 100%; justify-content: center;">
                                    Detail Produk <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>

            <!-- Pagination -->
            <div class="row" style="margin-top: 50px;">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </section>
    <!--End E-Commerce Section -->

@endsection
