@extends('layouts.app')

@section('title', 'Detail Destinasi - Desa Wisata Karangkemiri')
@section('shell_id', 'detailDestinasiPage')
@section('nav_active', 'destinasi')
@section('drawer_active', 'detail-destinasi')

@section('content')
    <!-- Pilihan Lokasi Destinasi (Simulasi Tujuan QR per Lokasi M07) -->
    <div class="dest-switcher" aria-label="Pilih Lokasi Destinasi">
      <span style="font-size: 12px; font-weight: 700; color: var(--text-muted); margin-right: 4px;">Lokasi QR:</span>
      <a href="?slug=candi" class="dest-chip active" data-dest-switch="candi">Candi Outbound</a>
      <a href="?slug=embung" class="dest-chip" data-dest-switch="embung">Embung Prabawulan</a>
      <a href="?slug=kelengkeng" class="dest-chip" data-dest-switch="kelengkeng">Agro Kelengkeng</a>
      <a href="?slug=petilasan" class="dest-chip" data-dest-switch="petilasan">Petilasan Mbah Siti Benter</a>
    </div>

    <!-- Main Detail Content -->
    <main class="page-container" style="padding-top: 14px;">
      <!-- Hero Image Box with Back Circle Button -->
      <section class="hero-card hero-detail" id="destHeroCard" style="margin-bottom: 24px; background-image: linear-gradient(180deg, rgba(16, 40, 26, 0.25) 0%, rgba(16, 40, 26, 0.72) 100%), url('{{ asset('assets/images/candi.png') }}'); background-size: cover; background-position: center;">
        <a href="{{ url('/destinasi.html') }}" class="hero-back-circle" aria-label="Kembali ke Daftar Destinasi">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 8l-4 4 4 4"></path>
            <path d="M16 12H8"></path>
          </svg>
        </a>
        <span class="hero-caption" id="destHeroCaption" style="color: #fff; text-shadow: 0 2px 8px rgba(0,0,0,0.45);">Wahana Edukasi &amp; Outbound Candi</span>
      </section>

      <div class="eyebrow" id="destEyebrow">DESTINASI • EDUKASI &amp; OUTBOUND</div>
      <h1 class="section-title" id="destTitle" style="font-size: 32px;">Wahana Edukasi &amp; Outbound Candi</h1>

      <!-- Kategori Badge + Tombol Beri Masukan S02 -->
      <div class="detail-header-row">
        <span class="badge-category" id="destBadge">Edukasi &amp; Outbound</span>
        <button type="button" class="btn-outline-green" id="openFeedbackBtn">
          <span>Beri Masukan Layanan</span>
        </button>
      </div>

      <!-- Location Line -->
      <div class="location-line">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
          <circle cx="12" cy="10" r="3"></circle>
        </svg>
        <span id="destLocation">Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas</span>
      </div>

      <!-- Description -->
      <p id="destDesc" style="font-size: 15px; color: var(--text-body); line-height: 1.65;">
        Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, serta edukasi kelompok di area terbuka yang asri.
      </p>

      <!-- Informasi Kunjungan (Jam, Harga/Keterangan Harga, Fasilitas, & Petunjuk Arah) -->
      <section class="visit-info-card" aria-label="Informasi Kunjungan">
        <div class="visit-info-grid">
          <div class="visit-info-item">
            <span class="visit-info-label">Jam Operasional</span>
            <span class="visit-info-value" id="destHours">Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)</span>
          </div>
          <div class="visit-info-item">
            <span class="visit-info-label">Harga &amp; Ketentuan</span>
            <span class="visit-info-value" id="destPrice">Tiket &amp; Paket: Hubungi Pengelola BUMDes</span>
          </div>
          <div class="visit-info-item">
            <span class="visit-info-label">Petunjuk Arah</span>
            <div>
              <a href="https://www.google.com/maps/search/?api=1&amp;query=Wahana+Edukasi+%26+Outbound+Candi+Karangkemiri+Karanglewas+Banyumas" target="_blank" rel="noopener" class="btn-outline-green" id="destMapsBtn" style="padding: 7px 14px; font-size: 13px;">
                <span>Buka di Google Maps</span>
              </a>
            </div>
          </div>
        </div>

        <div class="facilities-wrap">
          <div>
            <span class="visit-info-label">Fasilitas Tersedia</span>
            <div class="facilities-badges" id="destFacilities">
              <span class="facility-chip">✓ Area Outbound Luas</span>
              <span class="facility-chip">✓ Pendopo / Aula Kumpul</span>
              <span class="facility-chip">✓ Toilet &amp; Kamar Bilas</span>
              <span class="facility-chip">✓ Mushola</span>
              <span class="facility-chip">✓ Area Parkir Rombongan</span>
            </div>
          </div>
        </div>

        <!-- Peta Google Maps Lokasi Destinasi -->
        <div class="map-embed-wrap" style="margin-top: 18px; margin-bottom: 0; height: 210px;">
          <iframe
            id="destMapsIframe"
            title="Peta Lokasi Wahana Edukasi &amp; Outbound Candi"
            src="https://maps.google.com/maps?q=Wahana+Edukasi+%26+Outbound+Candi,+Karangkemiri,+Karanglewas,+Banyumas&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </section>

      <!-- Yang Bisa Dilakukan -->
      <section>
        <div class="eyebrow">YANG BISA DILAKUKAN</div>
        <h2 class="section-title" id="destActivityTitle">Kegiatan edukasi &amp; outbound</h2>

        <div class="activity-grid">
          <div class="activity-box" id="destAct1">Permainan outbound &amp; ketangkasan kelompok</div>
          <div class="activity-box" id="destAct2">Kegiatan edukasi sekolah, pramuka &amp; famili</div>
        </div>
      </section>

      <!-- Galeri Foto -->
      <section>
        <div class="eyebrow">GALERI FOTO</div>
        <h2 class="section-title">Momen di destinasi</h2>
        <div class="gallery-grid" id="destGalleryGrid">
          <div class="gallery-thumb" id="destGallery1" style="background-image: url('{{ asset('assets/images/outbound.jpeg') }}'); background-size: cover; background-position: center;"></div>
          <div class="gallery-thumb" id="destGallery2" style="background-image: url('{{ asset('assets/images/flying-fox-2.jpeg') }}'); background-size: cover; background-position: center;"></div>
          <div class="gallery-thumb" id="destGallery3" style="background-image: url('{{ asset('assets/images/ketapel-panahan.jpeg') }}'); background-size: cover; background-position: center;"></div>
        </div>
      </section>

      <!-- CTA Button: Tanya / Reservasi via WhatsApp (Logo WhatsApp Asli) -->
      <a href="https://wa.me/6285702573013" target="_blank" rel="noopener" class="btn-cta-green" id="destWaBtn">
        <span>Tanya / Reservasi via WhatsApp</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
        </svg>
      </a>

      <!-- Alur Lanjutan dari QR Lokasi (Tanpa Panah) -->
      <section class="qr-continue-section" aria-label="Eksplorasi Lanjutan">
        <div class="eyebrow">LANJUTKAN JELAJAHI KARANGKEMIRI</div>
        <h2 class="section-title" style="font-size: 22px;">Ingin mencari paket rombongan atau produk lokal?</h2>
        <div class="qr-continue-grid">
          <a href="{{ url('/paket-wisata.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Lihat Paket Wisata</div>
            <p class="qr-continue-desc">Pilihan Paket Outbound &amp; Paket Edukasi untuk sekolah, instansi, dan keluarga.</p>
          </a>

          <a href="{{ url('/katalog-umkm.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Katalog Produk UMKM</div>
            <p class="qr-continue-desc">Oleh-oleh khas Karangkemiri: tahu, gula jawa, kain perca, dan madu klanceng.</p>
          </a>

          <a href="{{ url('/destinasi.html') }}" class="qr-continue-card">
            <div class="qr-continue-title">Destinasi Wisata Lain</div>
            <p class="qr-continue-desc">Jelajahi Embung Prabawulan, Agro Kelengkeng Thabet, dan Petilasan.</p>
          </a>
        </div>
      </section>
    </main>
@endsection

@section('modal')
  <!-- MODAL FORMULIR FEEDBACK SUKARELA S02 -->
  <div class="modal-overlay" id="feedbackModalOverlay" role="dialog" aria-modal="true" aria-labelledby="feedbackModalTitle">
    <div class="review-modal">
      <div class="feedback-modal-header">
        <div class="feedback-header-left">
          <h3 class="feedback-modal-title" id="feedbackModalTitle">Beri Masukan Layanan</h3>
        </div>
        <button type="button" class="review-close" id="closeFeedbackBtn" aria-label="Tutup Formulir">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <form class="feedback-form" id="s02FeedbackForm">
        <div class="feedback-note-card">
          <div class="feedback-note-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="16" x2="12" y2="12"></line>
              <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
          </div>
          <div class="feedback-note-text">
            <strong>Privat &amp; Anonim:</strong> Masukan ini disimpan secara rahasia untuk bahan evaluasi BUMDesa Mandiri Sejahtera (tidak dipublikasikan). Mohon tidak memasukkan nomor HP atau informasi pribadi.
          </div>
        </div>

        <!-- Destinasi yang Dikunjungi -->
        <div class="feedback-field-group">
          <label class="feedback-label" for="feedbackDestName">Destinasi yang Dikunjungi</label>
          <div class="feedback-dest-wrapper">
            <svg class="feedback-dest-pin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <input type="text" id="feedbackDestName" value="Wahana Edukasi &amp; Outbound Candi" readonly class="feedback-dest-input">
          </div>
        </div>

        <!-- Rating Fasilitas -->
        <div class="feedback-rating-card" data-rating-group="rateFasilitas">
          <div class="feedback-rating-top">
            <span class="feedback-rating-label">Penilaian Fasilitas</span>
            <span class="feedback-rating-status" id="rateFasilitasText"></span>
          </div>
          <div class="feedback-stars-row" role="radiogroup" aria-label="Penilaian Fasilitas">
            <button type="button" class="star-btn" data-val="1" aria-label="1 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="2" aria-label="2 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="3" aria-label="3 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="4" aria-label="4 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="5" aria-label="5 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
          </div>
          <input type="hidden" id="rateFasilitas" name="rateFasilitas" value="0">
        </div>

        <!-- Rating Kebersihan -->
        <div class="feedback-rating-card" data-rating-group="rateKebersihan">
          <div class="feedback-rating-top">
            <span class="feedback-rating-label">Penilaian Kebersihan</span>
            <span class="feedback-rating-status" id="rateKebersihanText"></span>
          </div>
          <div class="feedback-stars-row" role="radiogroup" aria-label="Penilaian Kebersihan">
            <button type="button" class="star-btn" data-val="1" aria-label="1 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="2" aria-label="2 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="3" aria-label="3 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="4" aria-label="4 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="5" aria-label="5 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
          </div>
          <input type="hidden" id="rateKebersihan" name="rateKebersihan" value="0">
        </div>

        <!-- Rating Pelayanan -->
        <div class="feedback-rating-card" data-rating-group="ratePelayanan">
          <div class="feedback-rating-top">
            <span class="feedback-rating-label">Penilaian Pelayanan</span>
            <span class="feedback-rating-status" id="ratePelayananText"></span>
          </div>
          <div class="feedback-stars-row" role="radiogroup" aria-label="Penilaian Pelayanan">
            <button type="button" class="star-btn" data-val="1" aria-label="1 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="2" aria-label="2 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="3" aria-label="3 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="4" aria-label="4 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
            <button type="button" class="star-btn" data-val="5" aria-label="5 Bintang">
              <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </button>
          </div>
          <input type="hidden" id="ratePelayanan" name="ratePelayanan" value="0">
        </div>

        <!-- Asal Kabupaten/Kota -->
        <div class="feedback-field-group">
          <label for="feedbackOrigin" class="feedback-label">Asal Kabupaten/Kota <span class="feedback-label-muted">(Opsional)</span></label>
          <div class="feedback-input-wrapper">
            <svg class="feedback-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="2" y1="12" x2="22" y2="12"></line>
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>
            <input type="text" id="feedbackOrigin" placeholder="Contoh: Kab. Banyumas, Purwokerto..." class="feedback-input">
          </div>
        </div>

        <!-- Komentar / Saran -->
        <div class="feedback-field-group">
          <div class="feedback-label-row">
            <label for="feedbackComment" class="feedback-label">Komentar / Saran <span class="feedback-label-muted">(Opsional)</span></label>
            <span class="feedback-char-counter" id="feedbackCommentCounter">0/500</span>
          </div>
          <textarea id="feedbackComment" rows="3" maxlength="500" placeholder="Tulis masukan Anda untuk peningkatan fasilitas atau pelayanan..." class="feedback-textarea"></textarea>
        </div>

        <!-- Tombol Aksi -->
        <div class="feedback-actions">
          <button type="submit" class="btn-feedback-submit">
            <span>Kirim Masukan ke BUMDes</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="22" y1="2" x2="11" y2="13"></line>
              <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

