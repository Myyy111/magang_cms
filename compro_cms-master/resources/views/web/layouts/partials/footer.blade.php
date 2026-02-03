<!-- Main Footer -->
<footer class="main-footer" style="background-image: url({{ asset('web/images/background/footer-bg.jpg') }});">
    <div class="container wow fadeInUp">
        <!--Widgets Section-->
        <div class="widgets-section">
            @if(isset($setting))
            <div class="footer-logo-top">
                <a href="{{ route('home') }}"><img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo"></a>
            </div>
            @endif

            <div class="row clearfix">
                <div class="big-column col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column (Contact Info)-->
                        <div class="footer-column col-lg-7 col-md-12 col-sm-12">
                            <div class="footer-widget about-widget">
                                @if(isset($setting))
                                <div class="widget-content">
                                    <ul class="footer-contact-list">
                                        <li>
                                            <i class="far fa-map"></i>
                                            <div class="contact-detail">
                                                <span class="label">{{ __('contact.address') }}:</span>
                                                <span class="value">{{ $setting->contact_address }}</span>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone-volume" style="color: var(--accent-yellow);"></i>
                                            <div class="contact-detail">
                                                <span class="label">{{ __('contact.phone') }}:</span>
                                                <span class="value">
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_one) }}" target="_blank">{{ $setting->phone_one }}</a>@if(isset($setting->phone_two)), <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone_two) }}" target="_blank">{{ $setting->phone_two }}</a> @endif
                                                </span>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope" style="color: var(--accent-yellow);"></i>
                                            <div class="contact-detail">
                                                <span class="label">{{ __('contact.email') }}:</span>
                                                <span class="value">
                                                    @if($setting->email_one != 'subangkit@cmsdutasolusi.co.id')
                                                    <a href="mailto:{{ $setting->email_one }}">{{ $setting->email_one }}</a>
                                                    @endif
                                                    @if(isset($setting->email_two) && $setting->email_two != 'subangkit@cmsdutasolusi.co.id')
                                                    @if($setting->email_one != 'subangkit@cmsdutasolusi.co.id'), <br> @endif
                                                    <a href="mailto:{{ $setting->email_two }}">{{ $setting->email_two }}</a> 
                                                    @endif
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if(count($pages) > 0)
                        <!--Footer Column (Links)-->
                        <div class="footer-column col-lg-5 col-md-12 col-sm-12">
                            <div class="footer-widget links-widget ps-lg-4">
                                <h2 class="widget-title">{{ __('common.footer_links') }}</h2>
                                <div class="widget-content">
                                    <ul class="list">
                                        @foreach($pages as $key => $page)
                                        <li><a href="{{ route('page.single', $page->slug) }}">{{ $page->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if(count($recents) > 0)
                <div class="big-column col-xl-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-lg-12 col-md-12 col-sm-12">
                            <div class="footer-widget recent-posts">
                                <h2 class="widget-title">{{ __('common.recent_posts') }}</h2>
                                    <!--Footer Column-->
                                <div class="widget-content">
                                    <div class="item">
                                        @foreach($recents as $key => $recent)
                                        @if($key <= 1)
                                        <div class="post">
                                            <div class="thumb">
                                                <a href="{{ route('blog.single', $recent->slug) }}">
                                                    <img src="{{ asset('uploads/article/'.$recent->image_path) }}" alt="{{ $recent->title }}">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <span class="post-date">{{ date('M d, Y', strtotime($recent->created_at)) }}</span>
                                                <h4><a href="{{ route('blog.single', $recent->slug) }}">{!! str_limit(strip_tags($recent->title), 45, ' ...') !!}</a></h4>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner-container clearfix">
                <div class="copyright-text">© 2026 PT CMS Duta Solusi. All rights reserved.</div>
                <div class="social-links">
                    <ul class="social-icon-two">
                        @if(isset($social->facebook))
                        <li><a href="{{ $social->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if(isset($social->twitter))
                        <li><a href="{{ $social->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if(isset($social->instagram))
                        <li><a href="{{ $social->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if(isset($social->linkedin))
                        <li><a href="{{ $social->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if(isset($social->pinterest))
                        <li><a href="{{ $social->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                        @endif
                        @if(isset($social->youtube))
                        <li><a href="{{ $social->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if(isset($social->skype))
                        <li><a href="skype:{{ $social->skype }}?chat" target="_blank"><i class="fab fa-skype"></i></a></li>
                        @endif
                        @if(isset($social->whatsapp))
                        <li><a href="https://wa.me/{{ str_replace(' ', '', $social->whatsapp) }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Main Footer -->
