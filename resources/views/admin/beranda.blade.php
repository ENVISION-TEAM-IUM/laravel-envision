@extends('layouts.admin')

@section('title', 'Edit Halaman Beranda - Admin CMS Karangkemiri')
@section('admin_nav', 'beranda')
@section('drawer_active', 'beranda')

@section('content')
    <!-- Main Content: 03 • Beranda Website -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Beranda Website</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Edit halaman Beranda</h1>
      <p class="section-desc">Ubah teks yang tampil di halaman depan pengunjung.</p>

      <form data-admin-save-form data-save-msg="Perubahan halaman Beranda berhasil disimpan!">
        <div class="admin-two-col">
          <!-- Kolom Kiri: Bagian utama halaman -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Bagian utama halaman</h2>

            <div class="admin-form-group">
              <label for="homeHeroTitle">Judul besar</label>
              <input type="text" id="homeHeroTitle" class="admin-input" value="Jelajahi Desa Wisata Karangkemiri" required>
            </div>

            <div class="admin-form-group">
              <label for="homeHeroSub">Kalimat pengantar</label>
              <input type="text" id="homeHeroSub" class="admin-input" value="Wisata alam, edukasi, budaya, dan produk lokal" required>
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="homeBtnText">Teks tombol</label>
              <input type="text" id="homeBtnText" class="admin-input" value="Reservasi Sekarang" required>
            </div>
          </div>

          <!-- Kolom Kanan: Destinasi unggulan -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Destinasi unggulan</h2>
            <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 16px;">
              Pilih destinasi yang ingin ditampilkan di halaman depan.
            </p>

            <div style="display: flex; flex-direction: column; gap: 14px;">
              <!-- Item 1 -->
              <div class="admin-item-card">
                <div class="admin-item-left">
                  <div class="admin-item-thumb"></div>
                  <div>
                    <div class="admin-item-title">Wahana Edukasi &amp; Outbound Candi</div>
                    <div class="admin-item-sub">Tampil di beranda</div>
                  </div>
                </div>
                <div class="admin-item-right">
                  <span class="badge-tayang">Tayang</span>
                  <a href="{{ url('/admin-edit-destinasi.html?slug=candi') }}" class="admin-edit-link">Ubah &#10095;</a>
                </div>
              </div>

              <!-- Item 2 -->
              <div class="admin-item-card">
                <div class="admin-item-left">
                  <div class="admin-item-thumb"></div>
                  <div>
                    <div class="admin-item-title">Embung Prabawulan</div>
                    <div class="admin-item-sub">Tampil di beranda</div>
                  </div>
                </div>
                <div class="admin-item-right">
                  <span class="badge-tayang">Tayang</span>
                  <a href="{{ url('/admin-edit-destinasi.html?slug=embung') }}" class="admin-edit-link">Ubah &#10095;</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <p class="admin-tip-text">Tips: gunakan kalimat pendek agar nyaman dibaca di HP.</p>

        <div class="admin-btn-row">
          <a href="{{ url('/admin-pratinjau.html') }}" class="btn-admin-secondary">Lihat Pratinjau</a>
          <button type="submit" class="btn-admin-primary">Simpan Perubahan</button>
        </div>
      </form>
    </main>
@endsection

