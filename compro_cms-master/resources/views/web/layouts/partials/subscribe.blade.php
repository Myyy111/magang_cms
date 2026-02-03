@php
    $section_subscribe = \App\Models\Section::section('subscribe');
@endphp
@if(isset($section_subscribe))
<!--Subscribe Section-->
<section class="subscribe-section">
    <div class="container wow fadeInUp">
        <div class="row clearfix">
            <!--Form Column-->
            <div class="title-column col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <h2>{{ $section_subscribe->title }}</h2>
                <div class="text">{!! $section_subscribe->description !!}</div>
                <div class="icon-box">
                    <span class="icon flaticon-mail"></span>
                </div>
            </div>
            <!--Form Column-->
            <div class="form-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="subscribe-form">
                        <form method="post" action="{{ route('subscribe') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" value="" placeholder="{{ __('contact.email_address') }}" required>
                                <button type="submit" class="theme-btn"><i class="fab fa-telegram-plane"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Subscribe Section-->
@endif
