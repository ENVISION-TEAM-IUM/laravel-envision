@extends('layouts.app')

@section('title', 'Kontak & Lokasi - Desa Wisata Karangkemiri')
@section('nav_active', 'kontak')

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

    <!-- Main Content: 07 Kontak & Lokasi -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner -->
      <section class="hero-card hero-subpage" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.3) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/desa-wisata-karangkemiri-2.jpeg') }}'); background-size: cover; background-position: center;">
        <span class="hero-caption">Kunjungi Karangkemiri</span>
      </section>

      <!-- Section Heading -->
      <div style="margin-top: 20px;">
        <div class="eyebrow">KAMI SIAP MEMBANTU</div>
        <h1 class="section-title">Kontak &amp; Lokasi</h1>
      </div>

      <!-- 2-Column Web Layout for Contact Items & Map -->
      <div class="contact-layout">
        <!-- Left Column: 4 Contact Items + Social Media Row -->
        <div class="contact-list">
          <!-- 1. Alamat -->
          <a id="pubContactAddrLink" href="{{ $kontak->maps_url ?: 'https://maps.app.goo.gl/VF9FUXXkzUoiD7YT8' }}" target="_blank" rel="noopener" class="contact-item">
            <div class="contact-icon-circle">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
              </svg>
            </div>
            <div>
              <div class="contact-title">Alamat</div>
              <div id="pubContactAddrText" class="contact-sub">{{ $kontak->address }}</div>
            </div>
          </a>

          <!-- 2. WhatsApp -->
          <a id="pubContactWaLink" href="https://wa.me/{{ preg_replace('/\D/', '', $kontak->whatsapp ?: '6285702573013') }}?text=Halo%20Admin,%20saya%20mau%20reservasi" target="_blank" rel="noopener" class="contact-item">
            <div class="contact-icon-circle">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
              </svg>
            </div>
            <div>
              <div class="contact-title">Phone / WhatsApp</div>
              <div id="pubContactWaText" class="contact-sub">{{ $kontak->whatsapp }} (Reservasi &amp; Informasi Wisata)</div>
            </div>
          </a>

          <!-- 3. Email -->
          <a id="pubContactEmailLink" href="mailto:{{ $kontak->email }}" class="contact-item">
            <div class="contact-icon-circle">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
              </svg>
            </div>
            <div>
              <div class="contact-title">Email</div>
              <div id="pubContactEmailText" class="contact-sub">{{ $kontak->email }}</div>
            </div>
          </a>

          <!-- 4. Jam Operasional -->
          <div class="contact-item">
            <div class="contact-icon-circle">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div>
              <div class="contact-title">Jam operasional</div>
              <div id="pubContactHoursText" class="contact-sub">{{ $kontak->hours }}</div>
            </div>
          </div>

          <!-- 5. Media Sosial Resmi -->
          <div class="contact-item" style="flex-direction: column; align-items: stretch; gap: 14px;">
            <div style="display: flex; align-items: center; gap: 14px;">
              <div class="contact-icon-circle">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
              </div>
              <div>
                <div class="contact-title">Media Sosial Resmi</div>
                <div class="contact-sub">Ikuti akun resmi kami untuk update kegiatan &amp; promo</div>
              </div>
            </div>

            <!-- Tautan Medsos yang Diisi dari CMS -->
            <div class="contact-social-grid" id="pubContactSocials">
              @if ($kontak->instagram)
                <a href="{{ $kontak->instagram }}" target="_blank" rel="noopener noreferrer" class="contact-social-btn" title="Buka Instagram Desa Wisata Karangkemiri">
                  <span class="contact-social-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></span>
                  <span class="contact-social-label">Instagram</span>
                </a>
              @endif
              @if ($kontak->facebook)
                <a href="{{ $kontak->facebook }}" target="_blank" rel="noopener noreferrer" class="contact-social-btn" title="Buka Facebook Desa Wisata Karangkemiri">
                  <span class="contact-social-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span>
                  <span class="contact-social-label">Facebook</span>
                </a>
              @endif
              @if ($kontak->tiktok)
                <a href="{{ $kontak->tiktok }}" target="_blank" rel="noopener noreferrer" class="contact-social-btn" title="Buka TikTok Desa Wisata Karangkemiri">
                  <span class="contact-social-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.89 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.35 0 .68.06 1 .16V9.32a6.34 6.34 0 0 0-1-.08A6.34 6.34 0 0 0 3 15.58a6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V8.5a8.31 8.31 0 0 0 4.91 1.6V6.69z"></path></svg></span>
                  <span class="contact-social-label">TikTok</span>
                </a>
              @endif
              @if ($kontak->youtube)
                <a href="{{ $kontak->youtube }}" target="_blank" rel="noopener noreferrer" class="contact-social-btn" title="Buka YouTube Desa Wisata Karangkemiri">
                  <span class="contact-social-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#FFFFFF"></polygon></svg></span>
                  <span class="contact-social-label">YouTube</span>
                </a>
              @endif
            </div>
          </div>
        </div>

        <!-- Right Column: Lokasi di Google Maps Asli & CTA WhatsApp -->
        <div>
          <div class="eyebrow">TEMUKAN LOKASI</div>
          <h2 class="section-title">Lokasi di Google Maps</h2>

          <!-- Embed Peta Google Maps Asli dari web DESWIT KRKEMIRI -->
          <div class="map-embed-wrap">
            <iframe
              id="pubContactMapIframe"
              title="Peta Lokasi Desa Wisata Karangkemiri"
              src="{{ $kontak->maps_embed ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.489368405458!2d109.1782712!3d-7.410963700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65609ae8b98401%3A0xac573850d62e937c!2sWahana%20Edukasi%20%26%20Outbond%20CANDI!5e0!3m2!1sid!2sid!4v1787295836593!5m2!1sid!2sid' }}"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              allowfullscreen>
            </iframe>
          </div>

          <div style="margin-top: 14px; display: flex; flex-direction: column; gap: 10px;">
            <!-- Tombol Buka di Aplikasi Google Maps -->
            <a id="pubContactMapBtn" href="{{ $kontak->maps_url ?: 'https://maps.app.goo.gl/VF9FUXXkzUoiD7YT8' }}" target="_blank" rel="noopener noreferrer" class="btn-admin-secondary" style="width: 100%; text-align: center; justify-content: center; gap: 8px;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              <span>Buka Petunjuk Arah di Google Maps</span>
            </a>

            <!-- Bottom CTA WhatsApp -->
            <a id="pubContactWaBtn" href="https://wa.me/{{ preg_replace('/\D/', '', $kontak->whatsapp ?: '6285702573013') }}?text=Halo%20Admin,%20saya%20mau%20reservasi" target="_blank" rel="noopener noreferrer" class="btn-cta-green">
              <span>Tanya / Reservasi via WhatsApp</span>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </main>
@endsection
