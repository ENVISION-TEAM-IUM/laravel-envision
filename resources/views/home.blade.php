@extends('layouts.app')

@section('title', 'Beranda - Desa Wisata Karangkemiri')
@section('nav_active', 'home')

@section('content')
    <!-- Main Content: 01 Beranda -->
    <main class="page-container">
      <!-- Hero Banner -->
      <section class="hero-card hero-home">
        <span class="gold-dot"></span>
        <h1 class="hero-title">
          Jelajahi<br>
          Desa Wisata<br>
          Karangkemiri
        </h1>
        <p class="hero-subtitle">
          Wisata alam, edukasi, budaya, dan produk lokal dalam satu perjalanan.
        </p>
      </section>

      <!-- Primary CTA: Reservasi Sekarang (Tanpa Panah) -->
      <a href="{{ url('/paket-wisata.html') }}" class="btn-cta-indigo">
        <span>Reservasi Sekarang</span>
      </a>

      <!-- Pintasan Jelajah -->
      <div class="quick-links-row">
        <a href="{{ url('/destinasi.html?kategori=alam') }}">Wisata Alam</a>
        <a href="{{ url('/destinasi.html?kategori=edukasi') }}">Wisata Edukasi</a>
        <a href="{{ url('/katalog-umkm.html') }}">UMKM Lokal</a>
        <a href="{{ url('/profil.html') }}">Profil Desa</a>
      </div>

      <!-- Destinasi Unggulan (Kotak Bersih Tanpa Panah) -->
      <section>
        <div class="eyebrow">PILIHAN UNTUKMU</div>
        <h2 class="section-title">Destinasi unggulan</h2>

        <div class="cards-stack">
          <!-- Card 1: Candi -->
          <a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="horiz-card">
            <div class="thumb-box">
              <span class="gold-dot sm"></span>
              <span>Candi</span>
            </div>
            <div class="card-body">
              <h3 class="card-title">Wahana Edukasi &amp; Outbound Candi</h3>
              <p class="card-subtitle">Aktivitas keluarga dan rombongan</p>
            </div>
          </a>

          <!-- Card 2: Embung -->
          <a href="{{ url('/detail-destinasi.html?slug=embung') }}" class="horiz-card">
            <div class="thumb-box">
              <span class="gold-dot sm"></span>
              <span>Embung</span>
            </div>
            <div class="card-body">
              <h3 class="card-title">Embung Prabawulan</h3>
              <p class="card-subtitle">Wisata alam dan budidaya ikan</p>
            </div>
          </a>
        </div>
      </section>

      <!-- Pintasan Layanan BUMDes & UMKM (Tanpa Panah) -->
      <section class="qr-continue-section">
        <div class="eyebrow">RENCANAKAN KUNJUNGAN &amp; BELANJA LOKAL</div>
        <h2 class="section-title">Layanan BUMDes &amp; UMKM</h2>
        <div class="qr-continue-grid">
          <a href="{{ url('/paket-wisata.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Paket Wisata &amp; Sekolah</div>
            <p class="qr-continue-desc">Bandingkan Paket Outbound dan Paket Edukasi lengkap dengan durasi, fasilitas, dan ketentuan rombongan.</p>
          </a>

          <a href="{{ url('/katalog-umkm.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Katalog Produk UMKM</div>
            <p class="qr-continue-desc">Temukan tahu lokal, gula jawa, kerajinan kain perca, dan madu klanceng langsung dari pelaku UMKM.</p>
          </a>

          <a href="{{ url('/profil.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Profil Desa Wisata</div>
            <p class="qr-continue-desc">Kenali sejarah, visi pengembangan, dan pengelolaan Desa Wisata Karangkemiri oleh BUMDes.</p>
          </a>
        </div>
      </section>
    </main>
@endsection
