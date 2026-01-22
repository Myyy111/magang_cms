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
            <a href="{{ route($route.'.index') }}" class="btn btn-info">{{ __('dashboard.refresh') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ $title }} {{ __('dashboard.list') }}</h4>
                </div>
                <div class="card-body">
                  
                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table table-striped table-hover table-dark nowrap full-width">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.no') }}</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>{{ __('dashboard.status') }}</th>
                                <th>Date</th>
                                <th>{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="text-primary font-weight-bold">{{ $row->order_number }}</span>
                                </td>
                                <td>{{ $row->customer_name }}</td>
                                <td>Rp {{ number_format($row->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if( $row->status == 'completed' )
                                    <span class="badge badge-success badge-pill">Completed</span>
                                    @elseif( $row->status == 'processing' )
                                    <span class="badge badge-primary badge-pill">Processing</span>
                                    @elseif( $row->status == 'cancelled' )
                                    <span class="badge badge-danger badge-pill">Cancelled</span>
                                    @else
                                    <span class="badge badge-warning badge-pill">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $row->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route($route.'.show', [$row->id]) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
