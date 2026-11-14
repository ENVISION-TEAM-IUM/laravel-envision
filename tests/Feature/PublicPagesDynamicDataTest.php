<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use App\Models\PaketWisata;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
use App\Models\FeedbackLayanan;
use App\Models\GaleriFoto;
use App\Models\KunjunganDigital;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesDynamicDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_destinasi_displays_dynamic_database_records(): void
    {
        Destinasi::create([
            'slug' => 'curug-kemiri',
            'nama' => 'Curug Kemiri Indah',
            'kategori' => 'Wisata Alam',
            'lokasi' => 'Dusun 1, Desa Karangkemiri',
            'jam_buka' => '07.00 - 17.00 WIB',
            'harga_tiket' => 'Rp 10.000',
            'deskripsi' => 'Air terjun alami dengan pemandangan menawan di perbukitan Karangkemiri.',
            'status' => 'Tayang',
        ]);

        Destinasi::create([
            'slug' => 'destinasi-draf',
            'nama' => 'Destinasi Rahasia Belum Tayang',
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Deskripsi destinasi draf yang belum siap tampil.',
            'status' => 'Draf',
        ]);

        $response = $this->get('/destinasi');

        $response->assertStatus(200);
        $response->assertSee('Curug Kemiri Indah');
        $response->assertSee('Rp 10.000');
        $response->assertDontSee('Destinasi Rahasia Belum Tayang');
    }

    public function test_public_detail_destinasi_displays_specific_destination_by_slug(): void
    {
        $destinasi = Destinasi::create([
            'slug' => 'embung-karang',
            'nama' => 'Embung Karang Jengkol',
            'kategori' => 'Wisata Alam',
            'lokasi' => 'Dusun Karang Jengkol',
            'jam_buka' => '06.00 - 18.00 WIB',
            'harga_tiket' => 'Rp 5.000',
            'deskripsi' => 'Danau buatan yang sejuk untuk bersantai keluarga.',
            'status' => 'Tayang',
        ]);

        $resPath = $this->get('/detail-destinasi/' . $destinasi->slug);
        $resPath->assertStatus(200);
        $resPath->assertSee('Embung Karang Jengkol');
        $resPath->assertSee('Dusun Karang Jengkol');

        $resQuery = $this->get('/detail-destinasi?slug=' . $destinasi->slug);
        $resQuery->assertStatus(200);
        $resQuery->assertSee('Embung Karang Jengkol');
    }

    public function test_public_paket_wisata_displays_packages_from_database(): void
    {
        PaketWisata::create([
            'slug' => 'paket-susur-alam',
            'nama_paket' => 'Paket Susur Alam Karangkemiri',
            'harga' => 'Rp 125.000 / Orang',
            'destinasi_terkait' => 'Wahana Candi & Embung',
            'aktivitas_umkm' => 'Kuliner Tahu & Madu',
            'nomor_wa' => '081234567890',
            'fasilitas' => "Makan Siang Khas Desa\nPemandu Wisata Bersertifikat\nDokumentasi Kegiatan",
            'deskripsi' => 'Pengalaman berpetualang menyusuri alam dan sentra kerajinan desa Karangkemiri.',
            'status' => 'Aktif',
        ]);

        PaketWisata::create([
            'slug' => 'paket-tertutup',
            'nama_paket' => 'Paket Nonaktif Tidak Tampil',
            'harga' => 'Rp 999.000',
            'status' => 'Nonaktif',
            'deskripsi' => 'Paket nonaktif.',
        ]);

        $response = $this->get('/paket-wisata');

        $response->assertStatus(200);
        $response->assertSee('Paket Susur Alam Karangkemiri');
        $response->assertSee('Rp 125.000 / Orang');
        $response->assertSee('Makan Siang Khas Desa');
        $response->assertSee('Pemandu Wisata Bersertifikat');
        $response->assertDontSee('Paket Nonaktif Tidak Tampil');
    }

    public function test_public_katalog_umkm_displays_umkm_and_products_from_database(): void
    {
        $umkm = Umkm::create([
            'slug' => 'umkm-madu-murni',
            'nama_usaha' => 'Sentra Madu Klanceng Karangkemiri',
            'nama_pemilik' => 'Pak Budi Santoso',
            'sektor_usaha' => 'Hasil Peternakan',
            'nomor_wa' => '085712345678',
            'jam_operasional' => '08.00 - 16.00 WIB',
            'alamat' => 'RT 02 RW 03 Dusun Krajan',
            'deskripsi' => 'Peternakan lebah klanceng alami berkhasiat tinggi.',
            'status' => 'Tayang',
        ]);

        $umkmDraf = Umkm::create([
            'slug' => 'umkm-draf',
            'nama_usaha' => 'UMKM Draf Belum Buka',
            'nama_pemilik' => 'Pak Rahasia',
            'sektor_usaha' => 'Kerajinan',
            'nomor_wa' => '081234567899',
            'status' => 'Draf',
        ]);

        ProdukUmkm::create([
            'umkm_id' => $umkm->id,
            'slug' => 'madu-klanceng-250ml',
            'nama_produk' => 'Madu Klanceng Asli 250ml',
            'kategori' => 'makanan',
            'harga' => 'Rp 75.000',
            'deskripsi' => 'Madu murni tanpa campuran pemanis buatan.',
            'status' => 'Tayang',
        ]);

        ProdukUmkm::create([
            'umkm_id' => $umkm->id,
            'slug' => 'produk-draf',
            'nama_produk' => 'Produk Draf Belum Siap',
            'kategori' => 'makanan',
            'harga' => 'Rp 10.000',
            'status' => 'Draf',
        ]);

        $response = $this->get('/katalog-umkm');

        $response->assertStatus(200);
        $response->assertSee('Sentra Madu Klanceng Karangkemiri');
        $response->assertSee('Madu Klanceng Asli 250ml');
        $response->assertSee('Rp 75.000');
        $response->assertDontSee('UMKM Draf Belum Buka');
        $response->assertDontSee('Produk Draf Belum Siap');
    }

    public function test_feedback_store_saves_feedback_to_database(): void
    {
        $destinasi = Destinasi::create([
            'slug' => 'candi-test',
            'nama' => 'Wahana Candi Test',
            'kategori' => 'Edukasi',
            'status' => 'Tayang',
            'deskripsi' => 'Deskripsi destinasi.',
        ]);

        $payload = [
            'destinasi_id' => $destinasi->id,
            'nama_destinasi' => 'Wahana Candi Test',
            'rating_fasilitas' => 5,
            'rating_kebersihan' => 4,
            'rating_pelayanan' => 5,
            'asal_kota' => 'Purwokerto',
            'komentar' => 'Fasilitas sangat rapi dan instruktur ramah!',
        ];

        $response = $this->postJson('/feedback', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('feedback_layanan', [
            'nama_destinasi' => 'Wahana Candi Test',
            'asal_kota' => 'Purwokerto',
            'rating_fasilitas' => 5,
            'komentar' => 'Fasilitas sangat rapi dan instruktur ramah!',
        ]);
    }

    public function test_feedback_store_fails_when_all_ratings_are_zero(): void
    {
        $payload = [
            'nama_destinasi' => 'Destinasi Tanpa Rating',
            'rating_fasilitas' => 0,
            'rating_kebersihan' => 0,
            'rating_pelayanan' => 0,
        ];

        $response = $this->postJson('/feedback', $payload);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
        ]);
    }

    public function test_analytics_track_saves_page_view_and_whatsapp_clicks(): void
    {
        $resVisit = $this->postJson('/track-event', [
            'halaman' => '/paket-wisata',
            'tipe' => 'kunjungan',
        ]);
        $resVisit->assertStatus(200);

        $resClick = $this->postJson('/track-event', [
            'halaman' => '/detail-destinasi?slug=candi',
            'tipe' => 'klik_wa',
            'target' => 'Reservasi Paket Outbound',
        ]);
        $resClick->assertStatus(200);

        $this->assertDatabaseHas('kunjungan_digital', [
            'halaman' => '/paket-wisata',
            'tipe' => 'kunjungan',
        ]);

        $this->assertDatabaseHas('kunjungan_digital', [
            'halaman' => '/detail-destinasi?slug=candi',
            'tipe' => 'klik_wa',
            'target' => 'Reservasi Paket Outbound',
        ]);
    }

    public function test_galeri_foto_displays_dynamically_on_home_and_detail(): void
    {
        GaleriFoto::create([
            'judul' => 'Foto Outbound Sunset',
            'kategori' => 'wisata',
            'foto' => 'assets/images/outbound.jpeg',
            'urutan' => 1,
            'status' => 'Tayang',
        ]);

        $resHome = $this->get('/');
        $resHome->assertStatus(200);
        $resHome->assertSee('Foto Outbound Sunset');
    }
}
