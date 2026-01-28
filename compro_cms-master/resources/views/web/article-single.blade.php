@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('blog');
@endphp
@if(isset($header))

    @section('title', $article->title)

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

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="website">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $article->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($article->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('blog.single', $article->slug) }}"/>
    <meta property='og:image' content="{{ asset('uploads/article/'.$article->image_path) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('blog.single', $article->slug) }}" />
    <meta name="twitter:title" content="{{ $article->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($article->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/article/'.$article->image_path) }}" />
    @endif
@endsection

@section('content')

    <!--Page Title (Premium Cut)-->
    <section class="page-title-premium text-center">
        <!-- Floating Elements for Premium Feel -->
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        
        <div class="container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Blog</h1>
                </div>
                <div class="bread-crumb">
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li><a href="{{ route('blogs') }}">{{ __('navbar.blog') }}</a></li>
                        <li>{{ __('navbar.blog-detail') }}</li>
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
                    <div class="blog-detail-premium" style="background: #fff; padding: 40px; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid #f1f5f9;">
                        <!-- News Block -->
                        <div class="news-block">
                            <div class="inner-box">
                                <div class="image-box mb-4" style="border-radius: 20px; overflow: hidden; height: 450px;">
                                    <img src="{{ asset('uploads/article/'.$article->image_path) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="caption-box">
                                    <div class="inner">
                                        <ul class="post-meta d-flex gap-4 mb-3 list-unstyled" style="font-size: 14px; color: #64748b; font-weight: 600;">
                                            <li><i class="far fa-calendar-check me-2" style="color: #004aad;"></i>{{ date('d M, Y', strtotime($article->created_at)) }}</li>
                                            <li><i class="far fa-folder-open me-2" style="color: #004aad;"></i><a href="{{ route('blog.category', $article->category->slug) }}" style="color: inherit; text-decoration: none;">{{ $article->category->title }}</a></li>
                                        </ul>
                                        <style>
                                            .article-content {
                                                text-align: justify;
                                                text-justify: inter-word;
                                            }
                                            .article-content p {
                                                margin-bottom: 25px !important;
                                            }
                                            .article-content ul, .article-content ol {
                                                margin-bottom: 25px;
                                                padding-left: 20px;
                                            }
                                            .article-content li {
                                                margin-bottom: 10px;
                                            }
                                        </style>
                                        <div class="article-content" style="color: #334155; font-size: 17px; line-height: 1.9; letter-spacing: -0.01em;">
                                            {!! $article->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share / Tags -->
                        <div class="tags-share-box mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                            <div class="tags clearfix">
                                <span class="title" style="font-weight: 800; color: #001f3f;">Kategori:</span>
                                <a href="{{ route('blog.category', $article->category->slug) }}" class="badge bg-light text-primary p-2 px-3 ms-2" style="text-decoration: none; border-radius: 8px;">{{ $article->category->title }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar default-sidebar">
                        
                        <!--Search box Premium -->
                        <div class="sidebar-widget search-box-premium p-4 mb-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <form method="get" action="{{ route('blog.search') }}">
                                <div class="form-group mb-0 position-relative">
                                    <input type="search" name="search" class="form-control" style="border-radius: 12px; padding: 12px 20px; background: #f1f5f9; border: none;" placeholder="{{ __('search.search_field') }}" required="">
                                    <button type="submit" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #004aad;"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        @if(count($article_categories) > 0)
                        <!-- Categories Premium -->
                        <div class="sidebar-widget categories-premium p-4 mb-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <div class="sidebar-title mb-3"><h3 style="font-size: 18px; font-weight: 800;">{{ __('common.categories') }}</h3></div>
                            <ul class="cat-list list-unstyled">
                                @foreach($article_categories as $article_category)
                                <li class="mb-2">
                                    <a href="{{ route('blog.category', $article_category->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center p-2 px-3 rounded @if($article->category->id == $article_category->id) bg-primary text-white shadow-sm @else text-dark @endif" style="transition: all 0.3s ease; font-weight: 600; font-size: 14px;">
                                        {{ $article_category->title }} 
                                        <span class="badge @if($article->category->id == $article_category->id) bg-white text-primary @else bg-light text-muted @endif" style="font-size: 10px;">{{ $article_category->articles->where('status', 1)->count() }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(count($recents) > 0)
                        <!-- Latest News Premium -->
                        <div class="sidebar-widget latest-news-premium p-4" style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <div class="sidebar-title mb-4"><h3 style="font-size: 18px; font-weight: 800;">{{ __('common.recent_posts') }}</h3></div>
                            <div class="widget-content">
                                @foreach($recents as $recent)
                                <article class="post d-flex gap-3 mb-3 pb-3 border-bottom">
                                    <div class="post-thumb" style="width: 70px; height: 70px; flex-shrink: 0;">
                                        <a href="{{ route('blog.single', $recent->slug) }}">
                                            <img src="{{ asset('uploads/article/'.$recent->image_path) }}" alt="{{ $recent->title }}" class="rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4 style="font-size: 13px; font-weight: 700; margin-bottom: 5px; line-height: 1.4;">
                                            <a href="{{ route('blog.single', $recent->slug) }}" class="text-decoration-none text-dark">{{ str_limit(strip_tags($recent->title), 40, ' ...') }}</a>
                                        </h4>
                                        <div class="post-date text-muted" style="font-size: 11px;">{{ date('M d, Y', strtotime($recent->created_at)) }}</div>
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