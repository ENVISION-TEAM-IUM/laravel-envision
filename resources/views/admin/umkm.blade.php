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

      @php
        $currentTab = request('tab', $activeTab ?? 'products');
      @endphp

      <!-- Tab Switcher Bar: Produk UMKM vs Profil UMKM -->
      <div class="admin-tabs-bar" role="tablist">
        <a href="{{ route('admin.umkm.index', ['tab' => 'products']) }}" class="admin-tab-btn {{ $currentTab === 'products' ? 'active' : '' }}" style="text-decoration: none;">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
          <span>Daftar Produk UMKM</span>
        </a>
        <a href="{{ route('admin.umkm.index', ['tab' => 'profiles']) }}" class="admin-tab-btn {{ $currentTab === 'profiles' ? 'active' : '' }}" style="text-decoration: none;">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          <span>Profil Pelaku UMKM Desa</span>
        </a>
      </div>

      <!-- ========================================================
           TAB 1: KELOLA PRODUK UMKM
           ======================================================== -->
      <div id="tabContentProducts" style="{{ $currentTab === 'products' ? 'display: block;' : 'display: none;' }}">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <label for="adminFilterProductByUmkm" style="font-size: 13.5px; font-weight: 700; color: var(--text-dark); white-space: nowrap;">Filter UMKM:</label>
            <select id="adminFilterProductByUmkm" class="admin-select" style="width: 240px; min-width: 240px; max-width: 240px; padding: 7px 12px; font-size: 13.5px;" onchange="window.location.href='{{ route('admin.umkm.index') }}?tab=products&filter_umkm='+this.value">
              <option value="all" {{ request('filter_umkm') === 'all' || !request('filter_umkm') ? 'selected' : '' }}>Semua UMKM</option>
              @foreach ($umkmList as $u)
                <option value="{{ $u->id }}" {{ (string) request('filter_umkm') === (string) $u->id ? 'selected' : '' }}>{{ $u->nama_usaha }}</option>
              @endforeach
            </select>
          </div>
          <a href="{{ route('admin.umkm.index', ['tab' => 'products']) }}" class="btn-admin-primary" style="text-decoration: none;">
            + Tambah Produk Baru
          </a>
        </div>

        <div class="admin-two-col">
          <!-- Kolom Kiri: Daftar Produk -->
          <div style="display: flex; flex-direction: column; gap: 14px; min-width: 0; width: 100%;">
            @forelse ($products as $prod)
              <div class="admin-item-card" style="{{ isset($selectedProduct) && $selectedProduct && $selectedProduct->id === $prod->id ? 'border: 2px solid var(--green-dark); background: #f0fdf4;' : '' }}">
                <div class="admin-item-left">
                  <div class="admin-item-thumb" style="background-image: url('{{ asset($prod->foto ?: 'assets/images/paket-1.jpeg') }}'); background-size: cover; background-position: center;"></div>
                  <div>
                    <div class="admin-item-title">{{ $prod->nama_produk }}</div>
                    <div class="admin-item-sub">{{ $prod->harga }} &bull; {{ $prod->umkm->nama_usaha ?? 'UMKM Desa' }}</div>
                  </div>
                </div>
                <div class="admin-item-right">
                  <span class="badge-tayang">{{ $prod->status }}</span>
                  <div class="admin-card-actions">
                    <a href="{{ route('admin.umkm.index', ['tab' => 'products', 'edit_product' => $prod->slug]) }}" class="admin-edit-link" style="text-decoration: none;">Edit &#10095;</a>
                    <form action="{{ route('admin.umkm.produk.destroy', $prod->slug) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $prod->nama_produk }}?');" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="admin-delete-link" style="background: none; border: none; cursor: pointer;">Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="admin-panel-card" style="text-align: center; padding: 28px 16px;">
                <p style="font-size: 14px; color: var(--text-muted); margin: 0;">Belum ada produk UMKM.</p>
              </div>
            @endforelse
          </div>

          <!-- Kolom Kanan: Form Tambah / Edit Produk UMKM -->
          <div style="min-width: 0; width: 100%;">
            <form action="{{ isset($selectedProduct) && $selectedProduct ? route('admin.umkm.produk.update', $selectedProduct->slug) : route('admin.umkm.produk.store') }}" method="POST" enctype="multipart/form-data" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box;">
              @csrf
              @if (isset($selectedProduct) && $selectedProduct)
                @method('PUT')
              @endif

              <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 6px; flex-wrap: wrap;">
                <h2 class="admin-panel-title" style="margin-bottom: 0;">
                  {{ isset($selectedProduct) && $selectedProduct ? 'Edit Produk UMKM' : 'Tambah Produk Baru' }}
                </h2>
                <span class="badge-tayang" style="white-space: nowrap; flex-shrink: 0;">
                  Mode: {{ isset($selectedProduct) && $selectedProduct ? 'Edit' : 'Tambah' }}
                </span>
              </div>
              <p class="admin-panel-sub">Perbarui data produk, foto, harga, serta relasi UMKM pemiliknya.</p>

              <!-- Relasi ke UMKM -->
              <div class="admin-form-group">
                <label for="prodFormUmkmId">UMKM Pemilik Produk *</label>
                <select id="prodFormUmkmId" name="umkm_id" class="admin-select" required>
                  <option value="">-- Pilih UMKM Pemilik --</option>
                  @foreach ($umkmList as $u)
                    <option value="{{ $u->id }}" {{ (string) old('umkm_id', $selectedProduct->umkm_id ?? '') === (string) $u->id ? 'selected' : '' }}>
                      {{ $u->nama_usaha }} ({{ $u->nama_pemilik }})
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Nama Produk -->
              <div class="admin-form-group">
                <label for="prodFormName">Nama Produk *</label>
                <input type="text" id="prodFormName" name="nama_produk" class="admin-input" placeholder="Contoh: Tahu Karangkemiri Super" value="{{ old('nama_produk', $selectedProduct->nama_produk ?? '') }}" required>
              </div>

              <!-- Kategori & Status -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="prodFormCat">Kategori Produk *</label>
                  <select id="prodFormCat" name="kategori" class="admin-select">
                    @php $curProdCat = old('kategori', $selectedProduct->kategori ?? 'makanan'); @endphp
                    <option value="makanan" {{ $curProdCat === 'makanan' ? 'selected' : '' }}>Makanan Olahan</option>
                    <option value="kerajinan" {{ $curProdCat === 'kerajinan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                    <option value="tani" {{ $curProdCat === 'tani' ? 'selected' : '' }}>Hasil Pertanian / Ternak</option>
                    <option value="lokal" {{ $curProdCat === 'lokal' ? 'selected' : '' }}>Produk Lokal Lainnya</option>
                  </select>
                </div>
                <div class="admin-form-group">
                  <label for="prodFormStatus">Status Publikasi *</label>
                  <select id="prodFormStatus" name="status" class="admin-select">
                    @php $curProdStatus = old('status', $selectedProduct->status ?? 'Tayang'); @endphp
                    <option value="Tayang" {{ $curProdStatus === 'Tayang' ? 'selected' : '' }}>Tayang (Aktif di Katalog)</option>
                    <option value="Nonaktif" {{ $curProdStatus === 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Stok Kosong / Arsip)</option>
                    <option value="Draf" {{ $curProdStatus === 'Draf' ? 'selected' : '' }}>Draf (Belum Tayang)</option>
                  </select>
                </div>
              </div>

              <!-- Harga Produk -->
              <div class="admin-form-group">
                <label for="prodFormPrice">Harga / Keterangan Harga *</label>
                <input type="text" id="prodFormPrice" name="harga" class="admin-input" placeholder="Contoh: Rp 15.000 / bungkus" value="{{ old('harga', $selectedProduct->harga ?? '') }}" required>
              </div>

              <!-- Pengelolaan Foto Produk -->
              <div class="admin-form-group">
                <label>Foto Produk</label>
                <div style="display: flex; gap: 14px; align-items: center; margin-top: 6px;">
                  <div style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #eef3ec; border: 1px solid var(--border-light); flex-shrink: 0;">
                    <img id="prodFormPhotoPreview" src="{{ asset(($selectedProduct && $selectedProduct->foto) ? $selectedProduct->foto : 'assets/images/paket-1.jpeg') }}" alt="Pratinjau" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <div style="flex: 1;">
                    <input type="file" id="prodFormPhotoInput" name="foto" accept="image/*" class="admin-input" style="padding: 7px; font-size: 12.5px;" onchange="previewImageUpload(this, 'prodFormPhotoPreview')">
                  </div>
                </div>
              </div>

              <!-- Deskripsi Produk -->
              <div class="admin-form-group">
                <label for="prodFormDesc">Deskripsi Produk</label>
                <textarea id="prodFormDesc" name="deskripsi" class="admin-textarea" rows="3" placeholder="Jelaskan keistimewaan rasa, bahan baku, daya tahan simpan...">{{ old('deskripsi', $selectedProduct->deskripsi ?? '') }}</textarea>
              </div>

              <!-- Form Buttons -->
              <div class="admin-form-actions-bar" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="admin-form-actions-left">
                  @if (isset($selectedProduct) && $selectedProduct)
                    <a href="{{ route('admin.umkm.index', ['tab' => 'products']) }}" class="btn-admin-secondary" style="text-decoration: none;">
                      Batal Edit
                    </a>
                  @endif
                </div>
                <div class="admin-form-actions-right">
                  <button type="submit" class="btn-admin-primary">
                    {{ isset($selectedProduct) && $selectedProduct ? 'Simpan Perubahan' : 'Tambah Produk' }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ========================================================
           TAB 2: KELOLA PROFIL UMKM
           ======================================================== -->
      <div id="tabContentProfiles" style="{{ $currentTab === 'profiles' ? 'display: block;' : 'display: none;' }}">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
          <div>
            <h2 class="section-title" style="font-size: 20px; margin-bottom: 4px;">Daftar Pelaku UMKM Karangkemiri</h2>
            <p class="section-desc" style="margin-bottom: 0;">Setiap profil UMKM dapat menampung banyak produk dan nomor WhatsApp penjual.</p>
          </div>
          <a href="{{ route('admin.umkm.index', ['tab' => 'profiles']) }}" class="btn-admin-primary" style="text-decoration: none;">
            + Tambah Profil UMKM Baru
          </a>
        </div>

        <div class="admin-two-col">
          <!-- Kolom Kiri: Daftar Profil UMKM -->
          <div style="display: flex; flex-direction: column; gap: 14px; min-width: 0; width: 100%;">
            @forelse ($umkmList as $u)
              <div class="admin-item-card" style="{{ isset($selectedUmkm) && $selectedUmkm && $selectedUmkm->id === $u->id ? 'border: 2px solid var(--green-dark); background: #f0fdf4;' : '' }}">
                <div class="admin-item-left">
                  <div class="admin-item-thumb" style="background-image: url('{{ asset($u->foto ?: 'assets/images/paket-1.jpeg') }}'); background-size: cover; background-position: center;"></div>
                  <div>
                    <div class="admin-item-title">{{ $u->nama_usaha }}</div>
                    <div class="admin-item-sub">{{ $u->nama_pemilik }} &bull; {{ $u->sektor_usaha }} &bull; {{ count($u->produk) }} Produk</div>
                  </div>
                </div>
                <div class="admin-item-right">
                  <span class="badge-tayang">{{ $u->status }}</span>
                  <div class="admin-card-actions">
                    <a href="{{ route('admin.umkm.index', ['tab' => 'profiles', 'edit_umkm' => $u->slug]) }}" class="admin-edit-link" style="text-decoration: none;">Edit &#10095;</a>
                    <form action="{{ route('admin.umkm.destroy', $u->slug) }}" method="POST" onsubmit="return confirm('Hapus profil {{ $u->nama_usaha }}? Semua produk di bawah UMKM ini akan ikut terhapus.');" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="admin-delete-link" style="background: none; border: none; cursor: pointer;">Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="admin-panel-card" style="text-align: center; padding: 28px 16px;">
                <p style="font-size: 14px; color: var(--text-muted); margin: 0;">Belum ada profil UMKM.</p>
              </div>
            @endforelse
          </div>

          <!-- Kolom Kanan: Form Tambah / Edit Profil UMKM -->
          <div style="min-width: 0; width: 100%;">
            <form action="{{ isset($selectedUmkm) && $selectedUmkm ? route('admin.umkm.update', $selectedUmkm->slug) : route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box;">
              @csrf
              @if (isset($selectedUmkm) && $selectedUmkm)
                @method('PUT')
              @endif

              <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 6px; flex-wrap: wrap;">
                <h2 class="admin-panel-title" style="margin-bottom: 0;">
                  {{ isset($selectedUmkm) && $selectedUmkm ? 'Edit Profil UMKM' : 'Tambah Profil UMKM' }}
                </h2>
                <span class="badge-tayang" style="white-space: nowrap; flex-shrink: 0;">
                  Mode: {{ isset($selectedUmkm) && $selectedUmkm ? 'Edit' : 'Tambah' }}
                </span>
              </div>
              <p class="admin-panel-sub">Lengkapi profil tempat usaha, kontak WhatsApp, dan jam operasional pengrajin/penjual.</p>

              <!-- Nama Usaha UMKM -->
              <div class="admin-form-group">
                <label for="umkmProfileName">Nama Usaha / Merk UMKM *</label>
                <input type="text" id="umkmProfileName" name="nama_usaha" class="admin-input" placeholder="Contoh: UMKM Sari Kedelai" value="{{ old('nama_usaha', $selectedUmkm->nama_usaha ?? '') }}" required>
              </div>

              <!-- Nama Pemilik & Kategori Sektor -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="umkmProfileOwner">Nama Pemilik / Pengelola *</label>
                  <input type="text" id="umkmProfileOwner" name="nama_pemilik" class="admin-input" placeholder="Contoh: Ibu Siti Khodijah" value="{{ old('nama_pemilik', $selectedUmkm->nama_pemilik ?? '') }}" required>
                </div>
                <div class="admin-form-group">
                  <label for="umkmProfileCat">Sektor Usaha *</label>
                  <select id="umkmProfileCat" name="sektor_usaha" class="admin-select">
                    @php $curUmkmSec = old('sektor_usaha', $selectedUmkm->sektor_usaha ?? 'Makanan Olahan'); @endphp
                    <option value="Makanan Olahan" {{ $curUmkmSec === 'Makanan Olahan' ? 'selected' : '' }}>Makanan Olahan</option>
                    <option value="Produk Lokal" {{ $curUmkmSec === 'Produk Lokal' ? 'selected' : '' }}>Produk Lokal</option>
                    <option value="Kerajinan Tangan" {{ $curUmkmSec === 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                    <option value="Hasil Pertanian" {{ $curUmkmSec === 'Hasil Pertanian' ? 'selected' : '' }}>Hasil Pertanian / Ternak</option>
                  </select>
                </div>
              </div>

              <!-- WhatsApp & Jam Buka -->
              <div class="admin-form-grid">
                <div class="admin-form-group">
                  <label for="umkmProfileWa">Kontak WhatsApp Penjual *</label>
                  <input type="text" id="umkmProfileWa" name="nomor_wa" class="admin-input" placeholder="0857xxxxxxxx" value="{{ old('nomor_wa', $selectedUmkm->nomor_wa ?? '') }}" required>
                </div>
                <div class="admin-form-group">
                  <label for="umkmProfileHours">Jam Operasional Layanan</label>
                  <input type="text" id="umkmProfileHours" name="jam_operasional" class="admin-input" placeholder="Contoh: Setiap Hari, 07:00 – 17:00 WIB" value="{{ old('jam_operasional', $selectedUmkm->jam_operasional ?? '') }}">
                </div>
              </div>

              <!-- Status Tampil -->
              <div class="admin-form-group">
                <label for="umkmProfileStatus">Status Publikasi *</label>
                <select id="umkmProfileStatus" name="status" class="admin-select">
                  @php $curUmkmStat = old('status', $selectedUmkm->status ?? 'Tayang'); @endphp
                  <option value="Tayang" {{ $curUmkmStat === 'Tayang' ? 'selected' : '' }}>Tayang (Aktif di Website)</option>
                  <option value="Nonaktif" {{ $curUmkmStat === 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Arsip)</option>
                  <option value="Draf" {{ $curUmkmStat === 'Draf' ? 'selected' : '' }}>Draf</option>
                </select>
              </div>

              <!-- Alamat Lengkap -->
              <div class="admin-form-group">
                <label for="umkmProfileAddress">Alamat Lengkap / Dusun</label>
                <textarea id="umkmProfileAddress" name="alamat" class="admin-textarea" rows="2" style="resize: vertical;" placeholder="RT 03 / RW 01 Dusun Karang Jengkol, Desa Karangkemiri...">{{ old('alamat', $selectedUmkm->alamat ?? '') }}</textarea>
              </div>

              <!-- Deskripsi Usaha -->
              <div class="admin-form-group">
                <label for="umkmProfileDesc">Deskripsi Usaha</label>
                <textarea id="umkmProfileDesc" name="deskripsi" class="admin-textarea" rows="3" style="resize: vertical;" placeholder="Cerita singkat usaha, sejarah produksi, atau keunggulan produk UMKM...">{{ old('deskripsi', $selectedUmkm->deskripsi ?? '') }}</textarea>
              </div>

              <!-- Foto Profil Usaha -->
              <div class="admin-form-group">
                <label>Foto Tempat Usaha / Produk Utama</label>
                <div style="display: flex; gap: 14px; align-items: center; margin-top: 6px;">
                  <div style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #eef3ec; border: 1px solid var(--border-light); flex-shrink: 0;">
                    <img id="umkmFormPhotoPreview" src="{{ asset(($selectedUmkm && $selectedUmkm->foto) ? $selectedUmkm->foto : 'assets/images/paket-1.jpeg') }}" alt="Pratinjau" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <div style="flex: 1;">
                    <input type="file" id="umkmFormPhotoInput" name="foto" accept="image/*" class="admin-input" style="padding: 7px; font-size: 12.5px;" onchange="previewImageUpload(this, 'umkmFormPhotoPreview')">
                  </div>
                </div>
              </div>

              <!-- Form Buttons -->
              <div class="admin-form-actions-bar" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="admin-form-actions-left">
                  @if (isset($selectedUmkm) && $selectedUmkm)
                    <a href="{{ route('admin.umkm.index', ['tab' => 'profiles']) }}" class="btn-admin-secondary" style="text-decoration: none;">
                      Batal Edit
                    </a>
                  @endif
                </div>
                <div class="admin-form-actions-right">
                  <button type="submit" class="btn-admin-primary">
                    {{ isset($selectedUmkm) && $selectedUmkm ? 'Simpan Perubahan' : 'Simpan Profil UMKM' }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
