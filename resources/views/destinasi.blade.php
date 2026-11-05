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
      <section class="hero-card hero-subpage" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.3) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/candi.png') }}'); background-size: cover; background-position: center;">
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

      <!-- Destination Cards -->
      <div class="cards-stack">
        <!-- 1. Candi -->
        <a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="horiz-card" data-category="edukasi">
          <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/candi.png') }}'); background-size: cover; background-position: center;">
            <span>Candi</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Wahana Edukasi &amp; Outbound Candi</h2>
            <p class="card-subtitle">Permainan outbound, ketangkasan kelompok, flying fox, panahan, dan kegiatan edukasi luar ruang</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Edukasi &amp; Outbound</span>
              <span class="price-tag">Mulai Rp 75.000 – Rp 100.000</span>
            </div>
          </div>
        </a>

        <!-- 2. Embung Prabawulan -->
        <a href="{{ url('/detail-destinasi.html?slug=embung') }}" class="horiz-card" data-category="alam">
          <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/camping-ground.jpeg') }}'); background-size: cover; background-position: center;">
            <span>Embung</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Embung Prabawulan</h2>
            <p class="card-subtitle">Ruang rekreasi keluarga, pemandangan danau buatan, bersantai, memancing, dan budidaya ikan</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Wisata Alam</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>

        <!-- 3. Agro Kelengkeng Thabet -->
        <a href="{{ url('/detail-destinasi.html?slug=kelengkeng') }}" class="horiz-card" data-category="alam,edukasi">
          <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/whatsapp-image-2025-12-30-at-16.55.33.jpeg') }}'); background-size: cover; background-position: center;">
            <span>Buah</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Agro Kelengkeng Thabet</h2>
            <p class="card-subtitle">Agrowisata kebun kelengkeng unggulan desa, edukasi budidaya, dan petik buah musiman</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Agrowisata</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>

        <!-- 4. Petilasan Mbah Siti Benter -->
        <a href="{{ url('/detail-destinasi.html?slug=petilasan') }}" class="horiz-card" data-category="budaya">
          <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/sadranan.jpeg') }}'); background-size: cover; background-position: center;">
            <span>Budaya</span>
          </div>
          <div class="card-body">
            <h2 class="card-title">Petilasan Mbah Siti Benter</h2>
            <p class="card-subtitle">Kekayaan sejarah lokal, tradisi Sedekah Bumi, Sadranan, dan pelestarian budaya leluhur</p>
            <div class="card-meta-bottom">
              <span class="meta-tag-small">Wisata Budaya</span>
              <span class="price-tag">Konfirmasi Pengelola</span>
            </div>
          </div>
        </a>
      </div>
    </main>
@endsection
