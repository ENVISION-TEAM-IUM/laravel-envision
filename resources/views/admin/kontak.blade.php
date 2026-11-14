@extends('layouts.admin')

@section('title', 'Edit Kontak & Lokasi - Admin CMS Karangkemiri')
@section('admin_nav', 'kontak')
@section('drawer_active', 'kontak')

@section('content')
    <!-- Main Content: 09 • Kontak & Lokasi -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Kontak &amp; Lokasi</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Edit Kontak &amp; Lokasi</h1>
      <p class="section-desc">Pengaturan kontak resmi BUMDes, tautan Google Maps interaktif, nomor WhatsApp, dan akun media sosial desa.</p>

      @if (session('success'))
        <div class="admin-alert" style="display: flex; background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="admin-alert" style="display: flex; background: #ffebee; border: 1px solid #ffcdd2; color: #c62828; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="adminContactForm" action="{{ route('admin.kontak.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="admin-two-col">
          <!-- Kolom Kiri: Form Kontak -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Informasi Kontak Resmi BUMDes</h2>
            <p class="admin-panel-sub">Informasi ini otomatis tampil di halaman Kontak publik dan footer website.</p>

            <div class="admin-form-group">
              <label for="contactAddr">Alamat Lengkap Kantor / Sekretariat</label>
              <textarea id="contactAddr" name="address" class="admin-textarea" rows="2" style="resize: vertical; line-height: 1.5;" required>{{ old('address', $kontak->address) }}</textarea>
            </div>

            <div class="admin-form-grid">
              <div class="admin-form-group">
                <label for="contactWa">Nomor WhatsApp Utama</label>
                <input type="text" id="contactWa" name="whatsapp" class="admin-input" placeholder="Contoh: 0857 0257 3013" value="{{ old('whatsapp', $kontak->whatsapp) }}" required>
              </div>
              <div class="admin-form-group">
                <label for="contactEmail">Email Pengelola</label>
                <input type="email" id="contactEmail" name="email" class="admin-input" placeholder="contoh@email.com" value="{{ old('email', $kontak->email) }}" required>
              </div>
            </div>

            <div class="admin-form-group">
              <label for="contactHours">Jam Operasional Layanan</label>
              <input type="text" id="contactHours" name="hours" class="admin-input" placeholder="Senin–Minggu, 08.00–17.00 WIB" value="{{ old('hours', $kontak->hours) }}" required>
            </div>

            <div class="admin-form-group">
              <label for="contactMapUrl">Tautan Langsung Google Maps (Navigasi)</label>
              <input type="url" id="contactMapUrl" name="maps_url" class="admin-input" placeholder="https://maps.app.goo.gl/... atau tautan Google Maps" value="{{ old('maps_url', $kontak->maps_url) }}" required>
            </div>

            <div class="admin-form-group" style="margin-bottom: 24px;">
              <label for="contactMapEmbed">URL Embed Iframe Google Maps</label>
              <input type="text" id="contactMapEmbed" name="maps_embed" class="admin-input" placeholder="https://www.google.com/maps/embed?pb=..." value="{{ old('maps_embed', $kontak->maps_embed) }}">
            </div>

            <h3 class="admin-panel-title" style="font-size: 16px; padding-top: 18px; border-top: 1px dashed var(--border-light); margin-bottom: 6px;">Tautan Media Sosial Resmi</h3>
            <p class="admin-panel-sub" style="margin-bottom: 16px;">Tautan media sosial yang aktif akan otomatis ditampilkan pada kartu kontak publik.</p>

            <div class="admin-form-grid">
              <div class="admin-form-group">
                <label for="contactIg">Instagram URL</label>
                <input type="url" id="contactIg" name="instagram" class="admin-input" placeholder="https://instagram.com/desawisatakarangkemiri" value="{{ old('instagram', $kontak->instagram) }}">
              </div>
              <div class="admin-form-group">
                <label for="contactFb">Facebook URL</label>
                <input type="url" id="contactFb" name="facebook" class="admin-input" placeholder="https://facebook.com/desawisatakarangkemiri" value="{{ old('facebook', $kontak->facebook) }}">
              </div>
            </div>

            <div class="admin-form-grid" style="margin-bottom: 0;">
              <div class="admin-form-group">
                <label for="contactTiktok">TikTok URL</label>
                <input type="url" id="contactTiktok" name="tiktok" class="admin-input" placeholder="https://tiktok.com/@desawisatakarangkemiri" value="{{ old('tiktok', $kontak->tiktok) }}">
              </div>
              <div class="admin-form-group">
                <label for="contactYoutube">YouTube URL</label>
                <input type="url" id="contactYoutube" name="youtube" class="admin-input" placeholder="https://youtube.com/@desawisatakarangkemiri" value="{{ old('youtube', $kontak->youtube) }}">
              </div>
            </div>
          </div>

          <!-- Kolom Kanan: Pratinjau Lokasi & Verifikasi Kontak -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Pratinjau Peta &amp; Verifikasi Kontak</h2>
            <p class="admin-panel-sub">Pastikan peta dan tautan kontak berfungsi sebelum menyimpan.</p>

            <div class="map-embed-wrapper" style="margin-top: 12px; height: 260px; border-radius: 16px; overflow: hidden; border: 1px solid var(--border-light); box-shadow: var(--shadow-soft);">
              <iframe
                id="adminMapPreviewIframe"
                class="map-embed-iframe"
                style="height: 260px; width: 100%; border: 0;"
                title="Pratinjau Peta Lokasi Desa Wisata Karangkemiri"
                src="{{ $kontak->maps_embed ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.489368405458!2d109.1782712!3d-7.410963700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65609ae8b98401%3A0xac573850d62e937c!2sWahana%20Edukasi%20%26%20Outbond%20CANDI!5e0!3m2!1sid!2sid!4v1787295836593!5m2!1sid!2sid' }}"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen>
              </iframe>
            </div>

            <!-- Tombol Pengujian Langsung -->
            <div style="margin-top: 16px; display: flex; flex-direction: column; gap: 10px;">
              <a id="adminOpenMapBtn" href="{{ $kontak->maps_url ?: 'https://maps.app.goo.gl/VF9FUXXkzUoiD7YT8' }}" target="_blank" rel="noopener" class="btn-admin-secondary" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                <span>Uji Buka Tautan Google Maps</span>
              </a>

              <a id="adminTestWaBtn" href="https://wa.me/{{ preg_replace('/\D/', '', $kontak->whatsapp ?: '6285702573013') }}" target="_blank" rel="noopener" class="btn-cta-green" style="padding: 10px 16px; font-size: 14px; text-decoration: none; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 2c-5.516 0-9.999 4.486-9.999 10.001 0 1.766.461 3.489 1.338 5.008L2 22l5.125-1.344c1.471.801 3.129 1.224 4.904 1.224h.004c5.515 0 9.998-4.486 9.998-10.001 0-2.672-1.04-5.184-2.928-7.072C17.215 3.04 14.703 2 12.031 2zm0 18.215h-.003c-1.491 0-2.954-.401-4.233-1.159l-.304-.18-3.025.793.808-2.948-.198-.314a8.295 8.295 0 0 1-1.279-4.426c0-4.588 3.733-8.321 8.323-8.321 2.223 0 4.312.866 5.884 2.438a8.268 8.268 0 0 1 2.436 5.885c0 4.589-3.733 8.232-8.409 8.232zm4.565-6.228c-.25-.125-1.48-.73-1.709-.814-.229-.083-.396-.125-.563.125-.166.25-.646.814-.791.98-.146.167-.292.188-.542.063-.25-.125-1.055-.389-2.01-1.24-.743-.663-1.244-1.482-1.39-1.732-.146-.25-.016-.385.109-.51.112-.112.25-.292.375-.438.125-.146.166-.25.25-.417.083-.167.042-.313-.021-.438-.063-.125-.563-1.356-.771-1.856-.203-.487-.409-.421-.563-.429-.145-.007-.312-.009-.479-.009s-.438.063-.667.313c-.229.25-.875.855-.875 2.086s.896 2.419 1.021 2.586c.125.167 1.762 2.691 4.27 3.773.597.258 1.062.412 1.425.527.599.19 1.144.163 1.575.099.48-.072 1.48-.605 1.688-1.189.208-.584.208-1.084.146-1.189-.063-.104-.229-.167-.479-.292z"/></svg>
                <span>Uji Tautan WhatsApp</span>
              </a>
            </div>

            <!-- Ringkasan Live Preview -->
            <div style="margin-top: 18px; padding: 16px; background: var(--bg-canvas); border-radius: 12px; font-size: 13.5px; display: flex; flex-direction: column; gap: 8px; border: 1px solid var(--border-light);">
              <div style="font-weight: 700; color: var(--text-dark);">
                <span>Ringkasan Kontak Aktif di Website:</span>
              </div>
              <div><strong>WhatsApp:</strong> <span id="adminWaSummary">{{ $kontak->whatsapp }}</span></div>
              <div><strong>Email:</strong> <span id="adminEmailSummary">{{ $kontak->email }}</span></div>
              <div><strong>Jam:</strong> <span id="adminHoursSummary">{{ $kontak->hours }}</span></div>
              <div><strong>Medsos Aktif:</strong> <span id="adminSocialsSummary">{{ implode(', ', array_filter([$kontak->instagram ? 'Instagram' : null, $kontak->facebook ? 'Facebook' : null, $kontak->tiktok ? 'TikTok' : null, $kontak->youtube ? 'YouTube' : null])) ?: 'Belum diatur' }}</span></div>
            </div>
          </div>
        </div>

        <div class="admin-btn-row">
          <button type="submit" form="resetContactForm" id="btnResetContact" class="btn-admin-secondary" style="color: #B91C1C; margin-right: auto;" onclick="return confirm('Apakah Anda yakin ingin mengembalikan seluruh informasi kontak & lokasi ke data asli Karangkemiri?')">Reset ke Data Asli</button>
          <a href="{{ route('admin.dashboard') }}" class="btn-admin-secondary">Batal</a>
          <button type="submit" class="btn-admin-primary">Simpan Kontak &amp; Lokasi</button>
        </div>
      </form>
      <form id="resetContactForm" action="{{ route('admin.kontak.reset') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </main>
@endsection
