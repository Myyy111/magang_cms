@extends('admin.layouts.master')
@section('title', 'Buat Jadwal Baru')
@section('content')

<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0">Buat Jadwal Dismantle Baru</h4>
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
                <div class="card-body px-4 pb-4">
                    
                    <form action="{{ route($route.'.bulk-update') }}" method="POST" id="bulkScheduleForm">
                        @csrf
                        
                        <div class="alert alert-light border mb-4" style="border-radius: 8px;">
                            <i class="fas fa-info-circle mr-2 text-info"></i> Pilih beberapa pesanan yang ingin Anda masukkan ke dalam jadwal yang sama, lalu tentukan <b>Tanggal Jadwal</b> di bawah.
                        </div>

                        <div class="form-group mb-4">
                            <label for="dismantel_schedule" class="font-weight-600 small text-uppercase text-muted">Jadwal Dismantle:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0"><i class="far fa-calendar-alt text-primary"></i></span>
                                </div>
                                <input type="text" name="dismantel_schedule" id="dismantel_schedule" class="form-control border-left-0" 
                                       placeholder="Pilih Tanggal dan Waktu" 
                                       data-toggle="date-picker" 
                                       data-single-date-picker="true" 
                                       data-time-picker="true"
                                       data-time-picker24-hour="true"
                                       data-locale='{"format": "DD MMM YYYY, HH:mm"}'
                                       required readonly style="background-color: #fff;">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover" id="unscheduled-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="40">
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                <label class="custom-control-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th>No. Pesanan</th>
                                        <th>Nama Customer</th>
                                        <th>Unit Kerja</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox text-center">
                                                <input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="custom-control-input order-checkbox" id="check_{{ $order->id }}">
                                                <label class="custom-control-label" for="check_{{ $order->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">{{ $order->order_number }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>
                                            @php
                                                $unit = json_decode($order->unit_kerja_detail, true);
                                                echo $unit['cabang'] ?? ($unit['deputi'] ?? ($unit['kab_kota'] ?? '-'));
                                            @endphp
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if($order->status == 'paid')
                                                <span class="badge status-badge status-paid">Terbayar</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge status-badge status-processing">Diproses</span>
                                            @else
                                                <span class="badge badge-secondary">{{ strtoupper($order->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                                                <h5 class="font-weight-600">Semua pesanan sudah terjadwal!</h5>
                                                <p class="text-muted small">Tidak ada pesanan baru yang perlu dijadwalkan saat ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
 
                        <div class="mt-4 text-right">
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="btnSubmit" disabled>
                                <i class="fas fa-calendar-check mr-2"></i> Konfirmasi Jadwal
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_js')
<script>
$(document).ready(function() {
    // Check All logic
    $("#checkAll").click(function() {
        $(".order-checkbox").prop('checked', $(this).prop('checked'));
        toggleSubmitBtn();
    });

    $(".order-checkbox").change(function() {
        toggleSubmitBtn();
        if ($(".order-checkbox:checked").length == $(".order-checkbox").length) {
            $("#checkAll").prop('checked', true);
        } else {
            $("#checkAll").prop('checked', false);
        }
    });

    function toggleSubmitBtn() {
        if ($(".order-checkbox:checked").length > 0) {
            $("#btnSubmit").prop('disabled', false);
        } else {
            $("#btnSubmit").prop('disabled', true);
        }
    }

    $("#bulkScheduleForm").submit(function() {
        if ($("#dismantel_schedule").val() == "") {
            alert("Harap pilih Tanggal Jadwal terlebih dahulu.");
            return false;
        }
        return true;
    });
});
</script>
@endsection
