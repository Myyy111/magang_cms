@extends('admin.layouts.master')
@section('title', 'Wilayah & Unit Kerja')
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.work-area.create') }}" class="btn btn-primary">{{ __('dashboard.add_new') }}</a>
            <a href="{{ route('admin.work-area.index') }}" class="btn btn-info">{{ __('dashboard.refresh') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Wilayah & Unit Kerja {{ __('dashboard.list') }}</h4>
                </div>
                <div class="card-body">

                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table nowrap full-width">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.no') }}</th>
                                <th>Wilayah Kerja</th>
                                <th>Kab / Kota</th>
                                <th>Kantor Cabang / Asisten Deputi</th>
                                <th>Unit Struktural</th>
                                <th>{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $workAreas as $key => $row )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($row->wilayah_kerja == 'kantor_pusat')
                                        Kantor Pusat
                                    @elseif($row->wilayah_kerja == 'kantor_wilayah')
                                        Kedeputian Wilayah
                                    @else
                                        Kantor Cabang
                                    @endif
                                </td>
                                <td>{{ $row->kab_kota }}</td>
                                <td>{{ $row->kantor_cabang }}</td>
                                <td>{{ $row->deputi_direktorat }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.work-area.edit', $row->id) }}" class="btn btn-primary" title="Edit">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{ __('dashboard.are_you_sure') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __('dashboard.delete_warning') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.work-area.destroy', $row->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ __('dashboard.delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- end row-->
    
</div> <!-- container -->

@endsection
