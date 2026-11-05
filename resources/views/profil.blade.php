@extends('layouts.app')

@section('title', 'Profil Desa Wisata - Desa Wisata Karangkemiri')
@section('nav_active', 'profil')

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

    <!-- Main Content: 02 Profil Desa Wisata -->
    <main class="page-container" style="padding-top: 12px;">
      <!-- Hero Banner dengan Foto Asli Desa Wisata Karangkemiri -->
      <section class="hero-card hero-subpage" id="pubProfHeroCard" style="background-image: linear-gradient(180deg, rgba(14, 68, 33, 0.35) 0%, rgba(14, 68, 33, 0.82) 100%), url('{{ asset('assets/images/desa-wisata-karangkemiri-2.jpeg') }}'); background-size: cover; background-position: center;">
        <span class="hero-caption" id="pubProfHeroCaption">Mengenal desa kami</span>
      </section>

      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; <span>Profil Desa Wisata</span>
      </div>

      <!-- Tentang Kami & Sejarah Desa (Layout Padat & Seimbang Tanpa Space Kosong) -->
      <section>
        <h1 class="section-title" id="pubProfTitle" style="margin-bottom: 18px;">Profil Desa Wisata Karangkemiri</h1>

        <!-- Baris 1: Foto Utama Sejajar dengan Sejarah Desa & Kartu Statistik Singkat -->
        <div class="profile-two-col">
          <!-- Kolom Kiri: Foto Utama Bersebelahan Rapi -->
          <div class="profile-main-img-box">
            <img id="pubProfMainImg" src="{{ asset('assets/images/candi.png') }}" alt="Profil Desa Wisata Karangkemiri">
          </div>

          <!-- Kolom Kanan: Pengantar Sejarah & Kartu Statistik Terintegrasi -->
          <div style="display: flex; flex-direction: column; justify-content: space-between; gap: 14px; height: 100%;">
            <div class="admin-panel-card" style="margin-bottom: 0; height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
              <div>
                <p id="pubProfHistory" style="font-size: 15px; color: var(--text-body); line-height: 1.7; margin-bottom: 0;">
                  Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, sekitar 15 menit dari pusat Kota Purwokerto. Berada di kawasan pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk, desa ini menawarkan pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi.
                </p>
              </div>

              <!-- Stats Box Terintegrasi Pas di Bawah Teks (Mengisi Ruang Bawah) -->
              <div class="profile-stats-card" style="margin-top: 16px; margin-bottom: 0;">
                <div class="stat-since">
                  <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#145A2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="3" ry="3"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                  </svg>
                  <div style="color: var(--green-dark); line-height: 1.25;">
                    <div style="font-size: 13px; font-weight: 500;">Sejak</div>
                    <div id="pubProfSince" style="font-size: 16.5px; font-weight: 800;">2017</div>
                  </div>
                </div>

                <div class="stat-item">
                  <div>PENGELOLA</div>
                  <div id="pubProfManager">BUMDesa Mandiri Sejahtera</div>
                </div>

                <div class="stat-item">
                  <div>FOKUS</div>
                  <div id="pubProfFocus">Wisata &amp; UMKM</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Baris 2: Dua Kartu Seimbang (Keberagaman Potensi & Kelestarian Budaya/UMKM) -->
        <div class="profile-two-col">
          <!-- Kartu 1: Keberagaman Potensi -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
              <h2 class="section-title" style="font-size: 18px; margin-bottom: 0;">Keberagaman Potensi &amp; Rekreasi</h2>
            </div>
            <p id="pubProfPotensiDesc" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0; flex: 1;">
              Keunikan Desa Wisata Karangkemiri terletak pada keberagaman potensi yang saling terintegrasi. Daya tarik utamanya meliputi Wahana Edukasi dan Outbound Candi dengan berbagai wahana rekreasi keluarga dan outbound, Embung Prabawulan sebagai ruang rekreasi dan pemancingan, serta Agro Kelengkeng Thabet yang mengangkat potensi pertanian unggulan desa. Desa ini juga memiliki kekayaan sejarah melalui Petilasan Mbah Siti Benter, Panembahan Mbah Suryangalam, dan Makam Buyut Mbah Mertajaya.
            </p>
          </div>

          <!-- Kartu 2: Kelestarian Budaya & UMKM -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
            <div style="margin-bottom: 10px;">
              <h2 class="section-title" style="font-size: 18px; margin-bottom: 0;">Warisan Seni, Budaya &amp; Produk UMKM</h2>
            </div>
            <p id="pubProfCultureDesc" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0; flex: 1;">
              Warisan budaya tetap lestari melalui tradisi Sedekah Bumi, Sadranan, Wayang Clebek, Lengger Banyumasan, Kenthongan, dan Hadroh. Wisatawan juga dapat menikmati produk UMKM dan home industry seperti peyek, gula jawa, tahu, anyaman bambu, serta kerajinan kain perca. Seluruh potensi tersebut dikelola oleh BUMDesa Mandiri Sejahtera bersama masyarakat sebagai wujud pengembangan pariwisata yang berkelanjutan, edukatif, dan berdampak pada peningkatan ekonomi desa.
            </p>
          </div>
        </div>
      </section>

      <!-- Akses Mudah, Perjalanan Nyaman -->
      <section style="margin-top: 24px;">
        <div class="admin-panel-card" style="margin-bottom: 0;">
          <h2 class="section-title" style="font-size: 22px; margin-bottom: 10px;">Akses Mudah, Perjalanan Nyaman</h2>
          <p id="pubProfAccess" style="font-size: 14.5px; color: var(--text-body); line-height: 1.7; margin-bottom: 0;">
            Desa Wisata Karangkemiri berlokasi di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, dengan akses yang mudah dijangkau menggunakan kendaraan pribadi maupun transportasi daring. Dari Stasiun Purwokerto, perjalanan menuju lokasi berjarak sekitar 7 km dengan waktu tempuh kurang lebih 15–20 menit menggunakan taksi online, ojek online, atau kendaraan sewa. Bagi wisatawan yang datang melalui Bandara Jenderal Besar Soedirman (Purbalingga), perjalanan menuju Desa Wisata Karangkemiri memerlukan waktu sekitar 45–60 menit melalui jalur darat. Sementara itu, dari Yogyakarta International Airport (YIA), waktu tempuh menuju lokasi sekitar 3–4 jam melalui jalur darat menuju Purwokerto, kemudian dilanjutkan ke Desa Karangkemiri. Akses jalan menuju Desa Wisata Karangkemiri dalam kondisi baik dan dapat dilalui kendaraan roda dua, roda empat, maupun bus pariwisata, sehingga memudahkan wisatawan individu maupun rombongan untuk berkunjung.
          </p>
        </div>
      </section>

      <!-- Visi, Misi & Tujuan -->
      <section style="margin-top: 24px;">
        <div class="profile-two-col">
          <!-- Visi & Tujuan -->
          <div class="admin-panel-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <h2 class="section-title" id="pubProfVisionTitle" style="font-size: 22px; margin-bottom: 10px;">Visi</h2>
              <p id="pubProfVision" style="font-size: 15px; font-weight: 600; color: var(--green-dark); line-height: 1.65; margin-bottom: 20px;">
                “Terwujudnya Desa Wisata Karangkemiri yang berbasis potensi lokal, dikelola bersama dengan semangat gotong royong, serta memberikan manfaat bagi masyarakat.”
              </p>
            </div>

            <div style="border-top: 1px solid var(--border-subtle); padding-top: 16px;">
              <h3 class="section-title" style="font-size: 18px; margin-bottom: 8px;">Tujuan</h3>
              <p id="pubProfGoal" style="font-size: 14px; color: var(--text-body); line-height: 1.65; margin-bottom: 0;">
                Mengembangkan Desa Wisata Karangkemiri sebagai ruang wisata, belajar, dan berkegiatan berbasis potensi lokal melalui keterlibatan dan gotong royong masyarakat, sehingga memberikan pengalaman yang baik bagi pengunjung serta manfaat bagi masyarakat desa.
              </p>
            </div>
          </div>

          <!-- Misi -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="section-title" style="font-size: 22px; margin-bottom: 12px;">Misi</h2>
            <ul id="pubProfMissionList" class="pkg-checklist" style="font-size: 14px; color: var(--text-body); line-height: 1.6; display: flex; flex-direction: column; gap: 10px;">
              <li>Mengembangkan potensi lokal berupa alam, budaya, sejarah, pertanian, dan kearifan masyarakat sebagai daya tarik wisata.</li>
              <li>Meningkatkan kualitas wisata melalui pelayanan, fasilitas, kegiatan edukasi, rekreasi, dan outbound yang aman dan nyaman.</li>
              <li>Mendorong keterlibatan masyarakat dan generasi muda dalam pengelolaan dan pengembangan Desa Wisata.</li>
              <li>Mendukung UMKM dan usaha masyarakat agar dapat tumbuh melalui kegiatan pariwisata.</li>
              <li>Melestarikan budaya dan tradisi desa sebagai bagian dari identitas dan daya tarik wisata.</li>
              <li>Membangun kerja sama dan gotong royong antara pengelola, masyarakat, pemerintah, pelaku usaha, dan berbagai pihak dalam mengembangkan pariwisata desa.</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Struktur Organisasi Unit Wisata -->
      <section style="margin-top: 24px;">
        <h2 class="section-title" style="margin-bottom: 14px;">Struktur Organisasi Unit Wisata</h2>
        <div class="admin-panel-card" style="padding: 20px; text-align: center; margin-bottom: 0;">
          <img id="pubProfStructImg" src="{{ asset('assets/images/struktur-unit-wisata.png') }}" alt="Struktur Organisasi Unit Wisata Desa Wisata Karangkemiri" style="width: 100%; max-width: 920px; height: auto; border-radius: 14px; display: inline-block;">
        </div>
      </section>

      <!-- Galeri Foto Pendukung Profil Desa -->
      <section style="margin-top: 24px;">
        <h2 class="section-title" style="margin-bottom: 14px;">Galeri Aktivitas &amp; Tradisi Desa</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px;">
          <div id="penghargaan" style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px; scroll-margin-top: 90px;">
            <img id="pubProfSupportImg1" src="{{ asset('assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg') }}" alt="Penghargaan LDWN Peringkat ke-13 Nasional 2023" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
            <img id="pubProfSupportImg2" src="{{ asset('assets/images/outbound.jpeg') }}" alt="Kegiatan Outbound Candi" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
            <img id="pubProfSupportImg3" src="{{ asset('assets/images/camping-ground.jpeg') }}" alt="Area Camping Ground &amp; Alam" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
          <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-subtle); background: var(--bg-white); height: 190px;">
            <img id="pubProfSupportImg4" src="{{ asset('assets/images/sadranan.jpeg') }}" alt="Tradisi Budaya Sadranan" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>
        </div>
      </section>
    </main>
@endsection
