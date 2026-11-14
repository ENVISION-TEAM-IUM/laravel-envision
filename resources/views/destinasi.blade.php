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
        @forelse ($destinasiList as $item)
          @php
            $catLower = strtolower($item->kategori);
            $catFilter = 'semua,' . $catLower;
            if (str_contains($catLower, 'alam')) {
              $catFilter .= ',alam';
            }
            if (str_contains($catLower, 'edukasi') || str_contains($catLower, 'outbound') || str_contains($catLower, 'agro')) {
              $catFilter .= ',edukasi';
            }
            if (str_contains($catLower, 'budaya') || str_contains($catLower, 'religi')) {
              $catFilter .= ',budaya';
            }
            $fotoUrl = $item->foto ? asset($item->foto) : asset('assets/images/candi.png');
          @endphp
          <a href="{{ route('detail-destinasi.slug', ['slug' => $item->slug]) }}" class="horiz-card" data-category="{{ $catFilter }}">
            <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ $fotoUrl }}'); background-size: cover; background-position: center;">
              <span>{{ Str::limit($item->nama, 10, '') }}</span>
            </div>
            <div class="card-body">
              <h2 class="card-title">{{ $item->nama }}</h2>
              <p class="card-subtitle">{{ Str::limit($item->deskripsi, 140) }}</p>
              <div class="card-meta-bottom">
                <span class="meta-tag-small">{{ $item->kategori }}</span>
                <span class="price-tag">{{ $item->harga_tiket ?? 'Konfirmasi Pengelola' }}</span>
              </div>
            </div>
          </a>
        @empty
          <div class="admin-panel-card empty-state-card" style="text-align: center; padding: 44px 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Destinasi</h3>
            <p style="color: var(--text-muted); font-size: 14px;">Destinasi wisata Desa Karangkemiri akan segera ditayangkan.</p>
          </div>
        @endforelse
      </div>
    </main>
@endsection
