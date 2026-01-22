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
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!--Cart Section-->
    <section class="cart-section" style="padding: 80px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(is_array($cart) && count($cart) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white" style="box-shadow: 0 5px 20px rgba(0,0,0,0.05); border-radius: 10px; overflow: hidden;">
                            <thead style="background: #004aad; color: #fff;">
                                <tr>
                                    <th style="padding: 15px;">Produk</th>
                                    <th style="padding: 15px;">Harga</th>
                                    <th style="padding: 15px;">Jumlah</th>
                                    <th style="padding: 15px;">Subtotal</th>
                                    <th style="padding: 15px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr data-id="{{ $id }}">
                                        <td style="padding: 20px;">
                                            <div class="d-flex align-items-center">
                                                @if($details['image_path'] && $details['image_path'] != 'noimage.jpg')
                                                    <img src="{{ asset('uploads/product/'.$details['image_path']) }}" width="80" height="80" class="img-fluid rounded" style="object-fit: cover; margin-right: 15px;"/>
                                                @else
                                                    <img src="https://via.placeholder.com/80?text=No+Image" width="80" height="80" class="img-fluid rounded" style="margin-right: 15px;"/>
                                                @endif
                                                <h5 class="mb-0">{{ $details['title'] }}</h5>
                                            </div>
                                        </td>
                                        <td style="padding: 20px; vertical-align: middle;">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                        <td style="padding: 20px; vertical-align: middle;">
                                            <form action="{{ route('ecommerce.cart.update') }}" method="POST" class="d-flex" style="max-width: 150px;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control text-center quantity-input" min="1" style="border-radius: 5px 0 0 5px; border-right: none;">
                                                <button type="submit" class="btn btn-sm btn-primary" style="border-radius: 0 5px 5px 0;"><i class="fas fa-sync-alt"></i></button>
                                            </form>
                                        </td>
                                        <td style="padding: 20px; vertical-align: middle; font-weight: bold; color: #004aad;">
                                            Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                        </td>
                                        <td style="padding: 20px; vertical-align: middle;">
                                            <form action="{{ route('ecommerce.cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right" style="padding: 20px;">
                                        <h3><strong>Total: Rp {{ number_format($total, 0, ',', '.') }}</strong></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right" style="padding: 20px; border-top: none;">
                                        <a href="{{ route('ecommerce.index') }}" class="btn btn-warning text-white"><i class="fas fa-arrow-left"></i> Lanjut Belanja</a>
                                        <a href="{{ route('ecommerce.checkout') }}" class="btn-premium ml-2">Checkout <i class="fas fa-arrow-right"></i></a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                    <div class="text-center" style="padding: 100px 0;">
                        <div style="font-size: 60px; color: #ddd; margin-bottom: 20px;"><i class="fas fa-shopping-cart"></i></div>
                        <h3>Keranjang Belanja Kosong</h3>
                        <p class="mb-4">Anda belum menambahkan produk apapun.</p>
                        <a href="{{ route('ecommerce.index') }}" class="btn-premium">Mulai Belanja</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
