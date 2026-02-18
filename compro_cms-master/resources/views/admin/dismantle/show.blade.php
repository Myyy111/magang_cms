@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0">Detail Jadwal Dismantle</h4>
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Schedule Info -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h5 class="header-title mb-3 text-primary"><i class="far fa-calendar-alt mr-2"></i> Informasi Jadwal</h5>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td width="150" class="font-weight-bold text-muted">Tanggal</td>
                                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d F Y') }} <span class="text-muted ml-2">({{ \Carbon\Carbon::parse($row->tanggal)->diffForHumans() }})</span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted">Kode Wilayah</td>
                                    <td><span class="badge badge-soft-primary px-2">{{ $row->kode_wilayah }}</span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted">Kode Cabang</td>
                                    <td><span class="font-weight-bold">{{ $row->kode_cabang }}</span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted">Status Slot</td>
                                    <td>
                                        @if($row->status == 'open')
                                            <span class="badge badge-success px-3 py-2">OPEN</span>
                                        @elseif($row->status == 'full')
                                            <span class="badge badge-danger px-3 py-2">FULL</span>
                                        @else
                                            <span class="badge badge-secondary px-3 py-2">CLOSED</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-muted">Keterangan</td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="header-title mb-3 text-primary"><i class="fas fa-chart-pie mr-2"></i> Kapasitas & Slot</h5>
                            <div class="row text-center mt-4">
                                <div class="col-4 border-right">
                                    <h2 class="font-weight-bold mb-0 text-dark">{{ $row->kapasitas }}</h2>
                                    <small class="text-muted text-uppercase font-weight-bold">Total Kapasitas</small>
                                </div>
                                <div class="col-4 border-right">
                                    <h2 class="font-weight-bold mb-0 text-info">{{ $row->terpakai }}</h2>
                                    <small class="text-muted text-uppercase font-weight-bold">Terpakai</small>
                                </div>
                                <div class="col-4">
                                    <h2 class="font-weight-bold mb-0 {{ ($row->kapasitas - $row->terpakai) > 0 ? 'text-success' : 'text-danger' }}">{{ $row->kapasitas - $row->terpakai }}</h2>
                                    <small class="text-muted text-uppercase font-weight-bold">Sisa Slot</small>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="progress" style="height: 10px; border-radius: 5px;">
                                    @php
                                        $percent = $row->kapasitas > 0 ? ($row->terpakai / $row->kapasitas) * 100 : 0;
                                        $color = $percent < 50 ? 'bg-success' : ($percent < 80 ? 'bg-warning' : 'bg-danger');
                                    @endphp
                                    <div class="progress-bar {{ $color }}" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">0%</small>
                                    <small class="text-muted">{{ round($percent) }}% Terisi</small>
                                    <small class="text-muted">100%</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Associated Orders -->
                    <h5 class="header-title mb-3 mt-4 text-primary"><i class="fas fa-shopping-bag mr-2"></i> Daftar Pesanan ({{ $orders->count() }})</h5>
                    
                    @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>No Order</th>
                                    <th>Tanggal Order</th>
                                    <th>Nama Pemesan</th>
                                    <th>NPP</th>
                                    <th>Status Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $key }}</td>
                                    <td><span class="font-weight-bold text-primary">{{ $order->order_number }}</span></td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_id_num }}</td>
                                    <td>
                                        @if($order->status == 'paid')
                                            <span class="badge badge-success">Lunas</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge badge-info">Proses</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info" target="_blank" title="Lihat Detail Order">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $orders->links() }}
                    </div>
                    @else
                        <div class="alert alert-light text-center py-4 border">
                            <i class="far fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Belum ada pesanan yang menggunakan slot jadwal ini.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
