@extends('web.layouts.master')
@section('title', $title)
@section('content')

    <style>
        .checkout-section .form-check {
            display: flex !important;
            align-items: center !important;
            padding-left: 0 !important;
            margin-bottom: 10px !important;
            cursor: pointer;
            border: none !important;
        }
        .checkout-section .form-check-inline {
            display: inline-flex !important;
            margin-right: 25px !important;
        }
        .checkout-section .form-check-input {
            width: 18px !important;
            height: 18px !important;
            margin: 0 12px 0 0 !important;
            flex: 0 0 18px !important;
            cursor: pointer;
            position: static !important;
            appearance: auto !important;
            -webkit-appearance: radio !important;
        }
        .checkout-section .form-check-label {
            cursor: pointer;
            margin-bottom: 0 !important;
            font-size: 15px;
            color: #444;
            font-weight: 500;
            line-height: 1.4 !important;
            user-select: none;
            display: inline-block !important;
            flex: 1;
        }
        .checkout-section .payment-option-info {
            margin-left: 31px;
            margin-top: -5px;
            margin-bottom: 15px;
            display: block;
        }
        .checkout-section .alert-payment {
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }
        .checkout-section .form-group label.font-weight-bold {
            color: #333;
            margin-bottom: 12px;
            font-size: 16px;
            display: block;
        }
        .unit-row {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        .unit-row .label-text {
            width: 220px;
            flex-shrink: 0;
        }
        .unit-row .colon {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
    </style>

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

    <section class="checkout-section" style="padding: 80px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h4 class="mb-0" style="color: #004aad; font-weight: 700;">Data Pemesan</h4>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <form action="{{ route('ecommerce.process') }}" method="POST" id="checkoutForm"> 
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_name" class="form-label font-weight-bold">1. Nama Lengkap</label>
                                        <input type="text" class="form-control" name="customer_name" required value="{{ old('customer_name') }}" placeholder="Masukkan Nama Lengkap Anda">
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_id_num" class="form-label font-weight-bold">2. NPP</label>
                                        <input type="text" class="form-control" name="customer_id_num" required value="{{ old('customer_id_num') }}" placeholder="Nomor Induk Pegawai">
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="form-label font-weight-bold d-block">3. Wilayah Kerja</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="wilayah_kerja" id="wilayah_pusat" value="pusat" required>
                                            <label class="form-check-label" for="wilayah_pusat">KANTOR PUSAT</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="wilayah_kerja" id="wilayah_wilayah" value="wilayah" required>
                                            <label class="form-check-label" for="wilayah_wilayah">KANTOR WILAYAH</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                         <label class="form-label font-weight-bold mb-3">4. Unit Kerja (Wajib diisi semua)</label>
                                         <div class="unit-row">
                                             <div class="label-text">a. Kab / Kota </div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_a" placeholder="Isi nama Kab/Kota" required value="{{ old('unit_kerja_detail_a') }}" style="border-radius: 4px;">
                                             </div>
                                         </div>
                                         <div class="unit-row">
                                             <div class="label-text">b. Kantor Cabang/As.Dep</div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_b" placeholder="Isi nama Kantor Cabang" required value="{{ old('unit_kerja_detail_b') }}" style="border-radius: 4px;">
                                             </div>
                                         </div>
                                         <div class="unit-row">
                                             <div class="label-text">c. Dep.Dir.Bid/Dep.Dir.Wil</div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_c" placeholder="Isi nama Deputi" required value="{{ old('unit_kerja_detail_c') }}" style="border-radius: 4px;">
                                             </div>
                                         </div>
                                     </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_contact" class="form-label font-weight-bold">5. Nomor HP (WhatsApp)</label>
                                        <input type="text" class="form-control" name="customer_contact" required value="{{ old('customer_contact') }}" placeholder="Masukkan nomor WhatsApp aktif">
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="form-label font-weight-bold d-block">6. Status Pengguna (Pilih salah satu)</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_status" id="status_pengguna" value="pengguna" required>
                                            <label class="form-check-label" for="status_pengguna">Pengguna Laptop Sewa</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_status" id="status_bukan" value="bukan_pengguna" required>
                                            <label class="form-check-label" for="status_bukan">Bukan Pengguna Laptop Sewa</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group mb-3" id="serial_row" style="display: none;">
                                        <label for="laptop_serial_number" class="form-label font-weight-bold">7. Nomor Serial Number Laptop</label>
                                        <input type="text" class="form-control" name="laptop_serial_number" id="laptop_serial_number" placeholder="Wajib diisi jika Pengguna Laptop Sewa">
                                    </div>

                                    <hr class="w-100 my-4">

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="form-label font-weight-bold">Mekanisme Pembayaran</label>
                                        <div class="alert-payment">
                                            <div class="payment-item mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_mechanism" id="pay_transfer" value="transfer" required>
                                                    <label class="form-check-label fw-bold" for="pay_transfer">
                                                        a. Pembayaran langsung melalui transfer VA Bank BNI
                                                    </label>
                                                </div>
                                                <div class="payment-option-info">
                                                    <small class="text-muted">VA akan diinformasikan melalui Whatsapp Calon Pembeli oleh PT CMS Duta Solusi</small>
                                                </div>
                                            </div>

                                            <div class="payment-item">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_mechanism" id="pay_payroll" value="potong_gaji" required>
                                                    <label class="form-check-label fw-bold" for="pay_payroll">
                                                        b. Pembayaran melalui pemotongan gaji dengan cara :
                                                    </label>
                                                </div>
                                                
                                                <div class="payment-option-info" id="payroll_options" style="display: none;">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="payroll_deduction_periods" value="1" id="deduct_1">
                                                        <label class="form-check-label" for="deduct_1">1 (satu) kali pemotongan Gaji</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="payroll_deduction_periods" value="2" id="deduct_2">
                                                        <label class="form-check-label" for="deduct_2">2 (dua) kali pemotongan Gaji</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="payroll_deduction_periods" value="3" id="deduct_3">
                                                        <label class="form-check-label" for="deduct_3">3 (tiga) kali pemotongan Gaji</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payroll_deduction_periods" value="4" id="deduct_4">
                                                        <label class="form-check-label" for="deduct_4">4 (empat) kali pemotongan Gaji</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="customer_unit" id="legacy_unit">
                                </div>
                                <button type="submit" class="btn-premium w-100 mt-4 py-3" style="border: none; font-size: 18px; font-weight: bold;">
                                    <i class="fas fa-file-pdf me-2"></i> Buat Surat Pernyataan (PDF)
                                </button>
                                <p class="text-center mt-2 small text-muted">Akan mengunduh PDF untuk Anda tandatangani & upload kembali.</p>
                            </form>
                            
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Logic for Serial Number
                                const statusRadios = document.querySelectorAll('input[name="user_status"]');
                                const serialRow = document.getElementById('serial_row');
                                const serialInput = document.getElementById('laptop_serial_number');
                                
                                statusRadios.forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        if(this.value === 'pengguna') {
                                            serialRow.style.display = 'block';
                                            serialInput.required = true;
                                        } else {
                                            serialRow.style.display = 'none';
                                            serialInput.required = false;
                                            serialInput.value = '';
                                        }
                                    });
                                });

                                // Logic for Payment Mechanism
                                const payRadios = document.querySelectorAll('input[name="payment_mechanism"]');
                                const payrollOptions = document.getElementById('payroll_options');
                                const payrollInputs = payrollOptions.querySelectorAll('input[name="payroll_deduction_periods"]');

                                function togglePayroll() {
                                    const isPayroll = document.getElementById('pay_payroll').checked;
                                    if(isPayroll) {
                                        payrollOptions.style.display = 'block';
                                        payrollInputs.forEach(radio => radio.required = true);
                                    } else {
                                        payrollOptions.style.display = 'none';
                                        payrollInputs.forEach(radio => {
                                            radio.required = false;
                                            radio.checked = false;
                                        });
                                    }
                                }

                                payRadios.forEach(radio => {
                                    radio.addEventListener('change', togglePayroll);
                                });

                                // Submit Handler
                                const form = document.getElementById('checkoutForm');
                                form.addEventListener('submit', function(e) {
                                    const a = document.querySelector('input[name="unit_kerja_detail_a"]').value;
                                    const b = document.querySelector('input[name="unit_kerja_detail_b"]').value;
                                    const c = document.querySelector('input[name="unit_kerja_detail_c"]').value;
                                    document.getElementById('legacy_unit').value = `${a} | ${b} | ${c}`;
                                });
                                
                                togglePayroll(); // Initial check
                            });
                            </script>
                        </div>
                    </div>
                </div>

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
