<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    // ==========================================
    // 1. PUBLIC PAGES TESTS
    // ==========================================

    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Beranda - Desa Wisata Karangkemiri');
        $response->assertSee('class="active">Beranda</a>', false);
    }

    public function test_index_html_redirects_to_home(): void
    {
        $response = $this->get('/index.html');
        $response->assertRedirect('/');
    }

    public function test_profil_routes_return_successful_response(): void
    {
        $resClean = $this->get('/profil');
        $resClean->assertStatus(200);
        $resClean->assertSee('Profil Desa Wisata - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/profil.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Profil Desa Wisata - Desa Wisata Karangkemiri');
        $resHtml->assertSee('class="active">Profil Desa</a>', false);
    }

    public function test_destinasi_routes_return_successful_response(): void
    {
        $resClean = $this->get('/destinasi');
        $resClean->assertStatus(200);
        $resClean->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/destinasi.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');
        $resHtml->assertSee('class="active">Destinasi</a>', false);
    }

    public function test_detail_destinasi_routes_return_successful_response(): void
    {
        $resClean = $this->get('/detail-destinasi');
        $resClean->assertStatus(200);
        $resClean->assertSee('detailDestinasiPage');

        $resHtml = $this->get('/detail-destinasi.html?slug=candi');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('detailDestinasiPage');
    }

    public function test_paket_wisata_routes_return_successful_response(): void
    {
        $resClean = $this->get('/paket-wisata');
        $resClean->assertStatus(200);
        $resClean->assertSee('Paket Wisata - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/paket-wisata.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Paket Wisata - Desa Wisata Karangkemiri');
        $resHtml->assertSee('class="active">Paket</a>', false);
    }

    public function test_katalog_umkm_routes_return_successful_response(): void
    {
        $resClean = $this->get('/katalog-umkm');
        $resClean->assertStatus(200);
        $resClean->assertSee('Katalog UMKM - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/katalog-umkm.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Katalog UMKM - Desa Wisata Karangkemiri');
        $resHtml->assertSee('class="active">UMKM</a>', false);
    }

    public function test_kontak_routes_return_successful_response(): void
    {
        $resClean = $this->get('/kontak');
        $resClean->assertStatus(200);
        $resClean->assertSee('Kontak &amp; Lokasi - Desa Wisata Karangkemiri', false);

        $resHtml = $this->get('/kontak.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Kontak &amp; Lokasi - Desa Wisata Karangkemiri', false);
        $resHtml->assertSee('class="active">Kontak</a>', false);
    }

    // ==========================================
    // 2. ADMIN CMS PAGES TESTS
    // ==========================================

    public function test_admin_login_routes_return_successful_response(): void
    {
        $resClean = $this->get('/admin/login');
        $resClean->assertStatus(200);
        $resClean->assertSee('Login Admin CMS - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/admin-login.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Masuk ke CMS');
    }

    public function test_admin_dashboard_routes_return_successful_response(): void
    {
        $resClean = $this->get('/admin/dashboard');
        $resClean->assertStatus(200);
        $resClean->assertSee('Dashboard Admin - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/admin-dashboard.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Halo, Admin!');
    }

    public function test_admin_beranda_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-beranda.html');
        $response->assertStatus(200);
        $response->assertSee('Edit Halaman Beranda - Admin CMS Karangkemiri');
    }

    public function test_admin_destinasi_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-destinasi.html');
        $response->assertStatus(200);
        $response->assertSee('Kelola Destinasi Wisata - Admin CMS Karangkemiri');
    }

    public function test_admin_edit_destinasi_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-edit-destinasi.html?slug=candi');
        $response->assertStatus(200);
        $response->assertSee('Edit Informasi Destinasi - Admin CMS Karangkemiri');
    }

    public function test_admin_paket_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-paket.html');
        $response->assertStatus(200);
        $response->assertSee('Kelola Paket Wisata - Admin CMS Karangkemiri');
    }

    public function test_admin_umkm_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-umkm.html');
        $response->assertStatus(200);
        $response->assertSee('Kelola Katalog UMKM - Admin CMS Karangkemiri');
    }

    public function test_admin_profil_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-profil.html');
        $response->assertStatus(200);
        $response->assertSee('Edit Profil Desa - Admin CMS Karangkemiri');
    }

    public function test_admin_kontak_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-kontak.html');
        $response->assertStatus(200);
        $response->assertSee('Edit Kontak &amp; Lokasi - Admin CMS Karangkemiri', false);
    }

    public function test_admin_pratinjau_routes_return_successful_response(): void
    {
        $response = $this->get('/admin-pratinjau.html');
        $response->assertStatus(200);
        $response->assertSee('Pratinjau &amp; Publikasi - Admin CMS Karangkemiri', false);
    }
}
