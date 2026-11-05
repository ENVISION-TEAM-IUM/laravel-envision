@extends('layouts.admin')

@section('title', 'Kelola Katalog & Profil UMKM - Admin CMS Karangkemiri')
@section('admin_nav', 'umkm')
@section('drawer_active', 'umkm')

@section('content')
    <!-- Main Content: 08 • Katalog & Profil UMKM -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Katalog UMKM</span>
      </div>

      <!-- Header Section -->
      <div style="display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 18px;">
        <div>
          <h1 class="section-title" style="font-size: 32px;">Kelola UMKM &amp; Produk</h1>
          <p class="section-desc">Admin dapat mengelola beberapa profil UMKM desa serta produk yang dijual oleh masing-masing pelaku UMKM.</p>
        </div>
      </div>

      <!-- Tab Switcher Bar: Produk UMKM vs Profil UMKM -->
      <div class="admin-tabs-bar" role="tablist">
        <button type="button" class="admin-tab-btn active" id="tabBtnProducts" role="tab" aria-selected="true">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
          <span>Daftar Produk UMKM</span>
        </button>
        <button type="button" class="admin-tab-btn" id="tabBtnProfiles" role="tab" aria-selected="false">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          <span>Profil Pelaku UMKM Desa</span>
        </button>
      </div>

      <!-- ========================================================
           TAB 1: KELOLA PRODUK UMKM (Setiap UMKM memiliki banyak produk)
           ======================================================== -->
      <div id="tabContentProducts">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <label for="adminFilterProductByUmkm" style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); white-space: nowrap;">Filter UMKM:</label>
            <select id="adminFilterProductByUmkm" class="admin-select" style="width: 240px; min-width: 240px; max-width: 240px; padding: 7px 12px; font-size: 13.5px;">
              <option value="all">Semua UMKM</option>
              <!-- Diisi otomatis dari daftar profil UMKM -->
            </select>
          </div>
          <button type="button" class="btn-admin-primary" id="btnNewProduct">
            + Tambah Produk Baru
          </button>
        </div>

        <div class="admin-two-col">
          <!-- Kolom Kiri: Daftar Produk -->
          <div style="display: flex; flex-direction: column; gap: 14px; min-width: 0; width: 100%;" id="adminProductsListContainer">
            <!-- Rendered by JS -->
          </div>

          <!-- Kolom Kanan: Form Tambah / Edit Produk UMKM -->
          <div style="min-width: 0; width: 100%;">
            <form id="formUMKMProduct" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box;">
              <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 6px; flex-wrap: wrap;">
                <h2 class="admin-panel-title" id="prodFormHeaderTitle" style="margin-bottom: 0;">Edit Produk UMKM</h2>
                <span class="badge-tayang" id="prodFormModeBadge" style="white-space: nowrap; flex-shrink: 0;">Mode: Edit</span>
              </div>
              <p class="admin-panel-sub" id="prodFormHeaderSub">Perbarui data produk, foto, harga, serta relasi UMKM pemiliknya.</p>

              <input type="hidden" id="prodFormId" value="">

              <!-- Relasi ke UMKM -->
              <div class="admin-form-group">
                <label for="prodFormUmkmId">UMKM Pemilik Produk *</label>
                <select id="prodFormUmkmId" class="admin-select" required>
                  <!-- Diisi otomatis dari daftar profil UMKM -->
                </select>
                <span style="display: block; font-size: 12px; color: var(--text-muted); margin-top: 4px;">Pilih UMKM yang memproduksi barang ini. Kontak pemesanan akan otomatis diarahkan ke WhatsApp UMKM ini.</span>
              </div>

              <!-- Nama Produk -->
              <div class="admin-form-group">
                <label for="prodFormName">Nama Produk *</label>
                <input type="text" id="prodFormName" class="admin-input" placeholder="Contoh: Tahu Karangkemiri Super" required>
              </div>

              <!-- Kategori & Status -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="prodFormCat">Kategori Produk *</label>
                  <select id="prodFormCat" class="admin-select">
                    <option value="makanan">Makanan Olahan</option>
                    <option value="kerajinan">Kerajinan Tangan</option>
                    <option value="tani">Hasil Pertanian / Ternak</option>
                    <option value="lokal">Produk Lokal Lainnya</option>
                  </select>
                </div>
                <div class="admin-form-group">
                  <label for="prodFormStatus">Status Publikasi *</label>
                  <select id="prodFormStatus" class="admin-select">
                    <option value="Tayang">Tayang (Aktif di Katalog)</option>
                    <option value="Nonaktif">Nonaktif (Stok Kosong / Arsip)</option>
                    <option value="Draf">Draf (Belum Tayang)</option>
                  </select>
                  <span style="display: block; font-size: 11.5px; color: var(--text-muted); margin-top: 3px;">Pilih <strong>Nonaktif</strong> bila stok habis agar tidak tampil di website publik.</span>
                </div>
              </div>

              <!-- Harga Produk -->
              <div class="admin-form-group">
                <label for="prodFormPrice">Harga / Keterangan Harga *</label>
                <input type="text" id="prodFormPrice" class="admin-input" placeholder="Contoh: Rp 15.000 / bungkus atau Hubungi Penjual" required>
              </div>

              <!-- Pengelolaan Foto Produk -->
              <div class="admin-form-group">
                <label>Foto Produk</label>
                <div style="display: flex; gap: 14px; align-items: center; margin-top: 6px;">
                  <div style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #eef3ec; border: 1px solid var(--border-light); flex-shrink: 0;">
                    <img id="prodFormPhotoPreview" src="/assets/images/paket-1.jpeg" alt="Pratinjau Foto Produk" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <div style="flex: 1;">
                    <input type="file" id="prodFormPhotoInput" accept="image/*" class="admin-input" style="padding: 7px; font-size: 12.5px;">
                    <span id="prodFormPhotoLabel" style="display: block; font-size: 11.5px; color: var(--text-muted); margin-top: 4px;">Pilih file JPG/PNG/WEBP (Maksimal 5MB).</span>
                  </div>
                </div>
              </div>

              <!-- Deskripsi Produk -->
              <div class="admin-form-group">
                <label for="prodFormDesc">Deskripsi Singkat Produk</label>
                <textarea id="prodFormDesc" class="admin-textarea" rows="3" style="resize: vertical;" placeholder="Deskripsi bahan, keunggulan, atau ukuran kemasan produk..."></textarea>
              </div>

              <!-- Form Buttons Simetris -->
              <div class="admin-form-actions-bar">
                <div class="admin-form-actions-left">
                  <button type="button" class="btn-admin-danger" id="btnDeleteProduct" style="display: inline-block;">
                    Hapus
                  </button>
                </div>
                <div class="admin-form-actions-right">
                  <button type="button" class="btn-admin-secondary" id="btnCancelProductEdit">
                    Batal
                  </button>
                  <button type="submit" class="btn-admin-primary">
                    Simpan Produk UMKM
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ========================================================
           TAB 2: KELOLA PROFIL UMKM (Profil Usaha, Alamat, WA, Jam Buka)
           ======================================================== -->
      <div id="tabContentProfiles" style="display: none;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
          <div>
            <h2 class="section-title" style="font-size: 20px; margin-bottom: 4px;">Daftar Pelaku UMKM Karangkemiri</h2>
            <p class="section-desc" style="margin-bottom: 0;">Setiap profil UMKM dapat menampung banyak produk dan nomor WhatsApp penjual.</p>
          </div>
          <button type="button" class="btn-admin-primary" id="btnNewUmkmProfile">
            + Tambah Profil UMKM Baru
          </button>
        </div>

        <div class="admin-two-col">
          <!-- Kolom Kiri: Daftar Profil UMKM -->
          <div style="display: flex; flex-direction: column; gap: 14px; min-width: 0; width: 100%;" id="adminUmkmProfilesListContainer">
            <!-- Rendered by JS -->
          </div>

          <!-- Kolom Kanan: Form Tambah / Edit Profil UMKM -->
          <div style="min-width: 0; width: 100%;">
            <form id="formUMKMProfile" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box;">
              <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 6px; flex-wrap: wrap;">
                <h2 class="admin-panel-title" id="umkmProfileFormTitle" style="margin-bottom: 0;">Edit Profil UMKM</h2>
                <span class="badge-tayang" id="umkmProfileFormModeBadge" style="white-space: nowrap; flex-shrink: 0;">Mode: Edit</span>
              </div>
              <p class="admin-panel-sub" id="umkmProfileFormSub">Lengkapi profil tempat usaha, kontak WhatsApp, dan jam operasional pengrajin/penjual.</p>

              <input type="hidden" id="umkmProfileId" value="">

              <!-- Nama Usaha UMKM -->
              <div class="admin-form-group">
                <label for="umkmProfileName">Nama Usaha / Merk UMKM *</label>
                <input type="text" id="umkmProfileName" class="admin-input" placeholder="Contoh: UMKM Sari Kedelai" required>
              </div>

              <!-- Nama Pemilik & Kategori Sektor -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="umkmProfileOwner">Nama Pemilik / Pengelola *</label>
                  <input type="text" id="umkmProfileOwner" class="admin-input" placeholder="Contoh: Ibu Siti Khodijah" required>
                </div>
                <div class="admin-form-group">
                  <label for="umkmProfileCat">Sektor Usaha *</label>
                  <select id="umkmProfileCat" class="admin-select">
                    <option value="Makanan olahan">Makanan Olahan</option>
                    <option value="Produk lokal">Produk Lokal</option>
                    <option value="Kerajinan tangan">Kerajinan Tangan</option>
                    <option value="Hasil pertanian">Hasil Pertanian / Ternak</option>
                  </select>
                </div>
              </div>

              <!-- WhatsApp & Jam Buka -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="umkmProfileWa">Kontak WhatsApp Penjual *</label>
                  <input type="text" id="umkmProfileWa" class="admin-input" placeholder="08xxxxxxxxxx" required>
                  <span style="display: block; font-size: 11.5px; color: var(--text-muted); margin-top: 3px;">Pemesanan produk dari UMKM ini akan masuk ke nomor WhatsApp ini.</span>
                </div>
                <div class="admin-form-group">
                  <label for="umkmProfileHours">Jam Operasional Layanan *</label>
                  <input type="text" id="umkmProfileHours" class="admin-input" placeholder="Contoh: Setiap Hari, 07:00 – 17:00 WIB" required>
                </div>
              </div>

              <!-- Alamat Lengkap -->
              <div class="admin-form-group">
                <label for="umkmProfileAddress">Alamat Lengkap / Dusun *</label>
                <textarea id="umkmProfileAddress" class="admin-textarea" rows="2" style="resize: vertical;" placeholder="RT 03 / RW 01 Dusun Karang Jengkol, Desa Karangkemiri..." required></textarea>
              </div>

              <!-- Deskripsi Usaha -->
              <div class="admin-form-group">
                <label for="umkmProfileDesc">Deskripsi Usaha</label>
                <textarea id="umkmProfileDesc" class="admin-textarea" rows="3" style="resize: vertical;" placeholder="Cerita singkat usaha, sejarah produksi, atau keunggulan produk UMKM..."></textarea>
              </div>

              <!-- Form Buttons Simetris -->
              <div class="admin-form-actions-bar">
                <div class="admin-form-actions-left">
                  <button type="button" class="btn-admin-danger" id="btnDeleteUmkmProfile" style="display: inline-block;">
                    Hapus
                  </button>
                </div>
                <div class="admin-form-actions-right">
                  <button type="button" class="btn-admin-secondary" id="btnCancelUmkmProfileEdit">
                    Batal
                  </button>
                  <button type="submit" class="btn-admin-primary">
                    Simpan Profil UMKM
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
