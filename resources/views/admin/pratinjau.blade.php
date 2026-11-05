@extends('layouts.admin')

@section('title', 'Pratinjau & Publikasi - Admin CMS Karangkemiri')
@section('admin_nav', 'pratinjau')
@section('drawer_active', 'pratinjau')

@section('content')
    <!-- Main Content: 10 • Pratinjau & Publikasi -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Pratinjau &amp; Publikasi</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Periksa sebelum diterbitkan</h1>
      <p class="section-desc">Pastikan perubahan sudah benar sebelum tampil di website.</p>

      <!-- Banner Status Pemeriksaan -->
      <div class="admin-panel-card" style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 16px;">
          <div style="width: 48px; height: 48px; border-radius: 50%; background: var(--green-tint); color: var(--green-primary); display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; flex-shrink: 0;">
            &#10003;
          </div>
          <div>
            <div style="font-size: 18px; font-weight: 800; color: var(--text-dark);">Perubahan siap diperiksa</div>
            <div style="font-size: 14px; color: var(--text-muted); margin-top: 2px;">Lihat pratinjau sebelum menerbitkan.</div>
          </div>
        </div>
        <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="btn-preview-public">
          <span>Lihat Website Publik di Tab Baru</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
            <polyline points="15 3 21 3 21 9"></polyline>
            <line x1="10" y1="14" x2="21" y2="3"></line>
          </svg>
        </a>
      </div>

      <!-- 2 Kolom Web: Contoh Tampilan Pengunjung (Kiri) & Langkah Menerbitkan (Kanan) -->
      <div class="admin-two-col">
        <!-- Contoh tampilan pengunjung -->
        <div>
          <h2 class="section-title" style="font-size: 20px; margin-bottom: 12px;">Contoh tampilan pengunjung</h2>
          <div class="admin-panel-card" style="margin-bottom: 0; padding: 24px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px solid var(--border-subtle);">
              <div style="font-size: 14px; font-weight: 700; color: var(--text-muted);">Desa Wisata Karangkemiri</div>
              <span class="badge-tayang">Pratinjau Beranda</span>
            </div>

            <!-- Mini Hero Preview -->
            <div style="background: var(--green-primary); color: #ffffff; border-radius: 20px; padding: 28px 24px; margin-bottom: 16px;">
              <div style="font-size: 22px; font-weight: 800; line-height: 1.25; margin-bottom: 8px;">
                Jelajahi Desa Wisata Karangkemiri
              </div>
              <div style="font-size: 14px; color: rgba(255,255,255,0.88);">
                Wisata alam, edukasi, dan UMKM lokal
              </div>
            </div>

            <!-- Featured Destination Preview -->
            <div style="background: var(--bg-cream); border: 1px solid var(--border-subtle); border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
              <div>
                <div style="font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Destinasi unggulan</div>
                <div style="font-size: 15px; font-weight: 800; color: var(--text-dark); margin-top: 2px;">
                  Wahana Edukasi &amp; Outbound Candi
                </div>
              </div>
              <a href="{{ url('/detail-destinasi.html?slug=candi') }}" target="_blank" class="admin-edit-link">Lihat &#10095;</a>
            </div>
          </div>
        </div>

        <!-- Langkah menerbitkan -->
        <div>
          <h2 class="section-title" style="font-size: 20px; margin-bottom: 12px;">Langkah menerbitkan</h2>
          <div class="admin-panel-card" style="margin-bottom: 0; padding: 24px;">
            <div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 24px;">
              <div style="display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: var(--text-dark);">
                <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--green-tint); color: var(--green-primary); display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800;">1</span>
                <span>Periksa judul, foto, dan ejaan.</span>
              </div>
              <div style="display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: var(--text-dark);">
                <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--green-tint); color: var(--green-primary); display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800;">2</span>
                <span>Simpan sebagai draf jika belum siap.</span>
              </div>
              <div style="display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 700; color: var(--text-dark);">
                <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--green-tint); color: var(--green-primary); display: inline-flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 800;">3</span>
                <span>Tekan Terbitkan jika sudah disetujui.</span>
              </div>
            </div>

            <div class="admin-btn-row" style="margin-top: 0;">
              <button type="button" class="btn-admin-secondary" onclick="showCustomPopup('Tersimpan sebagai Draf', 'Perubahan berhasil disimpan sebagai Draf dan belum ditampilkan ke pengunjung.', 'Mengerti')">
                Simpan sebagai Draf
              </button>
              <button type="button" class="btn-admin-primary" onclick="showCustomPopup('Berhasil Diterbitkan!', 'Selamat! Seluruh perubahan berhasil diterbitkan ke Website Publik Desa Wisata Karangkemiri.', 'Selesai')">
                Terbitkan ke Website
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection

