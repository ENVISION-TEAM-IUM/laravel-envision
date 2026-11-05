@extends('layouts.admin')

@section('title', 'Kelola Destinasi Wisata - Admin CMS Karangkemiri')
@section('admin_nav', 'destinasi')
@section('drawer_active', 'destinasi')

@section('content')
    <!-- Main Content: 05 • Kelola Destinasi -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Kelola Destinasi</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Kelola Destinasi Wisata</h1>
      <p class="section-desc" style="margin-bottom: 20px;">Semua tempat wisata yang dapat dilihat pengunjung.</p>

      <!-- Bar Pencarian & Tombol Tambah Destinasi (Web Layout) -->
      <div style="display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 22px;">
        <div style="flex: 1; min-width: 260px;">
          <label for="adminSearchDest" style="display: block; font-size: 13.5px; font-weight: 700; margin-bottom: 6px;">Cari destinasi</label>
          <input type="text" id="adminSearchDest" class="admin-input" placeholder="Ketik nama tempat wisata">
        </div>
        <a href="{{ url('/admin-edit-destinasi.html?slug=new') }}" class="btn-admin-primary" style="padding: 13.5px 24px;">
          + Tambah Destinasi
        </a>
      </div>

      <!-- Daftar 4 Destinasi (Grid 2 Kolom di Web) -->
      <div class="admin-items-grid">
        <!-- 1. Candi -->
        <div class="admin-item-card" data-admin-dest-item>
          <div class="admin-item-left">
            <div class="admin-item-thumb"></div>
            <div>
              <div class="admin-item-title">Wahana Edukasi &amp; Outbound Candi</div>
              <div class="admin-item-sub">Edukasi • Outbound</div>
            </div>
          </div>
          <div class="admin-item-right">
            <span class="badge-tayang" data-item-badge>Tayang</span>
            <div class="admin-card-actions">
              <a href="{{ url('/admin-edit-destinasi.html?slug=candi') }}" class="admin-edit-link">Edit &#10095;</a>
              <button type="button" class="admin-delete-link" data-delete-item="Wahana Edukasi & Outbound Candi">Hapus</button>
            </div>
          </div>
        </div>

        <!-- 2. Embung -->
        <div class="admin-item-card" data-admin-dest-item>
          <div class="admin-item-left">
            <div class="admin-item-thumb"></div>
            <div>
              <div class="admin-item-title">Embung Prabawulan</div>
              <div class="admin-item-sub">Wisata alam</div>
            </div>
          </div>
          <div class="admin-item-right">
            <span class="badge-tayang" data-item-badge>Tayang</span>
            <div class="admin-card-actions">
              <a href="{{ url('/admin-edit-destinasi.html?slug=embung') }}" class="admin-edit-link">Edit &#10095;</a>
              <button type="button" class="admin-delete-link" data-delete-item="Embung Prabawulan">Hapus</button>
            </div>
          </div>
        </div>

        <!-- 3. Agro Kelengkeng -->
        <div class="admin-item-card" data-admin-dest-item>
          <div class="admin-item-left">
            <div class="admin-item-thumb"></div>
            <div>
              <div class="admin-item-title">Agro Kelengkeng Thabet</div>
              <div class="admin-item-sub">Agrowisata</div>
            </div>
          </div>
          <div class="admin-item-right">
            <span class="badge-tayang" data-item-badge>Tayang</span>
            <div class="admin-card-actions">
              <a href="{{ url('/admin-edit-destinasi.html?slug=kelengkeng') }}" class="admin-edit-link">Edit &#10095;</a>
              <button type="button" class="admin-delete-link" data-delete-item="Agro Kelengkeng Thabet">Hapus</button>
            </div>
          </div>
        </div>

        <!-- 4. Petilasan -->
        <div class="admin-item-card" data-admin-dest-item>
          <div class="admin-item-left">
            <div class="admin-item-thumb"></div>
            <div>
              <div class="admin-item-title">Petilasan Mbah Siti Benter</div>
              <div class="admin-item-sub">Wisata budaya</div>
            </div>
          </div>
          <div class="admin-item-right">
            <span class="badge-tayang" data-item-badge>Tayang</span>
            <div class="admin-card-actions">
              <a href="{{ url('/admin-edit-destinasi.html?slug=petilasan') }}" class="admin-edit-link">Edit &#10095;</a>
              <button type="button" class="admin-delete-link" data-delete-item="Petilasan Mbah Siti Benter">Hapus</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Info Box: Mudah kok! -->
      <div class="admin-panel-card" style="margin-top: 24px; margin-bottom: 0;">
        <div style="font-size: 16px; font-weight: 800; color: var(--green-dark); margin-bottom: 6px;">Mudah kok!</div>
        <p style="font-size: 14px; color: var(--text-muted);">
          Tekan Edit untuk memperbarui informasi. Tekan Tambah Destinasi untuk menambah tempat baru.
        </p>
      </div>
    </main>
@endsection

