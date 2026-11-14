<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
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
        $this->assertActiveNavigation($response->getContent(), '/');
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
        $this->assertActiveNavigation($resHtml->getContent(), '/profil.html');
    }

    public function test_destinasi_routes_return_successful_response(): void
    {
        $resClean = $this->get('/destinasi');
        $resClean->assertStatus(200);
        $resClean->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');

        $resHtml = $this->get('/destinasi.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');
        $this->assertActiveNavigation($resHtml->getContent(), '/destinasi.html');
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
        $this->assertActiveNavigation($resHtml->getContent(), '/paket-wisata.html');
    }

    public function test_katalog_umkm_routes_return_successful_response(): void
    {
        $resClean = $this->get('/katalog-umkm');
        $resClean->assertStatus(200);
        $resClean->assertSee('Katalog UMKM &amp; Produk Lokal - Desa Wisata Karangkemiri', false);

        $resHtml = $this->get('/katalog-umkm.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Katalog UMKM &amp; Produk Lokal - Desa Wisata Karangkemiri', false);
        $this->assertActiveNavigation($resHtml->getContent(), '/katalog-umkm.html');
    }

    public function test_kontak_routes_return_successful_response(): void
    {
        $resClean = $this->get('/kontak');
        $resClean->assertStatus(200);
        $resClean->assertSee('Kontak &amp; Lokasi - Desa Wisata Karangkemiri', false);

        $resHtml = $this->get('/kontak.html');
        $resHtml->assertStatus(200);
        $resHtml->assertSee('Kontak &amp; Lokasi - Desa Wisata Karangkemiri', false);
        $this->assertActiveNavigation($resHtml->getContent(), '/kontak.html');
    }

    // ==========================================
    // 2. ADMIN CMS PAGES TESTS
    // ==========================================

    public function test_admin_login_routes_return_successful_response(): void
    {
        $resClean = $this->get('/admin/login');
        $resClean->assertStatus(200);
        $resClean->assertSee('Login Admin CMS - Desa Wisata Karangkemiri');

        $this->get('/admin-login.html')->assertRedirect('/admin/login');
        $this->get('/admin-login')->assertRedirect('/admin/login');
    }

    public function test_admin_pages_require_authentication(): void
    {
        foreach ([
            '/admin/dashboard', '/admin-dashboard.html', '/admin-beranda.html',
            '/admin-destinasi.html', '/admin-edit-destinasi.html?slug=candi',
            '/admin-paket.html', '/admin-umkm.html', '/admin-profil.html',
            '/admin-kontak.html', '/admin-pratinjau.html',
        ] as $uri) {
            $this->get($uri)->assertRedirect('/admin/login');
        }
    }

    private function assertActiveNavigation(string $html, string $path): void
    {
        $previous = libxml_use_internal_errors(true);
        try {
            $document = new DOMDocument;
            $document->loadHTML($html);
            $xpath = new DOMXPath($document);
            $links = $xpath->query('//a[contains(concat(" ", normalize-space(@class), " "), " active ")]');
            $hrefs = [];
            foreach ($links as $link) {
                $hrefs[] = $link->getAttribute('href');
            }
            $this->assertContains(url($path), $hrefs);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }
}
