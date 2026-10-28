<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Beranda - Desa Wisata Karangkemiri');
        $response->assertSee('class="active">Beranda</a>', false);
    }

    public function test_profil_html_route_returns_successful_response(): void
    {
        $response = $this->get('/profil.html');

        $response->assertStatus(200);
        $response->assertSee('Profil Desa Wisata - Desa Wisata Karangkemiri');
        $response->assertSee('class="active">Profil Desa</a>', false);
    }

    public function test_profil_clean_route_returns_successful_response(): void
    {
        $response = $this->get('/profil');

        $response->assertStatus(200);
        $response->assertSee('Profil Desa Wisata - Desa Wisata Karangkemiri');
    }

    public function test_index_html_redirects_to_home(): void
    {
        $response = $this->get('/index.html');

        $response->assertRedirect('/');
    }
}
