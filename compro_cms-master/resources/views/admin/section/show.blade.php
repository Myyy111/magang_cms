@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="container-fluid">
    
    <!-- Include page breadcrumb -->
    @include('admin.inc.breadcrumb')

    <div class="row">
        <div class="col-12">
            <a href="{{ route($route.'.index') }}" class="btn btn-info shadow-sm mb-3">
                <i class="fas fa-arrow-left mr-1"></i> {{ __('dashboard.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h4 class="header-title" style="font-weight: 800; color: #333; text-transform: uppercase;">{{ __('dashboard.view') }} {{ $title }}</h4>
                </div>
                <div class="card-body px-4 pb-4">

                    <!-- Section Details Start -->
                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.title') }}</label>
                        <h5 style="font-weight: 700; color: #333; margin-top: 8px;">{{ $row->title }}</h5>
                    </div>

                    @if(!empty($row->icon))
                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.icon') }}</label>
                        <div style="margin-top: 8px;">
                            <div class="btn btn-secondary btn-lg" style="font-size: 24px; pointer-events: none;">{!! $row->icon !!}</div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($row->description))
                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.description') }}</label>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 8px;">
                            <p style="font-size: 15px; color: #333; line-height: 1.6; margin: 0;">{{ $row->description }}</p>
                        </div>
                    </div>
                    @endif

                    <hr style="border-top: 2px solid #e9ecef; margin: 24px 0;">

                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.status') }}</label>
                        <p style="margin-top: 8px;">
                            @if( $row->status == 1 )
                            <span class="badge badge-success badge-pill" style="font-size: 13px; padding: 6px 12px;">{{ __('dashboard.active') }}</span>
                            @else
                            <span class="badge badge-danger badge-pill" style="font-size: 13px; padding: 6px 12px;">{{ __('dashboard.inactive') }}</span>
                            @endif
                        </p>
                    </div>
                    <!-- Section Details End -->
                    
                </div>
                <div class="card-footer bg-white border-top-0 px-4 pb-4">
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-lg px-4" style="font-weight: 700;">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('dashboard.back') }}
                    </a>
                    <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-primary btn-lg px-4 ml-2" style="font-weight: 700;">
                        <i class="far fa-edit mr-1"></i> {{ __('dashboard.edit') }}
                    </a>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

@endsection