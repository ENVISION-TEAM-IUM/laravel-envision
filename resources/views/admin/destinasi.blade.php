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

      @if (session('success'))
        <div class="admin-alert" style="display: flex; background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600;">
          {{ session('success') }}
        </div>
      @endif

      <!-- Bar Pencarian & Tombol Tambah Destinasi (Web Layout) -->
      <form method="GET" action="{{ route('admin.destinasi.index') }}" style="display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 22px;">
        <div style="flex: 1; min-width: 260px;">
          <label for="adminSearchDest" style="display: block; font-size: 13.5px; font-weight: 700; margin-bottom: 6px;">Cari destinasi</label>
          <input type="text" id="adminSearchDest" name="search" class="admin-input" placeholder="Ketik nama tempat wisata..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-admin-secondary" style="padding: 13.5px 20px;">Cari</button>
        <a href="{{ route('admin.destinasi.create') }}" class="btn-admin-primary" style="padding: 13.5px 24px; text-decoration: none;">
          + Tambah Destinasi
        </a>
      </form>

      <!-- Daftar Destinasi dari Database (Grid 2 Kolom di Web) -->
      <div class="admin-items-grid">
        @forelse ($destinasi as $item)
          <div class="admin-item-card" data-admin-dest-item>
            <div class="admin-item-left">
              <div class="admin-item-thumb" style="background-image: url('{{ asset($item->foto ?: 'assets/images/candi.png') }}'); background-size: cover; background-position: center;"></div>
              <div>
                <div class="admin-item-title">{{ $item->nama }}</div>
                <div class="admin-item-sub">{{ $item->kategori }} &bull; {{ $item->jam_buka ?: 'Setiap Hari' }}</div>
              </div>
            </div>
            <div class="admin-item-right">
              <span class="badge-tayang" data-item-badge>{{ $item->status }}</span>
              <div class="admin-card-actions">
                <a href="{{ route('admin.destinasi.edit', $item->slug) }}" class="admin-edit-link">Edit &#10095;</a>
                <form action="{{ route('admin.destinasi.destroy', $item->slug) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi {{ $item->nama }}?');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="admin-delete-link" style="background: none; border: none; cursor: pointer;">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <div class="admin-panel-card" style="grid-column: 1 / -1; text-align: center; padding: 36px 20px;">
            <p style="font-size: 15px; color: var(--text-muted); margin: 0;">Belum ada data destinasi wisata. Klik <strong>+ Tambah Destinasi</strong> untuk menambahkan.</p>
          </div>
        @endforelse
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

