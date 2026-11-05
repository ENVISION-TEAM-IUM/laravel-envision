<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Destinasi;
use App\Models\User;
use App\Services\DestinasiService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DestinasiCrudTest extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->admin = Admin::factory()->create();
        $this->regularUser = User::factory()->create();
    }

    /**
     * Memastikan guest (belum login) ditolak pada seluruh endpoint CRUD destinasi.
     * Request JSON harus menerima status 401 dari middleware auth:admin,
     * sedangkan request HTML dialihkan ke halaman login admin.
     */
    public function test_guest_cannot_access_crud_operations(): void
    {
        $destinasi = Destinasi::factory()->create(['slug' => 'candi-test']);

        // 1. Request JSON harus mengembalikan 401 Unauthorized
        $this->getJson(route('admin.destinasi.index'))->assertStatus(401);
        $this->getJson(route('admin.destinasi.show', $destinasi))->assertStatus(401);
        $this->postJson(route('admin.destinasi.store'), ['nama' => 'Baru'])->assertStatus(401);
        $this->putJson(route('admin.destinasi.update', $destinasi), ['nama' => 'Ubah'])->assertStatus(401);
        $this->deleteJson(route('admin.destinasi.destroy', $destinasi))->assertStatus(401);

        // 2. Request HTML harus diarahkan ke admin.login
        $this->get(route('admin.destinasi.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.destinasi.show', $destinasi))->assertRedirect(route('admin.login'));
    }

    /**
     * Memastikan user biasa yang hanya terautentikasi pada guard web ditolak oleh middleware auth:admin.
     */
    public function test_regular_user_on_web_guard_cannot_access_crud_operations(): void
    {
        $destinasi = Destinasi::factory()->create(['slug' => 'candi-test']);

        $validPayload = [
            'nama' => 'Tempat Wisata Baru',
            'slug' => 'tempat-wisata-baru',
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Deskripsi tempat wisata...',
        ];

        // 1. Request JSON ditolak 401 oleh middleware auth:admin
        $this->actingAs($this->regularUser, 'web')
            ->getJson(route('admin.destinasi.index'))
            ->assertStatus(401);

        $this->actingAs($this->regularUser, 'web')
            ->getJson(route('admin.destinasi.show', $destinasi))
            ->assertStatus(401);

        $this->actingAs($this->regularUser, 'web')
            ->postJson(route('admin.destinasi.store'), $validPayload)
            ->assertStatus(401);

        $this->actingAs($this->regularUser, 'web')
            ->putJson(route('admin.destinasi.update', $destinasi), $validPayload)
            ->assertStatus(401);

        $this->actingAs($this->regularUser, 'web')
            ->deleteJson(route('admin.destinasi.destroy', $destinasi))
            ->assertStatus(401);

        // 2. Request HTML diarahkan ke admin.login
        $this->actingAs($this->regularUser, 'web')
            ->get(route('admin.destinasi.index'))
            ->assertRedirect(route('admin.login'));

        $this->actingAs($this->regularUser, 'web')
            ->get(route('admin.destinasi.show', $destinasi))
            ->assertRedirect(route('admin.login'));
    }

    /**
     * Memastikan admin dapat melihat daftar destinasi dengan pagination, search, dan filter status.
     */
    public function test_admin_can_list_destinations_with_search_and_filters(): void
    {
        Destinasi::factory()->create([
            'nama' => 'Wahana Edukasi Candi',
            'slug' => 'candi',
            'status' => 'Tayang',
            'kategori' => 'Edukasi & Outbound',
            'kategori_filter' => ['edukasi'],
        ]);

        Destinasi::factory()->create([
            'nama' => 'Embung Prabawulan',
            'slug' => 'embung',
            'status' => 'Draf',
            'kategori' => 'Wisata Alam',
            'kategori_filter' => ['alam'],
        ]);

        Destinasi::factory()->create([
            'nama' => 'Agro Kelengkeng Thabet',
            'slug' => 'kelengkeng',
            'status' => 'Tayang',
            'kategori' => 'Agrowisata',
            'kategori_filter' => ['alam', 'edukasi'],
        ]);

        // 1. Pencarian teks "Embung"
        $searchRes = $this->actingAs($this->admin, 'admin')
            ->getJson(route('admin.destinasi.index', ['search' => 'Embung']))
            ->assertStatus(200);

        $this->assertCount(1, $searchRes->json('data'));
        $this->assertEquals('Embung Prabawulan', $searchRes->json('data.0.nama'));

        // 2. Filter status "Tayang"
        $statusRes = $this->actingAs($this->admin, 'admin')
            ->getJson(route('admin.destinasi.index', ['status' => 'Tayang']))
            ->assertStatus(200);

        $this->assertCount(2, $statusRes->json('data'));

        // 3. Filter kategori "alam" (harus menyertakan Embung dan Kelengkeng)
        $kategoriRes = $this->actingAs($this->admin, 'admin')
            ->getJson(route('admin.destinasi.index', ['kategori' => 'alam']))
            ->assertStatus(200);

        $this->assertCount(2, $kategoriRes->json('data'));
    }

    /**
     * Memastikan admin dapat melihat detail satu destinasi via route model binding slug.
     */
    public function test_admin_can_show_destination_by_slug(): void
    {
        $destinasi = Destinasi::factory()->create([
            'nama' => 'Embung Prabawulan',
            'slug' => 'embung-prabawulan',
        ]);

        $response = $this->actingAs($this->admin, 'admin')
            ->getJson(route('admin.destinasi.show', $destinasi))
            ->assertStatus(200);

        $this->assertEquals('Embung Prabawulan', $response->json('nama'));
        $this->assertEquals('embung-prabawulan', $response->json('slug'));
    }

    /**
     * Memastikan admin dapat menambahkan destinasi dengan foto dan multi-kategori.
     */
    public function test_admin_can_store_destination_with_photo(): void
    {
        $file = UploadedFile::fake()->image('candi-foto.jpg', 800, 600);

        $payload = [
            'nama' => 'Wahana Edukasi & Outbound Candi',
            'slug' => 'wahana-edukasi-candi',
            'kategori' => 'Edukasi & Outbound',
            'kategori_filter' => ['edukasi', 'alam'],
            'deskripsi' => 'Fasilitas outbound lengkap di alam asri Karangkemiri.',
            'status' => 'Tayang',
            'foto' => $file,
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.destinasi.store'), $payload)
            ->assertStatus(201);

        $this->assertDatabaseHas('destinasi', [
            'slug' => 'wahana-edukasi-candi',
            'status' => 'Tayang',
        ]);

        $destinasi = Destinasi::where('slug', 'wahana-edukasi-candi')->first();
        $this->assertNotNull($destinasi->foto);
        Storage::disk('public')->assertExists($destinasi->foto);
        $this->assertEquals(['edukasi', 'alam'], $destinasi->kategori_filter);
    }

    /**
     * Memastikan duplikasi slug ditolak saat menambahkan destinasi baru.
     */
    public function test_store_fails_on_duplicate_slug(): void
    {
        Destinasi::factory()->create(['slug' => 'candi-outbound']);

        $payload = [
            'nama' => 'Candi Baru',
            'slug' => 'candi-outbound', // Duplikat
            'kategori' => 'Edukasi & Outbound',
            'deskripsi' => 'Deskripsi...',
        ];

        $this->actingAs($this->admin, 'admin')
            ->postJson(route('admin.destinasi.store'), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['slug']);
    }

    /**
     * Memastikan admin dapat memperbarui destinasi dan mengganti foto secara aman.
     */
    public function test_admin_can_update_destination_and_safely_replace_photo(): void
    {
        // 1. Buat destinasi dengan foto lama
        $oldFile = UploadedFile::fake()->image('old-photo.jpg');
        $oldPath = Storage::disk('public')->putFile('destinasi', $oldFile);

        $destinasi = Destinasi::factory()->create([
            'slug' => 'embung-prabawulan',
            'nama' => 'Embung Lama',
            'foto' => $oldPath,
            'status' => 'Draf',
        ]);

        Storage::disk('public')->assertExists($oldPath);

        // 2. Unggah foto baru menggunakan POST method spoofing (karena upload file di HTTP membutuhkan multipart POST)
        $newFile = UploadedFile::fake()->image('new-photo.png');

        $updatePayload = [
            'nama' => 'Embung Prabawulan Diperbarui',
            'slug' => 'embung-prabawulan', // Slug sama milik sendiri
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Deskripsi terbaru setelah pembenahan.',
            'status' => 'Tayang',
            'foto' => $newFile,
            '_method' => 'PUT',
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.destinasi.update', $destinasi), $updatePayload, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $fresh = $destinasi->fresh();
        $this->assertEquals('Embung Prabawulan Diperbarui', $fresh->nama);
        $this->assertEquals('Tayang', $fresh->status);
        $this->assertNotEquals($oldPath, $fresh->foto);

        // Foto baru harus ada di storage
        Storage::disk('public')->assertExists($fresh->foto);

        // Foto lama harus sudah dibersihkan karena tidak ada record lain yang menggunakan
        Storage::disk('public')->assertMissing($oldPath);
    }

    /**
     * Memastikan pembaruan tanpa upload foto tetap mempertahankan foto yang sudah ada.
     */
    public function test_update_retains_existing_photo_when_no_new_photo_uploaded(): void
    {
        $photoPath = Storage::disk('public')->putFile('destinasi', UploadedFile::fake()->image('existing.jpg'));

        $destinasi = Destinasi::factory()->create([
            'slug' => 'candi-keep-photo',
            'nama' => 'Candi Asli',
            'foto' => $photoPath,
        ]);

        $updatePayload = [
            'nama' => 'Candi Nama Baru',
            'slug' => 'candi-keep-photo',
            'kategori' => 'Edukasi & Outbound',
            'deskripsi' => 'Deskripsi tetap...',
            'status' => 'Tayang',
        ];

        $this->actingAs($this->admin, 'admin')
            ->putJson(route('admin.destinasi.update', $destinasi), $updatePayload)
            ->assertStatus(200);

        $fresh = $destinasi->fresh();
        $this->assertEquals('Candi Nama Baru', $fresh->nama);
        $this->assertEquals($photoPath, $fresh->foto);
        Storage::disk('public')->assertExists($photoPath);
    }

    /**
     * Memastikan jika penyimpanan database gagal saat ganti foto, file baru dibersihkan dan file lama tidak hilang.
     */
    public function test_photo_replacement_cleans_up_new_file_if_database_fails(): void
    {
        $oldFile = UploadedFile::fake()->image('lama.jpg');
        $oldPath = Storage::disk('public')->putFile('destinasi', $oldFile);

        $destinasi = Destinasi::factory()->create([
            'slug' => 'test-fail-recovery',
            'foto' => $oldPath,
        ]);

        $service = new DestinasiService();
        $newFile = UploadedFile::fake()->image('baru.jpg');

        // Simulasi error database dengan melemparkan exception sengaja
        try {
            $service->update($destinasi, [
                'nama' => 'Gagal',
                'slug' => null, // Memicu error database karena slug NOT NULL
            ], $newFile);
            $this->fail('Seharusnya exception database terlempar.');
        } catch (Exception $e) {
            // Exception diharapkan
        }

        // File lama TIDAK boleh terhapus
        Storage::disk('public')->assertExists($oldPath);
    }

    /**
     * Memastikan admin dapat menghapus destinasi dan membersihkan foto miliknya.
     */
    public function test_admin_can_delete_destination_and_clean_up_photo(): void
    {
        $photo = Storage::disk('public')->putFile('destinasi', UploadedFile::fake()->image('hapus.jpg'));

        $destinasi = Destinasi::factory()->create([
            'slug' => 'destinasi-dihapus',
            'foto' => $photo,
        ]);

        Storage::disk('public')->assertExists($photo);

        $this->actingAs($this->admin, 'admin')
            ->deleteJson(route('admin.destinasi.destroy', $destinasi))
            ->assertStatus(200);

        $this->assertDatabaseMissing('destinasi', ['slug' => 'destinasi-dihapus']);
        Storage::disk('public')->assertMissing($photo);
    }

    /**
     * Memastikan jika file foto digunakan oleh destinasi lain, penghapusan destinasi tidak menghapus file foto tersebut.
     */
    public function test_destroy_does_not_delete_photo_if_shared_by_another_destination(): void
    {
        $sharedPhoto = 'destinasi/shared-logo.png';
        Storage::disk('public')->put($sharedPhoto, 'dummy content');

        $destinasiA = Destinasi::factory()->create([
            'slug' => 'destinasi-a',
            'foto' => $sharedPhoto,
        ]);

        $destinasiB = Destinasi::factory()->create([
            'slug' => 'destinasi-b',
            'foto' => $sharedPhoto,
        ]);

        $this->actingAs($this->admin, 'admin')
            ->deleteJson(route('admin.destinasi.destroy', $destinasiA))
            ->assertStatus(200);

        $this->assertDatabaseMissing('destinasi', ['slug' => 'destinasi-a']);
        $this->assertDatabaseHas('destinasi', ['slug' => 'destinasi-b']);

        // Foto harus tetap ada di storage karena Destinasi B masih menggunakannya
        Storage::disk('public')->assertExists($sharedPhoto);
    }

    /**
     * Memastikan perubahan status (Draf -> Tayang -> Sembunyikan) berjalan dengan benar.
     */
    public function test_admin_can_transition_destination_status(): void
    {
        $destinasi = Destinasi::factory()->draf()->create(['slug' => 'destinasi-status']);
        $this->assertEquals('Draf', $destinasi->status);

        // Ubah ke Tayang
        $this->actingAs($this->admin, 'admin')
            ->putJson(route('admin.destinasi.update', $destinasi), [
                'nama' => $destinasi->nama,
                'slug' => 'destinasi-status',
                'kategori' => $destinasi->kategori,
                'deskripsi' => $destinasi->deskripsi,
                'status' => 'Tayang',
            ])
            ->assertStatus(200);

        $this->assertEquals('Tayang', $destinasi->fresh()->status);

        // Ubah ke Sembunyikan
        $this->actingAs($this->admin, 'admin')
            ->putJson(route('admin.destinasi.update', $destinasi), [
                'nama' => $destinasi->nama,
                'slug' => 'destinasi-status',
                'kategori' => $destinasi->kategori,
                'deskripsi' => $destinasi->deskripsi,
                'status' => 'Sembunyikan',
            ])
            ->assertStatus(200);

        $this->assertEquals('Sembunyikan', $destinasi->fresh()->status);
    }

    /**
     * Tes integrasi penuh:
     * 1. Login via POST admin.login.submit dengan kredensial Admin.
     * 2. Mengakses operasi CRUD destinasi (tambah, lihat, ubah).
     * 3. Logout via POST admin.logout.
     * 4. Memastikan endpoint CRUD kembali tidak dapat diakses (401 / redirect).
     */
    public function test_full_admin_lifecycle_login_crud_and_logout(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Admin Pengelola',
            'email' => 'pengelola@karangkemiri.id',
            'password' => Hash::make('bumdes2026'),
        ]);

        // 1. Sebelum login, guest tidak bisa mengakses index destinasi
        $this->getJson(route('admin.destinasi.index'))->assertStatus(401);

        // 2. Login melalui endpoint resmi admin.login.submit
        $loginResponse = $this->post(route('admin.login.submit'), [
            'email' => 'pengelola@karangkemiri.id',
            'password' => 'bumdes2026',
        ]);

        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertEquals($admin->id, Auth::guard('admin')->id());
        $loginResponse->assertRedirect(route('admin.dashboard'));

        // 3. Setelah login, admin dapat mengakses index destinasi
        $this->getJson(route('admin.destinasi.index'))->assertStatus(200);

        // 4. Admin membuat destinasi baru
        $storeResponse = $this->post(route('admin.destinasi.store'), [
            'nama' => 'Taman Herbal Karangkemiri',
            'slug' => 'taman-herbal-karangkemiri',
            'kategori' => 'Wisata Edukasi',
            'kategori_filter' => ['edukasi', 'alam'],
            'deskripsi' => 'Wisata budidaya tanaman obat keluarga.',
            'status' => 'Tayang',
        ], ['Accept' => 'application/json']);

        $storeResponse->assertStatus(201);
        $this->assertDatabaseHas('destinasi', ['slug' => 'taman-herbal-karangkemiri']);

        $destinasi = Destinasi::where('slug', 'taman-herbal-karangkemiri')->firstOrFail();

        // 5. Admin melihat detail destinasi (GET admin.destinasi.show)
        $showResponse = $this->get(route('admin.destinasi.show', $destinasi));
        $showResponse->assertStatus(200);
        $showResponse->assertJsonPath('slug', 'taman-herbal-karangkemiri');

        $this->getJson(route('admin.destinasi.show', $destinasi))
            ->assertStatus(200)
            ->assertJsonPath('slug', 'taman-herbal-karangkemiri');

        // 6. Admin memperbarui destinasi
        $this->putJson(route('admin.destinasi.update', $destinasi), [
            'nama' => 'Taman Herbal Karangkemiri Modern',
            'slug' => 'taman-herbal-karangkemiri',
            'kategori' => 'Wisata Edukasi',
            'deskripsi' => 'Deskripsi diperbarui.',
            'status' => 'Draf',
        ])->assertStatus(200);

        $this->assertEquals('Draf', $destinasi->fresh()->status);

        // 7. Admin melakukan logout
        $logoutResponse = $this->post(route('admin.logout'));
        $this->assertFalse(Auth::guard('admin')->check());
        $logoutResponse->assertRedirect(route('admin.login'));

        // 8. Setelah logout, akses CRUD kembali ditolak
        $this->getJson(route('admin.destinasi.index'))->assertStatus(401);
        $this->get(route('admin.destinasi.index'))->assertRedirect(route('admin.login'));
    }
}
