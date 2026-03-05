@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0">{{ $title }}</h4>
                    <div class="d-flex" style="gap: 10px;">
                        <div class="dropdown">
                            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file-export mr-1"></i> EXPORT
                            </button>
                            <div class="dropdown-menu dropdown-menu-right shadow border-0" style="border-radius: 8px;">
                                <a class="dropdown-item py-2" href="{{ route($route.'.export-csv', request()->all()) }}">
                                    <i class="fas fa-file-csv mr-2 text-success"></i> Download CSV
                                </a>
                                <a class="dropdown-item py-2" href="{{ route($route.'.export-pdf', request()->all()) }}" target="_blank">
                                    <i class="fas fa-file-pdf mr-2 text-danger"></i> Print PDF (Rekap)
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-info btn-sm" type="button" data-toggle="collapse" data-target="#filterBox" aria-expanded="false">
                            <i class="fas fa-filter mr-1"></i> FILTER
                        </button>
                        <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt mr-1"></i> REFRESH</a>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                  
                  <!-- Filter Box -->
                  <div class="collapse {{ request()->has('status') || request()->has('wilayah') || request()->has('payment') ? 'show' : '' }}" id="filterBox">
                    <div class="card card-body bg-light border-0 shadow-none mb-4" style="border-radius: 12px;">
                        <form action="{{ route($route.'.index') }}" method="GET">
                            <div class="row align-items-end">
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <label class="font-weight-600 small text-uppercase text-muted">Status</label>
                                    <select name="status" class="form-control" style="border-radius: 8px;">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pesanan Diterima</option>
                                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Menunggu Dismantel</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <label class="font-weight-600 small text-uppercase text-muted">Wilayah Kerja</label>
                                    <select name="wilayah" class="form-control" style="border-radius: 8px;">
                                        <option value="">Semua Wilayah</option>
                                        <option value="pusat" {{ request('wilayah') == 'pusat' ? 'selected' : '' }}>Kantor Pusat</option>
                                        <option value="wilayah" {{ request('wilayah') == 'wilayah' ? 'selected' : '' }}>Kedeputian Wilayah</option>
                                        <option value="cabang" {{ request('wilayah') == 'cabang' ? 'selected' : '' }}>Kantor Cabang</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <label class="font-weight-600 small text-uppercase text-muted">Mekanisme Pembayaran</label>
                                    <select name="payment" class="form-control" style="border-radius: 8px;">
                                        <option value="">Semua Pembayaran</option>
                                        <option value="transfer" {{ request('payment') == 'transfer' ? 'selected' : '' }}>VA Transfer</option>
                                        <option value="potong_gaji" {{ request('payment') == 'potong_gaji' ? 'selected' : '' }}>Potong Gaji</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark flex-grow-1" style="border-radius: 8px; font-weight: 600;"><i class="fas fa-search mr-1"></i> Telusuri</button>
                                        @if(request()->has('status') || request()->has('wilayah') || request()->has('payment'))
                                            <a href="{{ route($route.'.index') }}" class="btn btn-light ml-2" style="border-radius: 8px;">Reset</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                  
                  <!-- Bulk Action Panel -->
                  <form action="{{ route($route.'.bulk-update') }}" method="POST" id="bulkActionForm">
                    @csrf
                    <div id="bulk-action-bar" class="alert alert-light border shadow-sm mb-3 d-none align-items-center justify-content-between" style="border-radius: 12px; padding: 10px 20px;">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-primary mr-3" id="selected-count">0 Terpilih</span>
                            <h5 class="mb-0 text-dark" style="font-size: 14px; font-weight: 700;">Aksi Masal: Ubah Status ke</h5>
                        </div>
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <select name="status" class="form-control form-control-sm" style="width: 180px; border-radius: 8px;" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending">Pesanan Diterima</option>
                                <option value="paid">Dibayar</option>
                                <option value="processing">Menunggu Dismantel</option>
                                <option value="completed">Selesai</option>
                                <option value="failed">Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-dark btn-sm px-3" style="border-radius: 8px; font-weight: 700;">Terapkan</button>
                        </div>
                    </div>

                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table full-width">
                        <thead>
                            <tr>
                                <th width="40">
                                    <div class="custom-control custom-checkbox text-center">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Amount / Payment</th>
                                <th>Wilayah</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox text-center">
                                        <input type="checkbox" name="order_ids[]" value="{{ $row->id }}" class="custom-control-input order-checkbox" id="check_{{ $row->id }}">
                                        <label class="custom-control-label" for="check_{{ $row->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-primary font-weight-bold" style="white-space: nowrap; font-size: 0.8rem;">{{ $row->order_number }}</span>
                                </td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $row->customer_name }}</div>
                                    <small class="text-muted"><i class="fas fa-phone-alt mr-1" style="font-size: 0.7rem; opacity: 0.6;"></i>{{ $row->customer_contact }}</small>
                                    @if($row->npp || $row->customer_id_num)
                                    <br><small class="text-muted"><i class="fas fa-id-card mr-1" style="font-size: 0.7rem; opacity: 0.6;"></i>{{ $row->npp ?: $row->customer_id_num }}</small>
                                    @endif
                                </td>
                                <td class="font-weight-bold">
                                    <div class="text-dark">Rp {{ number_format($row->total_amount, 0, ',', '.') }}</div>
                                    <small class="badge badge-light border text-muted px-2 py-1" style="font-weight: 600; border-radius: 4px;">{{ $row->payment_mechanism == 'transfer' ? 'VA Transfer' : 'Potong Gaji' }}</small>
                                </td>
                                <td>
                                    @php
                                        $jsonDetail = json_decode($row->unit_kerja_detail, true);
                                    @endphp

                                    @if(!empty($row->wilayah_kerja))
                                        <span class="badge badge-secondary mb-1" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.03em; border-radius: 4px; background: #e2e8f0; color: #475569; padding: 3px 7px;">
                                            {{ strtoupper(str_replace('_', ' ', $row->wilayah_kerja)) }}
                                        </span>
                                    @endif

                                    @if(is_array($jsonDetail) && !empty(array_filter($jsonDetail)))
                                        <div class="mt-1" style="line-height: 1.5;">
                                            @if(!empty($jsonDetail['kab_kota']))
                                                <div class="text-muted" style="font-size: 0.73rem;"><i class="fas fa-map-marker-alt mr-1" style="opacity: 0.4; width: 10px;"></i>{{ $jsonDetail['kab_kota'] }}</div>
                                            @endif
                                            @if(!empty($jsonDetail['cabang']))
                                                <div class="text-dark" style="font-size: 0.82rem; font-weight: 600;">{{ $jsonDetail['cabang'] }}</div>
                                            @endif
                                            @if(!empty($jsonDetail['deputi']))
                                                <div class="text-muted" style="font-size: 0.73rem;">{{ $jsonDetail['deputi'] }}</div>
                                            @endif
                                        </div>
                                    @elseif(!empty($row->customer_unit))
                                        <div class="text-dark mt-1" style="font-size: 0.82rem; font-weight: 600;">{{ $row->customer_unit }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($row->esign_path)
                                        <span class="status-badge status-completed"><i class="fas fa-signature mr-1"></i> E-Signed</span>
                                    @elseif($row->signed_document_path)
                                        <span class="status-badge status-processing"><i class="fas fa-file-pdf mr-1"></i> Uploaded</span>
                                    @else
                                        <span class="status-badge status-missing"><i class="fas fa-clock mr-1"></i> Missing</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $row->status == 'completed' )
                                    <span class="status-badge status-completed">Selesai</span>
                                    @elseif( $row->status == 'processing' )
                                    <span class="status-badge status-processing">Menunggu Dismantel</span>
                                    @if($row->dismantel_schedule)
                                        <small class="d-block text-muted mt-1" style="font-size: 10px; font-weight: 600;">
                                            <i class="fas fa-calendar-day mr-1"></i> {{ $row->dismantel_schedule }}
                                        </small>
                                    @endif
                                    @elseif( $row->status == 'paid' )
                                    <span class="status-badge status-paid">Dibayar</span>
                                    @elseif( $row->status == 'failed' )
                                    <span class="status-badge status-failed">Dibatalkan</span>
                                    @else
                                    <span class="status-badge status-pending">Diterima</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-dark font-weight-600" style="font-size: 0.85rem;">{{ $row->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $row->created_at->format('H:i') }} WIB</small>
                                </td>
                                 <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route($route.'.show', [$row->id]) }}" class="btn btn-success" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                 </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                  <!-- Data Table End -->

                  </form>

                  @foreach( $rows as $row )
                    @include('admin.inc.delete')
                  @endforeach

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    
</div> <!-- container -->

@endsection

@section('page_js')
<script>
$(document).ready(function() {
    // Check All logic
    $("#checkAll").click(function() {
        $(".order-checkbox").prop('checked', $(this).prop('checked'));
        toggleBulkBar();
    });

    $(".order-checkbox").change(function() {
        if ($(".order-checkbox:checked").length == $(".order-checkbox").length) {
            $("#checkAll").prop('checked', true);
        } else {
            $("#checkAll").prop('checked', false);
        }
        toggleBulkBar();
    });

    function toggleBulkBar() {
        var count = $(".order-checkbox:checked").length;
        if (count > 0) {
            $("#bulk-action-bar").removeClass('d-none').addClass('d-flex');
            $("#selected-count").text(count + " Terpilih");
        } else {
            $("#bulk-action-bar").removeClass('d-flex').addClass('d-none');
        }
    }
});
</script>
@endsection
