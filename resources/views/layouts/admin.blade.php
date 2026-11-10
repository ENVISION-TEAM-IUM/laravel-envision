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
  <script>
    function previewImageUpload(input, previewId, nameDisplayId) {
      if (!input || !input.files || !input.files[0]) return;
      var file = input.files[0];
      if (nameDisplayId) {
        var nameEl = document.getElementById(nameDisplayId);
        if (nameEl) {
          var sizeMB = (file.size / (1024 * 1024)).toFixed(2);
          nameEl.textContent = 'Foto dipilih: ' + file.name + ' (' + sizeMB + ' MB)';
          nameEl.style.display = 'block';
        }
      }
      var target = document.getElementById(previewId);
      if (!target) return;
      if (window.FileReader) {
        var reader = new FileReader();
        reader.onload = function(e) {
          if (target.tagName === 'IMG') {
            target.src = e.target.result;
          } else {
            target.style.backgroundImage = 'url(' + e.target.result + ')';
          }
        };
        reader.readAsDataURL(file);
      } else if (window.URL && typeof window.URL.createObjectURL === 'function') {
        try {
          var url = window.URL.createObjectURL(file);
          if (target.tagName === 'IMG') {
            target.src = url;
          } else {
            target.style.backgroundImage = 'url(' + url + ')';
          }
        } catch (err) {}
      }
    }
  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin CMS - Desa Wisata Karangkemiri')</title>
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
    $adminNav = trim($__env->yieldContent('admin_nav', ''));
    if (!$adminNav) {
      if (request()->is('admin/dashboard*') || request()->is('admin-dashboard*')) {
        $adminNav = 'dashboard';
      } elseif (request()->is('admin/destinasi*') || request()->is('admin-destinasi*') || request()->is('admin/edit-destinasi*') || request()->is('admin-edit-destinasi*')) {
        $adminNav = 'destinasi';
      } elseif (request()->is('admin/paket*') || request()->is('admin-paket*')) {
        $adminNav = 'paket';
      } elseif (request()->is('admin/umkm*') || request()->is('admin-umkm*')) {
        $adminNav = 'umkm';
      } elseif (request()->is('admin/pratinjau*') || request()->is('admin-pratinjau*')) {
        $adminNav = 'pratinjau';
      } elseif (request()->is('admin/beranda*') || request()->is('admin-beranda*')) {
        $adminNav = 'beranda';
      } elseif (request()->is('admin/profil*') || request()->is('admin-profil*')) {
        $adminNav = 'profil';
      } elseif (request()->is('admin/kontak*') || request()->is('admin-kontak*')) {
        $adminNav = 'kontak';
      }
    }

    $drawerActive = trim($__env->yieldContent('drawer_active', $adminNav));
  @endphp

  <div class="app-shell">
    <!-- Top Navbar Web -->
    <header class="top-navbar">
      <div class="navbar-inner">
        <div style="display: flex; align-items: center; gap: 14px;">
          <button class="menu-btn" id="menuBtn" aria-label="Buka Menu Admin">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <a href="{{ url('/admin-dashboard.html') }}" class="brand-logo">
            <div class="brand-mark">
              <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri" class="brand-logo-img">
            </div>
            <div class="brand-text">
              Desa Wisata<br>Karangkemiri
            </div>
          </a>
        </div>

        <div style="display: flex; align-items: center; gap: 14px;">
          <span class="admin-role-label">PENGELOLA KONTEN</span>
        </div>
      </div>
    </header>

    @yield('content')

    <!-- Footer Panel CMS Admin -->
    <footer class="site-footer admin-footer">
      <div class="site-footer-inner">
        <div class="site-footer-bottom" style="border-top: none; padding-top: 0; margin-top: 0;">
          <div>&copy; {{ date('Y') }} CMS Admin Desa Wisata Karangkemiri &bull; BUMDesa Mandiri Sejahtera</div>
          <div class="site-footer-bottom-links">
            <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer">Website Publik</a>
            <span>&bull;</span>
            <a href="{{ url('/admin-profil.html') }}">Profil Desa</a>
            <span>&bull;</span>
            <a href="{{ url('/admin-pratinjau.html') }}">Pratinjau</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  @yield('modal')

  <!-- Slide-out Left Sidebar Navigation Admin -->
  <div class="drawer-backdrop" id="drawerBackdrop"></div>
  <aside class="nav-drawer" id="navDrawer" aria-label="Menu Samping Admin">
    <!-- Top Header -->
    <div class="drawer-header">
      <a href="{{ url('/admin-dashboard.html') }}" class="sidebar-brand">
        <div class="sidebar-logo-box">
          <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Logo Desa Wisata Karangkemiri">
        </div>
        <div class="sidebar-brand-info">
          <span class="sidebar-brand-title">CMS Admin</span>
          <span class="sidebar-brand-sub">Karangkemiri</span>
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
          <a href="{{ url('/admin-dashboard.html') }}" class="{{ $drawerActive === 'dashboard' ? 'active' : '' }}" data-tooltip="Dashboard">
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
            <span class="sidebar-text">Dashboard</span>
            <span class="sidebar-tooltip">Dashboard</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-beranda.html') }}" class="{{ $drawerActive === 'beranda' ? 'active' : '' }}" data-tooltip="Edit Beranda">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
            </span>
            <span class="sidebar-text">Edit Beranda</span>
            <span class="sidebar-tooltip">Edit Beranda</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-profil.html') }}" class="{{ $drawerActive === 'profil' ? 'active' : '' }}" data-tooltip="Edit Profil Desa">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18"></path>
                <path d="M5 21V7l8-4v18"></path>
                <path d="M19 21V11l-6-4"></path>
              </svg>
            </span>
            <span class="sidebar-text">Edit Profil Desa</span>
            <span class="sidebar-tooltip">Edit Profil Desa</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-destinasi.html') }}" class="{{ $drawerActive === 'destinasi' ? 'active' : '' }}" data-tooltip="Kelola Destinasi">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </span>
            <span class="sidebar-text">Kelola Destinasi</span>
            <span class="sidebar-tooltip">Kelola Destinasi</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-edit-destinasi.html') }}" class="{{ $drawerActive === 'edit-destinasi' ? 'active' : '' }}" data-tooltip="Edit Detail Destinasi">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                <line x1="7" y1="8" x2="17" y2="8"></line>
                <line x1="7" y1="12" x2="13" y2="12"></line>
              </svg>
            </span>
            <span class="sidebar-text">Edit Detail Destinasi</span>
            <span class="sidebar-tooltip">Edit Detail Destinasi</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-paket.html') }}" class="{{ $drawerActive === 'paket' ? 'active' : '' }}" data-tooltip="Kelola Paket Wisata">
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
            <span class="sidebar-text">Kelola Paket Wisata</span>
            <span class="sidebar-tooltip">Kelola Paket Wisata</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-umkm.html') }}" class="{{ $drawerActive === 'umkm' ? 'active' : '' }}" data-tooltip="Kelola Katalog UMKM">
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
            <span class="sidebar-text">Kelola Katalog UMKM</span>
            <span class="sidebar-tooltip">Kelola Katalog UMKM</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-pratinjau.html') }}" class="{{ $drawerActive === 'pratinjau' ? 'active' : '' }}" data-tooltip="Pratinjau & Publikasi">
            <span class="sidebar-chevron">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </span>
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                <polyline points="17 6 23 6 23 12"></polyline>
              </svg>
            </span>
            <span class="sidebar-text">Pratinjau &amp; Publikasi</span>
            <span class="sidebar-tooltip">Pratinjau &amp; Publikasi</span>
          </a>
        </li>
      </ul>

      <div class="sidebar-divider"></div>

      <div class="drawer-section-label">ACCOUNT</div>
      <ul class="drawer-links drawer-links-account">
        <li>
          <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" data-tooltip="Lihat Website Publik">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
              </svg>
            </span>
            <span class="sidebar-text">Website Publik</span>
            <span class="sidebar-tooltip">Website Publik</span>
          </a>
        </li>

        <li>
          <a href="{{ url('/admin-kontak.html') }}" class="{{ $drawerActive === 'kontak' ? 'active' : '' }}" data-tooltip="Pengaturan Kontak">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
              </svg>
            </span>
            <span class="sidebar-text">Settings</span>
            <span class="sidebar-tooltip">Pengaturan Kontak</span>
          </a>
        </li>

        <li>
          <form id="adminSidebarLogoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('adminSidebarLogoutForm').submit();" data-tooltip="Log out">
            <span class="sidebar-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
            </span>
            <span class="sidebar-text">Log out</span>
            <span class="sidebar-tooltip">Log out</span>
          </a>
        </li>
      </ul>

      <!-- Theme Switcher Row -->
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

    <!-- Bottom Profile Card & Floating Popup -->
    <div class="sidebar-footer" id="sidebarProfileTrigger">
      <div class="sidebar-avatar">
        <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Admin BUMDesa">
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name">{{ Auth::guard('admin')->user()->name ?? 'Admin BUMDesa' }}</span>
        <span class="sidebar-user-email">{{ Auth::guard('admin')->user()->email ?? 'mandirisejahtera@gmail.com' }}</span>

      <div class="sidebar-profile-popup" id="sidebarProfilePopup">
        <div class="profile-popup-header">
          <div class="sidebar-avatar">
            <img src="{{ asset('assets/images/logo-desa-wisata-karangkemiri.png') }}" alt="Admin BUMDesa">
          </div>
          <div class="sidebar-user-info">
            <span class="sidebar-user-name">{{ Auth::guard('admin')->user()->name ?? 'Admin BUMDesa' }}</span>
            <span class="sidebar-user-email">{{ Auth::guard('admin')->user()->email ?? 'mandirisejahtera@gmail.com' }}</span>
        </div>
        <ul class="profile-popup-links">
          <li>
            <a href="{{ url('/admin-profil.html') }}">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
              <span>Kelola Profil Desa</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/admin-pratinjau.html') }}">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              <span>Riwayat &amp; Pratinjau</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
              <span>Buka Website Publik</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('adminSidebarLogoutForm').submit();" style="color: #dc2626;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
              <span>Log out</span>
            </a>
          </li>
        <div class="profile-popup-version">v2.0 &bull; CMS BUMDesa Mandiri Sejahtera</div>
      </div>
    </div>
  </aside>

  <script src="{{ asset('js/app.js') }}?v={{ file_exists(public_path('js/app.js')) ? filemtime(public_path('js/app.js')) : time() }}"></script>
  @stack('scripts')
</body>
</html>

