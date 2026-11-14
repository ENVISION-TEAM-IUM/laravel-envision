<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-Content-Type-Options" content="nosniff">
  <meta name="referrer" content="strict-origin-when-cross-origin">
  <style id="antiClickjack">body { display: none !important; }</style>
  <script>
    /* Proteksi Anti-Clickjacking Frontend */
    if (self === top) {
      var antiClickjack = document.getElementById('antiClickjack');
      if (antiClickjack) antiClickjack.parentNode.removeChild(antiClickjack);
    } else {
      top.location = self.location;
    }
  </script>
  <script>
    (function() {
      try {
        if (localStorage.getItem('site_theme') === 'dark') {
          document.documentElement.classList.add('dark-mode');
          document.documentElement.style.backgroundColor = '#0E1613';
          document.documentElement.style.colorScheme = 'dark';
        }
      } catch (e) {}
    })();
  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Desa Wisata Karangkemiri')</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : time() }}">
  @stack('styles')
</head>
<body>
  <script>
    if (localStorage.getItem('site_theme') === 'dark') {
      document.body.classList.add('dark-mode');
    }
  </script>

  @php
    $currentNav = trim($__env->yieldContent('nav_active', ''));
    if (!$currentNav) {
      if (request()->is('/') || request()->is('index*')) {
        $currentNav = 'home';
      } elseif (request()->is('profil*')) {
        $currentNav = 'profil';
      } elseif (request()->is('destinasi*') || request()->is('detail-destinasi*')) {
        $currentNav = 'destinasi';
      } elseif (request()->is('paket*')) {
        $currentNav = 'paket';
      } elseif (request()->is('katalog*') || request()->is('umkm*')) {
        $currentNav = 'umkm';
      } elseif (request()->is('kontak*')) {
        $currentNav = 'kontak';
      }
    }

    $drawerNav = trim($__env->yieldContent('drawer_active', ''));
    if (!$drawerNav) {
      if (request()->is('detail-destinasi*')) {
        $drawerNav = 'detail-destinasi';
      } else {
        $drawerNav = $currentNav;
      }
    }
  @endphp

  <div class="app-shell"@hasSection('shell_id') id="@yield('shell_id')"@endif>
    <!-- Top Navbar Web -->
    <header class="top-navbar">
      <div class="navbar-inner">
        <div style="display: flex; align-items: center; gap: 14px;">
          <button class="menu-btn" id="menuBtn" aria-label="Buka Menu Navigasi">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <a href="{{ url('/') }}" class="brand-logo">
            <div class="brand-mark">
              <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri" class="brand-logo-img">
            </div>
            <div class="brand-text">
              Desa Wisata<br>Karangkemiri
            </div>
          </a>
        </div>

        <!-- Aksi Kontak Web (Mepet Kanan) -->
        <div class="navbar-actions-right">
          <a href="{{ url('/kontak.html') }}" class="btn-top-kontak {{ $currentNav === 'kontak' ? 'active' : '' }}">
            <span>Kontak</span>
          </a>
        </div>
      </div>
    </header>

    @yield('content')

    <!-- Footer Website Publik -->
    <footer class="site-footer">
      <div class="site-footer-inner">
        <div class="site-footer-grid">
          <!-- Kolom 1: Identitas Desa Wisata -->
          <div class="site-footer-brand">
            <a href="{{ url('/') }}" class="brand-logo" style="color: #FFFFFF;">
              <div class="brand-mark">
                <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri" class="brand-logo-img" style="background-color: #FFFFFF; border-radius: 50%; padding: 2px;">
              </div>
              <div class="brand-text" style="color: #FFFFFF; font-size: 16px;">
                Desa Wisata<br>Karangkemiri
              </div>
            </a>
            <p class="site-footer-desc">
              Wisata alam, edukasi, budaya, dan produk UMKM lokal dalam satu perjalanan di Kecamatan Karanglewas, Kabupaten Banyumas. Dikelola bersama oleh BUMDesa Mandiri Sejahtera dan masyarakat lokal.
            </p>
          </div>

          <!-- Kolom 2: Jelajahi Halaman -->
          <div class="site-footer-col">
            <div class="site-footer-heading">Jelajahi</div>
            <ul class="site-footer-links">
              <li><a href="{{ url('/') }}">Beranda</a></li>
              <li><a href="{{ url('/profil.html') }}">Profil Desa Wisata</a></li>
              <li><a href="{{ url('/destinasi.html') }}">Destinasi Wisata</a></li>
              <li><a href="{{ url('/paket-wisata.html') }}">Paket Wisata</a></li>
              <li><a href="{{ url('/katalog-umkm.html') }}">Katalog UMKM</a></li>
              <li><a href="{{ url('/kontak.html') }}">Kontak &amp; Lokasi</a></li>
            </ul>
          </div>

          <!-- Kolom 3: Destinasi Unggulan -->
          <div class="site-footer-col">
            <div class="site-footer-heading">Destinasi</div>
            <ul class="site-footer-links">
              <li><a href="{{ url('/detail-destinasi.html?slug=candi') }}">Wahana Edukasi &amp; Outbound Candi</a></li>
              <li><a href="{{ url('/detail-destinasi.html?slug=embung') }}">Embung Prabawulan</a></li>
              <li><a href="{{ url('/detail-destinasi.html?slug=kelengkeng') }}">Agro Kelengkeng Thabet</a></li>
              <li><a href="{{ url('/detail-destinasi.html?slug=petilasan') }}">Petilasan Mbah Siti Benter</a></li>
            </ul>
          </div>

          <!-- Kolom 4: Kontak & Lokasi -->
          <div class="site-footer-col">
            <div class="site-footer-heading">Kontak &amp; Pengelola</div>
            <ul class="site-footer-contact">
              <li>
                <span id="footerContactAddr">Karang Jengkol, Karangkemiri, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161</span>
              </li>
              <li>
                <a id="footerContactWa" href="https://wa.me/6285702573013?text=Halo%20BUMDesa%20Mandiri%20Sejahtera%20Desa%20Wisata%20Karangkemiri" target="_blank" rel="noopener">WhatsApp: 0857 0257 3013</a>
              </li>
              <li>
                <a id="footerContactEmail" href="mailto:mandirisejahtera.karangkemiri@gmail.com">mandirisejahtera.karangkemiri@gmail.com</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="site-footer-bottom">
          <div>&copy; {{ date('Y') }} Desa Wisata Karangkemiri &bull; Dikelola oleh BUMDesa Mandiri Sejahtera.</div>
          <div class="site-footer-bottom-links">
            <a href="{{ url('/kontak.html') }}">Bantuan &amp; Lokasi</a>
            <span>&bull;</span>
            <a href="{{ url('/admin-login.html') }}">CMS Admin</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  @yield('modal')

  <!-- Slide-out Left Sidebar Navigation (Modern Softtech-style Sidebar) -->
  <div class="drawer-backdrop" id="drawerBackdrop"></div>
  <aside class="nav-drawer" id="navDrawer" aria-label="Menu Samping">
    <!-- Top Header -->
    <div class="drawer-header">
      <a href="{{ url('/') }}" class="sidebar-brand">
        <div class="sidebar-logo-box">
          <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri">
        </div>
        <div class="sidebar-brand-info">
          <span class="sidebar-brand-title">Karangkemiri</span>
          <span class="sidebar-brand-sub">Desa Wisata</span>
        </div>
      </a>
      <button type="button" class="sidebar-collapse-btn" id="sidebarCollapseBtn" aria-label="Kecilkan / Perluas Menu" title="Kecilkan / Perluas Sidebar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
      </button>
    </div>

    <!-- Scrollable Menu Body -->
    <div class="sidebar-body">
      <div class="drawer-section-label">OVERVIEW</div>
      <ul class="drawer-links">
        <li>
          <a href="{{ url('/') }}" class="{{ $drawerNav === 'home' ? 'active' : '' }}" data-tooltip="Beranda">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
              </svg>
            </span>
            <span class="sidebar-text">Beranda</span>
            <span class="sidebar-tooltip">Beranda</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/profil.html') }}" class="{{ $drawerNav === 'profil' ? 'active' : '' }}" data-tooltip="Profil Desa Wisata">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18"></path>
                <path d="M5 21V7l8-4v18"></path>
                <path d="M19 21V11l-6-4"></path>
                <path d="M9 9v.01"></path>
                <path d="M9 12v.01"></path>
                <path d="M9 15v.01"></path>
              </svg>
            </span>
            <span class="sidebar-text">Profil Desa Wisata</span>
            <span class="sidebar-tooltip">Profil Desa Wisata</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/destinasi.html') }}" class="{{ $drawerNav === 'destinasi' ? 'active' : '' }}" data-tooltip="Destinasi Wisata">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </span>
            <span class="sidebar-text">Destinasi Wisata</span>
            <span class="sidebar-tooltip">Destinasi Wisata</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="{{ $drawerNav === 'detail-destinasi' ? 'active' : '' }}" data-tooltip="Detail Destinasi">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                <line x1="7" y1="8" x2="17" y2="8"></line>
                <line x1="7" y1="12" x2="13" y2="12"></line>
                <line x1="7" y1="16" x2="11" y2="16"></line>
              </svg>
            </span>
            <span class="sidebar-text">Detail Destinasi</span>
            <span class="sidebar-tooltip">Detail Destinasi</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/paket-wisata.html') }}" class="{{ $drawerNav === 'paket' ? 'active' : '' }}" data-tooltip="Paket Wisata">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </span>
            <span class="sidebar-text">Paket Wisata</span>
            <span class="sidebar-tooltip">Paket Wisata</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/katalog-umkm.html') }}" class="{{ $drawerNav === 'umkm' ? 'active' : '' }}" data-tooltip="Katalog UMKM">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <path d="M16 10a4 4 0 0 1-8 0"></path>
              </svg>
            </span>
            <span class="sidebar-text">Katalog UMKM</span>
            <span class="sidebar-tooltip">Katalog UMKM</span>
          </a>
        </li>
      </ul>

      <div class="sidebar-divider"></div>

      <div class="drawer-section-label">ACCOUNT</div>
      <ul class="drawer-links drawer-links-account">
        <li>
          <a href="{{ url('/admin-login.html') }}" data-tooltip="Login Admin CMS">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
            </span>
            <span class="sidebar-text">Login Admin CMS</span>
            <span class="sidebar-tooltip">Login Admin CMS</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/paket-wisata.html') }}" class="{{ ($drawerNav ?? '') === 'paket' ? 'active' : '' }}" data-tooltip="Jadwal &amp; Paket Wisata">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </span>
            <span class="sidebar-text">Jadwal &amp; Paket Wisata</span>
            <span class="sidebar-tooltip">Jadwal &amp; Paket Wisata</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/profil.html#penghargaan') }}" data-tooltip="Penghargaan LDWN 2023">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            </span>
            <span class="sidebar-text">Penghargaan LDWN 2023</span>
            <span class="sidebar-tooltip">Penghargaan LDWN 2023</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/kontak.html') }}" class="{{ ($drawerNav ?? '') === 'kontak' ? 'active' : '' }}" data-tooltip="Kontak &amp; Lokasi">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
              </svg>
            </span>
            <span class="sidebar-text">Kontak &amp; Lokasi</span>
            <span class="sidebar-tooltip">Kontak &amp; Lokasi</span>
          </a>
        </li>

        <li>
          <a href="https://wa.me/6285702573013?text=Halo%20BUMDesa%20Mandiri%20Sejahtera%20Desa%20Wisata%20Karangkemiri" target="_blank" rel="noopener noreferrer" data-tooltip="Chat WhatsApp">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
            </span>
            <span class="sidebar-text">Chat WhatsApp</span>
            <span class="sidebar-tooltip">Chat WhatsApp</span>
          </a>
        </li>
      </ul>

      <!-- Theme Switcher Row (Sun + Toggle + Moon) -->
      <div class="sidebar-theme-row">
        <span class="theme-icon sun-icon" aria-hidden="true">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
        </span>
        <button type="button" class="sidebar-theme-switch" id="sidebarThemeSwitch" aria-label="Ganti Tema Menu">
          <span class="switch-knob"></span>
        </button>
        <span class="theme-icon moon-icon" aria-hidden="true">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
        </span>
      </div>
    </div>

    <!-- Bottom Profile Card -->
    <div class="sidebar-footer" style="cursor: default;">
      <div class="sidebar-avatar">
        <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="BUMDesa Mandiri Sejahtera">
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name">BUMDesa Mandiri</span>
        <span class="sidebar-user-email">mandirisejahtera@gmail.com</span>
      </div>
    </div>
  </aside>

  <script src="{{ asset('js/app.js') }}?v={{ file_exists(public_path('js/app.js')) ? filemtime(public_path('js/app.js')) : time() }}"></script>
  @stack('scripts')
</body>
</html>
