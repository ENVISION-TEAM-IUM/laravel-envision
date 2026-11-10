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

      <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <a href="{{ route('admin.paket.index') }}" class="btn-admin-primary" style="text-decoration: none;">
          + Tambah Paket Baru
        </a>
      </div>

      <!-- 2-Column Web Layout: Daftar Paket (Kiri) & Formulir Paket (Kanan) -->
      <div class="admin-two-col">
        <!-- Kolom Kiri: Daftar Paket Wisata -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: -4px;">
            <div class="drawer-section-label" style="margin: 0;">DAFTAR PAKET TERDAFTAR</div>
            <span style="font-size: 12.5px; color: var(--text-muted);">{{ count($packages) }} Paket</span>
          </div>

          <div id="adminPackageList" style="display: flex; flex-direction: column; gap: 14px;">
            @forelse ($packages as $pkg)
              <div class="admin-item-card" style="{{ isset($selectedPackage) && $selectedPackage && $selectedPackage->id === $pkg->id ? 'border: 2px solid var(--green-dark); background: #f0fdf4;' : '' }}">
                <div class="admin-item-left">
                  <div class="admin-item-thumb" style="background-image: url('{{ asset($pkg->foto ?: 'assets/images/paket-1.jpeg') }}'); background-size: cover; background-position: center;"></div>
                  <div>
                    <div class="admin-item-title">{{ $pkg->nama_paket }}</div>
                    <div class="admin-item-sub">{{ $pkg->harga }} &bull; {{ $pkg->destinasi_terkait ?: 'Desa Karangkemiri' }}</div>
                  </div>
                </div>
                <div class="admin-item-right">
                  <span class="badge-tayang">{{ $pkg->status }}</span>
                  <div class="admin-card-actions">
                    <a href="{{ route('admin.paket.index', ['edit' => $pkg->slug]) }}" class="admin-edit-link" style="text-decoration: none;">
                      Edit &#10095;
                    </a>
                    <form action="{{ route('admin.paket.destroy', $pkg->slug) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket {{ $pkg->nama_paket }}?');" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="admin-delete-link" style="background: none; border: none; cursor: pointer;">Hapus</button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="admin-panel-card" style="text-align: center; padding: 28px 16px;">
                <p style="font-size: 14px; color: var(--text-muted); margin: 0;">Belum ada paket wisata.</p>
              </div>
            @endforelse
          </div>
        </div>

        <!-- Kolom Kanan: Formulir Tambah / Edit Paket -->
        <form action="{{ isset($selectedPackage) && $selectedPackage ? route('admin.paket.update', $selectedPackage->slug) : route('admin.paket.store') }}" method="POST" enctype="multipart/form-data" class="admin-panel-card" style="margin-bottom: 0; width: 100%; box-sizing: border-box; min-width: 0;">
          @csrf
          @if (isset($selectedPackage) && $selectedPackage)
            @method('PUT')
          @endif

          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; gap: 12px; flex-wrap: wrap;">
            <h2 class="admin-panel-title" style="margin-bottom: 0;">
              {{ isset($selectedPackage) && $selectedPackage ? 'Edit Paket Wisata' : 'Tambah Paket Baru' }}
            </h2>
            <span class="badge-category" style="font-size: 11.5px; white-space: nowrap; flex-shrink: 0;">
              Mode: {{ isset($selectedPackage) && $selectedPackage ? 'Edit Paket' : 'Tambah Baru' }}
            </span>
          </div>
          <p class="admin-panel-sub">Ubah detail paket kunjungan, foto, harga, dan ketentuan.</p>

          <div class="admin-form-group">
            <label for="pkgFormName">Nama paket *</label>
            <input type="text" id="pkgFormName" name="nama_paket" class="admin-input" placeholder="Contoh: Paket Outbound Ceria" value="{{ old('nama_paket', $selectedPackage->nama_paket ?? '') }}" required>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="pkgFormPrice">Harga / keterangan *</label>
              <input type="text" id="pkgFormPrice" name="harga" class="admin-input" placeholder="Contoh: mulai Rp 100.000 ,- / Orang" value="{{ old('harga', $selectedPackage->harga ?? '') }}" required>
            </div>

            <div class="admin-form-group">
              <label for="pkgFormStatus">Status publikasi *</label>
              <select id="pkgFormStatus" name="status" class="admin-select">
                @php $curPkgStatus = old('status', $selectedPackage->status ?? 'Aktif'); @endphp
                <option value="Aktif" {{ $curPkgStatus === 'Aktif' ? 'selected' : '' }}>Aktif (Tayang di Website)</option>
                <option value="Nonaktif" {{ $curPkgStatus === 'Nonaktif' ? 'selected' : '' }}>Nonaktif (Draf / Sembunyi)</option>
              </select>
            </div>
          </div>

          <!-- Upload Foto Paket -->
          <div class="admin-form-group">
            <label>Foto paket wisata</label>
            <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
              <div style="width: 80px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-light); background: #eee; flex-shrink: 0;">
                <img id="pkgFormPhotoPreview" src="{{ asset(($selectedPackage && $selectedPackage->foto) ? $selectedPackage->foto : 'assets/images/paket-1.jpeg') }}" alt="Pratinjau" style="width: 100%; height: 100%; object-fit: cover;">
              </div>
              <div style="flex: 1; min-width: 180px;">
                <input type="file" id="pkgFormPhotoInput" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" style="display: none;" onchange="previewImageUpload(this, 'pkgFormPhotoPreview', 'pkgFormPhotoFileName')">
                <button type="button" class="btn-admin-secondary" style="padding: 7px 14px; font-size: 13px;" onclick="document.getElementById('pkgFormPhotoInput').click();">
                  Pilih / Ganti Foto
                </button>
                <div id="pkgFormPhotoFileName" style="display: none; font-size: 12.5px; color: var(--green-dark, #2e7d32); font-weight: 600; margin-top: 4px;"></div>
              </div>
            </div>
          </div>

          <div class="admin-form-grid">
            <!-- Destinasi Terkait -->
            <div class="admin-form-group">
              <label for="pkgFormDest">Destinasi terkait</label>
              <select id="pkgFormDest" name="destinasi_terkait" class="admin-select">
                <option value="Seluruh Kawasan Desa Karangkemiri">Seluruh Kawasan Desa</option>
                @foreach ($destinations as $dest)
                  <option value="{{ $dest->nama }}" {{ old('destinasi_terkait', $selectedPackage->destinasi_terkait ?? '') === $dest->nama ? 'selected' : '' }}>
                    {{ $dest->nama }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Aktivitas UMKM Terkait -->
            <div class="admin-form-group">
              <label for="pkgFormUmkm">Aktivitas UMKM terkait</label>
              <input type="text" id="pkgFormUmkm" name="aktivitas_umkm" class="admin-input" placeholder="Contoh: Pembuatan Tahu, Gula Jawa, Kriya Perca" value="{{ old('aktivitas_umkm', $selectedPackage->aktivitas_umkm ?? '') }}">
            </div>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormWa">Nomor WhatsApp pemesanan</label>
            <input type="text" id="pkgFormWa" name="nomor_wa" class="admin-input" placeholder="085702573013" value="{{ old('nomor_wa', $selectedPackage->nomor_wa ?? '') }}">
          </div>

          <div class="admin-form-group">
            <label for="pkgFormFacilities">Fasilitas paket (pisahkan dengan baris baru)</label>
            <textarea id="pkgFormFacilities" name="fasilitas" class="admin-textarea" rows="3" placeholder="Pilihan fasilitas...">{{ old('fasilitas', $selectedPackage->fasilitas ?? '') }}</textarea>
          </div>

          <div class="admin-form-group">
            <label for="pkgFormDesc">Deskripsi lengkap, kegiatan &amp; ketentuan</label>
            <textarea id="pkgFormDesc" name="deskripsi" class="admin-textarea" rows="3" placeholder="Tuliskan penjelasan kegiatan dalam paket...">{{ old('deskripsi', $selectedPackage->deskripsi ?? '') }}</textarea>
          </div>

          <!-- Form Buttons Simetris -->
          <div class="admin-form-actions-bar" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="admin-form-actions-left">
              @if (isset($selectedPackage) && $selectedPackage)
                <a href="{{ route('admin.paket.index') }}" class="btn-admin-secondary" style="text-decoration: none;">
                  Batal Edit
                </a>
              @endif
            </div>
            <div class="admin-form-actions-right">
              <button type="submit" class="btn-admin-primary">
                {{ isset($selectedPackage) && $selectedPackage ? 'Simpan Perubahan' : 'Simpan Paket Baru' }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </main>
@endsection

