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
            <a href="{{ route($route.'.create') }}" class="btn btn-primary">{{ __('dashboard.add_new') }}</a>

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
                    <table id="basic-datatable" class="table nowrap full-width">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach( $rows as $key => $row )
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if(file_exists(public_path('uploads/'.$path.'/'.$row->image_path)) && !empty($row->image_path))
                                    <img src="{{ asset('uploads/'.$path.'/'.$row->image_path) }}" class="img-fluid" alt="Blog">
                                    @endif
                                </td>
                                <td>{!! str_limit(strip_tags($row->title), 50, ' ...') !!}</td>
                                <td>{{ $row->category->title }}</td>
                                <td>
                                    @if( $row->status == 1 )
                                    <span class="badge badge-success">{{ __('dashboard.active') }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('dashboard.inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route($route.'.show', [$row->id]) }}" class="btn btn-success" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route($route.'.edit', [$row->id]) }}" class="btn btn-primary" title="Edit">
                                            <i class="far fa-edit"></i>
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