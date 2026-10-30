<?php

namespace Tests\Feature;

use App\Http\Requests\StoreDestinasiRequest;
use App\Http\Requests\UpdateDestinasiRequest;
use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class DestinasiValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Data dasar yang valid untuk pengujian.
     */
    protected function validPayload(): array
    {
        return [
            'nama' => 'Wahana Edukasi & Outbound Candi',
            'slug' => 'wahana-edukasi-candi',
            'kategori' => 'Edukasi & Outbound',
            'kategori_filter' => ['edukasi', 'alam'],
            'deskripsi' => 'Destinasi outbound keluarga dan instansi.',
            'subjudul' => 'Aktivitas keluarga dan rombongan',
            'lokasi' => 'Dusun Karang Jengkol, Karangkemiri',
            'fasilitas' => ['Area Outbound', 'Toilet', 'Mushola'],
            'kegiatan' => ['Outbound kelompok', 'Edukasi pramuka'],
            'harga_tiket' => 'Hubungi Pengelola BUMDes',
            'jam_operasional' => 'Senin – Minggu, 08:00 – 17:00 WIB',
            'maps_url' => 'https://maps.google.com/?q=candi',
            'status' => 'Tayang',
        ];
    }

    /**
     * Memastikan validasi StoreDestinasiRequest lolos dengan data yang valid.
     */
    public function test_store_validation_passes_with_valid_data(): void
    {
        $request = new StoreDestinasiRequest();
        $validator = Validator::make($this->validPayload(), $request->rules(), $request->messages());

        $this->assertTrue($validator->passes(), 'Validasi seharusnya lolos dengan data valid.');
    }

    /**
     * Memastikan validasi gagal saat field wajib bernilai kosong, dan pesan berbahasa Indonesia.
     */
    public function test_store_validation_fails_when_required_inputs_are_empty(): void
    {
        $request = new StoreDestinasiRequest();
        $validator = Validator::make([
            'nama' => '',
            'slug' => '',
            'kategori' => '',
            'deskripsi' => '',
        ], $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());

        $errors = $validator->errors();
        $this->assertTrue($errors->has('nama'));
        $this->assertTrue($errors->has('slug'));
        $this->assertTrue($errors->has('kategori'));
        $this->assertTrue($errors->has('deskripsi'));

        $this->assertEquals('Nama destinasi wajib diisi.', $errors->first('nama'));
        $this->assertEquals('Slug destinasi wajib diisi.', $errors->first('slug'));
        $this->assertEquals('Kategori destinasi wajib diisi.', $errors->first('kategori'));
        $this->assertEquals('Deskripsi destinasi wajib diisi.', $errors->first('deskripsi'));
    }

    /**
     * Memastikan validasi StoreDestinasiRequest menolak slug yang duplikat di database.
     */
    public function test_store_validation_fails_on_duplicate_slug(): void
    {
        Destinasi::factory()->create(['slug' => 'embung-prabawulan']);

        $payload = $this->validPayload();
        $payload['slug'] = 'embung-prabawulan';

        $request = new StoreDestinasiRequest();
        $validator = Validator::make($payload, $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('slug'));
        $this->assertEquals(
            'Slug destinasi sudah digunakan. Silakan gunakan nama atau slug lain.',
            $validator->errors()->first('slug')
        );
    }

    /**
     * Memastikan UpdateDestinasiRequest mengizinkan slug yang sama milik record yang sedang diedit.
     */
    public function test_update_validation_allows_same_slug_for_own_record(): void
    {
        $destinasi = Destinasi::factory()->create(['slug' => 'candi-outbound']);

        $payload = $this->validPayload();
        $payload['slug'] = 'candi-outbound';

        $request = UpdateDestinasiRequest::create('/admin/destinasi/' . $destinasi->id, 'PUT', $payload);
        $request->destinasiModel = $destinasi;
        $request->setRouteResolver(fn () => new Route('PUT', '/admin/destinasi/{destinasi}', ['destinasi' => $destinasi]));

        $validator = Validator::make($payload, $request->rules(), $request->messages());

        $this->assertTrue(
            $validator->passes(),
            'Update seharusnya lolos jika slug sama dengan milik record sendiri.'
        );
    }

    /**
     * Memastikan UpdateDestinasiRequest menolak slug yang sudah dipakai oleh destinasi lain.
     */
    public function test_update_validation_fails_on_duplicate_slug_from_other_destinasi(): void
    {
        $destinasiA = Destinasi::factory()->create(['slug' => 'candi-outbound']);
        $destinasiB = Destinasi::factory()->create(['slug' => 'embung-prabawulan']);

        // Destinasi B mencoba memakai slug milik Destinasi A
        $payload = $this->validPayload();
        $payload['slug'] = 'candi-outbound';

        $request = UpdateDestinasiRequest::create('/admin/destinasi/' . $destinasiB->id, 'PUT', $payload);
        $request->destinasiModel = $destinasiB;
        $request->setRouteResolver(fn () => new Route('PUT', '/admin/destinasi/{destinasi}', ['destinasi' => $destinasiB]));

        $validator = Validator::make($payload, $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('slug'));
        $this->assertEquals(
            'Slug destinasi sudah digunakan. Silakan gunakan nama atau slug lain.',
            $validator->errors()->first('slug')
        );
    }

    /**
     * Memastikan validasi foto menolak file bukan gambar (misal PDF) dan gambar melebihi 5 MB.
     */
    public function test_validation_fails_with_invalid_file_type_and_large_size(): void
    {
        $request = new StoreDestinasiRequest();

        // 1a. Uji file bukan gambar (PDF) -> gagal aturan 'image'
        $invalidFile = UploadedFile::fake()->create('dokumen.pdf', 200, 'application/pdf');
        $payload = $this->validPayload();
        $payload['foto'] = $invalidFile;

        $validator = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('foto'));
        $this->assertEquals(
            'Foto destinasi harus berupa file gambar.',
            $validator->errors()->first('foto')
        );

        // 1b. Uji format gambar di luar mimes yang diizinkan (misal GIF) -> gagal aturan 'mimes'
        $gifFile = UploadedFile::fake()->image('animasi.gif');
        $payload['foto'] = $gifFile;

        $validatorGif = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validatorGif->fails());
        $this->assertTrue($validatorGif->errors()->has('foto'));
        $this->assertEquals(
            'Format foto destinasi harus berupa JPG, PNG, atau WebP.',
            $validatorGif->errors()->first('foto')
        );

        // 2. Uji file gambar melebihi 5 MB (misal 6 MB = 6144 KB)
        $oversizedFile = UploadedFile::fake()->image('besar.jpg')->size(6144);
        $payload['foto'] = $oversizedFile;

        $validator2 = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validator2->fails());
        $this->assertTrue($validator2->errors()->has('foto'));
        $this->assertEquals(
            'Ukuran foto destinasi tidak boleh lebih dari 5 MB.',
            $validator2->errors()->first('foto')
        );
    }

    /**
     * Memastikan validasi foto lolos dengan gambar valid (JPG, PNG, WebP) di bawah 5 MB.
     */
    public function test_validation_passes_with_valid_image_file(): void
    {
        $request = new StoreDestinasiRequest();

        $validWebp = UploadedFile::fake()->image('sampul.webp')->size(2048);
        $payload = $this->validPayload();
        $payload['foto'] = $validWebp;

        $validator = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validator->passes());
    }

    /**
     * Memastikan kategori_filter mendukung array multi-kategori dan menolak status yang tidak valid.
     */
    public function test_validation_multi_category_and_status_constraints(): void
    {
        $request = new StoreDestinasiRequest();

        // Multi-kategori valid
        $payload = $this->validPayload();
        $payload['kategori_filter'] = ['alam', 'edukasi', 'budaya'];

        $validator = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validator->passes());

        // Status di luar enum (Draf, Tayang, Sembunyikan)
        $payload['status'] = 'AktifSelalu'; // Status tidak valid
        $validatorInvalidStatus = Validator::make($payload, $request->rules(), $request->messages());
        $this->assertTrue($validatorInvalidStatus->fails());
        $this->assertTrue($validatorInvalidStatus->errors()->has('status'));
        $this->assertEquals(
            'Status destinasi hanya boleh bernilai Draf, Tayang, atau Sembunyikan.',
            $validatorInvalidStatus->errors()->first('status')
        );
    }

    /**
     * Memastikan otorisasi Form Request menolak pengguna publik dan mengizinkan pengguna terautentikasi (admin).
     */
    public function test_authorization_protects_admin_endpoint(): void
    {
        $storeRequest = new StoreDestinasiRequest();
        $updateRequest = new UpdateDestinasiRequest();

        // Belum login (publik) -> harus ditolak
        $this->assertFalse($storeRequest->authorize(), 'Pengguna publik tanpa login harus ditolak otorisasi.');
        $this->assertFalse($updateRequest->authorize(), 'Pengguna publik tanpa login harus ditolak otorisasi.');

        // Sudah login -> diizinkan
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->assertTrue($storeRequest->authorize(), 'Admin terautentikasi harus diizinkan.');
        $this->assertTrue($updateRequest->authorize(), 'Admin terautentikasi harus diizinkan.');
    }
}
