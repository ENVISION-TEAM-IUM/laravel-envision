@extends('layouts.admin')

@section('title', 'Edit Halaman Beranda - Admin CMS Karangkemiri')
@section('admin_nav', 'beranda')
@section('drawer_active', 'beranda')

@section('content')
    <!-- Main Content: 03 • Beranda Website -->
    <main class="page-container">
      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Admin</a> &nbsp;/&nbsp; <span>Beranda Website</span>
      </div>

      <h1 class="section-title" style="font-size: 32px;">Edit halaman Beranda</h1>
      <p class="section-desc">Ubah teks yang tampil di halaman depan pengunjung.</p>
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

      <form action="{{ route('admin.beranda.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="admin-two-col">
          <!-- Kolom Kiri: Bagian utama halaman -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Bagian utama halaman</h2>

            <div class="admin-form-group">
              <label for="homeHeroTitle">Judul besar</label>
              <input type="text" id="homeHeroTitle" name="hero_title" class="admin-input" value="{{ old('hero_title', $beranda->hero_title) }}" required>
            </div>

            <div class="admin-form-group">
              <label for="homeHeroSub">Kalimat pengantar</label>
              <input type="text" id="homeHeroSub" name="hero_subtitle" class="admin-input" value="{{ old('hero_subtitle', $beranda->hero_subtitle) }}" required>
            </div>

            <div class="admin-form-group" style="margin-bottom: 0;">
              <label for="homeBtnText">Teks tombol</label>
              <input type="text" id="homeBtnText" name="button_text" class="admin-input" value="{{ old('button_text', $beranda->button_text) }}" required>
            </div>
          </div>

          <!-- Kolom Kanan: Destinasi unggulan -->
          <div class="admin-panel-card" style="margin-bottom: 0;">
            <h2 class="admin-panel-title">Destinasi unggulan</h2>
            <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 16px;">
              Pilih destinasi yang ingin ditampilkan di halaman depan.
            </p>

            <div style="display: flex; flex-direction: column; gap: 14px;">
              @php
                $featured = (array) ($beranda->featured_destinations ?? []);
              @endphp
              @forelse ($destinations as $d)
                <label class="admin-item-card" style="cursor: pointer; display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 0;">
                  <div class="admin-item-left" style="display: flex; align-items: center; gap: 12px;">
                    <input type="checkbox" name="featured_destinations[]" value="{{ $d->slug }}" {{ in_array($d->slug, $featured) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: var(--green-primary); cursor: pointer;">
                    <div class="admin-item-thumb" style="background-image: url('{{ $d->foto ? asset($d->foto) : asset('assets/images/candi.png') }}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
                    <div>
                      <div class="admin-item-title">{{ $d->nama }}</div>
                      <div class="admin-item-sub">{{ in_array($d->slug, $featured) ? 'Tampil di beranda' : 'Tidak tampil di beranda' }}</div>
                    </div>
                  </div>
                  <div class="admin-item-right" style="display: flex; align-items: center; gap: 8px;">
                    <span class="{{ $d->status === 'Tayang' ? 'badge-tayang' : 'badge-draf' }}">{{ $d->status }}</span>
                    <a href="{{ route('admin.destinasi.edit', $d->slug) }}" class="admin-edit-link" onclick="event.stopPropagation();">Ubah &#10095;</a>
                  </div>
                </label>
              @empty
                <p style="font-size: 13.5px; color: var(--text-muted);">Belum ada destinasi wisata yang terdaftar.</p>
              @endforelse
            </div>
          </div>
        </div>

        <p class="admin-tip-text">Tips: gunakan kalimat pendek agar nyaman dibaca di HP.</p>

        <div class="admin-btn-row">
          <a href="{{ route('admin.pratinjau') }}" class="btn-admin-secondary">Lihat Pratinjau</a>
          <button type="submit" class="btn-admin-primary">Simpan Perubahan</button>
        </div>
      </form>
    </main>
@endsection

