@extends('layouts.admin')

@section('title', 'Kelola Paket Wisata - Admin CMS Karangkemiri')
@section('admin_nav', 'paket')
@section('drawer_active', 'paket')

@section('content')
    <!-- Main Content: 07 • Paket Wisata -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Paket Wisata</span>
      </div>

      <div style="display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 18px;">
        <div>
          <h1 class="section-title" style="font-size: 32px;">Kelola Paket Wisata</h1>
          <p class="section-desc">Atur paket kunjungan, upload foto, fasilitas, aktivitas UMKM, dan status publikasi.</p>
        </div>
        <button type="button" class="btn-admin-primary" id="btnNewPackage">
          + Tambah Paket Baru
        </button>
      </div>

      <!-- 2-Column Web Layout: Daftar Paket (Kiri) & Formulir Paket (Kanan) -->
      <div class="admin-two-col">
        <!-- Kolom Kiri: Daftar Paket Wisata -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: -4px;">
            <div class="drawer-section-label" style="margin: 0;">DAFTAR PAKET TERDAFTAR</div>
            <span style="font-size: 12.5px; color: var(--text-muted);" id="pkgCountLabel">2 Paket</span>
          </div>

          <div id="adminPackageList" style="display: flex; flex-direction: column; gap: 14px;">
            <!-- Render dinamis oleh initAdminPackages() di app.js -->
            <!-- Paket 1 -->
            <div class="admin-item-card" data-admin-pkg-card="outbound">
              <div class="admin-item-left">
                <div class="admin-item-thumb" style="background-image: url('{{ asset('assets/images/paket-1.jpeg') }}'); background-size: cover; background-position: center;"></div>
                <div>
                  <div class="admin-item-title">Paket Outbound</div>
                  <div class="admin-item-sub">mulai Rp 100.000 ,- / Orang &bull; Candi Outbound</div>
                </div>
              </div>
              <div class="admin-item-right">
                <span class="badge-tayang" data-pkg-badge>Aktif</span>
                <div class="admin-card-actions">
                  <button type="button" class="admin-edit-link" data-edit-pkg="outbound" style="background: none; border: none; cursor: pointer;">
                    Edit &#10095;
                  </button>
                  <button type="button" class="admin-delete-link" data-delete-pkg="outbound">Hapus</button>
                </div>
              </div>
            </div>

            <!-- Paket 2 -->
            <div class="admin-item-card" data-admin-pkg-card="edukasi">
              <div class="admin-item-left">
                <div class="admin-item-thumb" style="background-image: url('{{ asset('assets/images/paket-edukasi-1.jpeg') }}'); background-size: cover; background-position: center;"></div>
                <div>
                  <div class="admin-item-title">Paket Edukasi</div>
                  <div class="admin-item-sub">mulai Rp 75.000 ,- / Orang &bull; Sentra UMKM</div>
                </div>
              </div>
              <div class="admin-item-right">
                <span class="badge-tayang" data-pkg-badge>Aktif</span>
                <div class="admin-card-actions">
                  <button type="button" class="admin-edit-link" data-edit-pkg="edukasi" style="background: none; border: none; cursor: pointer;">
                    Edit &#10095;
                  </button>
                  <button type="button" class="admin-delete-link" data-delete-pkg="edukasi">Hapus</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom Kanan: Formulir Tambah / Edit Paket -->
        <form id="formPaket" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box; min-width: 0;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; gap: 12px; flex-wrap: wrap;">
            <h2 class="admin-panel-title" id="pkgFormHeaderTitle" style="margin-bottom: 0;">Formulir paket wisata</h2>
            <span class="badge-category" id="pkgFormModeBadge" style="font-size: 11.5px; white-space: nowrap; flex-shrink: 0;">Mode: Edit Paket</span>
          </div>
          <p class="admin-panel-sub" id="pkgFormHeaderSub">Ubah detail paket kunjungan, foto, harga, dan ketentuan.</p>

          <input type="hidden" id="pkgFormId" value="outbound">

          <!-- Alert validasi / notifikasi -->
          <div id="pkgFormAlert" class="admin-alert" style="display: none; margin-bottom: 16px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span id="pkgFormAlertText">Periksa kembali data paket Anda.</span>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormName">Nama paket *</label>
            <input type="text" id="pkgFormName" class="admin-input" placeholder="Contoh: Paket Outbound Ceria" value="Paket Outbound" required>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="pkgFormPrice">Harga / keterangan *</label>
              <input type="text" id="pkgFormPrice" class="admin-input" placeholder="Contoh: mulai Rp 100.000 ,- / Orang" value="mulai Rp 100.000 ,- / Orang" required>
            </div>

            <div class="admin-form-group">
              <label for="pkgFormStatus">Status publikasi *</label>
              <select id="pkgFormStatus" class="admin-select" data-status-select>
                <option value="Aktif" selected>Aktif (Tayang di Website)</option>
                <option value="Nonaktif">Nonaktif (Draf / Sembunyi)</option>
              </select>
            </div>
          </div>

          <!-- Upload Foto Paket -->
          <div class="admin-form-group">
            <label>Foto paket wisata</label>
            <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
              <div style="width: 80px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-light); background: #eee; flex-shrink: 0;">
                <img id="pkgFormPhotoPreview" src="{{ asset('assets/images/paket-1.jpeg') }}" alt="Pratinjau Foto Paket" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <div style="flex: 1; min-width: 180px;">
                <input type="file" id="pkgFormPhotoInput" accept="image/*" style="display: none;">
                <button type="button" class="btn-admin-secondary" style="padding: 7px 14px; font-size: 13px;" onclick="document.getElementById('pkgFormPhotoInput').click();">
                  Pilih / Ganti Foto
                </button>
                <span id="pkgFormPhotoName" style="display: block; font-size: 11.5px; color: var(--text-muted); margin-top: 4px;">File default terpasang</span>
              </div>
            </div>
          </div>

          <div class="admin-form-grid">
            <!-- Destinasi Terkait -->
            <div class="admin-form-group">
              <label for="pkgFormDest">Destinasi terkait</label>
              <select id="pkgFormDest" class="admin-select">
                <option value="Wahana Edukasi &amp; Outbound Candi" selected>Wahana Edukasi &amp; Outbound Candi</option>
                <option value="Embung Prabawulan">Embung Prabawulan</option>
                <option value="Agro Kelengkeng Thabet">Agro Kelengkeng Thabet</option>
                <option value="Petilasan Mbah Siti Benter">Petilasan Mbah Siti Benter</option>
                <option value="Seluruh Kawasan Desa Karangkemiri">Seluruh Kawasan Desa</option>
              </select>
            </div>

            <!-- Aktivitas UMKM Terkait -->
            <div class="admin-form-group">
              <label for="pkgFormUmkm">Aktivitas UMKM terkait</label>
              <input type="text" id="pkgFormUmkm" class="admin-input" placeholder="Contoh: Pembuatan Tahu, Gula Jawa, Kriya Perca" value="Kriya Kain Perca &amp; Kerajinan Lokal">
            </div>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormWa">Nomor WhatsApp pemesanan</label>
            <input type="text" id="pkgFormWa" class="admin-input" placeholder="085702573013" value="0857 0257 3013" required>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormFacilities">Fasilitas paket (pisahkan dengan baris baru)</label>
            <textarea id="pkgFormFacilities" class="admin-textarea" rows="3" placeholder="Pilihan: Paket Edukasi Ceria, Team Building&#10;Wahana outbound, flying fox &amp; panahan&#10;Pendamping instruktur berpengalaman&#10;Penggunaan area outbound &amp; pendopo luas">Pilihan: Paket Edukasi Ceria, Team Building &amp; Petualang Muda&#10;Wahana outbound, flying fox, ketapel &amp; panahan&#10;Permainan kelompok &amp; pendamping instruktur berpengalaman&#10;Penggunaan area outbound &amp; pendopo luas</textarea>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormDesc">Deskripsi lengkap, kegiatan &amp; ketentuan</label>
            <textarea id="pkgFormDesc" class="admin-textarea" rows="3" placeholder="Tuliskan penjelasan kegiatan dalam paket..." required>Nikmati pengalaman seru penuh kebersamaan melalui Paket Outbound di Desa Wisata Karangkemiri. Beragam aktivitas menantang dan menyenangkan di alam terbuka yang dirancang untuk melatih kerja sama, kepemimpinan, dan kekompakan tim.</textarea>
          </div>

          <!-- Form Buttons Simetris -->
          <div class="admin-form-actions-bar">
            <div class="admin-form-actions-left">
              <button type="button" class="btn-admin-danger" id="btnDeleteCurrentPkg">
                Hapus
              </button>
            </div>
            <div class="admin-form-actions-right">
              <button type="button" class="btn-admin-secondary" id="btnCancelEdit" style="display: none;">
                Batal Edit
              </button>
              <button type="submit" class="btn-admin-primary">
                Simpan Paket
              </button>
            </div>
          </div>
        </form>
      </div>
    </main>
@endsection

