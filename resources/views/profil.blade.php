@extends('layouts.app')

@section('title', 'Profil Desa Wisata - Desa Wisata Karangkemiri')
@section('nav_active', 'profil')

@section('content')
    <!-- Back Bar -->
    <div class="back-bar">
      <a href="{{ url('/') }}" class="back-link" aria-label="Kembali">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M12 8l-4 4 4 4"></path>
          <path d="M16 12H8"></path>
        </svg>
      </a>
    </div>

    <!-- Main Content: 02 Profil Desa Wisata -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner -->
      <section class="hero-card hero-subpage">
        <span class="gold-dot"></span>
        <span class="hero-caption">Mengenal desa kami</span>
      </section>

      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; <span>Profil Desa Wisata</span>
      </div>

      <!-- Tentang Kami -->
      <section>
        <div class="eyebrow">TENTANG KAMI</div>
        <h1 class="section-title" style="margin-bottom: 12px;">Desa Wisata Karangkemiri</h1>
        <p style="font-size: 15px; color: var(--text-body); line-height: 1.65;">
          Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas. Dikelola bersama BUMDes dan masyarakat lokal, desa ini memadukan potensi wisata alam, wahana edukasi &amp; outbound, nilai sejarah-budaya, serta produk UMKM unggulan warga.
        </p>

        <!-- Stats Box: Sejak 2017 | Pengelola BUMDes | Fokus Wisata & UMKM -->
        <div class="profile-stats-card">
          <div class="stat-since">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#145A2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <div style="color: var(--green-dark); line-height: 1.25;">
              <div style="font-size: 14px; font-weight: 500;">Sejak</div>
              <div style="font-size: 17px; font-weight: 800;">2017</div>
            </div>
          </div>

          <div class="stat-item">
            <div>PENGELOLA</div>
            <div>BUMDes</div>
          </div>

          <div class="stat-item">
            <div>FOKUS</div>
            <div>Wisata &amp; UMKM</div>
          </div>
        </div>
      </section>

      <!-- Arah Pengembangan & Visi -->
      <section>
        <div class="eyebrow">ARAH PENGEMBANGAN</div>
        <div class="potensi-banner">
          <span class="gold-dot sm"></span>
          <span class="hero-caption">Potensi desa</span>
          <div class="carousel-dots">
            <span class="active"></span>
            <span></span>
            <span></span>
          </div>
        </div>

        <h2 class="section-title" style="margin-bottom: 12px;">Visi kami</h2>
        <p style="font-size: 15px; color: var(--text-body); line-height: 1.65;">
          Mewujudkan Desa Wisata Karangkemiri yang mandiri, edukatif, dan berkelanjutan berbasis kearifan lokal serta pemberdayaan ekonomi masyarakat dan pelaku UMKM melalui pengelolaan BUMDes yang transparan.
        </p>
      </section>
    </main>
@endsection
