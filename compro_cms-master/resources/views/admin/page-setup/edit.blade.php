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
                    <h4 class="header-title" style="font-weight: 800; color: #333; text-transform: uppercase;">{{ __('dashboard.edit') }} {{ $title }}</h4>
                </div>
                <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body px-4 pb-4">

                    <!-- Form Start -->
                    <div class="form-group">
                        <label for="title" class="font-weight-600">{{ __('dashboard.title') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $row->title }}" required>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="meta_title" class="font-weight-600">{{ __('dashboard.meta_title') }}</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $row->meta_title }}">
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="font-weight-600">{{ __('dashboard.meta_description') }}</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{ $row->meta_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="font-weight-600">{{ __('dashboard.meta_keywords') }}</label>
                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3">{{ $row->meta_keywords }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status" class="font-weight-600">{{ __('dashboard.select_status') }}</label>
                        <select class="wide" name="status" id="status" data-plugin="customselect">
                            <option value="1" @if( $row->status == 1 ) selected @endif>{{ __('dashboard.active') }}</option>
                            <option value="0" @if( $row->status == 0 ) selected @endif>{{ __('dashboard.inactive') }}</option>
                        </select>
                    </div>
                    <!-- Form End -->
                    
                </div>
                <div class="card-footer bg-white border-top-0 px-4 pb-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4" style="font-weight: 700;">
                        <i class="fas fa-save mr-1"></i> {{ __('dashboard.update') }}
                    </button>
                </div>
                </form>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

@endsection