@extends('layouts.admin')

@section('title', 'Edit Profil Desa - Admin CMS Karangkemiri')
@section('admin_nav', 'profil')
@section('drawer_active', 'profil')

@section('content')
    <!-- Main Content: 04 • Formulir Pengelolaan Profil Desa melalui CMS -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/admin-dashboard.html') }}">Admin</a> &nbsp;/&nbsp; <span>Profil Desa</span>
      </div>

      <!-- Header & Status Publikasi -->
      <div style="display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 20px;">
        <div>
          <h1 class="section-title" style="font-size: 32px;">Edit Profil Desa</h1>
          <p class="section-desc" style="margin-bottom: 0;">Formulir pengelolaan profil, sejarah, visi, misi, struktur organisasi, serta foto pendukung Desa Wisata Karangkemiri.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
          <span class="badge-tayang" id="profStatusBadge">Tayang di Website</span>
          <span id="profLastSaved" style="font-size: 12.5px; color: var(--text-muted); font-weight: 600;">Tersinkronisasi</span>
        </div>
      </div>

      <!-- Alert Validasi Form Profil -->
      <div id="profFormAlert" class="admin-login-alert" style="display: none;" role="alert">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <span id="profFormAlertText"></span>
      </div>

      <form id="adminProfileForm" data-admin-save-form data-save-msg="Informasi Profil Desa berhasil diperbarui dan disinkronkan ke halaman publik!" novalidate>
        @csrf

        <!-- 1. Pengelolaan Struktur Organisasi serta Foto Pendukung -->
        <div class="admin-panel-card">
          <h2 class="admin-panel-title">1. Foto Utama, Struktur Organisasi &amp; Foto Pendukung</h2>
          <p class="admin-panel-sub">Kelola foto profil utama desa, bagan struktur organisasi unit wisata, serta foto pendukung kegiatan (Maks. 5 MB per foto).</p>

          <div style="display: flex; flex-direction: column; gap: 12px;">
            <!-- Foto Utama Desa Box -->
            <div class="admin-photo-box" style="margin-bottom: 0;">
              <div class="admin-photo-left" style="flex: 1; min-width: 0;">
                <div class="admin-photo-thumb" id="profMainPhotoThumb" style="overflow: hidden; padding: 0; position: relative; flex-shrink: 0;">
                  <img id="profMainPhotoPreview" src="{{ asset('assets/images/candi.png') }}" alt="Foto Utama Desa" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <div style="min-width: 0;">
                  <div style="font-size: 16px; font-weight: 800; color: var(--text-dark);">Foto utama desa *</div>
                  <div id="profMainPhotoName" style="font-size: 13px; color: var(--text-muted); margin-top: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">candi.png (Terverifikasi)</div>
                </div>
              </div>
              <label class="btn-admin-secondary" style="cursor: pointer; flex-shrink: 0; white-space: nowrap;">
                <span>Ganti Foto</span>
                <input type="file" id="profMainPhotoInput" name="main_photo" accept="image/jpeg,image/png,image/webp" style="display: none;">
              </label>
            </div>

            <!-- Foto Struktur Organisasi Unit Wisata Box -->
            <div class="admin-photo-box" style="margin-bottom: 0;">
              <div class="admin-photo-left" style="flex: 1; min-width: 0;">
                <div class="admin-photo-thumb" id="profStructPhotoThumb" style="overflow: hidden; padding: 0; position: relative; flex-shrink: 0;">
                  <img id="profStructPhotoPreview" src="{{ asset('assets/images/struktur-unit-wisata.png') }}" alt="Struktur Organisasi" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <div style="min-width: 0;">
                  <div style="font-size: 16px; font-weight: 800; color: var(--text-dark);">Bagan struktur organisasi *</div>
                  <div id="profStructPhotoName" style="font-size: 13px; color: var(--text-muted); margin-top: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">struktur-unit-wisata.png (Terverifikasi)</div>
                </div>
              </div>
              <label class="btn-admin-secondary" style="cursor: pointer; flex-shrink: 0; white-space: nowrap;">
                <span>Ganti Bagan</span>
                <input type="file" id="profStructPhotoInput" name="structure_photo" accept="image/jpeg,image/png,image/webp" style="display: none;">
              </label>
            </div>

            <!-- Foto Pendukung & Penghargaan Desa -->
            <div class="admin-photo-box" style="margin-bottom: 0;">
              <div class="admin-photo-left" style="flex: 1; min-width: 0;">
                <div class="admin-photo-thumb" id="profSupportPhotoThumb" style="overflow: hidden; padding: 0; position: relative; flex-shrink: 0;">
                  <img id="profSupportPhotoPreview" src="{{ asset('assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg') }}" alt="Penghargaan LDWN 2023" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <div style="min-width: 0;">
                  <div style="font-size: 16px; font-weight: 800; color: var(--text-dark);">Foto pendukung &amp; penghargaan desa</div>
                  <div id="profSupportPhotoName" style="font-size: 13px; color: var(--text-muted); margin-top: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg (Terverifikasi)</div>
                </div>
              </div>
              <label class="btn-admin-secondary" style="cursor: pointer; flex-shrink: 0; white-space: nowrap;">
                <span>Ganti Foto Pendukung</span>
                <input type="file" id="profSupportPhotoInput" name="support_photo" accept="image/jpeg,image/png,image/webp" style="display: none;">
              </label>
            </div>
          </div>
        </div>

        <!-- 2. Informasi Utama & Sejarah Desa -->
        <div class="admin-panel-card">
          <h2 class="admin-panel-title">2. Informasi Utama, Sejarah &amp; Aksesibilitas Desa</h2>
          <p class="admin-panel-sub">Konten resmi yang telah diverifikasi dari profil Desa Wisata Karangkemiri.</p>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="profTitle">Judul profil desa *</label>
              <input type="text" id="profTitle" name="title" class="admin-input" value="Profil Desa Wisata Karangkemiri" placeholder="Contoh: Profil Desa Wisata Karangkemiri" required>
            </div>

            <div class="admin-form-group">
              <label for="profHeroCaption">Caption banner utama *</label>
              <input type="text" id="profHeroCaption" name="hero_caption" class="admin-input" value="Mengenal desa kami" placeholder="Contoh: Mengenal desa kami" required>
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="profSummary">Ringkasan singkat desa *</label>
              <input type="text" id="profSummary" name="summary" class="admin-input" value="Pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi." placeholder="Ringkasan satu kalimat tentang desa" required>
            </div>

            <div class="admin-form-group">
              <label for="profStatus">Status publikasi halaman *</label>
              <select id="profStatus" name="status" class="admin-select">
                <option value="Tayang" selected>Tayang (Tampil di Website Publik)</option>
                <option value="Draf">Draf (Disimpan Sementara)</option>
              </select>
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="profHistory">Deskripsi &amp; sejarah desa wisata *</label>
              <textarea id="profHistory" name="history" class="admin-textarea" rows="5" placeholder="Tuliskan sejarah dan deskripsi desa." required>Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, sekitar 15 menit dari pusat Kota Purwokerto. Berada di kawasan pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk, desa ini menawarkan pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi.</textarea>
            </div>

            <div class="admin-form-group">
              <label for="profPotensiDesc">Keunikan potensi &amp; sejarah lokal *</label>
              <textarea id="profPotensiDesc" name="potensi_desc" class="admin-textarea" rows="5" placeholder="Tuliskan keunikan potensi alam dan situs sejarah desa." required>Keunikan Desa Wisata Karangkemiri terletak pada keberagaman potensi yang saling terintegrasi. Daya tarik utamanya meliputi Wahana Edukasi dan Outbound Candi dengan berbagai wahana rekreasi keluarga dan outbound, Embung Prabawulan sebagai ruang rekreasi dan pemancingan, serta Agro Kelengkeng Thabet yang mengangkat potensi pertanian unggulan desa. Desa ini juga memiliki kekayaan sejarah melalui Petilasan Mbah Siti Benter, Panembahan Mbah Suryangalam, dan Makam Buyut Mbah Mertajaya.</textarea>
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="profCultureDesc">Warisan budaya &amp; produk UMKM warga *</label>
              <textarea id="profCultureDesc" name="culture_desc" class="admin-textarea" rows="4" placeholder="Tuliskan tradisi budaya dan produk UMKM desa." required>Warisan budaya tetap lestari melalui tradisi Sedekah Bumi, Sadranan, Wayang Clebek, Lengger Banyumasan, Kenthongan, dan Hadroh. Wisatawan juga dapat menikmati produk UMKM dan home industry seperti peyek, gula jawa, tahu, anyaman bambu, serta kerajinan kain perca. Seluruh potensi tersebut dikelola oleh BUMDesa Mandiri Sejahtera bersama masyarakat sebagai wujud pengembangan pariwisata yang berkelanjutan, edukatif, dan berdampak pada peningkatan ekonomi desa.</textarea>
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="profAccess">Aksesibilitas &amp; rute perjalanan</label>
              <textarea id="profAccess" name="access_info" class="admin-textarea" rows="4" placeholder="Tuliskan kemudahan akses menuju lokasi desa wisata.">Desa Wisata Karangkemiri berlokasi di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, dengan akses yang mudah dijangkau menggunakan kendaraan pribadi maupun transportasi daring. Dari Stasiun Purwokerto, perjalanan menuju lokasi berjarak sekitar 7 km dengan waktu tempuh kurang lebih 15–20 menit. Dari Bandara Jenderal Besar Soedirman (Purbalingga) sekitar 45–60 menit, dan dari Yogyakarta International Airport (YIA) sekitar 3–4 jam. Akses jalan dalam kondisi baik dan dapat dilalui kendaraan roda dua, roda empat, maupun bus pariwisata.</textarea>
            </div>
          </div>
        </div>

        <!-- 3. Statistik & Identitas Pengelola -->
        <div class="admin-panel-card">
          <h2 class="admin-panel-title">3. Identitas Pengelola &amp; Kotak Statistik Profil</h2>
          <p class="admin-panel-sub">Ditampilkan pada kartu ringkasan hijau di bawah deskripsi Tentang Kami.</p>

          <div class="admin-form-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="profSince">Tahun berdiri (Sejak) *</label>
              <input type="text" id="profSince" name="since_year" class="admin-input" value="2017" placeholder="Contoh: 2017" required>
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="profManager">Lembaga pengelola *</label>
              <input type="text" id="profManager" name="manager" class="admin-input" value="BUMDesa Mandiri Sejahtera" placeholder="Contoh: BUMDesa Mandiri Sejahtera" required>
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="profFocus">Fokus pengembangan *</label>
              <input type="text" id="profFocus" name="focus" class="admin-input" value="Wisata & UMKM" placeholder="Contoh: Wisata & UMKM" required>
            </div>
          </div>
        </div>

        <!-- 4. Pengelolaan Visi, Misi & Tujuan -->
        <div class="admin-panel-card">
          <h2 class="admin-panel-title">4. Pengelolaan Visi, Misi &amp; Tujuan Desa Wisata</h2>
          <p class="admin-panel-sub">Mengatur pernyataan visi, daftar 6 misi pengembangan, serta tujuan Desa Wisata Karangkemiri.</p>

          <div class="admin-form-group">
            <label for="profVisionTitle">Judul bagian visi *</label>
            <input type="text" id="profVisionTitle" name="vision_title" class="admin-input" value="Visi" placeholder="Contoh: Visi" required>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="profVision">Visi desa wisata *</label>
              <textarea id="profVision" name="vision" class="admin-textarea" rows="3" placeholder="Tuliskan visi desa wisata." required>“Terwujudnya Desa Wisata Karangkemiri yang berbasis potensi lokal, dikelola bersama dengan semangat gotong royong, serta memberikan manfaat bagi masyarakat.”</textarea>
            </div>

            <div class="admin-form-group">
              <label for="profGoal">Tujuan pengembangan desa wisata *</label>
              <textarea id="profGoal" name="goal" class="admin-textarea" rows="3" placeholder="Tuliskan tujuan pengembangan desa wisata." required>Mengembangkan Desa Wisata Karangkemiri sebagai ruang wisata, belajar, dan berkegiatan berbasis potensi lokal melalui keterlibatan dan gotong royong masyarakat, sehingga memberikan pengalaman yang baik bagi pengunjung serta manfaat bagi masyarakat desa.</textarea>
            </div>
          </div>

          <div class="admin-form-group" style="margin-bottom: 0;">
            <label for="profMission">Misi pengembangan desa (Satu poin misi per baris) *</label>
            <textarea id="profMission" name="mission" class="admin-textarea" rows="6" placeholder="Tuliskan poin-poin misi, pisahkan dengan baris baru (Enter)." required>Mengembangkan potensi lokal berupa alam, budaya, sejarah, pertanian, dan kearifan masyarakat sebagai daya tarik wisata.
Meningkatkan kualitas wisata melalui pelayanan, fasilitas, kegiatan edukasi, rekreasi, dan outbound yang aman dan nyaman.
Mendorong keterlibatan masyarakat dan generasi muda dalam pengelolaan dan pengembangan Desa Wisata.
Mendukung UMKM dan usaha masyarakat agar dapat tumbuh melalui kegiatan pariwisata.
Melestarikan budaya dan tradisi desa sebagai bagian dari identitas dan daya tarik wisata.
Membangun kerja sama dan gotong royong antara pengelola, masyarakat, pemerintah, pelaku usaha, dan berbagai pihak dalam mengembangkan pariwisata desa.</textarea>
          </div>
        </div>

        <!-- 5. Pratinjau Langsung (Live Preview) -->
        <div class="admin-panel-card" style="background: var(--bg-cream); border-color: var(--border-subtle);">
          <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px solid var(--border-subtle);">
            <div>
              <h2 class="admin-panel-title" style="margin-bottom: 2px;">Pratinjau Langsung Halaman Profil Publik</h2>
              <p class="admin-panel-sub" style="margin-bottom: 0;">Perubahan konten tampil langsung pada website publik tanpa perubahan source code.</p>
            </div>
            <span class="badge-tayang" id="previewBadgeStatus">Status: Tayang</span>
          </div>

          <div style="background: var(--bg-white); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 20px;">
            <h3 id="previewProfTitle" style="font-size: 24px; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Profil Desa Wisata Karangkemiri</h3>
            <p id="previewProfHistory" style="font-size: 14.5px; color: var(--text-body); line-height: 1.6; margin-bottom: 16px;">
              Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, sekitar 15 menit dari pusat Kota Purwokerto. Berada di kawasan pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk, desa ini menawarkan pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi.
            </p>

            <div class="profile-stats-card" style="margin-top: 12px; margin-bottom: 18px;">
              <div class="stat-since">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--green-dark);">
                  <rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <div style="color: var(--green-dark); line-height: 1.25;">
                  <div style="font-size: 13px; font-weight: 500;">Sejak</div>
                  <div id="previewProfSince" style="font-size: 16px; font-weight: 800;">2017</div>
                </div>
              </div>

              <div class="stat-item">
                <div>PENGELOLA</div>
                <div id="previewProfManager">BUMDesa Mandiri Sejahtera</div>
              </div>

              <div class="stat-item">
                <div>FOKUS</div>
                <div id="previewProfFocus">Wisata &amp; UMKM</div>
              </div>
            </div>

            <h4 id="previewProfVisionTitle" style="font-size: 19px; font-weight: 800; color: var(--text-dark); margin-bottom: 6px;">Visi</h4>
            <p id="previewProfVision" style="font-size: 14.5px; font-weight: 600; color: var(--green-dark); line-height: 1.6; margin-bottom: 12px;">
              “Terwujudnya Desa Wisata Karangkemiri yang berbasis potensi lokal, dikelola bersama dengan semangat gotong royong, serta memberikan manfaat bagi masyarakat.”
            </p>
            <ul id="previewProfMissionList" class="pkg-checklist" style="font-size: 13.5px; color: var(--text-body); margin-bottom: 0;"></ul>
          </div>
        </div>

        <!-- Baris Tombol Aksi Simetris -->
        <div class="admin-form-actions-bar">
          <div class="admin-form-actions-left">
            <button type="button" id="resetProfileBtn" class="btn-admin-secondary">Reset ke Awal</button>
            <a href="{{ url('/admin-pratinjau.html') }}" class="btn-admin-secondary">Lihat Pratinjau</a>
          </div>
          <div class="admin-form-actions-right">
            <a href="{{ url('/admin-kontak.html') }}" class="btn-admin-secondary">Edit Kontak &#10095;</a>
            <button type="submit" class="btn-admin-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </main>
@endsection
