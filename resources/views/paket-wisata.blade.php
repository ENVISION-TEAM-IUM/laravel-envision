@extends('layouts.app')

@section('title', 'Paket Wisata - Desa Wisata Karangkemiri')
@section('nav_active', 'paket')

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

    <!-- Main Content: 05 Paket Wisata -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner -->
      <section class="hero-card hero-subpage" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.3) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/outbound.jpeg') }}'); background-size: cover; background-position: center;">
        <span class="hero-caption">Pengalaman edukatif &amp; outbound</span>
      </section>

      <!-- Section Heading -->
      <div style="margin-top: 20px; margin-bottom: 18px;">
        <div class="eyebrow">RENCANAKAN KUNJUNGAN</div>
        <h1 class="section-title">Paket wisata</h1>
        <p class="section-desc">
          Kami menyediakan berbagai pilihan paket wisata sesuai kebutuhan untuk sekolah, instansi, dan keluarga.
        </p>
      </div>

      <!-- Daftar Paket Wisata (Terkoneksi Dinamis dengan CMS BUMDes) -->
      <div class="cards-stack" id="publicPackageList">
        <!-- Paket 1: Paket Outbound -->
        <div style="display: flex; flex-direction: column; gap: 14px;" data-public-pkg="outbound">
          <div class="horiz-card pkg-card" style="flex: 1;">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/paket-1.jpeg') }}'); background-size: cover; background-position: center;">
              <span>Outbound</span>
            </div>
            <div class="card-body">
              <div>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px;">
                  <span class="meta-tag-small">Wahana Edukasi &amp; Outbound Candi</span>
                  <span class="meta-tag-small" style="background-color: var(--green-soft); color: var(--green-dark);">UMKM: Kriya Kain Perca &amp; Kerajinan Lokal</span>
                </div>
                <h2 class="card-title">Paket Outbound</h2>
                <p class="card-subtitle">
                  Kami menyediakan berbagai pilihan paket wisata sesuai kebutuhan. Paket Outbound tersedia di antaranya Paket Edukasi Ceria, Paket Team Building &amp; Paket Petualang Muda.
                </p>
                <ul class="pkg-checklist">
                  <li>Pilihan: Paket Edukasi Ceria, Team Building &amp; Petualang Muda</li>
                  <li>Wahana outbound, flying fox, ketapel &amp; panahan</li>
                  <li>Permainan kelompok &amp; pendamping instruktur berpengalaman</li>
                  <li>Penggunaan area outbound &amp; pendopo luas</li>
                </ul>
              </div>
              <div class="pkg-price-footer">
                <span class="price-tag">mulai Rp 100.000 ,- / Orang</span>
              </div>
            </div>
          </div>

          <div class="pkg-actions">
            <button type="button" class="pkg-btn pkg-btn-secondary" data-view-pkg-detail="outbound">
              Detail Paket
            </button>
            <a href="https://wa.me/6285702573013?text=Halo%20Admin%2C%20saya%20mau%20reservasi%20*Paket%20Outbound*%20Desa%20Wisata%20Karangkemiri." target="_blank" rel="noopener" class="pkg-btn pkg-btn-primary">
              <span>Reservasi WA</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Paket 2: Paket Edukasi -->
        <div style="display: flex; flex-direction: column; gap: 14px;" data-public-pkg="edukasi">
          <div class="horiz-card pkg-card" style="flex: 1;">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ asset('assets/images/paket-edukasi-1.jpeg') }}'); background-size: cover; background-position: center;">
              <span>Edukasi</span>
            </div>
            <div class="card-body">
              <div>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px;">
                  <span class="meta-tag-small">Sentra Edukasi &amp; UMKM Desa</span>
                  <span class="meta-tag-small" style="background-color: var(--green-soft); color: var(--green-dark);">UMKM: Tahu, Gula Jawa, Kriya Perca, Madu Klanceng</span>
                </div>
                <h2 class="card-title">Paket Edukasi</h2>
                <p class="card-subtitle">
                  Berbagai macam pilihan paket edukasi dengan harga terjangkau seperti pembuatan tahu, gula jawa, anyaman bambu, dan kerajinan kain perca.
                </p>
                <ul class="pkg-checklist">
                  <li>Praktik langsung bersama pelaku UMKM &amp; pemandu lokal</li>
                  <li>Edukasi pengolahan tahu, gula jawa, &amp; kriya kain perca</li>
                  <li>Edukasi pertanian &amp; budidaya lokal desa</li>
                  <li>Cocok untuk rombongan sekolah, mahasiswa &amp; instansi</li>
                </ul>
              </div>
              <div class="pkg-price-footer">
                <span class="price-tag">mulai Rp 75.000 ,- / Orang</span>
              </div>
            </div>
          </div>

          <div class="pkg-actions">
            <button type="button" class="pkg-btn pkg-btn-secondary" data-view-pkg-detail="edukasi">
              Detail Paket
            </button>
            <a href="https://wa.me/6285702573013?text=Halo%20Admin%2C%20saya%20mau%20reservasi%20*Paket%20Edukasi*%20Desa%20Wisata%20Karangkemiri." target="_blank" rel="noopener" class="pkg-btn pkg-btn-primary">
              <span>Reservasi WA</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- E-Brosur Resmi Desa Wisata Karangkemiri (Disalin dari brosur_galeri.html) -->
      <section style="margin-top: 32px;">
        <div class="eyebrow">INFORMASI LENGKAP PAKET WISATA 2026</div>
        <h2 class="section-title" style="margin-bottom: 8px;">E-Brosur dan Reservasi</h2>
        <p class="section-desc" style="margin-bottom: 18px;">
          Kunjungi Desa Wisata Karangkemiri, rasakan suasana pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk, dipadukan alam, budaya, edukasi, dan rekreasi.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px;">
          <div class="admin-panel-card" style="padding: 14px; margin-bottom: 0;">
            <img src="{{ asset('assets/images/brosur-paket-wisata-candi-2026-images.jpg') }}" alt="E-Brosur Paket Wisata Candi 2026 Halaman 1" style="width: 100%; height: auto; border-radius: 12px; display: block;">
          </div>
          <div class="admin-panel-card" style="padding: 14px; margin-bottom: 0;">
            <img src="{{ asset('assets/images/brosur-paket-wisata-candi-2026-images-1.jpg') }}" alt="E-Brosur Paket Wisata Candi 2026 Halaman 2" style="width: 100%; height: auto; border-radius: 12px; display: block;">
          </div>
        </div>
      </section>
    </main>
@endsection
