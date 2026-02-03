@extends('auth.layouts.master')
@section('title', __('auth.login'))
@section('content')
<div class="card shadow-sm">
    <div class="card-header pb-0">
        @if(isset($setting))
            <div class="mb-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo" style="max-height: 60px;">
                </a>
            </div>
        @endif
        <h3 class="mb-1">{{ __('auth.login') }}</h3>
        <p class="text-muted small">{{ __('auth.login_title') }}</p>
    </div>

    <div class="card-body p-4 pt-2">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group mb-4">
                <label for="email" class="form-label font-weight-bold text-dark small">{{ strtoupper(__('auth.email')) }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@address.com">
                </div>

                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <div class="d-flex justify-content-between mb-1">
                    <label for="password" class="form-label font-weight-bold text-dark small">{{ strtoupper(__('auth.password')) }}</label>
                    @if (Route::has('password.request'))
                        <a class="small text-muted font-weight-bold" href="{{ route('password.request') }}">
                            {{ __('auth.forgot_password') }}
                        </a>
                    @endif
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                </div>

                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label text-muted small" for="remember">
                        {{ __('auth.remember') }}
                    </label>
                </div>
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold">
                    <i class="mdi mdi-login-variant mr-1"></i> {{ __('auth.login') }}
                </button>
            </div>
        </form>
    </div>

    @if (Route::has('register'))
    <div class="card-footer bg-light border-0 text-center py-3">
        <span class="text-muted small">{{ __("auth.dont_have_account") }}</span>
        <a href="{{ route('register') }}" class="font-weight-bold ml-1" style="color: #103652;">{{ __('auth.register') }}</a>
    </div>
    @endif
</div>
@endsection
