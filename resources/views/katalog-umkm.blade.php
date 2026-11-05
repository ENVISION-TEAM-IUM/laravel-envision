@extends('layouts.app')

@section('title', 'Katalog UMKM & Produk Lokal - Desa Wisata Karangkemiri')
@section('nav_active', 'umkm')

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

    <!-- Main Content: 06 Katalog UMKM -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner -->
      <section class="hero-card hero-subpage" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.3) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/sadranan.jpeg') }}'); background-size: cover; background-position: center;">
        <span class="hero-caption">Produk Unggulan Lokal Karangkemiri</span>
      </section>

      <!-- Section Heading -->
      <div style="margin-top: 20px;">
        <div class="eyebrow">DUKUNG EKONOMI WARGA</div>
        <h1 class="section-title">Katalog UMKM &amp; Produk Lokal</h1>
        <p class="section-desc" style="margin-top: 6px;">
          Jelajahi beragam produk olahan khas, kerajinan tangan, dan hasil tani berkualitas dari pelaku UMKM Desa Wisata Karangkemiri. Anda dapat memesan langsung ke pengrajin melalui WhatsApp.
        </p>
      </div>

      <!-- Filter Controls: Kategori & Pilihan UMKM -->
      <div style="display: flex; flex-direction: column; gap: 14px; margin: 20px 0 24px;">
        <!-- Category Filter Pills -->
        <div class="filter-pills" id="publicCategoryFilterPills">
          <button class="filter-pill active" data-filter-btn="semua">Semua Produk</button>
          <button class="filter-pill" data-filter-btn="makanan">Makanan Olahan</button>
          <button class="filter-pill" data-filter-btn="kerajinan">Kerajinan Tangan</button>
          <button class="filter-pill" data-filter-btn="tani">Hasil Pertanian</button>
          <button class="filter-pill" data-filter-btn="lokal">Produk Lokal</button>
        </div>

        <!-- Filter Dropdown berdasarkan Profil UMKM -->
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
          <span style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); white-space: nowrap;">Pilih Berdasarkan UMKM:</span>
          <select id="publicFilterUmkmSelect" class="admin-select" style="width: 260px; min-width: 260px; max-width: 260px; padding: 8px 14px; font-size: 13.5px; border-radius: 99px;">
            <option value="all">Semua UMKM</option>
            <!-- Diisi otomatis oleh JavaScript -->
          </select>
        </div>
      </div>

      <!-- Product Grid (Ditarik Otomatis dari CMS) -->
      <div class="umkm-grid" id="publicUmkmGrid">
        <!-- Rendered by initPublicUMKM() in app.js -->
      </div>

      <!-- Seksi Profil UMKM Desa (Setiap UMKM dengan Alamat, WA, dan Jam Operasional) -->
      <div style="margin-top: 52px; padding-top: 36px; border-top: 1px solid var(--border-light);">
        <div class="eyebrow">PROFIL PENGRAJIN &amp; USAHA</div>
        <h2 class="section-title" style="font-size: 26px;">Pelaku UMKM Desa Karangkemiri</h2>
        <p class="section-desc" style="margin-bottom: 24px;">
          Kenali unit usaha warga desa, jam operasional, alamat rumah produksi, dan hubungi langsung pengelolanya.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;" id="publicUmkmProfilesGrid">
          <!-- Rendered by initPublicUMKM() in app.js -->
        </div>
      </div>
    </main>
@endsection
