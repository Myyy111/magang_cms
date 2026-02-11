@extends('admin.layouts.master')
@section('title', 'Wilayah & Unit Kerja')
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')
    <!-- end page title --> 

    <div class="row mb-3">
        <div class="col-12 text-right">
            <a href="{{ route('admin.work-area.create') }}" class="btn btn-primary shadow-sm"><i class="fas fa-plus mr-1"></i> TAMBAH WILAYAH & UNIT</a>
            <a href="{{ route('admin.work-area.index') }}" class="btn btn-secondary shadow-sm"><i class="fas fa-sync-alt mr-1"></i> REFRESH</a>
        </div>
    </div>

    <!-- Kantor Wilayah Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 text-primary" style="font-weight: 700;"><i class="fas fa-map-marked-alt mr-2"></i> TABEL KANTOR WILAYAH</h4>
                </div>
                <div class="card-body px-4 pb-4">
                  <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center" width="50">NO</th>
                                <th>KODE WILAYAH (KDKR)</th>
                                <th>NAMA KANTOR WILAYAH</th>
                                <th width="150" class="text-right">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse( $kantorWilayah as $key => $row )
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>
                                    @if($row->kdkr)
                                        <span class="badge badge-primary px-2 py-1" style="font-size: 0.85rem;">{{ $row->kdkr }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="font-weight-600">{{ $row->nama_kw ?: '-' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.work-area.edit', $row->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @include('admin.inc.delete')
                                </td>
                            </tr>
                          @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data Kantor Wilayah</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kantor Cabang Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 text-success" style="font-weight: 700;"><i class="fas fa-code-branch mr-2"></i> TABEL KANTOR CABANG</h4>
                </div>
                <div class="card-body px-4 pb-4">
                  <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center" width="50">NO</th>
                                <th>KDKR</th>
                                <th>NAMA KANTOR CABANG (NMKC)</th>
                                <th>KODE CABANG (KDKC)</th>
                                <th width="150" class="text-right">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse( $kantorCabang as $key => $row )
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>
                                    @if($row->kdkr)
                                        <span class="badge badge-primary px-2 py-1" style="font-size: 0.85rem;">{{ $row->kdkr }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="font-weight-600">{{ $row->nmkc ?: '-' }}</td>
                                <td>
                                    @if($row->kdkc)
                                        <span class="badge badge-secondary px-2 py-1" style="font-size: 0.85rem;">{{ $row->kdkc }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.work-area.edit', $row->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @include('admin.inc.delete')
                                </td>
                            </tr>
                          @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data Kantor Cabang</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kantor Pusat Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 text-dark" style="font-weight: 700;"><i class="fas fa-building mr-2"></i> TABEL KANTOR PUSAT</h4>
                </div>
                <div class="card-body px-4 pb-4">
                  <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center" width="50">NO</th>
                                <th>KDKR</th>
                                <th>KDKC</th>
                                <th>ASISTEN DEPUTI / UNIT</th>
                                <th width="150" class="text-right">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse( $kantorPusat as $key => $row )
                            <tr>
                                <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge badge-primary px-2 py-1" style="font-size: 0.85rem;">{{ $row->kdkr ?: '00' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-secondary px-2 py-1" style="font-size: 0.85rem;">{{ $row->kdkc ?: '0001' }}</span>
                                </td>
                                <td class="font-weight-600">{{ $row->kantor_cabang ?: '-' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.work-area.edit', $row->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @include('admin.inc.delete')
                                </td>
                            </tr>
                          @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data Kantor Pusat</td>
                            </tr>
                          @endforelse
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->
@endsection
