<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fas fa-angle-double-up"></span></div>

<script src="{{ asset('web/js/jquery.js') }}"></script>
<script src="{{ asset('web/js/popper.min.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('web/js/owl.js') }}"></script>
<script src="{{ asset('web/js/wow.js') }}"></script>
<script src="{{ asset('web/js/appear.js') }}"></script>
<script src="{{ asset('web/js/isotope.js') }}"></script>
<script src="{{ asset('web/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('web/js/jquery-ui.js') }}"></script>
<script src="{{ asset('web/js/mixitup.js') }}"></script>
@if($livechat->status == 1)
<script src="{{ asset('web/js/floating-wpp.min.js') }}"></script>
@endif
<script src="{{ asset('web/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // 🔍 Toastr Handlers for all common session keys
    @if(Session::has('success')) toastr.success("{{ Session::get('success') }}"); @endif
    @if(Session::has('message')) toastr.success("{{ Session::get('message') }}"); @endif
    @if(Session::has('info')) toastr.info("{{ Session::get('info') }}"); @endif
    @if(Session::has('warning')) toastr.warning("{{ Session::get('warning') }}"); @endif
    @if(Session::has('error')) toastr.error("{{ Session::get('error') }}"); @endif
    @if(Session::has('status')) toastr.info("{{ Session::get('status') }}"); @endif
    @if(Session::has('alert')) toastr.warning("{{ Session::get('alert') }}"); @endif
    
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}", "Validasi Gagal");
        @endforeach
    @endif
    
    console.log("🚀 Toastr initialized");
</script>


@if($livechat->status == 0)
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script type="text/javascript">
    (function($) {
    "use strict";

        window.fbAsyncInit = function() {
            FB.init({
            xfbml            : true,
            version          : 'v8.0'
            });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    })(jQuery);
</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
    attribution=setup_tool
    page_id="{{ $livechat->facebook_id }}"
    theme_color="{{ $livechat->facebook_color }}"
    logged_in_greeting="{{ $livechat->facebook_greeting_in }}"
    logged_out_greeting="{{ $livechat->facebook_greeting_out }}">
</div>
@endif
