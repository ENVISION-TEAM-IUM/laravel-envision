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
      <!-- Hero Banner dengan Foto Asli Desa Wisata Karangkemiri -->
      <section class="hero-card hero-subpage" id="pubProfHeroCard" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.35) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/desa-wisata-karangkemiri-2.jpeg') }}'); background-size: cover; background-position: center;">
        <span class="hero-caption" id="pubProfHeroCaption">{{ $profil->hero_caption ?? 'Mengenal desa kami' }}</span>
      </section>

      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; <span>Profil Desa Wisata</span>
      </div>

      <!-- Tentang Kami & Sejarah Desa (Layout Padat & Seimbang Tanpa Space Kosong) -->
      <section>
        <h1 class="section-title" id="pubProfTitle" style="margin-bottom: 18px;">{{ $profil->title ?? 'Profil Desa Wisata Karangkemiri' }}</h1>
        <!-- Baris 1: Foto Utama Sejajar dengan Sejarah Desa & Kartu Statistik Singkat -->
        <div class="profile-two-col">
          <!-- Kolom Kiri: Foto Utama Bersebelahan Rapi -->
          <div class="profile-main-img-box">
            <img id="pubProfMainImg" src="{{ asset($profil->main_photo ?: 'assets/images/candi.png') }}" alt="{{ $profil->title ?? 'Profil Desa Wisata Karangkemiri' }}">
          </div>

          <!-- Kolom Kanan: Pengantar Sejarah & Kartu Statistik Terintegrasi -->
          <div style="display: flex; flex-direction: column; justify-content: space-between; gap: 14px; height: 100%;">
            <div class="admin-panel-card" style="margin-bottom: 0; height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
              <div>
                <p id="pubProfHistory" style="font-size: 15px; color: var(--text-body); line-height: 1.7; margin-bottom: 0;">
                  {{ $profil->history }}
                </p>
              </div>

              <!-- Stats Box Terintegrasi Pas di Bawah Teks (Mengisi Ruang Bawah) -->
              <div class="profile-stats-card" style="margin-top: 16px; margin-bottom: 0;">
                <div class="stat-since">
                  <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#145A2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                  </svg>
                  <div style="color: var(--green-dark); line-height: 1.25;">
                    <div style="font-size: 13px; font-weight: 500;">Sejak</div>
                    <div id="pubProfSince" style="font-size: 16.5px; font-weight: 800;">{{ $profil->since_year ?? '2017' }}</div>
                  </div>
                </div>

                <div class="stat-item">
                  <div>PENGELOLA</div>
                  <div id="pubProfManager">{{ $profil->manager ?? 'BUMDesa Mandiri Sejahtera' }}</div>
                </div>

                <div class="stat-item">
                  <div>FOKUS</div>
                  <div id="pubProfFocus">{{ $profil->focus ?? 'Wisata & UMKM' }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Baris 2: Dua Kartu Seimbang (Keberagaman Potensi & Kelestarian Budaya/UMKM) -->
        <div class="profile-two-col">
          <!-- Kartu 1: Keberagaman Potensi -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
              <h2 class="section-title" style="font-size: 18px; margin-bottom: 0;">Keberagaman Potensi &amp; Rekreasi</h2>
            </div>
            <p id="pubProfPotensiDesc" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0; flex: 1;">
              {{ $profil->potensi_desc }}
            </p>
          </div>

          <!-- Kartu 2: Kelestarian Budaya & UMKM -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
              <h2 class="section-title" style="font-size: 18px; margin-bottom: 0;">Warisan Seni, Budaya &amp; Produk UMKM</h2>
            </div>
            <p id="pubProfCultureDesc" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0; flex: 1;">
              {{ $profil->culture_desc }}
            </p>
          </div>
        </div>
      </section>

      <!-- Akses Mudah, Perjalanan Nyaman -->
      <section style="margin-top: 24px;">
        <div class="admin-panel-card" style="margin-bottom: 0;">
          <h2 class="section-title" style="font-size: 22px; margin-bottom: 10px;">Akses Mudah, Perjalanan Nyaman</h2>
          <p id="pubProfAccess" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0;">
            {{ $profil->access_info }}
          </p>
        </div>
      </section>

      <!-- Visi, Misi & Tujuan -->
      <section style="margin-top: 24px;">
        <div class="profile-two-col">
          <!-- Visi & Tujuan -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <h2 class="section-title" id="pubProfVisionTitle" style="font-size: 22px; margin-bottom: 10px;">{{ $profil->vision_title ?? 'Visi' }}</h2>
              <p id="pubProfVision" style="font-size: 15px; font-weight: 600; color: var(--green-dark); line-height: 1.65; margin-bottom: 20px;">
                {{ $profil->vision }}
              </p>
            </div>

            <div style="border-top: 1px solid var(--border-subtle); padding-top: 16px;">
              <h3 class="section-title" style="font-size: 18px; margin-bottom: 8px;">Tujuan</h3>
              <p id="pubProfGoal" style="font-size: 14px; color: var(--text-body); line-height: 1.65; margin-bottom: 0;">
                {{ $profil->goal }}
              </p>
            </div>
          </div>

          <!-- Misi -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="section-title" style="font-size: 22px; margin-bottom: 12px;">Misi</h2>
            <ul id="pubProfMissionList" class="pkg-checklist" style="font-size: 14px; color: var(--text-body); line-height: 1.6; display: flex; flex-direction: column; gap: 10px;">
              @php
                $missions = array_filter(preg_split('/\r\n|\r|\n/', (string) ($profil->mission ?? '')));
              @endphp
              @forelse ($missions as $m)
                <li>{{ $m }}</li>
              @empty
                <li>Mengembangkan potensi lokal sebagai daya tarik wisata.</li>
              @endforelse
            </ul>
          </div>
        </div>
      </section>

      <!-- Struktur Organisasi Unit Wisata -->
      <section style="margin-top: 24px;">
        <h2 class="section-title" style="margin-bottom: 14px;">Struktur Organisasi Unit Wisata</h2>
        <div class="admin-panel-card" style="padding: 20px; text-align: center; margin-bottom: 0;">
          <img id="pubProfStructImg" src="{{ asset($profil->structure_photo ?: 'assets/images/struktur-unit-wisata.png') }}" alt="Struktur Organisasi Unit Wisata Desa Wisata Karangkemiri" style="width: 100%; max-width: 920px; height: auto; border-radius: 14px; display: inline-block;">
        </div>
      </section>

      <!-- Galeri Foto Pendukung Profil Desa -->
      <section style="margin-top: 24px;">
        <h2 class="section-title" style="margin-bottom: 14px;">Galeri Aktivitas &amp; Tradisi Desa</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
          @forelse ($galeriList ?? [] as $g)
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
              <img src="{{ asset($g->foto) }}" alt="{{ $g->judul }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
          @empty
            <div id="penghargaan" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px; scroll-margin-top: 90px;">
              <img id="pubProfSupportImg1" src="{{ asset($profil->support_photo ?: 'assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg') }}" alt="Penghargaan LDWN Desa Wisata Karangkemiri" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
              <img id="pubProfSupportImg2" src="{{ asset('assets/images/outbound.jpeg') }}" alt="Kegiatan Outbound Candi" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
              <img id="pubProfSupportImg3" src="{{ asset('assets/images/camping-ground.jpeg') }}" alt="Area Camping Ground &amp; Alam" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
              <img id="pubProfSupportImg4" src="{{ asset('assets/images/sadranan.jpeg') }}" alt="Tradisi Budaya Sadranan" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
          @endforelse
        </div>
      </section>
    </main>
@endsection
