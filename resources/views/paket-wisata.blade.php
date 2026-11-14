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
      <div class="cards-stack" id="publicPackageList" data-server-rendered="true">
        @forelse ($paketList as $paket)
          @php
            $cleanWa = preg_replace('/[^\d]/', '', $paket->nomor_wa ?? '085702573013');
            if (str_starts_with($cleanWa, '0')) {
              $cleanWa = '62' . substr($cleanWa, 1);
            }
            $waText = rawurlencode("Halo Admin, saya mau reservasi *{$paket->nama_paket}* Desa Wisata Karangkemiri.");
            $tagText = str_contains(strtolower($paket->nama_paket), 'outbound')
              ? 'Outbound'
              : (str_contains(strtolower($paket->nama_paket), 'edukasi') ? 'Edukasi' : 'Wisata');
            $fasilitasLines = array_filter(array_map('trim', explode("\n", $paket->fasilitas ?? '')));
            $fotoUrl = $paket->foto ? asset($paket->foto) : asset('assets/images/paket-1.jpeg');
          @endphp
          <div style="display: flex; flex-direction: column; gap: 14px;" data-public-pkg="{{ $paket->slug ?? $paket->id }}">
            <div class="horiz-card pkg-card" style="flex: 1;">
              <div class="thumb-box" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.15) 0%, rgba(14, 68, 33, 0.72) 100%), url('{{ $fotoUrl }}'); background-size: cover; background-position: center;">
                <span>{{ $tagText }}</span>
              </div>
              <div class="card-body">
                <div>
                  <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 8px;">
                    @if (!empty($paket->destinasi_terkait))
                      <span class="meta-tag-small">{{ $paket->destinasi_terkait }}</span>
                    @endif
                    @if (!empty($paket->aktivitas_umkm))
                      <span class="meta-tag-small" style="background-color: var(--green-soft); color: var(--green-dark);">UMKM: {{ $paket->aktivitas_umkm }}</span>
                    @endif
                  </div>
                  <h2 class="card-title">{{ $paket->nama_paket }}</h2>
                  <p class="card-subtitle">
                    {{ $paket->deskripsi }}
                  </p>
                  @if (!empty($fasilitasLines))
                    <ul class="pkg-checklist">
                      @foreach ($fasilitasLines as $fLine)
                        <li>{{ ltrim($fLine, "-•* \t") }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
                <div class="pkg-price-footer">
                  <span class="price-tag">{{ $paket->harga }}</span>
                </div>
              </div>
            </div>

            <div class="pkg-actions">
              <button type="button" class="pkg-btn pkg-btn-secondary"
                      data-view-pkg-detail="{{ $paket->slug ?? $paket->id }}"
                      data-pkg-name="{{ $paket->nama_paket }}"
                      data-pkg-price="{{ $paket->harga }}"
                      data-pkg-desc="{{ $paket->deskripsi }}"
                      data-pkg-facilities="{{ $paket->fasilitas }}"
                      data-pkg-destinasi="{{ $paket->destinasi_terkait }}"
                      data-pkg-umkm="{{ $paket->aktivitas_umkm }}"
                      data-pkg-wa="{{ $cleanWa }}"
                      data-pkg-image="{{ $fotoUrl }}">
                Detail Paket
              </button>
              <a href="https://wa.me/{{ $cleanWa }}?text={{ $waText }}" target="_blank" rel="noopener" class="pkg-btn pkg-btn-primary">
                <span>Reservasi WA</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.042-.458-.083-.146-.562-1.355-.77-1.855-.209-.5-.417-.438-.563-.438-.146 0-.313-.02-.479-.02-.167 0-.438.062-.667.312-.229.25-.875.854-.875 2.084s.896 2.417 1.02 2.584c.125.167 1.77 2.709 4.292 3.792.604.25 1.083.417 1.458.542.604.188 1.167.167 1.604.104.479-.063 1.48-.604 1.688-1.188.208-.583.208-1.083.146-1.188-.063-.104-.229-.166-.479-.291z"/>
                </svg>
              </a>
            </div>
          </div>
        @empty
          <div class="admin-panel-card empty-state-card" style="text-align: center; padding: 40px 20px;">
            <h3 style="font-size: 18px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Paket Wisata Aktif</h3>
            <p style="color: var(--text-muted); font-size: 14px; max-width: 520px; margin: 0 auto 16px; line-height: 1.6;">Silakan hubungi pengelola BUMDesa Mandiri Sejahtera untuk informasi pemesanan khusus.</p>
            <a href="https://wa.me/6285702573013?text=Halo%20BUMDesa%20Karangkemiri%2C%20saya%20ingin%20menanyakan%20paket%20wisata." target="_blank" rel="noopener" class="btn-empty-state-wa">
              <span>Hubungi BUMDes via WhatsApp</span>
            </a>
          </div>
        @endforelse
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
