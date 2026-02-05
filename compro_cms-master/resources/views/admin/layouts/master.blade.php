<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.common.header_script')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #6366f1;
                --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
                --success: #10b981;
                --success-soft: #dcfce7;
                --danger: #f43f5e;
                --danger-soft: #fee2e2;
                --warning: #f59e0b;
                --warning-soft: #fef3c7;
                --info: #0ea5e9;
                --info-soft: #e0f2fe;
                --dark: #0f172a;
                --slate-50: #f8fafc;
                --slate-100: #f1f5f9;
                --slate-200: #e2e8f0;
                --slate-400: #94a3b8;
                --slate-600: #475569;
                --slate-800: #1e293b;
                --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            }

            body { 
                font-family: 'Inter', sans-serif !important; 
                background-color: var(--slate-50) !important;
                color: var(--slate-800);
                letter-spacing: -0.015em;
            }

            /* Premium Layout */
            .left-side-menu { background: var(--dark) !important; box-shadow: 10px 0 30px rgba(0,0,0,0.05); }
            .navbar-custom { background: white !important; box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important; padding: 0 20px; border-bottom: 1px solid var(--slate-100) !important; }
            .content-page { padding: 30px 25px !important; }
            
            /* Sidebar Typography */
            #sidebar-menu .menu-title { 
                color: var(--slate-400) !important; 
                text-transform: uppercase !important; 
                font-size: 0.65rem !important; 
                font-weight: 800 !important; 
                letter-spacing: 0.1em !important; 
                padding: 15px 25px 5px !important;
                opacity: 0.6;
            }
            #sidebar-menu > ul > li > a { 
                border-radius: 12px; 
                margin: 4px 18px; 
                padding: 12px 18px; 
                color: #cbd5e1 !important;
                font-weight: 500;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #sidebar-menu > ul > li > a:hover { background: rgba(255,255,255,0.08); color: white !important; }
            #sidebar-menu > ul > li > a.active { background: var(--primary) !important; color: white !important; box-shadow: 0 8px 16px rgba(99, 102, 241, 0.4); }
            #sidebar-menu > ul > li > a i { font-size: 1.1rem; margin-right: 12px; opacity: 0.8; }

            /* Modern Breadcrumb */
            .breadcrumb-item a { color: var(--slate-400); font-weight: 600; }
            .breadcrumb-item.active { color: var(--dark); font-weight: 800; }

            /* Floating Luxury Tables */
            .table-responsive { overflow-x: auto !important; -webkit-overflow-scrolling: touch; }
            .table { 
                border-collapse: separate !important; 
                border-spacing: 0 12px !important; 
                width: 100% !important; 
                min-width: 1000px; /* Ensure table doesn't get too squeezed */
                margin-top: -12px !important;
                background: transparent !important;
            }
            .table thead th { 
                background: transparent !important; 
                color: var(--slate-600) !important; 
                font-weight: 700 !important; 
                text-transform: uppercase !important; 
                font-size: 0.75rem !important; 
                letter-spacing: 0.05em !important; 
                padding: 10px 20px !important; 
                border: none !important;
            }
            .table tbody tr { background: white !important; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); transition: transform 0.2s ease, box-shadow 0.2s ease; cursor: default; }
            .table tbody tr:hover { transform: translateY(-2px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.06) !important; }
            .table tbody td { 
                padding: 15px 20px !important; 
                border: none !important;
                vertical-align: middle !important;
                color: var(--slate-800);
            }
            .table tbody td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
            .table tbody td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
            
            /* Table Thumbnails */
            .table img { width: 60px !important; height: 40px !important; object-fit: cover !important; border-radius: 8px !important; box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important; }

            /* Luxury Buttons */
            .btn { border-radius: 10px !important; font-weight: 700 !important; transition: all 0.3s ease !important; }
            .btn-primary { background: var(--primary-gradient) !important; border: none !important; color: white !important; box-shadow: 0 8px 15px rgba(99, 102, 241, 0.25) !important; }
            .btn-info { background: white !important; border: 1px solid var(--slate-200) !important; color: var(--primary) !important; }
            .btn-info:hover { background: var(--slate-50) !important; border-color: var(--primary) !important; }

            /* Action Buttons in Grid */
            .btn-group .btn { 
                width: 38px !important; 
                height: 38px !important; 
                padding: 0 !important; 
                display: inline-flex !important; 
                align-items: center !important; 
                justify-content: center !important; 
                margin: 0 3px !important;
                box-shadow: 0 4px 6px rgba(0,0,0,0.08) !important;
                border: none !important;
            }
            .btn-success { background: var(--success) !important; color: white !important; }
            .btn-success:hover { filter: brightness(0.9); }
            .btn-danger { background: var(--danger) !important; color: white !important; }
            .btn-danger:hover { filter: brightness(0.9); }
            .btn-primary-solid { background: var(--primary) !important; color: white !important; } /* Custom for edit button if needed */

            /* Luxury Status Badges */
            .badge { padding: 8px 16px !important; border-radius: 30px !important; font-weight: 700 !important; letter-spacing: 0.02em !important; font-size: 0.72rem !important; }
            .badge-success { background: var(--success-soft) !important; color: var(--success) !important; }
            .badge-danger { background: var(--danger-soft) !important; color: var(--danger) !important; }
            .badge-info { background: var(--info-soft) !important; color: var(--info) !important; }
            .badge-warning { background: var(--warning-soft) !important; color: var(--warning) !important; }
            .badge-primary { background: #e0e7ff !important; color: var(--primary) !important; }

            /* DataTables Polish */
            .dataTables_wrapper .dataTables_filter input { 
                border: 1px solid var(--slate-200) !important; 
                border-radius: 50px !important; 
                padding: 10px 20px !important; 
                background: white !important; 
            }
            .dataTables_wrapper .dataTables_length select {
                border: 1px solid var(--slate-200) !important;
                border-radius: 8px !important;
                padding: 8px 12px !important;
                background: white !important;
            }
            
            /* Pagination Styling */
            .pagination { 
                display: flex !important; 
                align-items: center !important; 
                gap: 4px !important;
                margin-top: 20px !important;
            }
            .pagination .page-item { margin: 0 !important; }
            .pagination .page-link { 
                border: 1px solid var(--slate-200) !important; 
                border-radius: 8px !important; 
                padding: 8px 12px !important;
                min-width: 40px !important;
                height: 40px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                color: var(--slate-600) !important; 
                font-weight: 600 !important;
                background: white !important;
                transition: all 0.2s ease !important;
            }
            .pagination .page-link:hover { 
                background: var(--slate-50) !important; 
                border-color: var(--primary) !important;
                color: var(--primary) !important;
            }
            .pagination .page-item.active .page-link { 
                background: var(--primary-gradient) !important; 
                border: none !important; 
                color: white !important; 
                box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3) !important; 
            }
            .pagination .page-item.disabled .page-link {
                background: var(--slate-50) !important;
                color: var(--slate-400) !important;
                border-color: var(--slate-200) !important;
                cursor: not-allowed !important;
                opacity: 0.6 !important;
            }
            /* Previous/Next buttons */
            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                border-radius: 8px !important;
                font-weight: 700 !important;
            }
            
            /* Card Consistency */
            .card { border: 1px solid var(--slate-200) !important; border-radius: 20px !important; box-shadow: var(--card-shadow) !important; overflow: hidden; }
            .card-header { padding: 1.5rem 2rem !important; background: white !important; border-bottom: 1px solid var(--slate-100) !important; }
            .header-title { font-size: 1.15rem !important; font-weight: 800 !important; color: var(--dark) !important; }

            /* Modal Stability & Anti-Flicker */
            body.modal-open { 
                padding-right: 0px !important; 
                overflow: hidden !important;
            }
            /* Matikan efek hover tabel saat modal terbuka untuk menghentikan getaran */
            body.modal-open .table tbody tr:hover { 
                transform: none !important; 
                box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important; 
            }
            .modal-backdrop {
                backdrop-filter: blur(4px) !important;
                -webkit-backdrop-filter: blur(4px) !important;
                background-color: rgba(15, 23, 42, 0.5) !important;
            }

            /* Premium Profile Dropdown */
            .profile-dropdown { 
                border: none !important; 
                border-radius: 20px !important; 
                box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; 
                padding: 10px !important;
                min-width: 200px !important;
                margin-top: 15px !important;
            }
            .profile-dropdown .dropdown-header { 
                padding: 15px 20px !important; 
                background: var(--slate-50) !important; 
                border-radius: 12px !important; 
                margin-bottom: 8px !important; 
            }
            .profile-dropdown .dropdown-header h6 { 
                color: var(--slate-400) !important; 
                font-size: 0.75rem !important; 
                text-transform: uppercase; 
                letter-spacing: 0.05em; 
                font-weight: 700; 
                margin-bottom: 4px !important;
            }
            .profile-dropdown .pro-user-name { 
                color: var(--dark) !important; 
                font-size: 0.95rem !important; 
                font-weight: 800 !important; 
                display: block !important;
            }
            .profile-dropdown .dropdown-item { 
                padding: 12px 18px !important; 
                border-radius: 10px !important; 
                font-weight: 600 !important; 
                color: var(--slate-600) !important; 
                transition: all 0.2s ease;
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
            }
            .profile-dropdown .dropdown-item:hover { 
                background: var(--slate-100) !important; 
                color: var(--primary) !important; 
                transform: translateX(5px);
            }
            .profile-dropdown .dropdown-item i { font-size: 1.1rem; opacity: 0.7; }
            .profile-dropdown .dropdown-divider { margin: 8px 0 !important; opacity: 0.5; }

            /* Premium Header/Navbar Styling */
            .navbar-custom { 
                background: rgba(255, 255, 255, 0.8) !important; 
                backdrop-filter: blur(12px) !important; 
                -webkit-backdrop-filter: blur(12px) !important; 
                border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important; 
                box-shadow: 0 4px 15px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -1px rgba(0, 0, 0, 0.02) !important;
                padding: 0 30px !important;
                height: 75px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                position: sticky !important;
                top: 0 !important;
                z-index: 100 !important;
                margin-bottom: 0px !important;
            }
            .content-page { margin-top: -75px !important; padding-top: 75px !important; }
            .button-menu-mobile { display: none !important; }
            
            .nav-user { 
                height: 45px !important; 
                padding: 0 15px !important; 
                border-radius: 14px !important; 
                background: var(--slate-50) !important;
                display: flex !important;
                align-items: center !important;
                border: 1px solid var(--slate-100) !important;
                transition: all 0.2s ease !important;
            }
            .nav-user:hover { background: white !important; box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important; border-color: var(--primary-soft) !important; }
            .nav-user img { 
                margin: 0 !important; 
                width: 32px !important; 
                height: 32px !important; 
                box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
            }
            
            /* Breadcrumb Polish */
            .page-title-box { padding: 30px 0 !important; }
            .breadcrumb-item a { color: var(--slate-400) !important; font-weight: 600; }
            .breadcrumb-item.active { color: var(--primary) !important; font-weight: 700; }

            /* Premium Modal Styling */
            .modal-content { border: none !important; border-radius: 24px !important; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3) !important; overflow: hidden; border: 1px solid rgba(255,255,255,0.1) !important; }
            .modal-backdrop.show { opacity: 0.5 !important; backdrop-filter: blur(4px) !important; -webkit-backdrop-filter: blur(4px) !important; background-color: rgba(15, 23, 42, 0.7) !important; }
            .modal-header { border-bottom: 1px solid var(--slate-100) !important; padding: 20px 30px !important; }
            .modal-body { padding: 40px 30px !important; }
            .modal-footer { border-top: 1px solid var(--slate-100) !important; padding: 15px 30px 25px !important; display: flex !important; gap: 12px !important; justify-content: center !important; }
            .modal-footer .btn { margin: 0 !important; padding: 10px 25px !important; min-width: 120px !important; }
            
            .modal-icon-container { 
                width: 80px; 
                height: 80px; 
                background: var(--danger-soft); 
                color: var(--danger); 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                font-size: 2.5rem; 
                margin: 0 auto 25px;
                animation: pulse-danger 2s infinite;
            }

            @keyframes pulse-danger {
                0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 63, 94, 0.4); }
                70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(244, 63, 94, 0); }
                100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
            }

            .btn-light-premium { 
                background: var(--slate-100) !important; 
                color: var(--slate-600) !important; 
                border: none !important;
            }
            .btn-light-premium:hover { background: var(--slate-200) !important; color: var(--dark) !important; }
        </style>
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu left-side-menu-dark">

                <div class="slimscroll-menu">

                    @if(isset($setting))
                    <!-- LOGO -->
                    <a href="{{ route('admin.dashboard.index') }}" class="logo text-center mb-4">
                        <span class="logo-lg">
                            <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="logo" height="40">
                        </span>
                        <span class="logo-sm">
                            <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="logo" height="40">
                        </span>
                    </a>
                    @endif

                    @if(Request::is('admin*'))
                    <!--- Sidemenu -->
                    @include('admin.inc.sidebar')
                    <!-- End Sidebar -->
                    @endif

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <div class="navbar-left d-flex align-items-center">
                            <!-- Menu Toggle Removed as requested -->
                        </div>

                        <ul class="list-unstyled topbar-right-menu mb-0 d-flex align-items-center">
                            <li class="d-none d-sm-block">
                                <a href="{{ route('home') }}" target="_blank" class="btn btn-link text-dark font-weight-700 mr-2" style="text-decoration: none;">
                                    <i class="fe-external-link mr-1"></i> {{ __('dashboard.home') }}
                                </a>
                            </li>

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                    </li>
                                @endif
                            @else

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ asset('/dashboard/images/users/user.png') }}" alt="user-image" class="rounded-circle mr-2">
                                    <span class="pro-user-name d-none d-md-inline-block text-dark font-weight-700">
                                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down ml-1"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title text-left">
                                        <h6>{{ __('dashboard.welcome') }}</h6>
                                        <span class="pro-user-name">
                                            {{ Auth::user()->name }}
                                        </span>
                                    </div>

                                    <!-- item-->
                                    <a href="{{ route('admin.setting.index') }}" class="dropdown-item">
                                        <i class="fe-settings"></i>
                                        <span>{{ trans_choice('dashboard.setting', 2) }}</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fe-log-out text-danger"></i>
                                        <span class="text-danger">{{ __('dashboard.logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                    <!-- end Topbar -->


                    <!-- Start Content-->
                    @yield('content')
                    <!-- End Content-->
                    


                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                @if(isset($setting))
                                {{ __('dashboard.admin') }} &copy; - {!! strip_tags($setting->footer_text, '<p><a><b><i><u><strong>') !!}
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="{{ route('home') }}">{{ __('dashboard.home') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        @include('admin.layouts.common.footer_script')
    </body>
</html>