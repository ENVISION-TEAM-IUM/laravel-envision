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
            <option value="all">Semua UMKM Karangkemiri</option>
            @foreach ($umkmList as $u)
              <option value="{{ $u->id }}">{{ $u->nama_usaha }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Product Grid (Ditarik Otomatis dari CMS) -->
      <div class="umkm-grid" id="publicUmkmGrid" data-server-rendered="true">
        @forelse ($produkList as $p)
          @php
            $umkmOwner = $p->umkm;
            $rawWa = $umkmOwner->nomor_wa ?? '085702573013';
            $cleanWa = preg_replace('/[^\d]/', '', $rawWa);
            if (str_starts_with($cleanWa, '0')) {
              $cleanWa = '62' . substr($cleanWa, 1);
            }
            $namaUsaha = $umkmOwner->nama_usaha ?? 'Pelaku UMKM';
            $waText = rawurlencode("Halo *{$namaUsaha}*, saya melihat produk *{$p->nama_produk}* di Katalog Website Desa Wisata Karangkemiri dan ingin menanyakan/memesan produk ini.");
            $fotoUrl = $p->foto ? asset($p->foto) : asset('assets/images/paket-1.jpeg');
            $catLabel = match(strtolower($p->kategori)) {
              'makanan' => 'Makanan Olahan',
              'kerajinan' => 'Kerajinan Tangan',
              'tani' => 'Hasil Pertanian',
              default => 'Produk Lokal',
            };
          @endphp
          <div class="umkm-card" data-category="{{ strtolower($p->kategori) }}" data-umkm-id="{{ $p->umkm_id }}">
            <div class="umkm-thumb" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.1) 0%, rgba(14, 68, 33, 0.7) 100%), url('{{ $fotoUrl }}'); background-size: cover; background-position: center;">
              <span>{{ $p->nama_produk }}</span>
            </div>
            <div class="umkm-body">
              <span class="meta-tag-small">{{ $catLabel }}</span>
              <h3 class="umkm-title">{{ $p->nama_produk }}</h3>
              @if (!empty($p->deskripsi))
                <p style="font-size: 12.5px; color: var(--text-muted); line-height: 1.4; margin: 4px 0 8px;">{{ $p->deskripsi }}</p>
              @endif
              <p class="umkm-producer" style="margin-bottom: 2px;">Oleh: <strong>{{ $namaUsaha }}</strong></p>
              <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 8px;">📍 {{ $umkmOwner->alamat ?? 'Desa Karangkemiri' }}</p>
              <div class="umkm-footer">
                <span class="umkm-price">{{ $p->harga }}</span>
                <a href="https://wa.me/{{ $cleanWa }}?text={{ $waText }}" target="_blank" rel="noopener" class="btn-wa-order">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="margin-right: 4px;">
                    <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.042-.458-.083-.146-.562-1.355-.77-1.855-.209-.5-.417-.438-.563-.438-.146 0-.313-.02-.479-.02-.167 0-.438.062-.667.312-.229.25-.875.854-.875 2.084s.896 2.417 1.02 2.584c.125.167 1.77 2.709 4.292 3.792.604.25 1.083.417 1.458.542.604.188 1.167.167 1.604.104.479-.063 1.48-.604 1.688-1.188.208-.583.208-1.083.146-1.188-.063-.104-.229-.166-.479-.291z"/>
                  </svg>
                  <span>Pesan WA</span>
                </a>
              </div>
            </div>
          </div>
        @empty
          <div class="admin-panel-card empty-state-card" style="grid-column: 1 / -1; text-align: center; padding: 44px 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Produk UMKM</h3>
            <p style="color: var(--text-muted); font-size: 14px;">Produk olahan dan kerajinan lokal akan segera ditampilkan.</p>
          </div>
        @endforelse
      </div>

      <!-- Seksi Profil UMKM Desa (Setiap UMKM dengan Alamat, WA, dan Jam Operasional) -->
      <div style="margin-top: 52px; padding-top: 36px; border-top: 1px solid var(--border-light);">
        <div class="eyebrow">PROFIL PENGRAJIN &amp; USAHA</div>
        <h2 class="section-title" style="font-size: 26px;">Pelaku UMKM Desa Karangkemiri</h2>
        <p class="section-desc" style="margin-bottom: 24px;">
          Kenali unit usaha warga desa, jam operasional, alamat rumah produksi, dan hubungi langsung pengelolanya.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;" id="publicUmkmProfilesGrid" data-server-rendered="true">
          @forelse ($umkmList as $u)
            @php
              $rawWa = $u->nomor_wa ?? '085702573013';
              $cleanWa = preg_replace('/[^\d]/', '', $rawWa);
              if (str_starts_with($cleanWa, '0')) {
                $cleanWa = '62' . substr($cleanWa, 1);
              }
              $waText = rawurlencode("Halo *{$u->nama_usaha}*, saya melihat profil usaha Anda di Website Desa Wisata Karangkemiri.");
            @endphp
            <div class="admin-panel-card" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: 16px; padding: 20px;">
              <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                  <span class="meta-tag-small">{{ $u->sektor_usaha ?? 'UMKM Desa' }}</span>
                  <span style="font-size: 12px; font-weight: 700; color: var(--green-forest);">{{ $u->produk->count() }} Produk</span>
                </div>
                <h3 style="font-size: 17px; font-weight: 800; color: var(--text-dark); margin-bottom: 6px;">{{ $u->nama_usaha }}</h3>
                <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 12px; line-height: 1.5;">{{ $u->deskripsi }}</p>
                <div style="font-size: 12.5px; color: var(--text-body); display: flex; flex-direction: column; gap: 4px; margin-bottom: 16px;">
                  <div>👤 <strong>Pemilik:</strong> {{ $u->nama_pemilik }}</div>
                  <div>📍 <strong>Alamat:</strong> {{ $u->alamat ?? 'Desa Karangkemiri' }}</div>
                  <div>⏰ <strong>Jam:</strong> {{ $u->jam_operasional ?? '08:00 - 17:00 WIB' }}</div>
                </div>
              </div>
              <a href="https://wa.me/{{ $cleanWa }}?text={{ $waText }}" target="_blank" rel="noopener" class="btn-outline-green" style="text-align: center; justify-content: center; padding: 10px;">
                <span>Hubungi Usaha Ini</span>
              </a>
            </div>
          @empty
            <div class="admin-panel-card empty-state-card" style="grid-column: 1 / -1; text-align: center; padding: 32px 20px;">
              <p style="color: var(--text-muted); font-size: 14px;">Belum ada profil UMKM yang terdaftar.</p>
            </div>
          @endforelse
        </div>
      </div>
    </main>
@endsection
