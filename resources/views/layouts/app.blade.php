<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Desa Wisata Karangkemiri')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>
<body>

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
  @endphp

  <div class="app-shell">
    <!-- Top Navbar Web -->
    <header class="top-navbar">
      <div class="navbar-inner">
        <a href="{{ url('/') }}" class="brand-logo">
          <div class="brand-mark">
            <span class="brand-pill-left"></span>
            <span class="brand-pill-right"></span>
          </div>
          <div class="brand-text">
            Desa Wisata<br>Karangkemiri
          </div>
        </a>

        <!-- Navigasi Utama Web -->
        <nav class="web-nav-pill" aria-label="Navigasi Utama">
          <a href="{{ url('/') }}" class="{{ $currentNav === 'home' ? 'active' : '' }}">Beranda</a>
          <a href="{{ url('/profil.html') }}" class="{{ $currentNav === 'profil' ? 'active' : '' }}">Profil Desa</a>
          <a href="{{ url('/destinasi.html') }}" class="{{ $currentNav === 'destinasi' ? 'active' : '' }}">Destinasi</a>
          <a href="{{ url('/paket-wisata.html') }}" class="{{ $currentNav === 'paket' ? 'active' : '' }}">Paket</a>
          <a href="{{ url('/katalog-umkm.html') }}" class="{{ $currentNav === 'umkm' ? 'active' : '' }}">UMKM</a>
          <a href="{{ url('/kontak.html') }}" class="{{ $currentNav === 'kontak' ? 'active' : '' }}">Kontak</a>
        </nav>

        <button class="menu-btn" id="menuBtn" aria-label="Buka Menu Navigasi">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </header>

    @yield('content')
  </div>

  <!-- Slide-out Hamburger Menu Drawer (Akses 7 Halaman Publik) -->
  <div class="drawer-backdrop" id="drawerBackdrop"></div>
  <aside class="nav-drawer" id="navDrawer">
    <div class="drawer-header">
      <div class="brand-logo">
        <div class="brand-mark">
          <span class="brand-pill-left"></span>
          <span class="brand-pill-right"></span>
        </div>
        <div class="brand-text">Desa Wisata<br>Karangkemiri</div>
      </div>
      <button class="drawer-close" id="drawerClose" aria-label="Tutup Menu">&times;</button>
    </div>

    <ul class="drawer-links">
      <li><a href="{{ url('/') }}" class="{{ $currentNav === 'home' ? 'active' : '' }}"><span>Beranda</span></a></li>
      <li><a href="{{ url('/profil.html') }}" class="{{ $currentNav === 'profil' ? 'active' : '' }}"><span>Profil Desa Wisata</span></a></li>
      <li><a href="{{ url('/destinasi.html') }}" class="{{ $currentNav === 'destinasi' ? 'active' : '' }}"><span>Destinasi Wisata</span></a></li>
      <li><a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="{{ $currentNav === 'detail-destinasi' ? 'active' : '' }}"><span>Detail Destinasi</span></a></li>
      <li><a href="{{ url('/paket-wisata.html') }}" class="{{ $currentNav === 'paket' ? 'active' : '' }}"><span>Paket Wisata</span></a></li>
      <li><a href="{{ url('/katalog-umkm.html') }}" class="{{ $currentNav === 'umkm' ? 'active' : '' }}"><span>Katalog UMKM</span></a></li>
      <li><a href="{{ url('/kontak.html') }}" class="{{ $currentNav === 'kontak' ? 'active' : '' }}"><span>Kontak &amp; Lokasi</span></a></li>
      <li><a href="{{ url('/admin-login.html') }}"><span>Login Admin CMS</span></a></li>
    </ul>
  </aside>

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
