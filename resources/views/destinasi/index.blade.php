@extends('layouts.app')

@section('title', 'Destinasi Wisata - Desa Wisata Karangkemiri')
@section('nav_active', 'destinasi')

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

    <!-- Main Content: 03 Destinasi Wisata -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner -->
      <section class="hero-card hero-subpage">
        <span class="gold-dot"></span>
        <span class="hero-caption">Destinasi wisata</span>
      </section>

      <!-- Section Title -->
      <div style="margin-top: 20px;">
        <div class="eyebrow">JELAJAHI KARANGKEMIRI</div>
        <div class="header-with-hours">
          <h1 class="section-title">Pilih pengalamanmu</h1>
        </div>
      </div>

      <!-- Category Filter Pills -->
      <div class="filter-pills">
        <button class="filter-pill active" data-filter-btn="semua">Semua</button>
        <button class="filter-pill" data-filter-btn="alam">Wisata Alam</button>
        <button class="filter-pill" data-filter-btn="edukasi">Edukasi &amp; Outbound</button>
        <button class="filter-pill" data-filter-btn="budaya">Budaya</button>
      </div>

      <!-- Destination Cards (Kotak Rapi Tanpa Panah & Tanpa Rating Publik) -->
      <div class="cards-stack">
        <!-- 1. Candi -->
        <a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="horiz-card" data-category="edukasi">
          <div class="thumb-box">
            <span class="gold-dot sm"></span>
            <span>Candi</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Wahana Edukasi &amp; Outbound Candi</h2>
            <p class="card-subtitle">Permainan outbound, ketangkasan kelompok, dan kegiatan edukasi luar ruang</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Edukasi &amp; Outbound</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>

        <!-- 2. Embung Prabawulan -->
        <a href="{{ url('/detail-destinasi.html?slug=embung') }}" class="horiz-card" data-category="alam">
          <div class="thumb-box">
            <span class="gold-dot sm"></span>
            <span>Embung</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Embung Prabawulan</h2>
            <p class="card-subtitle">Pemandangan danau buatan, bersantai, memancing, dan budidaya ikan</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Wisata Alam</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>

        <!-- 3. Agro Kelengkeng Thabet -->
        <a href="{{ url('/detail-destinasi.html?slug=kelengkeng') }}" class="horiz-card" data-category="alam,edukasi">
          <div class="thumb-box">
            <span class="gold-dot sm"></span>
            <span>Buah</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Agro Kelengkeng Thabet</h2>
            <p class="card-subtitle">Agrowisata kebun kelengkeng, edukasi budidaya, dan petik buah musiman</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Agrowisata</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>

        <!-- 4. Petilasan Mbah Siti Benter -->
        <a href="{{ url('/detail-destinasi.html?slug=petilasan') }}" class="horiz-card" data-category="budaya">
          <div class="thumb-box">
            <span class="gold-dot sm"></span>
            <span>Budaya</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Petilasan Mbah Siti Benter</h2>
            <p class="card-subtitle">Wisata sejarah dan pelestarian nilai budaya leluhur masyarakat lokal</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Wisata Budaya</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>
      </div>
    </main>
@endsection
