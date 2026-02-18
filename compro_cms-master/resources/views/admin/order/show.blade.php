@extends('admin.layouts.master')
@section('title', $title)
@section('page_css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')

<style>
    .order-card { border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .status-timeline { position: relative; padding-left: 30px; }
    .status-timeline::before { content: ''; position: absolute; left: 10px; top: 0; bottom: 0; width: 2px; background: #eee; }
    .status-point { position: absolute; left: 0; width: 22px; height: 22px; border-radius: 50%; background: #fff; border: 3px solid #ddd; z-index: 1; }
    .status-point.active { border-color: #004aad; background: #004aad; }
    .info-label { color: #888; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
    .info-value { font-weight: 600; color: #333; font-size: 1rem; }
    .doc-preview { background: #f8f9fa; border: 1px dashed #ddd; border-radius: 8px; padding: 20px; text-align: center; }
</style>

<!-- Start Content-->
<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route($route.'.index') }}" class="btn btn-light shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> {{ __('dashboard.back') }}
                </a>
                <div>
                   <span class="badge badge-soft-primary p-2 px-3" style="font-size: 0.9rem;">
                        ID Pesanan: #{{ $row->order_number }}
                   </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Info -->
        <div class="col-lg-8">
            <!-- Customer & Purchase Info -->
            <div class="card order-card mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="card-title mb-0"><i class="fas fa-user-circle mr-2 text-primary"></i> Data Pemesan & Pembelian</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value">{{ $row->customer_name }}</div>
                        </div>
                         <div class="col-md-4 mb-3">
                            <div class="info-label">N P P / N I P</div>
                            <div class="info-value">{{ $row->npp ?: ($row->customer_id_num ?: '-') }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">KDKR</div>
                            <div class="info-value"><span class="badge badge-primary px-2" style="vertical-align: middle;">{{ $row->kdkr ?? '-' }}</span></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">KDKC</div>
                            <div class="info-value"><span class="badge badge-success px-2" style="vertical-align: middle;">{{ $row->kdkc ?? '-' }}</span></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Nomor WhatsApp</div>
                            <div class="info-value">{{ $row->customer_contact }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Wilayah Kerja</div>
                            <div class="info-value">
                                @if($row->wilayah_kerja == 'pusat')
                                    KANTOR PUSAT
                                @elseif($row->wilayah_kerja == 'wilayah')
                                    KANTOR WILAYAH
                                @else
                                    {{ ucfirst($row->wilayah_kerja) ?: '-' }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="info-label">Unit Kerja Detail</div>
                            <div class="info-value">
                                @php $unit_detail = json_decode($row->unit_kerja_detail, true); @endphp
                                @if(is_array($unit_detail))
                                    <div class="bg-light p-2 rounded mt-1" style="font-size: 0.9rem;">
                                        <strong>Kab/Kota:</strong> {{ $unit_detail['kab_kota'] ?? '-' }} <br>
                                        <strong>Cabang/As.Dep:</strong> {{ $unit_detail['cabang'] ?? '-' }} <br>
                                        <strong>Deputi/Bld/Wil:</strong> {{ $unit_detail['deputi'] ?? '-' }}
                                    </div>
                                @else
                                    {{ $row->unit_kerja_detail }}
                                @endif
                            </div>
                        </div>

                        <!-- 🗓️ Assigned Dismantle Schedule Info -->
                        @if($row->dismantle_schedule_id)
                        <div class="col-md-12 mb-3">
                            <div class="info-label text-primary">🗓️ Jadwal Dismantle (Slot Terpesan)</div>
                            <div class="info-value">
                                <div class="alert alert-info border-0 mt-1 d-flex align-items-center" style="background: #eef7ff; color: #004aad;">
                                    <i class="fas fa-calendar-check fa-2x mr-3 opacity-5"></i>
                                    <div>
                                        <div class="font-weight-bold" style="font-size: 1.1rem;">
                                            {{ \Carbon\Carbon::parse($row->dismantleSchedule->tanggal)->translatedFormat('d F Y') }}
                                        </div>
                                        <div class="small">Terdaftar pada Cabang: {{ $row->dismantleSchedule->kantor_cabang ?? $row->kdkc }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <hr class="my-3 opacity-5">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Status Pengguna</div>
                            <div class="info-value">{{ $row->user_status == 'pengguna' ? 'Pengguna Laptop Sewa' : 'Bukan Pengguna Laptop Sewa' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Serial Number Laptop</div>
                            <div class="info-value">{{ $row->laptop_serial_number ?: '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">Mekanisme Bayar</div>
                            <div class="info-value">
                                {{ $row->payment_mechanism == 'transfer' ? 'Transfer VA BNI' : 'Potong Gaji' }}
                                @if($row->payment_mechanism == 'potong_gaji')
                                    <span class="badge badge-soft-warning ml-1">{{ $row->payroll_deduction_periods }}x Cicil</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="card order-card mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="card-title mb-0"><i class="fas fa-box-open mr-2 text-primary"></i> Rincian Produk</h5>
                </div>
                <div class="card-body px-4">
                    <div class="table-responsive">
                        <table class="table table-borderless table-centered table-nowrap mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th class="text-center">Kuantitas</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($row->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image_path)
                                                <img src="{{ asset('uploads/product/'.$item->product->image_path) }}" alt="" class="rounded mr-2" height="40">
                                            @endif
                                            <div>
                                                <h6 class="m-0">{{ $item->product ? $item->product->title : 'Produk Dihapus' }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold" style="font-size: 1.1rem; border-top: 2px solid #f1f3f4;">
                                    <td colspan="3" class="text-right pt-3">TOTAL BAYAR</td>
                                    <td class="text-right pt-3 text-primary">Rp {{ number_format($row->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="col-lg-4">
            <!-- Order Progress / Status Wrapper -->
            <div class="card order-card mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="card-title mb-0">Status Pesanan</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <form action="{{ route($route.'.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="info-label">Pilih Status Baru:</label>
                            <select class="form-control custom-select-lg border-primary mb-3" name="status" id="status" style="height: 50px; font-weight: bold;">
                                <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>🕒 Pesanan Diterima</option>
                                <option value="paid" {{ $row->status == 'paid' ? 'selected' : '' }}>💳 Pembayaran Dikonfirmasi</option>
                                <option value="processing" {{ $row->status == 'processing' ? 'selected' : '' }}>🗓️ Menunggu Jadwal Dismentel</option>
                                <option value="completed" {{ $row->status == 'completed' ? 'selected' : '' }}>✅ Selesai / Dismentel</option>
                                <option value="failed" {{ $row->status == 'failed' ? 'selected' : '' }}>❌ Batal / Gagal</option>
                            </select>
                        </div>

                        @if(!$row->dismantle_schedule_id)
                        <div id="dismantel_input_group" class="form-group mb-3" style="display: {{ $row->status == 'processing' ? 'block' : 'none' }}; background: #f0f7ff; padding: 15px; border-radius: 12px; border: 1px solid #d0e7ff;">
                            <label class="info-label" style="color: #004aad;">🗓️ Tentukan Jadwal Dismentel:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-primary border-right-0"><i class="fas fa-calendar-alt text-primary"></i></span>
                                </div>
                                <input type="text" name="dismantel_schedule" id="dismantel_schedule_input" class="form-control border-primary" value="{{ $row->dismantel_schedule }}" placeholder="Pilih Tanggal & Waktu..." readonly style="background: white;">
                            </div>
                            <small class="text-muted">Klik untuk membuka kalender. Jadwal akan tampil di pelacakan user.</small>
                        </div>
                        @else
                        <div class="form-group mb-3 p-3 text-center" style="background: #f0f7ff; border-radius: 12px; border: 1px dashed #004aad;">
                            <i class="fas fa-calendar-alt text-primary mb-2"></i>
                            <div class="small text-muted mb-1">Jadwal Fix:</div>
                            <div class="font-weight-bold text-primary">
                                {{ \Carbon\Carbon::parse($row->dismantleSchedule->tanggal)->translatedFormat('d F Y') }}
                            </div>
                            <input type="hidden" name="dismantel_schedule" value="{{ $row->dismantleSchedule->tanggal }}">
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow">
                            Update Status <i class="fas fa-save ml-1"></i>
                        </button>
                    </form>
                    
                    <div class="mt-4 border-top pt-3">
                        <small class="text-muted d-block mb-2">Aksi Cepat:</small>
                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">
                           <i class="fas fa-trash mr-1"></i> Hapus Pesanan Ini
                        </button>
                        <!-- Include Delete modal -->
                        @include('admin.inc.delete')
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="card order-card">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="card-title mb-0">Dokumen & Persetujuan</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="doc-preview">
                        @if($row->esign_path)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Tanda Tangan Elektronik (E-Sign):</small>
                                <img src="{{ asset('uploads/signatures/' . $row->esign_path) }}" alt="E-Sign" class="img-fluid border rounded bg-white p-2" style="max-height: 120px;">
                            </div>
                            <a href="{{ route('ecommerce.download_pdf', $row->id) }}" class="btn btn-info btn-sm btn-block mb-3" target="_blank">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat PDF Pernyataan
                            </a>
                        @endif

                        @if($row->signed_document_path)
                            <div class="mb-3 pt-3 {{ $row->esign_path ? 'border-top' : '' }}">
                                <i class="far fa-file-pdf fa-3x text-danger mb-2"></i>
                                <h6 class="mb-2">Surat Pernyataan (Upload)</h6>
                                <a href="{{ asset('uploads/documents/' . $row->signed_document_path) }}" class="btn btn-danger btn-sm btn-block" target="_blank">
                                    <i class="fas fa-eye mr-1"></i> Lihat Dokumen Upload
                                </a>
                            </div>
                        @elseif(!$row->esign_path)
                            <div class="mb-3"><i class="far fa-file-pdf fa-4x text-muted opacity-3"></i></div>
                            <p class="text-muted mb-0"><i>User belum memberikan persetujuan (E-Sign atau Upload).</i></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- container -->

@endsection

@section('page_js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        (function() {
            const statusSelect = document.getElementById('status');
            const inputGroup = document.getElementById('dismantel_input_group');
            
            // Initialize Flatpickr
            flatpickr("#dismantel_schedule_input", {
                enableTime: true,
                dateFormat: "d M Y, H:i",
                minDate: "today",
                time_24hr: true
            });

            function toggleDismantelInput() {
                if(statusSelect.value === 'processing') {
                    inputGroup.style.display = 'block';
                } else {
                    inputGroup.style.display = 'none';
                }
            }

            if (statusSelect) {
                statusSelect.addEventListener('change', toggleDismantelInput);
                // Initial check
                toggleDismantelInput();
            }
        })();
    </script>
@endsection
