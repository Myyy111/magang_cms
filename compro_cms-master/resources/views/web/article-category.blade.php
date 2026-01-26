@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('blog');
@endphp
@if(isset($header))

    @section('title', $header->meta_title)

    @section('top_meta_tags')
    @if(isset($header->meta_description))
    <meta name="description" content="{!! str_limit(strip_tags($header->meta_description), 160, ' ...') !!}">
    @else
    <meta name="description" content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}">
    @endif

    @if(isset($header->meta_keywords))
    <meta name="keywords" content="{!! strip_tags($header->meta_keywords) !!}">
    @else
    <meta name="keywords" content="{!! strip_tags($setting->keywords) !!}">
    @endif
    @endsection

@endif

@section('content')

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <!-- Floating Elements for Premium Feel -->
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>{{ __('navbar.blog') }}</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        @if(isset($current_category))
                            <li><a href="{{ route('blogs') }}">{{ __('navbar.blog') }}</a></li>
                            <li>{{ $current_category->title }}</li>
                        @else
                            <li>{{ __('navbar.blog') }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container" style="background: #f8fafc; padding: 100px 0;">
        <div class="container">
            <div class="row clearfix">
                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-classic">
                        
                        @foreach($articles as $article)
                        <!-- News Block Premium -->
                        <div class="blog-card-premium mb-5 wow fadeInUp">
                            <div class="blog-image-wrapper" style="height: 380px;">
                                @if($article->image_path)
                                    <img src="{{ asset('uploads/article/'.$article->image_path) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                                <div class="blog-date-badge">
                                    {{ date('d M, Y', strtotime($article->created_at)) }}
                                </div>
                            </div>
                            <div class="blog-content-premium p-4">
                                <h3 class="mb-3"><a href="{{ route('blog.single', $article->slug) }}" class="text-decoration-none text-dark" style="font-weight: 800; font-size: 26px;">{{ $article->title }}</a></h3>
                                <div class="text mb-4" style="color: #64748b; font-size: 16px; line-height: 1.8;">{!! str_limit(strip_tags($article->description), 200, ' ...') !!}</div>
                                <a href="{{ route('blog.single', $article->slug) }}" class="blog-read-more" style="font-weight: 700; color: var(--primary-blue); text-decoration: none;">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div> 
                        @endforeach

                        @if(count($articles) == 0)
                            <div class="text-center py-5">
                                <h3 class="text-muted">{{ __('search.no_result') }}</h3>
                            </div>
                        @endif

                    </div>

                    <div class="pagination-wrapper mt-4">
                        {{ $articles->appends(Request::only('search'))->links() }}
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar default-sidebar">
                        
                        <!--Search box Premium -->
                        <div class="sidebar-widget search-box-premium p-4 mb-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <form method="get" action="{{ route('blog.search') }}">
                                <div class="form-group mb-0 position-relative">
                                    <input type="search" name="search" class="form-control" style="border-radius: 12px; padding: 12px 20px; background: #f1f5f9; border: none;" placeholder="{{ __('search.search_field') }}" value="@if(isset($search)){{ $search }}@endif" required="">
                                    <button type="submit" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--primary-blue);"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        @if(count($article_categories) > 0)
                        <!-- Categories Premium -->
                        <div class="sidebar-widget categories-premium p-4 mb-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <div class="sidebar-title mb-3"><h3 style="font-size: 20px; font-weight: 800;">{{ __('common.categories') }}</h3></div>
                            <ul class="cat-list list-unstyled">
                                @foreach($article_categories as $article_category)
                                <li class="mb-2 @if(isset($current_category)) @if($current_category->id == $article_category->id) active @endif @endif">
                                    <a href="{{ route('blog.category', $article_category->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center p-2 rounded @if(isset($current_category) && $current_category->id == $article_category->id) bg-primary text-white @else text-dark @endif" style="transition: all 0.3s ease;">
                                        {{ $article_category->title }} 
                                        <span class="badge @if(isset($current_category) && $current_category->id == $article_category->id) bg-white text-primary @else bg-light text-muted @endif">{{ $article_category->articles->where('status', 1)->count() }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(count($recents) > 0)
                        <!-- Latest News Premium -->
                        <div class="sidebar-widget latest-news-premium p-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <div class="sidebar-title mb-4"><h3 style="font-size: 20px; font-weight: 800;">{{ __('common.recent_posts') }}</h3></div>
                            <div class="widget-content">
                                @foreach($recents as $key => $recent)
                                <article class="post d-flex gap-3 mb-3 pb-3 border-bottom">
                                    <div class="post-thumb" style="width: 80px; height: 80px; flex-shrink: 0;">
                                        <a href="{{ route('blog.single', $recent->slug) }}">
                                            <img src="{{ asset('uploads/article/'.$recent->image_path) }}" alt="{{ $recent->title }}" class="rounded shadow-sm" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4 style="font-size: 14px; font-weight: 700; margin-bottom: 5px; line-height: 1.4;">
                                            <a href="{{ route('blog.single', $recent->slug) }}" class="text-decoration-none text-dark">{{ str_limit(strip_tags($recent->title), 50, ' ...') }}</a>
                                        </h4>
                                        <div class="post-date text-muted" style="font-size: 11px;">{{ date('F d, Y', strtotime($recent->created_at)) }}</div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                        @endif           
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sidebar Container -->

@endsection