@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')
    <!-- end page title --> 


    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="header-title mb-0">{{ $title }}</h4>
                    <div class="d-flex" style="gap: 10px;">
                        <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-sync-alt mr-1"></i> REFRESH
                        </a>
                    </div>
                </div>
                <div class="card-body">

                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table nowrap full-width">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.no') }}</th>
                                <th>{{ __('dashboard.quote_no') }}</th>
                                <th>{{ __('dashboard.name') }}</th>
                                <th>{{ __('dashboard.date') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                                <th>{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ route($route.'.show', [$row->id]) }}" class="font-weight-bold">#{{ $row->id }}</a></td>
                                <td>
                                    {{ $row->name }}<br>
                                    <small class="text-muted">{{ $row->email }}</small>
                                </td>
                                <td>{{ date('d M Y', strtotime($row->created_at)) }}</td>
                                <td>
                                    @if( $row->status == 1 )
                                    <span class="badge badge-warning">{{ __('dashboard.pending') }}</span>
                                    @elseif( $row->status == 2 )
                                    <span class="badge badge-info">{{ __('dashboard.estimated') }}</span>
                                    @elseif( $row->status == 3 )
                                    <span class="badge badge-success">{{ __('dashboard.approved') }}</span>
                                    @elseif( $row->status == 0 )
                                    <span class="badge badge-danger">{{ __('dashboard.rejected') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route($route.'.show', [$row->id]) }}" class="btn btn-success" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <!-- Include Delete modal -->
                                    @include('admin.inc.delete')
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
<!-- End Content-->

@endsection