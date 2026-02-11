@extends('admin.layouts.master')
@section('title', 'Tambah Wilayah & Unit Kerja')
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')

    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.work-area.index') }}" class="btn btn-info mb-3">
                <i class="fas fa-arrow-left mr-1"></i> {{ __('dashboard.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-primary py-2 text-white">
                    <h4 class="header-title mb-0">{{ __('dashboard.add_new') }} Wilayah & Unit Kerja</h4>
                </div>
                <div class="card-body">

                    <!-- Form Start -->
                    <form class="needs-validation" novalidate action="{{ route('admin.work-area.store') }}" method="post" id="workAreaForm">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="font-weight-600">Pilih Wilayah Kerja <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="kantor_pusat" name="wilayah_kerja" class="custom-control-input" value="kantor_pusat" required>
                                    <label class="custom-control-label" for="kantor_pusat">Kantor Pusat</label>
                                </div>
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="kantor_wilayah" name="wilayah_kerja" class="custom-control-input" value="kantor_wilayah" required>
                                    <label class="custom-control-label" for="kantor_wilayah">Kantor Wilayah</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="kantor_cabang" name="wilayah_kerja" class="custom-control-input" value="kantor_cabang" required>
                                    <label class="custom-control-label" for="kantor_cabang">Kantor Cabang</label>
                                </div>
                            </div>
                        </div>

                        <!-- Universal Field: KDKR (isi untuk semua) -->
                        <div id="universal_fields" style="display: none;" class="p-3 border rounded bg-light mb-3">
                            <div class="form-group">
                                <label for="kdkr" class="font-weight-600">KDKR <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kdkr" id="kdkr" placeholder="Masukkan Kode Regional/Wilayah" required>
                            </div>
                        </div>

                        <!-- Kantor Wilayah Fields -->
                        <div id="kw_fields" style="display: none;" class="p-3 border rounded bg-light mb-3">
                            <h5 class="mb-3">Informasi Kantor Wilayah</h5>
                            <div class="form-group">
                                <label for="nama_kw" class="font-weight-600">Nama KW <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_kw" id="nama_kw" placeholder="Masukkan Nama Kantor Wilayah">
                            </div>
                        </div>

                        <!-- Kantor Cabang Fields -->
                        <div id="kc_fields" style="display: none;" class="p-3 border rounded bg-light mb-3">
                            <h5 class="mb-3">Informasi Kantor Cabang</h5>
                            <div class="form-group">
                                <label for="nmkc" class="font-weight-600">NMKC <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nmkc" id="nmkc" placeholder="Masukkan Nama Kantor Cabang">
                            </div>
                            <div class="form-group">
                                <label for="kdkc" class="font-weight-600">KDKC <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kdkc" id="kdkc" placeholder="Masukkan Kode Kantor Cabang">
                            </div>
                        </div>

                        <!-- Kantor Pusat Fields (Existing) -->
                        <div id="kp_fields" style="display: none;" class="p-3 border rounded bg-light mb-3">
                            <h5 class="mb-3">Informasi Kantor Pusat</h5>
                            <div class="form-group">
                                <label for="kantor_cabang_text" class="font-weight-600">Asisten Deputi</label>
                                <input type="text" class="form-control" name="kantor_cabang" id="kantor_cabang_text" placeholder="Nama Asisten Deputi">
                            </div>
                        </div>

                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" style="min-width: 200px;">{{ __('dashboard.save') }}</button>
                        </div>

                    </form>
                    <!-- Form End -->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="wilayah_kerja"]');
        const universalFields = document.getElementById('universal_fields');
        const kwFields = document.getElementById('kw_fields');
        const kcFields = document.getElementById('kc_fields');
        const kpFields = document.getElementById('kp_fields');
        
        const kdkrInput = document.getElementById('kdkr');
        const kwInputs = kwFields.querySelectorAll('input');
        const kcInputs = kcFields.querySelectorAll('input');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Show universal
                universalFields.style.display = 'block';
                kdkrInput.required = true;

                // Hide sub fields
                kwFields.style.display = 'none';
                kcFields.style.display = 'none';
                kpFields.style.display = 'none';
                
                // Remove required
                kwInputs.forEach(i => i.required = false);
                kcInputs.forEach(i => i.required = false);

                if (this.value === 'kantor_wilayah') {
                    kwFields.style.display = 'block';
                    kwInputs.forEach(i => i.required = true);
                } else if (this.value === 'kantor_cabang') {
                    kcFields.style.display = 'block';
                    kcInputs.forEach(i => i.required = true);
                } else if (this.value === 'kantor_pusat') {
                    kpFields.style.display = 'block';
                }
            });
        });
    });
</script>

@endsection
