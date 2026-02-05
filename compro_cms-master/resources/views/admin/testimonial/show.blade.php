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
            <a href="{{ route($route.'.index') }}" class="btn btn-info">{{ __('dashboard.back') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ __('dashboard.view') }} {{ $title }}</h4>
                </div>
                <div class="card-body">

                    <!-- Details View Start -->
                    <h4><span class="text-highlight">{{ __('dashboard.name') }}:</span> {{ $row->title }}</h4>
                    <p><span class="text-highlight">{{ __('dashboard.designation') }}:</span> {{ $row->designation }}</p>
                    <p><span class="text-highlight">{{ __('dashboard.organization') }}:</span> {{ $row->organization }}</p>
                    <hr/>

                    @if(file_exists(public_path('uploads/'.$path.'/'.$row->image_path)))
                    <div class="mb-3">
                        <p><span class="text-highlight">{{ __('dashboard.photo') }}:</span></p>
                        <img src="{{ asset('uploads/'.$path.'/'.$row->image_path) }}" class="img-fluid rounded border" style="max-width: 200px;" alt="Photo">
                    </div>
                    <hr/>
                    @endif

                    <div class="mb-3">
                        <p><span class="text-highlight">{{ __('dashboard.description') }}:</span></p>
                        <div class="border p-3 rounded bg-light">{!! $row->description !!}</div>
                    </div>

                    <hr/>
                    <p><span class="text-highlight">{{ __('dashboard.status') }}:</span> 
                    @if( $row->status == 1 )
                    <span class="badge badge-success badge-pill">{{ __('dashboard.active') }}</span>
                    @else
                    <span class="badge badge-danger badge-pill">{{ __('dashboard.inactive') }}</span>
                    @endif
                    </p>
                    <!-- Details View End -->
                    
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->

    
</div> <!-- container -->
<!-- End Content-->

@endsection