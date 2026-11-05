@extends('layouts.admin')

@section('title', 'Edit Informasi Destinasi - Admin CMS Karangkemiri')
@section('admin_nav', 'destinasi')
@section('drawer_active', 'edit-destinasi')

@section('content')
    <!-- Main Content: 06 • Edit Detail Destinasi -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <a href="{{ url('/admin-destinasi.html') }}">Kelola Destinasi</a> &nbsp;/&nbsp; <span>Edit Detail Destinasi</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Edit Informasi Destinasi</h1>
      <p class="section-desc" style="margin-bottom: 20px;">Isi kolom yang tersedia. Kolom bertanda * wajib diisi.</p>

      <form id="adminEditDestForm" data-admin-save-form data-save-msg="Data destinasi wisata berhasil disimpan!" data-redirect="admin-destinasi.html">
        <!-- Foto Destinasi Box -->
        <div class="admin-photo-box">
          <div class="admin-photo-left">
            <div class="admin-photo-thumb">FOTO</div>
            <div>
              <div style="font-size: 17px; font-weight: 800; color: var(--text-dark);">Foto destinasi *</div>
              <div style="font-size: 13.5px; color: var(--text-muted); margin-top: 4px;">Pilih foto yang jelas dan sesuai (Maks. 5 MB).</div>
            </div>
          </div>
          <label class="btn-admin-secondary" style="cursor: pointer;">
            <span>Ganti</span>
            <input type="file" accept="image/*" style="display: none;" onchange="showCustomPopup('Foto Dipilih', 'Foto destinasi berhasil dipilih: ' + (this.files[0] ? this.files[0].name : ''), 'Lanjutkan')">
          </label>
        </div>

        <!-- Form Input Fields (Web 2-Column Layout) -->
        <div class="admin-panel-card">
          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="inputDestName">Nama destinasi *</label>
              <input type="text" id="inputDestName" class="admin-input" placeholder="Wahana Edukasi & Outbound Candi" value="Wahana Edukasi & Outbound Candi" required>
            </div>

            <div class="admin-form-group">
              <label for="inputDestCategory">Kategori *</label>
              <input type="text" id="inputDestCategory" class="admin-input" placeholder="Edukasi / Outbound" value="Edukasi / Outbound" required>
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="inputDestLocation">Lokasi</label>
              <input type="text" id="inputDestLocation" class="admin-input" placeholder="Alamat atau patokan lokasi" value="Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas">
            </div>

            <div class="admin-form-group">
              <label for="inputDestHours">Jam buka</label>
              <input type="text" id="inputDestHours" class="admin-input" placeholder="Contoh: Senin–Ahad, 09.00–17.00" value="Senin–Ahad, 08.00–17.00 WIB">
            </div>
          </div>

          <div class="admin-form-group">
            <label for="inputDestDesc">Deskripsi destinasi *</label>
            <textarea id="inputDestDesc" class="admin-textarea" placeholder="Ceritakan daya tarik tempat ini..." required>Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, serta edukasi kelompok di area terbuka yang asri.</textarea>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="inputDestFacilities">Fasilitas</label>
              <input type="text" id="inputDestFacilities" class="admin-input" placeholder="Contoh: outbound, area parkir, toilet" value="Area Outbound Luas, Pendopo / Aula Kumpul, Toilet & Kamar Bilas, Mushola, Area Parkir Rombongan">
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="inputDestStatus">Status tampil *</label>
              <select id="inputDestStatus" class="admin-select">
                <option value="Tayang" selected>Tayang (Tampil di Website Publik)</option>
                <option value="Draf">Draf (Disimpan Sementara)</option>
                <option value="Sembunyikan">Sembunyikan (Nonaktif Sementara)</option>
              </select>
            </div>
          </div>
        </div>

        <div class="admin-btn-row" style="justify-content: space-between; flex-wrap: wrap;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ url('/admin-destinasi.html') }}" class="btn-admin-secondary">Batal</a>
            <button type="submit" class="btn-admin-primary">Simpan Destinasi</button>
          </div>
          <button type="button" class="btn-admin-danger" data-delete-from-form="inputDestName" data-delete-redirect="admin-destinasi.html">
            Hapus Destinasi
          </button>
        </div>
      </form>
    </main>
@endsection

