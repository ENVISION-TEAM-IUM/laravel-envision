<?php

namespace Tests\Feature;

use Tests\TestCase;

class DestinasiTest extends TestCase
{
    /**
     * Test /destinasi route returns successful response and contains correct content.
     */
    public function test_destinasi_route_returns_successful_response(): void
    {
        $response = $this->get(route('destinasi.index'));

        $response->assertStatus(200);
        $response->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');
        $response->assertSee('Pilih pengalamanmu');
        $response->assertSee('Wahana Edukasi &amp; Outbound Candi', false);
        $response->assertSee('Embung Prabawulan');
        $response->assertSee('Agro Kelengkeng Thabet');
        $response->assertSee('Petilasan Mbah Siti Benter');
        $response->assertSee('class="active">Destinasi</a>', false);
    }

    /**
     * Test legacy /destinasi.html compatibility.
     */
    public function test_destinasi_html_compatibility_route_returns_successful_response(): void
    {
        $response = $this->get('/destinasi.html');

        $response->assertStatus(200);
        $response->assertSee('Destinasi Wisata - Desa Wisata Karangkemiri');
        $response->assertSee('Pilih pengalamanmu');
        $response->assertSee('class="active">Destinasi</a>', false);
    }

    /**
     * Test category filter query parameters work on /destinasi.
     */
    public function test_destinasi_with_category_query_parameters(): void
    {
        $responseAlam = $this->get('/destinasi?kategori=alam');
        $responseAlam->assertStatus(200);
        $responseAlam->assertSee('data-filter-btn="alam"', false);
        $responseAlam->assertSee('data-category="alam"', false);

        $responseEdukasi = $this->get('/destinasi?kategori=edukasi');
        $responseEdukasi->assertStatus(200);
        $responseEdukasi->assertSee('data-filter-btn="edukasi"', false);
        $responseEdukasi->assertSee('data-category="edukasi"', false);

        $responseLegacyAlam = $this->get('/destinasi.html?kategori=alam');
        $responseLegacyAlam->assertStatus(200);
        $responseLegacyAlam->assertSee('data-filter-btn="alam"', false);

        $responseLegacyEdukasi = $this->get('/destinasi.html?kategori=edukasi');
        $responseLegacyEdukasi->assertStatus(200);
        $responseLegacyEdukasi->assertSee('data-filter-btn="edukasi"', false);
    }

    /**
     * Test destination card links and data attributes are preserved.
     */
    public function test_destinasi_cards_and_data_attributes_preserved(): void
    {
        $response = $this->get('/destinasi');

        $response->assertStatus(200);
        $response->assertSee('data-filter-btn="semua"', false);
        $response->assertSee('data-filter-btn="alam"', false);
        $response->assertSee('data-filter-btn="edukasi"', false);
        $response->assertSee('data-filter-btn="budaya"', false);
        $response->assertSee('data-category="edukasi"', false);
        $response->assertSee('data-category="alam"', false);
        $response->assertSee('data-category="alam,edukasi"', false);
        $response->assertSee('data-category="budaya"', false);
        $response->assertSee('detail-destinasi.html?slug=candi');
        $response->assertSee('detail-destinasi.html?slug=embung');
        $response->assertSee('detail-destinasi.html?slug=kelengkeng');
        $response->assertSee('detail-destinasi.html?slug=petilasan');
    }
}
