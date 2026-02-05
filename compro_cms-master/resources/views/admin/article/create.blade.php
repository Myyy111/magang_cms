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
                    <h4 class="header-title" style="font-weight: 800; color: #333; text-transform: uppercase;">{{ __('dashboard.add_new') }} {{ $title }}</h4>
                </div>
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body px-4 pb-4">

                    <!-- Form Start -->
                    <div class="form-group">
                        <label for="title" class="font-weight-600">{{ __('dashboard.title') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.title') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="font-weight-600">{{ __('dashboard.blog_category') }} <span class="text-danger">*</span></label>
                        <select class="wide" name="category" id="category" required data-plugin="customselect">
                            <option value="">{{ __('dashboard.select') }}</option>
                            @foreach( $categories as $category )
                            <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.blog_category') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-600">{{ __('dashboard.description') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control textMediaEditor" name="description" id="description" rows="15" required>{{ old('description') }}</textarea>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.description') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="font-weight-600">{{ __('dashboard.thumbnail') }} <span class="text-danger">*</span> <span class="text-muted" style="font-size: 11px;">( {{ __('dashboard.image_size', ['height' => 280, 'width' => 500]) }} )</span></label>
                        <input type="file" class="form-control" name="image" id="image" required>

                        <div class="invalid-feedback">
                          {{ __('dashboard.please_provide') }} {{ __('dashboard.thumbnail') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="video_id" class="font-weight-600">{{ __('dashboard.youtube_video_id') }}</label>
                        <input type="text" class="form-control" name="video_id" id="video_id" value="{{ old('video_id') }}" placeholder="Contoh: oN_SOnfA0YQ">
                    </div>
                    <!-- Form End -->
                    
                </div>
                <div class="card-footer bg-white border-top-0 px-4 pb-4">
                    <button type="submit" class="btn btn-primary btn-lg px-4" style="font-weight: 700;">
                        <i class="fas fa-save mr-1"></i> {{ __('dashboard.save') }}
                    </button>
                </div>
                </form>
            </div>
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

@endsection

@section('page_js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.textMediaEditor').summernote({
             height: 400,
             toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "italic", "underline", "clear"]],
                ['fontsize', ['fontsize']],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ]
        });
    });
</script>
@endsection