@extends('layouts.admin')

@section('title', 'Dashboard Admin - Desa Wisata Karangkemiri')
@section('admin_nav', 'dashboard')
@section('drawer_active', 'dashboard')

@section('content')
    <!-- Main Content: 02 • Dashboard -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Dashboard</span>
      </div>

      <!-- Greeting -->
      <h1 class="section-title" style="font-size: 32px;">Halo, {{ Auth::guard('admin')->user()->name ?? 'Admin BUMDes' }}!</h1>
      <p class="section-desc">Pantau statistik kunjungan digital pengunjung serta Kelola isi website desa wisata secara mandiri.</p>

      <!-- 4 Ringkasan Konten CMS -->
      <div class="admin-stats-grid">
        <div class="admin-stat-card">
          <div class="admin-stat-num">{{ $totalKunjungan ?? 0 }}</div>
          <div class="admin-stat-label">Total Kunjungan Web</div>
        </div>
        <div class="admin-stat-card">
          <div class="admin-stat-num">{{ $totalDestinasi ?? 4 }}</div>
          <div class="admin-stat-label">Destinasi wisata</div>
        </div>
        <div class="admin-stat-card">
          <div class="admin-stat-num" id="dashTotalPackages" data-server-rendered="true">{{ $totalPaket ?? 0 }}</div>
          <div class="admin-stat-label">Paket wisata aktif</div>
        </div>
        <div class="admin-stat-card">
          <div class="admin-stat-num" id="dashTotalUmkm" data-server-rendered="true">{{ $totalUmkm ?? 0 }}</div>
          <div class="admin-stat-label">Unit UMKM terdaftar</div>
        </div>
      </div>

      <!-- Seksi Statistik Kunjungan Digital & Minat Pengunjung (Checklist Analitik) -->
      <section id="adminDashboardAnalytics" style="margin: 28px 0 32px;">
        <div style="display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 12px;">
          <div>
            <div class="eyebrow" style="color: var(--green-dark);">STATISTIK &amp; MINAT PENGUNJUNG</div>
            <h2 class="section-title" style="font-size: 24px; margin-bottom: 4px;">Kunjungan Digital Website</h2>
          </div>
          <!-- QA & Testing Controls -->
          <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
            <button type="button" class="btn-admin-secondary" id="btnSimulateVisit" style="padding: 6px 12px; font-size: 12.5px;">
              + Simulasi 1 Kunjungan
            </button>
            <button type="button" class="btn-admin-secondary" id="btnSimulateWa" style="padding: 6px 12px; font-size: 12.5px;">
              + Simulasi 1 Klik WA
            </button>
            <button type="button" class="btn-admin-secondary" id="btnResetAnalytics" style="padding: 6px 12px; font-size: 12.5px; color: #B91C1C;">
              Reset Data
            </button>
          </div>
        </div>

        <!-- Disclaimer Box sesuai batasan analitik -->
        <div class="admin-panel-card" style="background: var(--green-tint); border-color: rgba(20, 90, 50, 0.2); padding: 12px 18px; margin-bottom: 18px; border-radius: 14px;">
          <div style="font-size: 13px; color: var(--text-dark); line-height: 1.5;">
            <strong>Batasan Sistem Analitik:</strong> Angka ini mencatat statistik kunjungan digital dan interaksi pada website publik yang menjaga privasi pengunjung (tanpa melacak identitas pribadi). Statistik website tidak disamakan dengan jumlah wisatawan fisik atau reservasi resmi di lokasi.
          </div>
        </div>

        <!-- 4 Digital Metrics Cards -->
        <div class="admin-stats-grid" style="margin-bottom: 20px;">
          <div class="admin-stat-card">
            <div class="admin-stat-num" id="metricTotalViews">1.248</div>
            <div class="admin-stat-label">Total Tayangan Halaman (Page Views)</div>
          </div>
          <div class="admin-stat-card">
            <div class="admin-stat-num" id="metricUniqueVisitors">412</div>
            <div class="admin-stat-label">Estimasi Pengunjung Unik (Privasi Aman)</div>
          </div>
          <div class="admin-stat-card">
            <div class="admin-stat-num" id="metricTotalWa" style="color: #0E7490;">168</div>
            <div class="admin-stat-label">Minat Klik WhatsApp (Konversi Minat)</div>
          </div>
          <div class="admin-stat-card">
            <div class="admin-stat-num" id="metricAvgViews" style="color: #D97706;">3,0</div>
            <div class="admin-stat-label">Rata-rata Halaman per Pengunjung</div>
          </div>
        </div>

        <!-- 2 Kolom Rincian: Top Halaman (Kiri) & Top Minat WhatsApp (Kanan) -->
        <div class="admin-two-col">
          <!-- Kolom Kiri: Halaman Paling Banyak Dikunjungi -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
              <h3 class="admin-panel-title" style="margin-bottom: 0; font-size: 16px;">Halaman Paling Banyak Dikunjungi</h3>
              <span class="badge-tayang" style="font-size: 11px;">Ranking Halaman</span>
            </div>
            <p class="admin-panel-sub" style="font-size: 12.5px; margin-bottom: 16px;">Ringkasan minat pengunjung terhadap konten wisata dan produk desa.</p>

            <div id="analyticsTopPagesList" style="display: flex; flex-direction: column; gap: 14px;">
              <!-- Rendered by JS -->
            </div>
          </div>

          <!-- Kolom Kanan: Minat Interaksi Pengunjung (Klik WhatsApp) -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 14px; flex-wrap: wrap;">
              <h3 class="admin-panel-title" style="margin-bottom: 0; font-size: 16px;">Minat Interaksi Pengunjung (WhatsApp)</h3>
              <span class="badge-category" style="font-size: 11px; white-space: nowrap; flex-shrink: 0;">Tujuan Tanya Jawab</span>
            </div>
            <p class="admin-panel-sub" style="font-size: 12.5px; margin-bottom: 16px;">Pencatatan klik tombol WhatsApp saat pengunjung tertarik memesan atau bertanya.</p>

            <div id="analyticsTopWaList" style="display: flex; flex-direction: column; gap: 14px;">
              <!-- Rendered by JS -->
            </div>
          </div>
        </div>
      </section>

      <!-- Seksi Masukan & Evaluasi Layanan Pengunjung -->
      <section style="margin: 28px 0 32px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
          <div>
            <div class="eyebrow" style="color: var(--green-dark);">EVALUASI BUMDES</div>
            <h2 class="section-title" style="font-size: 22px; margin-bottom: 0;">Masukan Layanan Pengunjung ({{ $totalFeedback ?? 0 }})</h2>
          </div>
        </div>

        <div class="admin-panel-card" style="padding: 20px;">
          @forelse ($recentFeedbacks ?? [] as $fb)
            <div style="border-bottom: 1px solid var(--border-light); padding: 12px 0; {{ $loop->last ? 'border-bottom: none;' : '' }}">
              <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 6px;">
                <span style="font-weight: 700; color: var(--text-dark); font-size: 14.5px;">📍 {{ $fb->nama_destinasi }}</span>
                <span style="font-size: 12px; color: var(--text-muted);">{{ $fb->created_at?->diffForHumans() ?? 'Baru saja' }} {{ $fb->asal_kota ? '• ' . $fb->asal_kota : '' }}</span>
              </div>
              <div style="display: flex; gap: 14px; flex-wrap: wrap; font-size: 12.5px; color: var(--text-muted); margin-bottom: 6px;">
                <span>Fasilitas: <strong>{{ $fb->rating_fasilitas }}/5 ⭐</strong></span>
                <span>Kebersihan: <strong>{{ $fb->rating_kebersihan }}/5 ⭐</strong></span>
                <span>Pelayanan: <strong>{{ $fb->rating_pelayanan }}/5 ⭐</strong></span>
              </div>
              @if ($fb->komentar)
                <p style="font-size: 13.5px; color: var(--text-body); background: var(--surface-light, #f9fafb); padding: 8px 12px; border-radius: 8px; margin: 4px 0 0;">
                  "{{ $fb->komentar }}"
                </p>
              @endif
            </div>
          @empty
            <div style="text-align: center; padding: 24px 10px; color: var(--text-muted); font-size: 14px;">
              Belum ada masukan pengunjung yang masuk. Masukan akan otomatis tersimpan di database dan tampil di sini saat pengunjung mengirim evaluasi dari halaman detail destinasi.
            </div>
          @endforelse
        </div>
      </section>

      <!-- Menu Aksi: Mau mengubah apa hari ini? -->
      <section>
        <h2 class="section-title" style="font-size: 22px; margin-bottom: 14px;">Mau mengubah apa hari ini?</h2>

        <div class="admin-action-grid">
          <!-- 1. Edit Beranda -->
          <a href="{{ url('/admin-beranda.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Edit Beranda</div>
                <div class="admin-action-sub">Judul, banner, dan destinasi unggulan</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>

          <!-- 2. Kelola Destinasi -->
          <a href="{{ url('/admin-destinasi.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="9"></circle>
                  <circle cx="12" cy="12" r="5"></circle>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Kelola Destinasi</div>
                <div class="admin-action-sub">Nama tempat, foto, dan informasi</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>

          <!-- 3. Kelola Paket Wisata -->
          <a href="{{ url('/admin-paket.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                  <rect x="9" y="9" width="6" height="6"></rect>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Kelola Paket Wisata</div>
                <div class="admin-action-sub">Harga dan kegiatan dalam paket</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>

          <!-- 4. Kelola Produk & Profil UMKM -->
          <a href="{{ url('/admin-umkm.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="12 2 22 12 12 22 2 12 12 2"></polygon>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Kelola Produk &amp; Profil UMKM</div>
                <div class="admin-action-sub">Produk, pengrajin, dan kontak penjual</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>

          <!-- 5. Profil & Kontak -->
          <a href="{{ url('/admin-profil.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="7" r="7"></circle>
                  <line x1="12" y1="2" x2="12" y2="5"></line>
                  <line x1="12" y1="19" x2="12" y2="22"></line>
                  <line x1="2" y1="12" x2="5" y2="12"></line>
                  <line x1="19" y1="12" x2="22" y2="12"></line>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Profil &amp; Kontak</div>
                <div class="admin-action-sub">Informasi desa dan lokasi</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>

          <!-- 6. Pratinjau & Publikasi -->
          <a href="{{ url('/admin-pratinjau.html') }}" class="admin-action-card">
            <div class="admin-action-left">
              <div class="admin-action-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <div>
                <div class="admin-action-title">Pratinjau &amp; Publikasi</div>
                <div class="admin-action-sub">Periksa perubahan sebelum diterbitkan</div>
              </div>
            </div>
            <span class="admin-chevron">&#10095;</span>
          </a>
        </div>
      </section>
    </main>
@endsection
