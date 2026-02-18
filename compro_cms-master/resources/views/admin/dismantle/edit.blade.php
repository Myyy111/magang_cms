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
                    <h4 class="header-title mb-0">Edit Jadwal Dismantle</h4>
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route($route.'.update', $row->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kode_wilayah" class="font-weight-600">Kode Wilayah <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_wilayah" id="kode_wilayah" class="form-control" value="{{ $row->kode_wilayah }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kode_cabang" class="font-weight-600">Kode Cabang <span class="text-danger">*</span></label>
                                    <input type="text" name="kode_cabang" id="kode_cabang" class="form-control" value="{{ $row->kode_cabang }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal" class="font-weight-600">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $row->tanggal }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status" class="font-weight-600">Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="open" {{ $row->status == 'open' ? 'selected' : '' }}>OPEN</option>
                                        <option value="full" {{ $row->status == 'full' ? 'selected' : '' }}>FULL</option>
                                        <option value="closed" {{ $row->status == 'closed' ? 'selected' : '' }}>CLOSED</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row bg-light rounded pt-3 pb-1 mb-3 mx-0">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="kapasitas" class="font-weight-600">Kapasitas Slot</label>
                                    <input type="number" name="kapasitas" id="kapasitas" class="form-control font-weight-bold" min="0" value="{{ $row->kapasitas }}" required>
                                    <small class="text-muted">Total slot yang tersedia.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="terpakai" class="font-weight-600 text-muted">Slot Terpakai</label>
                                    <input type="number" id="terpakai" class="form-control bg-white" value="{{ $row->terpakai }}" readonly>
                                    <small class="text-muted">Jumlah order masuk.</small>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="sisa" class="font-weight-600 text-primary">Sisa Slot</label>
                                    <input type="number" id="sisa" class="form-control bg-white text-primary font-weight-bold" value="{{ $row->kapasitas - $row->terpakai }}" readonly>
                                    <small class="text-muted">Slot tersedia.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="keterangan" class="font-weight-600">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="4" placeholder="Opsional">{{ $row->keterangan }}</textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> Perbarui Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple script to update 'Sisa Slot' when capacity changes
    document.getElementById('kapasitas').addEventListener('input', function() {
        var capacity = parseInt(this.value) || 0;
        var used = parseInt(document.getElementById('terpakai').value) || 0;
        document.getElementById('sisa').value = capacity - used;
    });
</script>

@endsection
