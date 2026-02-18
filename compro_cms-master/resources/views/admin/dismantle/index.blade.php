@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    @include('admin.inc.breadcrumb')

    <!-- Summary Cards -->
    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; border-left: 4px solid #004aad;">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase mb-1 font-weight-bold" style="font-size: 10px; letter-spacing: 0.5px;">Total Jadwal</p>
                    <h3 class="mb-0 text-dark font-weight-bold">{{ $total_jadwal }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; border-left: 4px solid #2ecc71;">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase mb-1 font-weight-bold" style="font-size: 10px; letter-spacing: 0.5px;">Slot Open</p>
                    <h3 class="mb-0 text-success font-weight-bold">{{ $slot_open }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; border-left: 4px solid #e74c3c;">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase mb-1 font-weight-bold" style="font-size: 10px; letter-spacing: 0.5px;">Slot Full</p>
                    <h3 class="mb-0 text-danger font-weight-bold">{{ $slot_full }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; border-left: 4px solid #f39c12;">
                <div class="card-body p-3">
                    <p class="text-muted text-uppercase mb-1 font-weight-bold" style="font-size: 10px; letter-spacing: 0.5px;">Jadwal Hari Ini</p>
                    <h3 class="mb-0 text-warning font-weight-bold">{{ $slot_today }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center flex-wrap">
                    <h4 class="header-title mb-2 mb-md-0">{{ $title }}</h4>
                    <div class="d-flex" style="gap: 10px;">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                            <i class="fas fa-plus mr-1"></i> BUAT JADWAL BARU
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal">
                            <i class="fas fa-file-excel mr-1"></i> IMPORT EXCEL
                        </button>
                        <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync-alt mr-1"></i> REFRESH
                        </a>
                    </div>
                </div>
                
                <!-- Filter Section -->
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ route($route.'.index') }}" method="GET" class="row align-items-end bg-light p-3 rounded mb-3">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <label for="filter_tanggal" class="small font-weight-bold text-muted">Tanggal</label>
                            <input type="date" name="tanggal" id="filter_tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <label for="filter_cabang" class="small font-weight-bold text-muted">Kode Cabang</label>
                            <input type="text" name="kode_cabang" id="filter_cabang" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('kode_cabang') }}">
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <label for="filter_status" class="small font-weight-bold text-muted">Status</label>
                            <select name="status" id="filter_status" class="form-control form-control-sm">
                                <option value="">Semua Status</option>
                                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>OPEN</option>
                                <option value="full" {{ request('status') == 'full' ? 'selected' : '' }}>FULL</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>CLOSED</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <label class="small font-weight-bold text-muted d-block">&nbsp;</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="show_all" name="show_all" value="1" {{ request('show_all') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="show_all" style="font-size: 12px;">Tampilkan Semua</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-dark btn-sm mr-1">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                            <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-redo mr-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-body px-4 pb-4">
                  
                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table class="table table-hover full-width">
                        <thead class="bg-light">
                            <tr>
                                <th width="50" class="border-top-0">No</th>
                                <th class="border-top-0">
                                    <a href="{{ route($route.'.index', array_merge(request()->all(), ['sort' => 'tanggal', 'order' => (request('sort') == 'tanggal' && request('order') == 'desc') ? 'asc' : 'desc'])) }}" class="text-dark">
                                        Tanggal 
                                        @if(request('sort') == 'tanggal') <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                                    </a>
                                </th>
                                <th class="border-top-0">Kode Wilayah</th>
                                <th class="border-top-0">Kode Cabang</th>
                                <th class="border-top-0 text-center">
                                    <a href="{{ route($route.'.index', array_merge(request()->all(), ['sort' => 'kapasitas', 'order' => (request('sort') == 'kapasitas' && request('order') == 'desc') ? 'asc' : 'desc'])) }}" class="text-dark">
                                        Kapasitas
                                        @if(request('sort') == 'kapasitas') <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }} ml-1"></i> @endif
                                    </a>
                                </th>
                                <th class="border-top-0 text-center">Terpakai</th>
                                <th class="border-top-0 text-center">Sisa</th>
                                <th class="border-top-0 text-center">Status</th>
                                <th class="border-top-0 text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            @php
                                $sisa = $row->kapasitas - $row->terpakai;
                                $statusClass = $row->status == 'open' ? 'success' : ($row->status == 'full' ? 'danger' : 'secondary');
                                $statusLabel = strtoupper($row->status);
                                
                                // 4️⃣ Indikator Visual Kapasitas
                                $sisaPercent = $row->kapasitas > 0 ? ($sisa / $row->kapasitas) * 100 : 0;
                                if ($sisa == 0) {
                                    $sisaBadgeClass = 'danger';
                                } elseif ($sisaPercent <= 20) {
                                    $sisaBadgeClass = 'warning';
                                } else {
                                    $sisaBadgeClass = 'success';
                                }
                            @endphp
                            <tr>
                                <td class="align-middle">{{ $rows->firstItem() + $key }}</td>
                                <td class="align-middle">
                                    <div class="text-dark font-weight-bold">
                                        <i class="far fa-calendar-alt mr-2 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="align-middle"><span class="text-dark font-weight-bold">{{ $row->kode_wilayah }}</span></td>
                                <td class="align-middle"><span class="text-dark font-weight-bold">{{ $row->kode_cabang }}</span></td>
                                <td class="text-center align-middle font-weight-bold">{{ $row->kapasitas }}</td>
                                <td class="text-center align-middle">{{ $row->terpakai }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-{{ $sisaBadgeClass }} px-2 py-1">{{ $sisa }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-{{ $statusClass }} px-3 py-2" style="font-size: 0.8rem;">{{ $statusLabel }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <div style="display: flex; flex-direction: row; gap: 5px; justify-content: center;">
                                        <a href="{{ route($route.'.show', $row->id) }}" class="btn btn-success btn-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px;" title="Lihat Detail">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-info btn-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px;" title="Edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px;" title="Hapus" onclick="confirmDelete({{ $row->id }})">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $row->id }}" action="{{ route($route.'.destroy', $row->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                  <!-- Data Table End -->

                  <div class="mt-3 d-flex justify-content-end">
                      {{ $rows->appends(request()->all())->links() }}
                  </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div> <!-- container -->

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route($route.'.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Jadwal Dismantle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_wilayah" class="font-weight-600">Kode Wilayah <span class="text-danger">*</span></label>
                            <input type="text" name="kode_wilayah" id="kode_wilayah" class="form-control" placeholder="Contoh: 01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kode_cabang" class="font-weight-600">Kode Cabang <span class="text-danger">*</span></label>
                            <input type="text" name="kode_cabang" id="kode_cabang" class="form-control" placeholder="Contoh: 001" required>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="tanggal" class="font-weight-600">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kapasitas" class="font-weight-600">Kapasitas Slot <span class="text-danger">*</span></label>
                            <input type="number" name="kapasitas" id="kapasitas" class="form-control" min="0" value="0" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keterangan" class="font-weight-600">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Opsional"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route($route.'.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="importModalLabel">Import Jadwal Dismantle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file" class="font-weight-600">Pilih File CSV</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".csv" required>
                        <div class="alert alert-info mt-3 py-2" style="font-size: 0.8rem;">
                            <i class="fas fa-info-circle mr-1"></i> <strong>Format CSV (Tanpa Header):</strong><br>
                            Kolom 1: Kode Wilayah<br>
                            Kolom 2: Kode Cabang<br>
                            Kolom 3: Tanggal (YYYY-MM-DD)<br>
                            Kolom 4: Keterangan (Opsional)<br>
                            Kolom 5: Kapasitas (Angka, default 0)<br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Mulai Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
    function confirmDelete(id) {
        if(confirm('Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
