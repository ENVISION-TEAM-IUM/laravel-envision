@extends('layouts.admin')

@section('title', 'Edit Informasi Destinasi - Admin CMS Karangkemiri')
@section('admin_nav', 'destinasi')
@section('drawer_active', 'edit-destinasi')

@section('content')
    <!-- Main Content: 06 • Edit Detail Destinasi -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Admin</a> &nbsp;/&nbsp; <a href="{{ route('admin.destinasi.index') }}">Kelola Destinasi</a> &nbsp;/&nbsp; <span>{{ isset($destinasi) && $destinasi ? 'Edit: ' . $destinasi->nama : 'Tambah Destinasi Baru' }}</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">{{ isset($destinasi) && $destinasi ? 'Edit Informasi Destinasi' : 'Tambah Destinasi Wisata' }}</h1>
      <p class="section-desc" style="margin-bottom: 20px;">Isi kolom yang tersedia. Kolom bertanda * wajib diisi.</p>

      @if ($errors->any())
        <div class="admin-alert" style="display: flex; background: #ffebee; border: 1px solid #ffcdd2; color: #c62828; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ isset($destinasi) && $destinasi ? route('admin.destinasi.update', $destinasi->slug) : route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($destinasi) && $destinasi)
          @method('PUT')
        @endif

        <!-- Foto Destinasi Box -->
        <div class="admin-photo-box">
          <div class="admin-photo-left">
            <div class="admin-photo-thumb" style="overflow: hidden; background: #eee;">
              @if (isset($destinasi) && $destinasi && $destinasi->foto)
                <img id="destPhotoPreview" src="{{ asset($destinasi->foto) }}" alt="{{ $destinasi->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
              @else
                <img id="destPhotoPreview" src="{{ asset('assets/images/candi.png') }}" alt="Pratinjau" style="width: 100%; height: 100%; object-fit: cover;">
              @endif
            </div>
            <div>
              <div style="font-size: 17px; font-weight: 800; color: var(--text-dark);">Foto destinasi</div>
              <div style="font-size: 13.5px; color: var(--text-muted); margin-top: 4px;">Pilih foto yang jelas dan sesuai (JPG, PNG, WEBP maks. 10 MB).</div>
              <div id="destPhotoFileName" style="display: none; font-size: 13px; color: var(--green-dark, #2e7d32); font-weight: 700; margin-top: 6px;"></div>
            </div>
          </div>
          <div style="flex-shrink: 0;">
            <input type="file" id="destPhotoInput" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp,image/gif" style="display: none;" onchange="previewImageUpload(this, 'destPhotoPreview', 'destPhotoFileName')">
            <button type="button" class="btn-admin-secondary" style="cursor: pointer;" onclick="document.getElementById('destPhotoInput').click();">
              Pilih / Ganti Foto
            </button>
          </div>
        </div>

        <!-- Form Input Fields (Web 2-Column Layout) -->
        <div class="admin-panel-card">
          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="inputDestName">Nama destinasi *</label>
              <input type="text" id="inputDestName" name="nama" class="admin-input" placeholder="Contoh: Wahana Outbound Candi" value="{{ old('nama', $destinasi->nama ?? '') }}" required>
            </div>

            <div class="admin-form-group">
              <label for="inputDestCategory">Kategori *</label>
              <input type="text" id="inputDestCategory" name="kategori" class="admin-input" placeholder="Contoh: Edukasi & Outbound" value="{{ old('kategori', $destinasi->kategori ?? '') }}" required>
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="inputDestLocation">Lokasi</label>
              <input type="text" id="inputDestLocation" name="lokasi" class="admin-input" placeholder="Alamat atau patokan lokasi" value="{{ old('lokasi', $destinasi->lokasi ?? '') }}">
            </div>

            <div class="admin-form-group">
              <label for="inputDestHours">Jam buka</label>
              <input type="text" id="inputDestHours" name="jam_buka" class="admin-input" placeholder="Contoh: Senin–Ahad, 08.00–17.00 WIB" value="{{ old('jam_buka', $destinasi->jam_buka ?? '') }}">
            </div>
          </div>

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="inputDestPrice">Harga tiket / tarif</label>
              <input type="text" id="inputDestPrice" name="harga_tiket" class="admin-input" placeholder="Contoh: Mulai Rp 15.000 / orang" value="{{ old('harga_tiket', $destinasi->harga_tiket ?? '') }}">
            </div>

            <div class="admin-form-group">
              <label for="inputDestStatus">Status tampil *</label>
              <select id="inputDestStatus" name="status" class="admin-select">
                @php $currentStatus = old('status', $destinasi->status ?? 'Tayang'); @endphp
                <option value="Tayang" {{ $currentStatus === 'Tayang' ? 'selected' : '' }}>Tayang (Tampil di Website Publik)</option>
                <option value="Draf" {{ $currentStatus === 'Draf' ? 'selected' : '' }}>Draf (Disimpan Sementara)</option>
                <option value="Sembunyikan" {{ $currentStatus === 'Sembunyikan' ? 'selected' : '' }}>Sembunyikan (Nonaktif Sementara)</option>
              </select>
            </div>
          </div>

          <div class="admin-form-group" style="margin-bottom: 0;">
            <label for="inputDestDesc">Deskripsi destinasi *</label>
            <textarea id="inputDestDesc" name="deskripsi" class="admin-textarea" rows="4" placeholder="Ceritakan daya tarik tempat ini..." required>{{ old('deskripsi', $destinasi->deskripsi ?? '') }}</textarea>
          </div>
        </div>

        <div class="admin-btn-row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('admin.destinasi.index') }}" class="btn-admin-secondary">Batal</a>
            <button type="submit" class="btn-admin-primary">{{ isset($destinasi) && $destinasi ? 'Simpan Perubahan' : 'Tambah Destinasi' }}</button>
          </div>
          @if (isset($destinasi) && $destinasi)
            <button type="button" class="btn-admin-danger" onclick="if(confirm('Hapus destinasi ini?')){ document.getElementById('deleteDestForm').submit(); }">
              Hapus Destinasi
            </button>
          @endif
        </div>
      </form>

      @if (isset($destinasi) && $destinasi)
        <form id="deleteDestForm" action="{{ route('admin.destinasi.destroy', $destinasi->slug) }}" method="POST" style="display: none;">
          @csrf
          @method('DELETE')
        </form>
      @endif
    </main>
@endsection

