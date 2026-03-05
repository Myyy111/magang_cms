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
            font-size: 14px;
            color: #555;
        }
        .unit-row .colon {
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            font-weight: bold;
        }
        
        /* Mobile Optimization for Unit Kerja Form */
        @media (max-width: 576px) {
            .unit-row {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 15px;
            }
            .unit-row .label-text {
                width: 100%;
                margin-bottom: 6px;
                font-weight: 600;
            }
            .unit-row .colon {
                display: none;
            }
            .unit-row .flex-grow-1 {
                width: 100%;
            }
        }
        /* Signature Pad Styles - Mobile Friendly */
        .signature-wrapper {
            position: relative;
            width: 100%;
            height: 220px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 2px dashed #004aad;
            border-radius: 12px;
            background-color: #f8faff;
            margin-bottom: 10px;
            touch-action: none; /* Penting: mencegah scroll saat menandatangani */
        }
        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            cursor: crosshair;
            touch-action: none;
        }
        .signature-hint {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
        }
        .signature-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .btn-clear-sig {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-clear-sig:hover {
            background: #fecaca;
        }
        /* Fix iPhone Signature Pad & Scrolling */
        .signature-wrapper {
            position: relative;
            width: 100%;
            height: 220px;
            background-color: #ffffff;
            border: 2px dashed #004aad;
            border-radius: 15px;
            touch-action: none; /* Penting untuk iPhone: cegah scroll saat ttd */
            overflow: hidden;
        }
        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            touch-action: none;
            cursor: crosshair;
        }

        /* Wilayah Kerja Card Fix (iPhone Friendly) */
        .wilayah-card-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        @media (max-width: 576px) {
            .wilayah-card-grid {
                grid-template-columns: 1fr;
            }
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
                                        <label class="form-label font-weight-bold d-block mb-2">3. Wilayah Kerja</label>
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        @foreach($wilayah_options as $value => $label)
                                            <label for="wilayah_{{ $value }}" style="display: flex; align-items: center; gap: 8px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 10px 16px; cursor: pointer; font-weight: 600; font-size: 14px; color: #334155; transition: all 0.2s; flex: 1; min-width: 120px; min-height: 48px;">
                                                <input class="form-check-input" type="radio" name="wilayah_kerja" id="wilayah_{{ $value }}" value="{{ $value }}" required style="width: 18px; height: 18px; margin: 0; flex-shrink: 0; accent-color: #004aad; cursor: pointer;">
                                                {{ strtoupper($label) }}
                                            </label>
                                        @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group mb-3">
                                         <label class="form-label font-weight-bold mb-3">4. Unit Kerja (Wajib diisi semua)</label>
                                         <div class="unit-row">
                                             <div class="label-text">a. Kab / Kota </div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_a" id="unit_a" list="list_kab_kota" placeholder="Cari atau Ketik Kab/Kota" required value="{{ old('unit_kerja_detail_a') }}" style="border-radius: 4px;">
                                                 <datalist id="list_kab_kota">
                                                     @foreach($work_areas->unique('kab_kota') as $wa)
                                                        <option value="{{ $wa->kab_kota }}">
                                                     @endforeach
                                                 </datalist>
                                             </div>
                                         </div>
                                         <div class="unit-row">
                                             <div class="label-text">b. Kantor Cabang/As.Dep</div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_b" id="unit_b" list="list_cabang" placeholder="Cari atau Ketik Kantor Cabang" required value="{{ old('unit_kerja_detail_b') }}" style="border-radius: 4px;">
                                                 <datalist id="list_cabang"></datalist>
                                             </div>
                                         </div>
                                         <div class="unit-row">
                                             <div class="label-text">c. Dep.Dir.Bld/Dep.Dir.Wil</div>
                                             <div class="colon">:</div>
                                             <div class="flex-grow-1">
                                                 <input type="text" class="form-control" name="unit_kerja_detail_c" id="unit_c" list="list_deputi" placeholder="Cari atau Ketik Deputi" required value="{{ old('unit_kerja_detail_c') }}" style="border-radius: 4px;">
                                                 <datalist id="list_deputi"></datalist>
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
                                    <input type="hidden" name="esign_data" id="esign_data">

                                    <div class="col-md-12 form-group mb-3">
                                        <label class="form-label font-weight-bold">Tanda Tangan Elektronik (E-Sign)</label>
                                        <p class="text-muted small mb-2">✍️ Sentuh dan geser jari Anda pada kotak di bawah untuk membubuhkan tanda tangan.</p>
                                        <div class="signature-wrapper" id="signatureContainer">
                                            <canvas id="signature-pad" class="signature-pad"></canvas>
                                            <div class="signature-hint" id="signatureHint">
                                                <i class="fas fa-pen" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                                Tanda tangan di sini
                                            </div>
                                        </div>
                                        <div class="signature-actions">
                                            <button type="button" id="clear-signature" class="btn-clear-sig">
                                                <i class="fas fa-eraser mr-1"></i> Bersihkan Tanda Tangan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button with specialized override styles -->
                                <style>
                                    #btn-pdf-submit {
                                        padding: 10px 20px !important;
                                        border-radius: 8px !important;
                                        border-radius: 8px !important;
                                        font-size: 14px !important;
                                        width: 100%;
                                        margin-top: 15px;
                                        border: none;
                                        font-weight: 700;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 8px;
                                        box-shadow: none !important; 
                                        height: auto !important;
                                    }
                                </style>
                                <button type="submit" id="btn-pdf-submit" class="btn-premium">
                                    <i class="fas fa-check-circle" style="font-size: 16px;"></i> Konfirmasi & Kirim Pesanan
                                </button>
                                <p class="text-center mt-2 text-muted" style="font-size: 11px;">Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan yang berlaku.</p>
                            </form>
                            
                            <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Signature Pad Logic
                                const canvas = document.getElementById('signature-pad');
                                const signaturePad = new SignaturePad(canvas, {
                                    backgroundColor: 'rgba(255, 255, 255, 0)',
                                    penColor: 'rgb(0, 0, 0)'
                                });

                                // Sembunyikan hint saat mulai menandatangani
                                const hint = document.getElementById('signatureHint');
                                canvas.addEventListener('mousedown', () => { if(hint) hint.style.display = 'none'; });
                                canvas.addEventListener('touchstart', () => { if(hint) hint.style.display = 'none'; }, {passive: true});

                                function resizeCanvas() {
                                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                                    canvas.width = canvas.offsetWidth * ratio;
                                    canvas.height = canvas.offsetHeight * ratio;
                                    canvas.getContext("2d").scale(ratio, ratio);
                                    signaturePad.clear();
                                }

                                window.addEventListener("resize", resizeCanvas);
                                resizeCanvas();

                                document.getElementById('clear-signature').addEventListener('click', function() {
                                    signaturePad.clear();
                                });

                                // Work Area Data for Dynamic Loading
                                const workAreas = @json($work_areas);

                                // Handle Dynamic Filtering for Unit Kerja
                                const wilayahRadios = document.querySelectorAll('input[name="wilayah_kerja"]');
                                const datalistCabang = document.getElementById('list_cabang');
                                const datalistDeputi = document.getElementById('list_deputi');
                                const inputA = document.getElementById('unit_a');
                                const inputB = document.getElementById('unit_b');
                                const inputC = document.getElementById('unit_c');

                                function updateUnitLists(isInitial = false) {
                                    const selectedWilayah = document.querySelector('input[name="wilayah_kerja"]:checked')?.value;
                                    
                                    // Clear datalists
                                    datalistCabang.innerHTML = '';
                                    datalistDeputi.innerHTML = '';
                                    document.getElementById('list_kab_kota').innerHTML = '';
                                    
                                    // Clear inputs when changing wilayah type to avoid "leaked" data from previous selection (e.g. from PUSAT)
                                    // Only clear if NOT the initial load (to preserve old() values on validation error)
                                    if(!isInitial) {
                                        inputA.value = '';
                                        inputB.value = '';
                                        inputC.value = '';
                                    }
                                    
                                    if(selectedWilayah) {
                                        const filtered = workAreas.filter(wa => wa.wilayah_kerja === selectedWilayah);
                                        
                                        // Update Kab/Kota Datalist
                                        const uniqueKab = [...new Set(filtered.map(wa => wa.kab_kota || wa.nmkc))];
                                        uniqueKab.forEach(kab => {
                                            if(kab) document.getElementById('list_kab_kota').innerHTML += `<option value="${kab}">`;
                                        });

                                        // Update Cabang Datalist
                                        const uniqueCabang = [...new Set(filtered.map(wa => wa.kantor_cabang))];
                                        uniqueCabang.forEach(cabang => {
                                            if(cabang) datalistCabang.innerHTML += `<option value="${cabang}">`;
                                        });

                                        // Update Deputi Datalist
                                        const uniqueDeputi = [...new Set(filtered.map(wa => wa.deputi_direktorat))];
                                        uniqueDeputi.forEach(deputi => {
                                            if(deputi) datalistDeputi.innerHTML += `<option value="${deputi}">`;
                                        });

                                        // Auto-fill if there is only a single match (like Kantor PUSAT)
                                        if(filtered.length === 1) {
                                            inputA.value = filtered[0].kab_kota || filtered[0].nmkc || '';
                                            inputB.value = filtered[0].kantor_cabang || '';
                                            inputC.value = filtered[0].deputi_direktorat || '';
                                        }
                                    }
                                }

                                wilayahRadios.forEach(radio => {
                                    radio.addEventListener('change', () => updateUnitLists(false));
                                });

                                // Event listener when Kab/Kota is typed/selected to filter branch
                                inputA.addEventListener('input', function() {
                                    const val = this.value;
                                    const selectedWilayah = document.querySelector('input[name="wilayah_kerja"]:checked')?.value;
                                    const matches = workAreas.filter(wa => (wa.kab_kota === val || wa.nmkc === val) && wa.wilayah_kerja === selectedWilayah);
                                    
                                    if(matches.length > 0) {
                                        datalistCabang.innerHTML = '';
                                        const uniqueCabang = [...new Set(matches.map(wa => wa.kantor_cabang))];
                                        uniqueCabang.forEach(cabang => {
                                            if(cabang) datalistCabang.innerHTML += `<option value="${cabang}">`;
                                        });

                                        // If only one branch in this city/office, auto-fill it
                                        if(matches.length === 1) {
                                            inputB.value = matches[0].kantor_cabang || '';
                                            inputC.value = matches[0].deputi_direktorat || '';
                                        }
                                    }
                                });

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
                                    console.log("📝 Form submission started...");
                                    if (signaturePad.isEmpty()) {
                                        e.preventDefault();
                                        console.warn("⚠️ Signature is empty!");
                                        alert("Silakan bubuhkan tanda tangan Anda terlebih dahulu.");
                                        return;
                                    }

                                    const submitBtn = document.getElementById('btn-pdf-submit');
                                    if(submitBtn) {
                                        submitBtn.disabled = true;
                                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                                    }

                                    const a = document.getElementById('unit_a')?.value || '';
                                    const b = document.getElementById('unit_b')?.value || '';
                                    const c = document.getElementById('unit_c')?.value || '';
                                    
                                    const legacyInput = document.getElementById('legacy_unit');
                                    if(legacyInput) legacyInput.value = `${a} | ${b} | ${c}`;

                                    // Store signature data
                                    const esignInput = document.getElementById('esign_data');
                                    if(esignInput) esignInput.value = signaturePad.toDataURL();
                                    
                                    console.log("✅ Form submitting...");
                                });
                                
                                togglePayroll(); // Initial check
                                updateUnitLists(); // Initial list setup
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
