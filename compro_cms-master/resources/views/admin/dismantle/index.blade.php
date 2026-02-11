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
                        <a href="{{ route($route.'.create') }}" class="btn btn-dark btn-sm"><i class="fas fa-plus mr-1"></i> BUAT JADWAL BARU</a>
                        <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt mr-1"></i> REFRESH</a>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                  
                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table full-width">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jadwal</th>
                                <th>Wilayah</th>
                                <th>Kantor Cabang</th>
                                <th>Jumlah Order</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            @php
                                $scheduleOrders = \App\Models\Order::where('dismantel_schedule', $row->dismantel_schedule)->get();
                                $orderCount = $scheduleOrders->count();

                                $wilayahList = $scheduleOrders->map(function($order) {
                                    if($order->wilayah_kerja == 'pusat') return 'Kantor Pusat';
                                    if($order->wilayah_kerja == 'wilayah') return 'Kantor Wilayah'; 
                                    return ucwords(str_replace('_', ' ', $order->wilayah_kerja));
                                })->unique()->filter()->values();

                                $branchList = $scheduleOrders->map(function($order) {
                                     $detail = json_decode($order->unit_kerja_detail, true);
                                     if (is_array($detail)) {
                                         return $detail['cabang'] ?? $detail['kab_kota'] ?? $detail['deputi'] ?? '-';
                                     }
                                     return $order->unit_kerja_detail;
                                })->unique()->filter()->values();
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="text-dark font-weight-bold">{{ $row->dismantel_schedule }}</span>
                                </td>
                                <td>
                                    @foreach($wilayahList as $wil)
                                        <div class="badge badge-info mb-1">{{ $wil }}</div><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($branchList as $branch)
                                        <div class="text-dark font-weight-bold mb-1" style="font-size: 0.9rem;"><i class="fas fa-building mr-1 text-secondary"></i> {{ $branch }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge badge-primary" style="font-size: 0.9rem;">{{ $orderCount }} Order</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route($route.'.edit', ['schedule' => $row->dismantel_schedule]) }}" class="btn btn-info" title="Edit">
                                        <i class="far fa-edit mr-1"></i> Edit Jadwal
                                    </a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                  <!-- Data Table End -->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    
</div> <!-- container -->

@endsection
