<header class="main-header-premium" id="premiumHeader">
    <div class="nav-container">
        <!-- Logo -->
        <div class="logo-box">
            <a href="{{ route('home') }}">
                @if(isset($setting))
                <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
                @else
                <img src="https://cmsdutasolusi.co.id/uploads/setting/CMS logo web transparant_1752657853.png" alt="Logo" style="height: 45px; width: auto; object-fit: contain;">
                @endif
            </a>
        </div>

        <!-- Main Navigation -->
        <nav class="premium-nav">
            <a href="{{ url('/') }}" class="premium-nav-link">BERANDA</a>
            <a href="{{ url('/#team') }}" class="premium-nav-link">TIM</a>
            <a href="{{ route('about') }}" class="premium-nav-link">TENTANG KAMI</a>
            
            <!-- Layanan Mega Menu -->
            <div class="premium-nav-item has-mega-menu">
                <a href="{{ route('services') }}" class="premium-nav-link">LAYANAN <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                <div class="mega-menu-wrapper">
                    <div class="mega-menu-container">
                        <div class="mega-menu-row">
                            @php
                                $serviceChunks = $service_subnavs->chunk(ceil($service_subnavs->count() / 3));
                            @endphp
                            @foreach($serviceChunks as $chunk)
                            <div class="mega-menu-col">
                                <ul class="mega-menu-list">
                                    @foreach($chunk as $service_nav)
                                    <li><a href="{{ route('service.single', $service_nav->slug) }}">{{ $service_nav->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('portfolios') }}" class="premium-nav-link">PORTOFOLIO</a>

            <!-- Info Terkini Mega Menu -->
            <div class="premium-nav-item has-mega-menu">
                <a href="{{ route('blogs') }}" class="premium-nav-link">INFO TERKINI <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                <div class="mega-menu-wrapper">
                    <div class="mega-menu-container">
                        <div class="mega-menu-row">
                            @php
                                $footerSlugs = ['finance', 'hrga', 'berita-insight-cms'];
                                $mainCategories = $article_subnavs->whereNotIn('slug', $footerSlugs);
                                $footerCategories = $article_subnavs->whereIn('slug', $footerSlugs);
                                $articleChunks = $mainCategories->chunk(ceil($mainCategories->count() / 3));
                            @endphp
                            @foreach($articleChunks as $chunk)
                            <div class="mega-menu-col">
                                <ul class="mega-menu-list">
                                    @foreach($chunk as $article_nav)
                                    <li><a href="{{ route('blog.category', $article_nav->slug) }}">{{ $article_nav->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                        <!-- Bottom section of Mega Menu -->
                        @if($footerCategories->count() > 0)
                        <div class="mega-menu-footer">
                            <div class="mega-menu-row">
                                @foreach($footerCategories as $footer_nav)
                                <div class="mega-menu-col">
                                    <a href="{{ route('blog.category', $footer_nav->slug) }}" class="footer-link">{{ $footer_nav->title }}</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- E-Commerce Mega Menu -->
            <div class="premium-nav-item has-mega-menu">
                <a href="{{ route('ecommerce.index') }}" class="premium-nav-link">E-COMMERCE <i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></a>
                <div class="mega-menu-wrapper">
                    <div class="mega-menu-container">
                        <div class="mega-menu-row">
                            <div class="mega-menu-col">
                                <ul class="mega-menu-list">
                                    <li><a href="{{ route('ecommerce.index') }}">Daftar Produk</a></li>
                                    <li><a href="{{ route('ecommerce.cart') }}">Keranjang Belanja</a></li>
                                    <li><a href="{{ route('ecommerce.track') }}">Cek Status Pesanan</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('faqs') }}" class="premium-nav-link">FAQS</a>
            <a href="{{ route('contact') }}" class="premium-nav-link">KONTAK KAMI</a>
        </nav>

        <!-- Header CTA -->
        <div class="header-cta-wrapper">
            <a href="{{ route('get-quote') }}" class="header-cta-btn">
                Ajukan Penawaran <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Mobile Toggle -->
        <div class="mobile-nav-toggle-box">
            <button class="mobile-nav-toggle" id="openMobileMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
