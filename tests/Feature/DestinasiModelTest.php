<?php

namespace Tests\Feature;

use App\Models\Destinasi;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DestinasiModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan tabel destinasi ada dan memiliki semua kolom yang diharapkan.
     */
    public function test_destinasi_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasTable('destinasi'));

        $expectedColumns = [
            'id',
            'nama',
            'slug',
            'kategori',
            'kategori_filter',
            'subjudul',
            'deskripsi',
            'lokasi',
            'foto',
            'galeri',
            'fasilitas',
            'harga_tiket',
            'jam_operasional',
            'maps_url',
            'maps_embed',
            'kegiatan',
            'kontak_wa',
            'status',
            'created_at',
            'updated_at',
        ];

        foreach ($expectedColumns as $column) {
            $this->assertTrue(
                Schema::hasColumn('destinasi', $column),
                "Kolom '{$column}' tidak ditemukan pada tabel destinasi."
            );
        }
    }

    /**
     * Memastikan kebijakan default status adalah 'Draf' agar destinasi baru tidak langsung tayang.
     */
    public function test_default_status_is_draf(): void
    {
        $destinasi = Destinasi::create([
            'nama' => 'Petilasan Mbah Siti Benter',
            'slug' => 'petilasan-mbah-siti-benter',
            'kategori' => 'Wisata Budaya',
            'deskripsi' => 'Situs sejarah dan budaya lokal masyarakat Karangkemiri.',
        ]);

        $this->assertDatabaseHas('destinasi', [
            'id' => $destinasi->id,
            'status' => 'Draf',
        ]);

        $this->assertEquals('Draf', $destinasi->status);
        $this->assertTrue($destinasi->isDraf());
        $this->assertFalse($destinasi->isTayang());

        // Field opsional harus bernilai null
        $this->assertNull($destinasi->harga_tiket);
        $this->assertNull($destinasi->jam_operasional);
        $this->assertNull($destinasi->lokasi);
        $this->assertNull($destinasi->fasilitas);
        $this->assertNull($destinasi->galeri);
        $this->assertNull($destinasi->kegiatan);
    }

    /**
     * Memastikan destinasi dapat dibuat dan dipublikasikan dengan status 'Tayang'.
     */
    public function test_can_create_and_publish_destinasi(): void
    {
        $destinasi = Destinasi::factory()->tayang()->create([
            'nama' => 'Embung Prabawulan',
            'slug' => 'embung-prabawulan',
        ]);

        $this->assertDatabaseHas('destinasi', [
            'id' => $destinasi->id,
            'nama' => 'Embung Prabawulan',
            'slug' => 'embung-prabawulan',
            'status' => 'Tayang',
        ]);

        $this->assertTrue($destinasi->isTayang());
        $this->assertFalse($destinasi->isDraf());
    }

    /**
     * Memastikan destinasi mendukung multi-kategori pada kategori_filter (misal Agro Kelengkeng Thabet).
     */
    public function test_destinasi_supports_multiple_kategori_filter(): void
    {
        // Contoh kasus: Agro Kelengkeng Thabet berkategori utama 'Agrowisata'
        // dan masuk ke filter 'alam' serta 'edukasi' sekaligus.
        $kelengkeng = Destinasi::create([
            'nama' => 'Agro Kelengkeng Thabet',
            'slug' => 'agro-kelengkeng-thabet',
            'kategori' => 'Agrowisata',
            'kategori_filter' => ['alam', 'edukasi'],
            'deskripsi' => 'Kebun kelengkeng lokal dan wisata petik buah.',
            'status' => 'Tayang',
        ]);

        $candi = Destinasi::create([
            'nama' => 'Wahana Edukasi & Outbound Candi',
            'slug' => 'candi-outbound',
            'kategori' => 'Edukasi & Outbound',
            'kategori_filter' => ['edukasi'],
            'deskripsi' => 'Outbound dan edukasi alam terbuka.',
            'status' => 'Tayang',
        ]);

        $embung = Destinasi::create([
            'nama' => 'Embung Prabawulan',
            'slug' => 'embung-prabawulan',
            'kategori' => 'Wisata Alam',
            'kategori_filter' => ['alam'],
            'deskripsi' => 'Danau buatan dan pemandangan alam.',
            'status' => 'Tayang',
        ]);

        $petilasan = Destinasi::create([
            'nama' => 'Petilasan Mbah Siti Benter',
            'slug' => 'petilasan-mbah-siti-benter',
            'kategori' => 'Wisata Budaya',
            'kategori_filter' => ['budaya'],
            'deskripsi' => 'Situs budaya bersejarah.',
            'status' => 'Tayang',
        ]);

        // Cek casting JSON array
        $freshKelengkeng = $kelengkeng->fresh();
        $this->assertIsArray($freshKelengkeng->kategori_filter);
        $this->assertEquals(['alam', 'edukasi'], $freshKelengkeng->kategori_filter);

        // Filter 'alam' harus menemukan Agro Kelengkeng dan Embung
        $alamResults = Destinasi::kategori('alam')->pluck('slug')->toArray();
        $this->assertContains('agro-kelengkeng-thabet', $alamResults);
        $this->assertContains('embung-prabawulan', $alamResults);
        $this->assertNotContains('candi-outbound', $alamResults);
        $this->assertNotContains('petilasan-mbah-siti-benter', $alamResults);

        // Filter 'edukasi' harus menemukan Agro Kelengkeng dan Candi
        $edukasiResults = Destinasi::kategori('edukasi')->pluck('slug')->toArray();
        $this->assertContains('agro-kelengkeng-thabet', $edukasiResults);
        $this->assertContains('candi-outbound', $edukasiResults);
        $this->assertNotContains('embung-prabawulan', $edukasiResults);
        $this->assertNotContains('petilasan-mbah-siti-benter', $edukasiResults);

        // Pencarian dengan kategori utama 'Agrowisata'
        $agroResults = Destinasi::kategori('agrowisata')->pluck('slug')->toArray();
        $this->assertContains('agro-kelengkeng-thabet', $agroResults);
        $this->assertCount(1, $agroResults);
    }

    /**
     * Memastikan mutator kategori_filter menerima string dipisah koma dan menyimpannya sebagai array.
     */
    public function test_kategori_filter_mutator_accepts_comma_string(): void
    {
        $destinasi = Destinasi::create([
            'nama' => 'Agro Kelengkeng',
            'slug' => 'agro-kelengkeng',
            'kategori' => 'Agrowisata',
            'kategori_filter' => 'alam, edukasi',
            'deskripsi' => 'Uji coba input string koma.',
        ]);

        $fresh = $destinasi->fresh();
        $this->assertIsArray($fresh->kategori_filter);
        $this->assertEquals(['alam', 'edukasi'], $fresh->kategori_filter);
    }

    /**
     * Memastikan constraint unique pada slug berjalan dengan benar.
     */
    public function test_slug_must_be_unique(): void
    {
        Destinasi::factory()->create([
            'slug' => 'candi-outbound',
        ]);

        $this->expectException(QueryException::class);

        Destinasi::factory()->create([
            'slug' => 'candi-outbound',
        ]);
    }

    /**
     * Memastikan casting array/JSON bekerja untuk fasilitas, galeri, kegiatan, dan kategori_filter.
     */
    public function test_json_casts_work_properly(): void
    {
        $fasilitas = ['Area Outbound', 'Gazebo', 'Toilet'];
        $galeri = ['foto1.jpg', 'foto2.jpg'];
        $kegiatan = ['Outbound kelompok', 'Edukasi sekolah'];
        $kategoriFilter = ['alam', 'edukasi'];

        $destinasi = Destinasi::factory()->create([
            'fasilitas' => $fasilitas,
            'galeri' => $galeri,
            'kegiatan' => $kegiatan,
            'kategori_filter' => $kategoriFilter,
        ]);

        $fresh = $destinasi->fresh();

        $this->assertIsArray($fresh->fasilitas);
        $this->assertEquals($fasilitas, $fresh->fasilitas);

        $this->assertIsArray($fresh->galeri);
        $this->assertEquals($galeri, $fresh->galeri);

        $this->assertIsArray($fresh->kegiatan);
        $this->assertEquals($kegiatan, $fresh->kegiatan);

        $this->assertIsArray($fresh->kategori_filter);
        $this->assertEquals($kategoriFilter, $fresh->kategori_filter);
    }

    /**
     * Memastikan scopeTayang dan scopeDraf bekerja menyaring status.
     */
    public function test_scope_tayang_and_scope_draf(): void
    {
        Destinasi::factory()->tayang()->create(['nama' => 'Destinasi Tayang']);
        Destinasi::factory()->draf()->create(['nama' => 'Destinasi Draf']);
        Destinasi::factory()->sembunyikan()->create(['nama' => 'Destinasi Tersembunyi']);

        $published = Destinasi::tayang()->get();
        $this->assertCount(1, $published);
        $this->assertEquals('Destinasi Tayang', $published->first()->nama);

        $drafts = Destinasi::draf()->get();
        $this->assertCount(1, $drafts);
        $this->assertEquals('Destinasi Draf', $drafts->first()->nama);
    }

    /**
     * Memastikan getRouteKeyName mengembalikan 'slug'.
     */
    public function test_route_key_name_is_slug(): void
    {
        $destinasi = new Destinasi();
        $this->assertEquals('slug', $destinasi->getRouteKeyName());
    }
}
