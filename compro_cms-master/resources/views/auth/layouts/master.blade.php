<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.common.header_script')
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style type="text/css">
            body {
                font-family: 'Outfit', sans-serif;
                background-color: #f4f7f6;
                background-image: radial-gradient(#d1d5db 0.5px, transparent 0.5px);
                background-size: 20px 20px;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
            }
            .auth-container {
                width: 100%;
                max-width: 420px;
                padding: 20px;
            }
            .card {
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                background: #ffffff;
                overflow: hidden;
            }
            .card-header {
                background: transparent;
                border-bottom: none;
                padding-top: 40px;
                text-align: center;
            }
            .card-header h3 {
                font-weight: 700;
                color: #103652;
                margin-top: 15px;
                letter-spacing: -0.02em;
            }
            .btn-primary {
                background-color: #103652;
                border: none;
                border-radius: 8px;
                padding: 12px;
                font-weight: 600;
                transition: all 0.2s ease;
                color: white;
            }
            .btn-primary:hover {
                background-color: #0d2a40;
                transform: none;
                box-shadow: 0 4px 12px rgba(16, 54, 82, 0.2);
            }
            
            /* Unified Input Group Styling */
            .input-group {
                border: 1.5px solid #e5e7eb;
                border-radius: 8px;
                background-color: #f9fafb;
                transition: all 0.2s;
                overflow: hidden;
                display: flex;
                align-items: center;
            }
            .input-group:focus-within {
                background-color: #fff;
                box-shadow: 0 0 0 4px rgba(16, 54, 82, 0.1);
                border-color: #103652;
            }
            .input-group .input-group-prepend,
            .input-group .input-group-text {
                background-color: transparent !important;
                border: none !important;
                padding-right: 0;
                color: #6b7280;
            }
            .input-group .form-control {
                background-color: transparent !important;
                border: none !important;
                box-shadow: none !important;
                height: 45px;
                color: #333;
            }
            .input-group .form-control::placeholder {
                color: #9ca3af;
                opacity: 1;
            }
        </style>
    </head>

    <body>
        <div class="auth-container">
            @yield('content')
        </div>

        @include('admin.layouts.common.footer_script')
    </body>
</html>