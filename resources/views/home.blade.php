@extends('layouts.app')

@section('title', 'Beranda - Desa Wisata Karangkemiri')
@section('nav_active', 'home')

@section('content')
    <!-- Main Content: 01 Beranda -->
    <main class="page-container">
      <!-- Hero Banner dengan Gambar Asli Desa Wisata Karangkemiri -->
      <section class="hero-card hero-home" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.35) 0%, rgba(14, 68, 33, 0.85) 100%), url('{{ asset('assets/images/desa-wisata-karangkemiri-2.jpeg') }}'); background-size: cover; background-position: center;">
        <h1 class="hero-title">
          Jelajahi<br>
          Desa Wisata<br>
          Karangkemiri
        </h1>
        <p class="hero-subtitle">
          Pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi. Rasakan suasana pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk.
        </p>
      </section>

      <!-- Primary CTA: Reservasi Sekarang -->
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

      <!-- Destinasi Unggulan -->
      <section>
        <div class="eyebrow">PILIHAN UNTUKMU</div>
        <h2 class="section-title">Destinasi unggulan</h2>

        <div class="cards-stack">
          <!-- Card 1: Candi -->
          <a href="{{ url('/detail-destinasi.html?slug=candi') }}" class="horiz-card">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/candi.png') }}'); background-size: cover; background-position: center;">
              <span>Candi</span>
            </div>
            <div class="card-body">
              <h3 class="card-title">Wahana Edukasi &amp; Outbound Candi</h3>
              <p class="card-subtitle">Aktivitas keluarga dan rombongan</p>
            </div>
          </a>

          <!-- Card 2: Embung -->
          <a href="{{ url('/detail-destinasi.html?slug=embung') }}" class="horiz-card">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/camping-ground.jpeg') }}'); background-size: cover; background-position: center;">
              <span>Embung</span>
            </div>
            <div class="card-body">
              <h3 class="card-title">Embung Prabawulan</h3>
              <p class="card-subtitle">Wisata alam dan budidaya ikan</p>
            </div>
          </a>
        </div>
      </section>

      <!-- Galeri Wisata (Disalin dari web DESWIT KRKEMIRI) -->
      <section style="margin-top: 28px;">
        <div class="eyebrow">DOKUMENTASI KEGIATAN</div>
        <h2 class="section-title" style="margin-bottom: 14px;">Galeri Wisata</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 14px;">
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/ketapel-panahan.jpeg') }}" alt="Ketapel & Panahan Outbound" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg') }}" alt="Penghargaan LDWN Peringkat ke-13 Nasional 2023" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/flying-fox-2.jpeg') }}" alt="Wahana Flying Fox" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/camping-ground.jpeg') }}" alt="Camping Ground Karangkemiri" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/outbound.jpeg') }}" alt="Kegiatan Outbound Rombongan" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); height: 185px;">
            <img src="{{ asset('assets/images/sadranan.jpeg') }}" alt="Tradisi Budaya Sadranan" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
        </div>
      </section>

      <!-- Pintasan Layanan BUMDes & UMKM -->
      <section class="qr-continue-section">
        <div class="eyebrow">RENCANAKAN KUNJUNGAN &amp; BELANJA LOKAL</div>
        <h2 class="section-title">Layanan BUMDes &amp; UMKM</h2>
        <div class="qr-continue-grid">
          <a href="{{ url('/paket-wisata.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Paket Wisata &amp; Sekolah</div>
            <p class="qr-continue-desc">Paket Outbound (mulai Rp 100.000/orang) dan Paket Edukasi (mulai Rp 75.000/orang) meliputi Paket Edukasi Ceria, Team Building &amp; Petualang Muda.</p>
          </a>

          <a href="{{ url('/katalog-umkm.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Katalog Produk UMKM</div>
            <p class="qr-continue-desc">Temukan tahu lokal, gula jawa, peyek, anyaman bambu, kerajinan kain perca, dan madu klanceng langsung dari pelaku UMKM.</p>
          </a>

          <a href="{{ url('/profil.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Profil Desa Wisata</div>
            <p class="qr-continue-desc">Kenali sejarah, visi-misi, struktur organisasi, dan pengelolaan Desa Wisata Karangkemiri oleh BUMDesa Mandiri Sejahtera.</p>
          </a>
        </div>
      </section>
    </main>
@endsection
