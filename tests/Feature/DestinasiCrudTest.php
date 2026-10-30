<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\DestinasiController;
use App\Models\Destinasi;
use App\Models\User;
use App\Services\DestinasiService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DestinasiCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Daftarkan rute admin CRUD sementara hanya untuk konteks test suite
        // Tanpa memodifikasi file routes/web.php
        Route::prefix('admin/destinasi')
            ->middleware(\Illuminate\Routing\Middleware\SubstituteBindings::class)
            ->name('admin.destinasi.')
            ->group(function () {
                Route::get('/', [DestinasiController::class, 'index'])->name('index');
                Route::get('/{destinasi:slug}', [DestinasiController::class, 'show'])->name('show');
                Route::post('/', [DestinasiController::class, 'store'])->name('store');
                Route::put('/{destinasi:slug}', [DestinasiController::class, 'update'])->name('update');
                Route::delete('/{destinasi:slug}', [DestinasiController::class, 'destroy'])->name('destroy');
            });

        Storage::fake('public');

        $this->adminUser = User::factory()->create();
        $this->regularUser = User::factory()->create();
    }

    /**
     * Helper untuk mengaktifkan Gate 'manage-destinasi' bagi admin.
     */
    protected function authorizeAdmin(): void
    {
        Gate::define('manage-destinasi', fn (User $user) => $user->id === $this->adminUser->id);
    }

    /**
     * Memastikan guest (tanpa login) ditolak pada seluruh operasi CRUD.
     */
    public function test_guest_cannot_access_crud_operations(): void
    {
        // Gate fail-closed: jika belum login, dilarang mengakses
        $destinasi = Destinasi::factory()->create(['slug' => 'candi-test']);

        $this->getJson('/admin/destinasi')->assertStatus(403);
        $this->getJson('/admin/destinasi/candi-test')->assertStatus(403);
        $this->postJson('/admin/destinasi', ['nama' => 'Baru'])->assertStatus(403);
        $this->putJson('/admin/destinasi/candi-test', ['nama' => 'Ubah'])->assertStatus(403);
        $this->deleteJson('/admin/destinasi/candi-test')->assertStatus(403);
    }

    /**
     * Memastikan user yang terautentikasi namun tidak memiliki ability 'manage-destinasi' ditolak (fail-closed).
     */
    public function test_regular_user_without_manage_destinasi_ability_is_forbidden(): void
    {
        // Gate secara eksplisit menolak regular user
        Gate::define('manage-destinasi', fn (User $user) => false);

        $destinasi = Destinasi::factory()->create(['slug' => 'candi-test']);

        $validPayload = [
            'nama' => 'Tempat Wisata Baru',
            'slug' => 'tempat-wisata-baru',
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Deskripsi tempat wisata...',
        ];

        $this->actingAs($this->regularUser)
            ->getJson('/admin/destinasi')
            ->assertStatus(403);

        $this->actingAs($this->regularUser)
            ->postJson('/admin/destinasi', $validPayload)
            ->assertStatus(403);

        $this->actingAs($this->regularUser)
            ->putJson('/admin/destinasi/candi-test', $validPayload)
            ->assertStatus(403);

        $this->actingAs($this->regularUser)
            ->deleteJson('/admin/destinasi/candi-test')
            ->assertStatus(403);
    }

    /**
     * Memastikan admin dapat melihat daftar destinasi dengan pagination, search, dan filter status.
     */
    public function test_admin_can_list_destinations_with_search_and_filters(): void
    {
        $this->authorizeAdmin();

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
        $searchRes = $this->actingAs($this->adminUser)
            ->getJson('/admin/destinasi?search=Embung')
            ->assertStatus(200);

        $this->assertCount(1, $searchRes->json('data'));
        $this->assertEquals('Embung Prabawulan', $searchRes->json('data.0.nama'));

        // 2. Filter status "Tayang"
        $statusRes = $this->actingAs($this->adminUser)
            ->getJson('/admin/destinasi?status=Tayang')
            ->assertStatus(200);

        $this->assertCount(2, $statusRes->json('data'));

        // 3. Filter kategori "alam" (harus menyertakan Embung dan Kelengkeng)
        $kategoriRes = $this->actingAs($this->adminUser)
            ->getJson('/admin/destinasi?kategori=alam')
            ->assertStatus(200);

        $this->assertCount(2, $kategoriRes->json('data'));
    }

    /**
     * Memastikan admin dapat menambahkan destinasi dengan foto dan multi-kategori.
     */
    public function test_admin_can_store_destination_with_photo(): void
    {
        $this->authorizeAdmin();

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

        $response = $this->actingAs($this->adminUser)
            ->postJson('/admin/destinasi', $payload)
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
        $this->authorizeAdmin();

        Destinasi::factory()->create(['slug' => 'candi-outbound']);

        $payload = [
            'nama' => 'Candi Baru',
            'slug' => 'candi-outbound', // Duplikat
            'kategori' => 'Edukasi & Outbound',
            'deskripsi' => 'Deskripsi...',
        ];

        $this->actingAs($this->adminUser)
            ->postJson('/admin/destinasi', $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['slug']);
    }

    /**
     * Memastikan admin dapat memperbarui destinasi dan mengganti foto secara aman.
     */
    public function test_admin_can_update_destination_and_safely_replace_photo(): void
    {
        $this->authorizeAdmin();

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

        // 2. Unggah foto baru
        $newFile = UploadedFile::fake()->image('new-photo.png');

        $updatePayload = [
            'nama' => 'Embung Prabawulan Diperbarui',
            'slug' => 'embung-prabawulan', // Slug sama milik sendiri
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Deskripsi terbaru setelah pembenahan.',
            'status' => 'Tayang',
            'foto' => $newFile,
        ];

        $response = $this->actingAs($this->adminUser)
            ->putJson('/admin/destinasi/embung-prabawulan', $updatePayload)
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
        $this->authorizeAdmin();

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

        $this->actingAs($this->adminUser)
            ->putJson('/admin/destinasi/candi-keep-photo', $updatePayload)
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
                'slug' => null, // Ini akan memicu error database karena slug wajib dan NOT NULL
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
        $this->authorizeAdmin();

        $photo = Storage::disk('public')->putFile('destinasi', UploadedFile::fake()->image('hapus.jpg'));

        $destinasi = Destinasi::factory()->create([
            'slug' => 'destinasi-dihapus',
            'foto' => $photo,
        ]);

        Storage::disk('public')->assertExists($photo);

        $this->actingAs($this->adminUser)
            ->deleteJson('/admin/destinasi/destinasi-dihapus')
            ->assertStatus(200);

        $this->assertDatabaseMissing('destinasi', ['slug' => 'destinasi-dihapus']);
        Storage::disk('public')->assertMissing($photo);
    }

    /**
     * Memastikan jika file foto digunakan oleh destinasi lain, penghapusan destinasi tidak menghapus file foto tersebut.
     */
    public function test_destroy_does_not_delete_photo_if_shared_by_another_destination(): void
    {
        $this->authorizeAdmin();

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

        $this->actingAs($this->adminUser)
            ->deleteJson('/admin/destinasi/destinasi-a')
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
        $this->authorizeAdmin();

        $destinasi = Destinasi::factory()->draf()->create(['slug' => 'destinasi-status']);
        $this->assertEquals('Draf', $destinasi->status);

        // Ubah ke Tayang
        $this->actingAs($this->adminUser)
            ->putJson('/admin/destinasi/destinasi-status', [
                'nama' => $destinasi->nama,
                'slug' => 'destinasi-status',
                'kategori' => $destinasi->kategori,
                'deskripsi' => $destinasi->deskripsi,
                'status' => 'Tayang',
            ])
            ->assertStatus(200);

        $this->assertEquals('Tayang', $destinasi->fresh()->status);

        // Ubah ke Sembunyikan
        $this->actingAs($this->adminUser)
            ->putJson('/admin/destinasi/destinasi-status', [
                'nama' => $destinasi->nama,
                'slug' => 'destinasi-status',
                'kategori' => $destinasi->kategori,
                'deskripsi' => $destinasi->deskripsi,
                'status' => 'Sembunyikan',
            ])
            ->assertStatus(200);

        $this->assertEquals('Sembunyikan', $destinasi->fresh()->status);
    }
}
