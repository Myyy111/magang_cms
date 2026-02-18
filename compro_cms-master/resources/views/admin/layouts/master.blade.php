<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.common.header_script')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #475569;
                --primary-soft: #f1f5f9;
                --accent: #3b82f6;
                --success: #059669;
                --success-soft: #ecfdf5;
                --danger: #dc2626;
                --danger-soft: #fef2f2;
                --warning: #d97706;
                --warning-soft: #fffbeb;
                --info: #0284c7;
                --info-soft: #f0f9ff;
                --dark: #1e293b;
                --slate-50: #f8fafc;
                --slate-100: #f1f5f9;
                --slate-200: #e2e8f0;
                --slate-300: #cbd5e1;
                --slate-400: #94a3b8;
                --slate-600: #475569;
                --slate-800: #1e293b;
                --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            }

            body { 
                font-family: 'Inter', sans-serif !important; 
                background-color: #fcfcfd !important;
                color: #334155;
                letter-spacing: -0.01em;
            }

            /* Minimal Layout */
            .left-side-menu { background: #ffffff !important; border-right: 1px solid var(--slate-200) !important; box-shadow: none !important; }
            .navbar-custom { background: white !important; box-shadow: none !important; padding: 0 20px; border-bottom: 1px solid var(--slate-200) !important; }
            .content-page { padding: 30px 25px !important; }
            
            /* Sidebar Minimalism */
            #sidebar-menu .menu-title { 
                color: var(--slate-400) !important; 
                text-transform: uppercase !important; 
                font-size: 0.7rem !important; 
                font-weight: 700 !important; 
                letter-spacing: 0.05em !important; 
                padding: 20px 25px 10px !important;
            }
            #sidebar-menu > ul > li > a { 
                border-radius: 8px; 
                margin: 2px 15px; 
                padding: 10px 15px; 
                color: var(--slate-600) !important;
                font-weight: 500;
                transition: all 0.15s ease;
            }
            #sidebar-menu > ul > li > a:hover { background: var(--slate-100); color: var(--dark) !important; }
            #sidebar-menu > ul > li > a.active { background: var(--slate-800) !important; color: white !important; box-shadow: none !important; }
            #sidebar-menu > ul > li > a i { font-size: 1.1rem; margin-right: 12px; opacity: 0.7; }
            
            /* Submenu minimalism */
            #sidebar-menu .nav-second-level li a { color: var(--slate-600) !important; padding: 8px 15px 8px 45px !important; }
            #sidebar-menu .nav-second-level li a:hover { color: var(--dark) !important; }
            #sidebar-menu .nav-second-level li a.active { color: var(--accent) !important; font-weight: 600 !important; background: var(--slate-50) !important; }


            /* Modern Breadcrumb */
            .breadcrumb-item a { color: var(--slate-400); font-weight: 500; }
            .breadcrumb-item.active { color: var(--slate-600); font-weight: 600; }

            /* Simple & Clean Tables */
            .table { 
                width: 100% !important; 
                margin-bottom: 1rem !important;
                background-color: transparent !important;
                border-collapse: collapse !important;
            }
            .table thead th { 
                background: var(--slate-50) !important; 
                color: var(--slate-600) !important; 
                font-weight: 600 !important; 
                text-transform: none !important; 
                font-size: 0.8rem !important; 
                padding: 12px 15px !important; 
                border-bottom: 1px solid var(--slate-200) !important;
                border-top: none !important;
            }
            .table tbody tr { background: white !important; transition: background 0.1s ease; }
            .table tbody tr:hover { background: var(--slate-50) !important; transform: none !important; box-shadow: none !important; }
            .table tbody td { 
                padding: 12px 15px !important; 
                border-top: none !important;
                border-bottom: 1px solid var(--slate-100) !important;
                vertical-align: middle !important;
                color: var(--slate-700);
                font-size: 0.85rem;
            }
            
            /* Minimal Buttons */
            .btn { border-radius: 6px !important; font-weight: 600 !important; font-size: 0.85rem !important; padding: 8px 16px !important; transition: all 0.2s ease !important; border: 1px solid transparent !important; }
            .btn-primary { background: var(--slate-800) !important; border-color: var(--slate-800) !important; color: white !important; box-shadow: none !important; }
            .btn-primary:hover { background: var(--dark) !important; opacity: 0.9; }
            
            
            .btn-info { background: #17a2b8 !important; border-color: #17a2b8 !important; color: white !important; }
            .btn-info:hover { background: #138496 !important; border-color: #117a8b !important; }

            /* Grid Action Buttons - Consistent sizing for all */
            .btn-group .btn,
            table .btn-group .btn,
            .table .btn-group .btn,
            #basic-datatable .btn-group .btn { 
                width: 36px !important; 
                height: 36px !important; 
                padding: 0 !important; 
                display: inline-flex !important; 
                align-items: center !important; 
                justify-content: center !important; 
                margin: 0 3px !important;
                box-shadow: none !important;
                border: 1px solid transparent !important;
                transition: all 0.2s ease !important;
                font-size: 14px !important;
                border-radius: 6px !important;
            }
            
            /* Success Button (View) - Green */
            .btn-group .btn-success,
            table .btn-group .btn-success,
            .table .btn-group .btn-success,
            #basic-datatable .btn-group .btn-success { 
                background: #28a745 !important; 
                border-color: #28a745 !important; 
                color: white !important; 
            }
            .btn-group .btn-success:hover,
            table .btn-group .btn-success:hover,
            .table .btn-group .btn-success:hover,
            #basic-datatable .btn-group .btn-success:hover { 
                background: #218838 !important; 
                border-color: #1e7e34 !important; 
                transform: translateY(-1px);
            }
            
            /* Info Button (Edit) - Cyan */
            .btn-group .btn-info,
            table .btn-group .btn-info,
            .table .btn-group .btn-info,
            #basic-datatable .btn-group .btn-info { 
                background: #17a2b8 !important; 
                border-color: #17a2b8 !important; 
                color: white !important; 
            }
            .btn-group .btn-info:hover,
            table .btn-group .btn-info:hover,
            .table .btn-group .btn-info:hover,
            #basic-datatable .btn-group .btn-info:hover { 
                background: #138496 !important; 
                border-color: #117a8b !important; 
                transform: translateY(-1px);
            }
            
            /* Danger Button (Delete) - Red */
            .btn-group .btn-danger,
            table .btn-group .btn-danger,
            .table .btn-group .btn-danger,
            #basic-datatable .btn-group .btn-danger { 
                background: #dc3545 !important; 
                border-color: #dc3545 !important; 
                color: white !important; 
            }
            .btn-group .btn-danger:hover,
            table .btn-group .btn-danger:hover,
            .table .btn-group .btn-danger:hover,
            #basic-datatable .btn-group .btn-danger:hover { 
                background: #c82333 !important; 
                border-color: #bd2130 !important; 
                transform: translateY(-1px);
            }

            /* Minimal Status Badges & Labels */
            .badge, .status-badge { 
                padding: 5px 12px !important; 
                border-radius: 6px !important; 
                font-weight: 600 !important; 
                font-size: 0.72rem !important; 
                display: inline-flex !important;
                align-items: center;
                white-space: nowrap !important;
                border: 1px solid transparent !important;
                line-height: 1.2;
            }
            .badge-success { background: var(--success-soft) !important; color: var(--success) !important; }
            .badge-danger { background: var(--danger-soft) !important; color: var(--danger) !important; }
            .badge-info { background: var(--info-soft) !important; color: var(--info) !important; }
            .badge-warning { background: var(--warning-soft) !important; color: var(--warning) !important; }
            .badge-primary { background: var(--primary-soft) !important; color: var(--slate-700) !important; }
            .badge-secondary { background: var(--slate-100) !important; color: var(--slate-600) !important; }

            /* Specific Soft Status Classes (Consistent across app) */
            .status-completed { background-color: #ecfdf5 !important; color: #065f46 !important; }
            .status-completed i { color: #10b981 !important; } /* Vibrant Green Icon */

            .status-processing { background-color: #eff6ff !important; color: #1e40af !important; }
            .status-processing i { color: #3b82f6 !important; } /* Vibrant Blue Icon */

            .status-paid { background-color: #f5f3ff !important; color: #5b21b6 !important; }
            .status-paid i { color: #8b5cf6 !important; } /* Vibrant Purple Icon */

            .status-pending { background-color: #fffbeb !important; color: #92400e !important; }
            .status-pending i { color: #f59e0b !important; } /* Vibrant Amber Icon */

            .status-failed { background-color: #fef2f2 !important; color: #991b1b !important; }
            .status-failed i { color: #ef4444 !important; } /* Vibrant Red Icon */

            .status-missing { background-color: #f8fafc !important; color: #64748b !important; border: 1px solid #e2e8f0 !important; }
            .status-missing i { color: #94a3b8 !important; }

            .status-neutral { background-color: #f1f5f9 !important; color: #475569 !important; }
            .status-neutral i { color: #64748b !important; }

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
                background: var(--dark) !important; 
                border-color: var(--dark) !important; 
                color: white !important; 
                box-shadow: none !important; 
            }
            .pagination .page-item.disabled .page-link {
                background: #ffffff !important;
                color: var(--slate-300) !important;
                border-color: var(--slate-100) !important;
                cursor: not-allowed !important;
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