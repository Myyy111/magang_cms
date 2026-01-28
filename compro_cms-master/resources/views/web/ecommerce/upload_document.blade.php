@extends('web.layouts.master')
@section('title', 'Upload Dokumen')
@section('content')

    <section class="page-title-premium text-center">
        <div class="container">
            <div class="title-box">
                <h1>Upload Dokumen</h1>
            </div>
            <div class="bread-crumb">
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li>Upload</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="checkout-section py-50" style="padding: 80px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 text-center">
                            <h4 class="mb-2" style="color: #004aad; font-weight: 700;">Langkah Terakhir</h4>
                            <p class="text-muted">Untuk menyelesaikan pesanan #{{ $order->order_number }}, mohon upload Surat Pernyataan yang telah ditandatangani.</p>
                        </div>
                        <div class="card-body px-5 pb-5">
                            
                            <!-- Step Indicator -->
                            <div class="d-flex justify-content-center mb-5">
                                <div class="text-center mx-3">
                                    <div style="width: 40px; height: 40px; background: #e2e8f0; color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">1</div>
                                    <small>Isi Form</small>
                                </div>
                                <div class="text-center mx-3">
                                    <div style="width: 40px; height: 40px; background: #e2e8f0; color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">2</div>
                                    <small>Download PDF</small>
                                </div>
                                <div class="text-center mx-3">
                                    <div style="width: 40px; height: 40px; background: #004aad; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-weight: bold;">3</div>
                                    <small class="text-primary font-weight-bold">Upload & Selesai</small>
                                </div>
                            </div>

                            <div class="alert alert-warning mb-4">
                                <i class="fas fa-download me-2"></i> <a href="{{ route('ecommerce.download_pdf', $order->id) }}" class="fw-bold text-decoration-underline" target="_blank">Unduh surat Anda disini</a>.
                            </div>

                            <form action="{{ route('ecommerce.store_document', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="signed_document" class="form-label font-weight-bold">Upload Surat Pernyataan (PDF/JPG/PNG)</label>
                                    <input type="file" class="form-control-file p-2 border rounded w-100" name="signed_document" id="signed_document" required accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Maksimal ukuran file 5MB.</small>
                                </div>

                                <button type="submit" class="btn-premium w-100" style="border: none; padding: 15px;">
                                    <i class="fas fa-check-circle me-2"></i> Selesaikan Transaksi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
