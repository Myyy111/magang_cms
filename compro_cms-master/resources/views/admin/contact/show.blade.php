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
        <div class="col-12 col-lg-9">
            <div class="card shadow border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h4 class="header-title" style="font-weight: 800; color: #333; text-transform: uppercase;">{{ __('dashboard.view') }} {{ $title }}</h4>
                </div>
                <div class="card-body px-4 pb-4">

                    <!-- Email Details Start -->
                    <div class="mb-4">
                        <h5 style="font-weight: 700; color: #333; margin-bottom: 8px;">{{ __('dashboard.subject') }}</h5>
                        <p style="font-size: 16px; color: #555;">{{ $row->subject }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.name') }}</label>
                                <p style="font-size: 15px; color: #333; margin-top: 4px;">{{ $row->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.email') }}</label>
                                <p style="font-size: 15px; color: #333; margin-top: 4px;">
                                    <a href="mailto:{{ $row->email }}" style="color: #007bff; text-decoration: none;">{{ $row->email }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(isset($row->phone))
                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.phone') }}</label>
                        <p style="font-size: 15px; color: #333; margin-top: 4px;">
                            <a href="tel:{{ $row->phone }}" style="color: #007bff; text-decoration: none;">{{ $row->phone }}</a>
                        </p>
                    </div>
                    @endif

                    <hr style="border-top: 2px solid #e9ecef; margin: 24px 0;">

                    <div class="mb-4">
                        <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.message') }}</label>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 8px;">
                            <p style="font-size: 15px; color: #333; line-height: 1.6; margin: 0;">
                                {!! nl2br(strip_tags($row->message, '<p><a><b><i><u><strong><br><ul><ol><li><del><ins><sup><sub><pre>')) !!}
                            </p>
                        </div>
                    </div>

                    <hr style="border-top: 2px solid #e9ecef; margin: 24px 0;">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.status') }}</label>
                            <p style="margin-top: 8px;">
                                @if( $row->status == 1 )
                                <span class="badge badge-success badge-pill" style="font-size: 13px; padding: 6px 12px;">{{ __('dashboard.active') }}</span>
                                @else
                                <span class="badge badge-danger badge-pill" style="font-size: 13px; padding: 6px 12px;">{{ __('dashboard.inactive') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-600" style="color: #666; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('dashboard.date') }}</label>
                            <p style="font-size: 15px; color: #333; margin-top: 8px;">{{ date('h:i:s A | d-M-Y', strtotime($row->created_at)) }}</p>
                        </div>
                    </div>
                    <!-- Email Details End -->
                    
                </div>
                <div class="card-footer bg-white border-top-0 px-4 pb-4">
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary btn-lg px-4" style="font-weight: 700;">
                        <i class="fas fa-arrow-left mr-1"></i> {{ __('dashboard.back') }}
                    </a>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

@endsection