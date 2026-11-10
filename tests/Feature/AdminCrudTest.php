<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create([
            'username' => 'admin_bumdes',
            'email' => 'admin@bumdes.id',
            'name' => 'Admin BUMDes',
        ]);
    }

    public function test_admin_can_view_dashboard_with_stats(): void
    {
        Destinasi::create([
            'slug' => 'candi-test',
            'nama' => 'Candi Test',
            'kategori' => 'Edukasi',
            'status' => 'Tayang',
            'deskripsi' => 'Deskripsi Candi',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Admin BUMDes');
        $response->assertSee('Destinasi wisata');
    }

    public function test_admin_can_view_destinasi_index(): void
    {
        $destinasi = Destinasi::create([
            'slug' => 'embung-prabawulan',
            'nama' => 'Embung Prabawulan',
            'kategori' => 'Wisata Alam',
            'status' => 'Tayang',
            'deskripsi' => 'Danau buatan asri',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.destinasi.index'));

        $response->assertStatus(200);
        $response->assertSee('Embung Prabawulan');
    }

    public function test_admin_can_create_destinasi(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('destinasi.jpg');

        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.destinasi.store'), [
            'nama' => 'Bukit Bintang Karangkemiri',
            'kategori' => 'Wisata Alam',
            'lokasi' => 'Dusun Atas',
            'jam_buka' => '08:00 - 18:00',
            'harga_tiket' => 'Rp 10.000',
            'deskripsi' => 'Pemandangan indah dari ketinggian',
            'status' => 'Tayang',
            'foto' => $file,
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseHas('destinasi', [
            'nama' => 'Bukit Bintang Karangkemiri',
            'slug' => 'bukit-bintang-karangkemiri',
            'kategori' => 'Wisata Alam',
        ]);

        $dest = Destinasi::where('slug', 'bukit-bintang-karangkemiri')->first();
        $this->assertNotNull($dest);
        $this->assertStringStartsWith('storage/destinasi/', $dest->foto);
    }

    public function test_admin_can_update_destinasi(): void
    {
        $dest = Destinasi::create([
            'slug' => 'dest-update-test',
            'nama' => 'Nama Lama',
            'kategori' => 'Alam',
            'status' => 'Tayang',
            'deskripsi' => 'Deskripsi Lama',
            'foto' => 'storage/destinasi/old_foto.jpg',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.destinasi.update', $dest->slug), [
            'nama' => 'Nama Baru Destinasi',
            'kategori' => 'Budaya',
            'lokasi' => 'Pusat Desa',
            'jam_buka' => '24 Jam',
            'harga_tiket' => 'Gratis',
            'deskripsi' => 'Deskripsi Baru yang lengkap',
            'status' => 'Tayang',
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseHas('destinasi', [
            'id' => $dest->id,
            'nama' => 'Nama Baru Destinasi',
            'kategori' => 'Budaya',
            'foto' => 'storage/destinasi/old_foto.jpg',
        ]);
    }
    public function test_admin_can_update_destinasi_with_new_photo(): void
    {
        Storage::fake('public');

        $initialFile = UploadedFile::fake()->image('old_photo.jpg');
        $initialPath = $initialFile->store('destinasi', 'public');

        $dest = Destinasi::create([
            'slug' => 'dest-photo-update',
            'nama' => 'Destinasi Foto Test',
            'kategori' => 'Alam',
            'status' => 'Tayang',
            'deskripsi' => 'Deskripsi Awal',
            'foto' => 'storage/'.$initialPath,
        ]);

        Storage::disk('public')->assertExists($initialPath);

        $newFile = UploadedFile::fake()->image('new_photo.jpg');

        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.destinasi.update', $dest->slug), [
            'nama' => 'Destinasi Foto Test Diperbarui',
            'kategori' => 'Alam',
            'deskripsi' => 'Deskripsi Baru',
            'status' => 'Tayang',
            'foto' => $newFile,
        ]);

        $response->assertRedirect(route('admin.destinasi.index'));

        $dest->refresh();
        $this->assertNotEquals('storage/'.$initialPath, $dest->foto);
        $this->assertStringStartsWith('storage/destinasi/', $dest->foto);

        // Old photo should be deleted from disk
        Storage::disk('public')->assertMissing($initialPath);

        // New photo should exist on disk
        $newPath = str_replace('storage/', '', $dest->foto);
        Storage::disk('public')->assertExists($newPath);
    }


    public function test_admin_can_delete_destinasi(): void
    {
        $dest = Destinasi::create([
            'slug' => 'dest-delete-test',
            'nama' => 'Destinasi Akan Dihapus',
            'kategori' => 'Alam',
            'status' => 'Tayang',
            'deskripsi' => 'Deskripsi',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->delete(route('admin.destinasi.destroy', $dest->slug));

        $response->assertRedirect(route('admin.destinasi.index'));
        $this->assertDatabaseMissing('destinasi', [
            'id' => $dest->id,
        ]);
    }

    public function test_admin_can_create_and_manage_paket_wisata(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.paket.store'), [
            'nama_paket' => 'Paket Camping Seru',
            'harga' => 'Rp 150.000 / orang',
            'status' => 'Aktif',
            'destinasi_terkait' => 'Embung Prabawulan',
            'aktivitas_umkm' => 'Kopi Robusta Desa',
            'nomor_wa' => '081234567890',
            'fasilitas' => 'Tenda, api unggun, sarapan',
            'deskripsi' => 'Pengalaman berkemah asri',
        ]);

        $response->assertRedirect(route('admin.paket.index'));
        $this->assertDatabaseHas('paket_wisata', [
            'nama_paket' => 'Paket Camping Seru',
            'slug' => 'paket-camping-seru',
            'status' => 'Aktif',
        ]);

        $pkg = PaketWisata::where('slug', 'paket-camping-seru')->first();
        $this->assertNotNull($pkg);

        // Update Paket
        $updateResp = $this->actingAs($this->admin, 'admin')->put(route('admin.paket.update', $pkg->slug), [
            'nama_paket' => 'Paket Camping Seru Premium',
            'harga' => 'Rp 200.000 / orang',
            'status' => 'Aktif',
            'destinasi_terkait' => 'Embung Prabawulan',
            'aktivitas_umkm' => 'Kopi Robusta Desa',
            'nomor_wa' => '081234567890',
            'fasilitas' => 'Tenda VIP, BBQ, sarapan',
            'deskripsi' => 'Pengalaman berkemah asri bintang 5',
        ]);

        $updateResp->assertRedirect(route('admin.paket.index'));
        $this->assertDatabaseHas('paket_wisata', [
            'id' => $pkg->id,
            'nama_paket' => 'Paket Camping Seru Premium',
        ]);

        // Delete Paket
        $delResp = $this->actingAs($this->admin, 'admin')->delete(route('admin.paket.destroy', $pkg->slug));
        $delResp->assertRedirect(route('admin.paket.index'));
        $this->assertDatabaseMissing('paket_wisata', ['id' => $pkg->id]);
    }

    public function test_admin_can_create_and_manage_umkm_and_products(): void
    {
        // 1. Create UMKM
        $createUmkmResp = $this->actingAs($this->admin, 'admin')->post(route('admin.umkm.store'), [
            'nama_usaha' => 'Kopi Karangkemiri',
            'nama_pemilik' => 'Pak Slamet',
            'sektor_usaha' => 'Makanan Olahan',
            'nomor_wa' => '081234567890',
            'jam_operasional' => '08:00 - 17:00 WIB',
            'alamat' => 'RT 01 RW 02',
            'deskripsi' => 'Kopi petik merah asli lereng desa',
            'status' => 'Tayang',
        ]);

        $createUmkmResp->assertRedirect(route('admin.umkm.index', ['tab' => 'profiles']));
        $this->assertDatabaseHas('umkm', [
            'nama_usaha' => 'Kopi Karangkemiri',
            'slug' => 'kopi-karangkemiri',
        ]);

        $umkm = Umkm::where('slug', 'kopi-karangkemiri')->first();
        $this->assertNotNull($umkm);

        // 2. Create Product under UMKM
        $createProdResp = $this->actingAs($this->admin, 'admin')->post(route('admin.umkm.produk.store'), [
            'umkm_id' => $umkm->id,
            'nama_produk' => 'Kopi Robusta 250gr',
            'kategori' => 'makanan',
            'harga' => 'Rp 35.000',
            'status' => 'Tayang',
            'deskripsi' => 'Bubuk kopi murni kemasan higienis',
        ]);

        $createProdResp->assertRedirect(route('admin.umkm.index', ['tab' => 'products']));
        $this->assertDatabaseHas('produk_umkm', [
            'umkm_id' => $umkm->id,
            'nama_produk' => 'Kopi Robusta 250gr',
            'slug' => 'kopi-robusta-250gr',
        ]);

        $product = ProdukUmkm::where('slug', 'kopi-robusta-250gr')->first();
        $this->assertNotNull($product);

        // 3. Update Product
        $updateProdResp = $this->actingAs($this->admin, 'admin')->put(route('admin.umkm.produk.update', $product->slug), [
            'umkm_id' => $umkm->id,
            'nama_produk' => 'Kopi Robusta 250gr Premium',
            'kategori' => 'makanan',
            'harga' => 'Rp 40.000',
            'status' => 'Tayang',
            'deskripsi' => 'Bubuk kopi murni rasa mantap',
        ]);

        $updateProdResp->assertRedirect(route('admin.umkm.index', ['tab' => 'products']));
        $this->assertDatabaseHas('produk_umkm', [
            'id' => $product->id,
            'nama_produk' => 'Kopi Robusta 250gr Premium',
        ]);

        // 4. Delete Product
        $delProdResp = $this->actingAs($this->admin, 'admin')->delete(route('admin.umkm.produk.destroy', $product->slug));
        $delProdResp->assertRedirect(route('admin.umkm.index', ['tab' => 'products']));
        $this->assertDatabaseMissing('produk_umkm', ['id' => $product->id]);

        // 5. Delete UMKM
        $delUmkmResp = $this->actingAs($this->admin, 'admin')->delete(route('admin.umkm.destroy', $umkm->slug));
        $delUmkmResp->assertRedirect(route('admin.umkm.index', ['tab' => 'profiles']));
        $this->assertDatabaseMissing('umkm', ['id' => $umkm->id]);
    }
}
