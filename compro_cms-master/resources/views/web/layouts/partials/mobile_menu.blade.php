<!-- Mobile Menu Backdrop -->
<div id="mobileMenuBackdrop" style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999998; display: none; opacity: 0; transition: opacity 0.4s ease;"></div>

<!-- Fullscreen Mobile Menu Sidebar -->
<div id="premiumMobileMenu" class="premium-mobile-menu">
    <div class="mobile-menu-header">
        <div class="mobile-menu-logo">
            @if(isset($setting))
            <img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="Logo">
            @else
            <img src="https://cmsdutasolusi.co.id/uploads/setting/CMS logo web transparant_1752657853.png" alt="Logo">
            @endif
        </div>
        <button id="closePremiumMenu" class="close-menu-btn">&times;</button>
    </div>
    
    <div class="mobile-nav-container">
        <div class="mobile-nav-group">
            <a href="{{ url('/') }}" class="mobile-nav-item">BERANDA</a>
            <a href="{{ url('/#team') }}" class="mobile-nav-item">TIM</a>
            <a href="{{ route('about') }}" class="mobile-nav-item">TENTANG KAMI</a>
            
            <div class="mobile-has-sub">
                <div class="mobile-nav-item" onclick="toggleSubmenu('submenu-services-premium', this)">
                    <span>LAYANAN</span>
                    <button class="mobile-submenu-btn">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="submenu-services-premium" class="mobile-submenu-list">
                        @foreach($service_subnavs as $service_nav)
                        <a href="{{ route('service.single', $service_nav->slug) }}" class="mobile-submenu-link">{{ $service_nav->title }}</a>
                        @endforeach
                </div>
            </div>

            <a href="{{ route('portfolios') }}" class="mobile-nav-item">PORTOFOLIO</a>
            
            <div class="mobile-has-sub">
                <div class="mobile-nav-item" onclick="toggleSubmenu('submenu-blogs-premium', this)">
                    <span>INFO TERKINI</span>
                    <button class="mobile-submenu-btn">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="submenu-blogs-premium" class="mobile-submenu-list">
                        @foreach($article_subnavs as $article_nav)
                        <a href="{{ route('blog.category', $article_nav->slug) }}" class="mobile-submenu-link">{{ $article_nav->title }}</a>
                        @endforeach
                </div>
            </div>

            <div class="mobile-has-sub">
                <div class="mobile-nav-item" onclick="toggleSubmenu('submenu-ecommerce-premium', this)">
                    <span>E-COMMERCE</span>
                    <button class="mobile-submenu-btn">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="submenu-ecommerce-premium" class="mobile-submenu-list">
                        <a href="{{ route('ecommerce.index') }}" class="mobile-submenu-link">Daftar Produk</a>
                        <a href="{{ route('ecommerce.cart') }}" class="mobile-submenu-link">Keranjang Belanja</a>
                        <a href="{{ route('ecommerce.track') }}" class="mobile-submenu-link">Cek Status Pesanan</a>
                </div>
            </div>

            <a href="{{ route('faqs') }}" class="mobile-nav-item">FAQS</a>
            <a href="{{ route('contact') }}" class="mobile-nav-item">KONTAK KAMI</a>
        </div>
    </div>

    <div class="mobile-menu-footer">
        <a href="{{ route('get-quote') }}" class="header-cta-btn" style="width: 100% !important; justify-content: center !important;">
            Ajukan Penawaran <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('premiumHeader');
        const openBtn = document.getElementById('openMobileMenu');
        const closeBtn = document.getElementById('closePremiumMenu');
        const overlay = document.getElementById('premiumMobileMenu');
        const backdrop = document.getElementById('mobileMenuBackdrop');
        const mobileLinks = document.querySelectorAll('.mobile-nav-group a');

        // Scroll Logic
        function handleScroll() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check

        // Mobile Menu Logic
        if(openBtn) {
            openBtn.addEventListener('click', () => {
                overlay.style.transform = 'translateX(0)';
                backdrop.style.display = 'block';
                setTimeout(() => {
                    backdrop.style.opacity = '1';
                }, 10);
                document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
            });
        }

        function closeMenu() {
            overlay.style.transform = 'translateX(100%)';
            backdrop.style.opacity = '0';
            setTimeout(() => {
                backdrop.style.display = 'none';
            }, 400);
            document.body.style.overflow = ''; // Restore scrolling
        }

        if(closeBtn) closeBtn.addEventListener('click', closeMenu);
        if(backdrop) backdrop.addEventListener('click', closeMenu);
        mobileLinks.forEach(link => link.addEventListener('click', closeMenu));
        
        // Scroll to Top Logic
        const scrollBtn = document.querySelector('.scroll-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                if(scrollBtn) scrollBtn.style.display = 'flex';
            } else {
                if(scrollBtn) scrollBtn.style.display = 'none';
            }
        });

        if(scrollBtn) {
            scrollBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });

    // Mobile Submenu Toggle
    function toggleSubmenu(id, parent) {
        const submenu = document.getElementById(id);
        const isHidden = window.getComputedStyle(submenu).display === 'none';
        
        if (isHidden) {
            submenu.style.display = 'flex';
            parent.classList.add('active');
        } else {
            submenu.style.display = 'none';
            parent.classList.remove('active');
        }
    }
</script>
