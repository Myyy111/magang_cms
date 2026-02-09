@extends('admin.layouts.master')
@section('title', 'Edit Wilayah & Unit Kerja')
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
                <div class="card-header">
                    <h4 class="header-title">{{ __('dashboard.edit') }} Wilayah & Unit Kerja</h4>
                </div>
                <div class="card-body">

                    <!-- Form Start -->
                    <form class="needs-validation" novalidate action="{{ route('admin.work-area.update', $workArea->id) }}" method="post" id="workAreaForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Bagian 3 – Wilayah Kerja -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Bagian 3 – Wilayah Kerja</h4>
                                <hr/>
                                <div class="form-group mb-4">
                                    <label class="font-weight-600">Pilih Wilayah Kerja <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="kantor_pusat" name="wilayah_kerja" class="custom-control-input" value="kantor_pusat" @if($workArea->wilayah_kerja == 'kantor_pusat') checked @endif required>
                                        <label class="custom-control-label" for="kantor_pusat">Kantor Pusat</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="kantor_wilayah" name="wilayah_kerja" class="custom-control-input" value="kantor_wilayah" @if($workArea->wilayah_kerja == 'kantor_wilayah') checked @endif required>
                                        <label class="custom-control-label" for="kantor_wilayah">Kedeputian Wilayah</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="kantor_cabang" name="wilayah_kerja" class="custom-control-input" value="kantor_cabang" @if($workArea->wilayah_kerja == 'kantor_cabang') checked @endif required>
                                        <label class="custom-control-label" for="kantor_cabang">Kantor Cabang</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __('dashboard.please_provide') }} Wilayah Kerja
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 4 – Unit Kerja -->
                        <div id="unit_kerja_section">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h4>Bagian 4 – Unit Kerja</h4>
                                    <hr/>
                                    
                                    <div class="form-group">
                                        <label for="kab_kota" class="font-weight-600">a. Kab / Kota <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kab_kota" id="kab_kota" value="{{ $workArea->kab_kota }}" placeholder="Nama Kabupaten atau Kota" required>
                                        <div class="invalid-feedback">
                                            {{ __('dashboard.please_provide') }} Kab / Kota
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="kantor_cabang_text" class="font-weight-600">b. Kantor Cabang / Asisten Deputi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="kantor_cabang" id="kantor_cabang_text" value="{{ $workArea->kantor_cabang }}" placeholder="Nama Kantor Cabang atau unit setara" required>
                                        <div class="invalid-feedback">
                                            {{ __('dashboard.please_provide') }} Kantor Cabang / Asisten Deputi
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="deputi_direktorat" class="font-weight-600">c. Deputi / Direktorat / Bidang / Deputi Direktorat Wilayah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="deputi_direktorat" id="deputi_direktorat" value="{{ $workArea->deputi_direktorat }}" placeholder="Nama unit struktural" required>
                                        <div class="invalid-feedback">
                                            {{ __('dashboard.please_provide') }} Unit Struktural
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary" id="submit_button">{{ __('dashboard.update') }}</button>
                        </div>

                    </form>
                    <!-- Form End -->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('input[name="wilayah_kerja"]');
        const submitButton = document.getElementById('submit_button');
        const unitKerjaSection = document.getElementById('unit_kerja_section');
        const unitKerjaInputs = unitKerjaSection.querySelectorAll('input[required]');

        radios.forEach(radio => {
            radio.addEventListener('change', validateForm);
        });

        unitKerjaInputs.forEach(input => {
            input.addEventListener('input', validateForm);
        });

        function validateForm() {
            let isValid = true;
            const anyRadioChecked = Array.from(radios).some(r => r.checked);
            
            if (!anyRadioChecked) {
                isValid = false;
            } else {
                unitKerjaInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        isValid = false;
                    }
                });
            }

            submitButton.disabled = !isValid;
        }

        // Initial check
        validateForm();
    });
</script>

@endsection
