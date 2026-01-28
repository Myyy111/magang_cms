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
                    <h4 class="header-title mb-0" style="font-weight: 700; color: #333;">{{ $title }}</h4>
                    <a href="{{ route($route.'.index') }}" class="btn btn-soft-secondary btn-sm"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
                </div>
                <div class="card-body px-4 pb-4">
                  
                  <!-- Data Table Start -->
                  <div class="table-responsive">
                    <table id="basic-datatable" class="table full-width">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Wilayah</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="text-primary font-weight-bold">{{ $row->order_number }}</span>
                                </td>
                                <td>
                                    <div class="font-weight-600 text-dark">{{ $row->customer_name }}</div>
                                    <small class="text-muted">{{ $row->customer_contact }}</small>
                                </td>
                                <td class="font-weight-bold">Rp {{ number_format($row->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($row->wilayah_kerja == 'pusat')
                                        <span class="badge badge-primary">Pusat</span>
                                    @elseif($row->wilayah_kerja == 'wilayah')
                                        <span class="badge badge-info">Wilayah</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($row->signed_document_path)
                                        <span class="badge badge-info"><i class="fas fa-file-pdf mr-1"></i> Uploaded</span>
                                    @else
                                        <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> Missing</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $row->status == 'completed' )
                                    <span class="badge badge-success">Completed</span>
                                    @elseif( $row->status == 'paid' )
                                    <span class="badge badge-primary">Paid</span>
                                    @elseif( $row->status == 'failed' )
                                    <span class="badge badge-danger">Failed</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-dark">{{ $row->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $row->created_at->format('H:i') }} WIB</small>
                                </td>
                                 <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route($route.'.show', [$row->id]) }}" class="btn btn-success" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $row->id }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                 </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                  <!-- Data Table End -->

                  @foreach( $rows as $row )
                    @include('admin.inc.delete')
                  @endforeach

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    
</div> <!-- container -->

@endsection
