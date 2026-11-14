<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Destinasi;
use App\Models\KontakDesa;
use App\Models\ProfilDesa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminContentSettingsTest extends TestCase
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

    public function test_guest_cannot_access_cms_settings_pages(): void
    {
        $this->get(route('admin.beranda'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.profil'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.kontak'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.pratinjau'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_and_update_beranda_settings(): void
    {
        Destinasi::create([
            'slug' => 'candi-edukasi',
            'nama' => 'Candi Edukasi',
            'kategori' => 'Edukasi',
            'status' => 'Tayang',
            'deskripsi' => 'Wahana edukasi',
        ]);

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.beranda'));
        $response->assertStatus(200);
        $response->assertSee('Edit halaman Beranda');

        $updateResponse = $this->actingAs($this->admin, 'admin')->put(route('admin.beranda.update'), [
            'hero_title' => 'Selamat Datang di Karangkemiri',
            'hero_subtitle' => 'Pusat wisata edukasi dan outbound terpadu',
            'button_text' => 'Pesan Sekarang',
            'featured_destinations' => ['candi-edukasi'],
        ]);

        $updateResponse->assertRedirect(route('admin.beranda'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('beranda_settings', [
            'hero_title' => 'Selamat Datang di Karangkemiri',
            'button_text' => 'Pesan Sekarang',
        ]);

        // Verify public home page reflects updated content
        $publicHome = $this->get(route('home'));
        $publicHome->assertStatus(200);
        $publicHome->assertSee('Selamat Datang di Karangkemiri');
        $publicHome->assertSee('Pesan Sekarang');
        $publicHome->assertSee('Candi Edukasi');
    }

    public function test_admin_can_view_and_update_profil_desa(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.profil'));
        $response->assertStatus(200);
        $response->assertSee('Edit Profil Desa');

        $fakePhoto = UploadedFile::fake()->image('profil_baru.jpg', 600, 400);

        $updateResponse = $this->actingAs($this->admin, 'admin')->put(route('admin.profil.update'), [
            'title' => 'Profil Terbaru Desa Karangkemiri',
            'hero_caption' => 'Mengenal Keindahan Desa Kami',
            'summary' => 'Desa wisata unggulan di Jawa Tengah.',
            'status' => 'Tayang',
            'history' => 'Sejarah desa yang kaya akan budaya dan nilai gotong royong.',
            'potensi_desc' => 'Potensi pertanian dan outbound terbaik.',
            'culture_desc' => 'Kesenian lengger dan tradisi sadranan.',
            'access_info' => '15 menit dari Stasiun Purwokerto.',
            'since_year' => '2018',
            'manager' => 'BUMDesa Mandiri Baru',
            'focus' => 'Agrowisata & UMKM',
            'vision_title' => 'Visi Unggulan',
            'vision' => 'Menjadi desa wisata nomor satu nasional.',
            'goal' => 'Meningkatkan kesejahteraan masyarakat.',
            'mission' => "Misi 1: Pendidikan.\nMisi 2: Pelestarian alam.",
            'main_photo' => $fakePhoto,
        ]);

        $updateResponse->assertRedirect(route('admin.profil'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('profil_desa', [
            'title' => 'Profil Terbaru Desa Karangkemiri',
            'since_year' => '2018',
            'manager' => 'BUMDesa Mandiri Baru',
        ]);

        // Verify public profile page
        $publicProfile = $this->get(route('profil'));
        $publicProfile->assertStatus(200);
        $publicProfile->assertSee('Profil Terbaru Desa Karangkemiri');
        $publicProfile->assertSee('BUMDesa Mandiri Baru');
        $publicProfile->assertSee('Misi 1: Pendidikan.');
    }

    public function test_admin_can_reset_profil_desa(): void
    {
        $profil = ProfilDesa::current();
        $profil->title = 'Judul Sementara';
        $profil->save();

        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.profil.reset'));
        $response->assertRedirect(route('admin.profil'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('profil_desa', [
            'title' => 'Profil Desa Wisata Karangkemiri',
        ]);
    }

    public function test_admin_can_view_and_update_kontak_desa(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.kontak'));
        $response->assertStatus(200);
        $response->assertSee('Edit Kontak & Lokasi');

        $updateResponse = $this->actingAs($this->admin, 'admin')->put(route('admin.kontak.update'), [
            'address' => 'Jl. Karangkemiri No. 12, Banyumas',
            'whatsapp' => '0812 3456 7890',
            'email' => 'kontak@karangkemiri.id',
            'hours' => 'Setiap Hari 08:00 - 18:00 WIB',
            'maps_url' => 'https://maps.app.goo.gl/testing123',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=test',
            'instagram' => 'https://instagram.com/karangkemiri_official',
            'facebook' => 'https://facebook.com/karangkemiri_official',
            'tiktok' => 'https://tiktok.com/@karangkemiri',
            'youtube' => 'https://youtube.com/@karangkemiri',
        ]);

        $updateResponse->assertRedirect(route('admin.kontak'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('kontak_desa', [
            'address' => 'Jl. Karangkemiri No. 12, Banyumas',
            'whatsapp' => '0812 3456 7890',
            'email' => 'kontak@karangkemiri.id',
        ]);

        // Verify public contact page
        $publicContact = $this->get(route('kontak'));
        $publicContact->assertStatus(200);
        $publicContact->assertSee('Jl. Karangkemiri No. 12, Banyumas');
        $publicContact->assertSee('0812 3456 7890');
        $publicContact->assertSee('kontak@karangkemiri.id');
    }

    public function test_admin_can_reset_kontak_desa(): void
    {
        $kontak = KontakDesa::current();
        $kontak->email = 'temp@domain.com';
        $kontak->save();

        $response = $this->actingAs($this->admin, 'admin')->post(route('admin.kontak.reset'));
        $response->assertRedirect(route('admin.kontak'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kontak_desa', [
            'email' => 'mandirisejahtera.karangkemiri@gmail.com',
        ]);
    }

    public function test_admin_can_view_pratinjau_and_toggle_publish_draft(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.pratinjau'));
        $response->assertStatus(200);
        $response->assertSee('Periksa sebelum diterbitkan');

        // Test draft
        $draftResponse = $this->actingAs($this->admin, 'admin')->post(route('admin.pratinjau.draft'));
        $draftResponse->assertRedirect(route('admin.pratinjau'));
        $draftResponse->assertSessionHas('success');

        $this->assertDatabaseHas('beranda_settings', ['status' => 'Draf']);
        $this->assertDatabaseHas('profil_desa', ['status' => 'Draf']);

        // Test publish
        $publishResponse = $this->actingAs($this->admin, 'admin')->post(route('admin.pratinjau.publish'));
        $publishResponse->assertRedirect(route('admin.pratinjau'));
        $publishResponse->assertSessionHas('success');

        $this->assertDatabaseHas('beranda_settings', ['status' => 'Tayang']);
        $this->assertDatabaseHas('profil_desa', ['status' => 'Tayang']);
    }

    public function test_validation_errors_when_updating_beranda(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.beranda.update'), [
            'hero_title' => '',
            'hero_subtitle' => '',
            'button_text' => '',
            'status' => 'InvalidStatus',
        ]);

        $response->assertSessionHasErrors(['hero_title', 'hero_subtitle', 'button_text', 'status']);
    }

    public function test_validation_errors_when_updating_profil(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.profil.update'), [
            'title' => '',
            'hero_caption' => '',
            'summary' => '',
            'status' => 'BukanStatusValid',
            'history' => '',
            'potensi_desc' => '',
            'culture_desc' => '',
            'since_year' => '',
            'manager' => '',
            'focus' => '',
            'vision_title' => '',
            'vision' => '',
            'goal' => '',
            'mission' => '',
        ]);

        $response->assertSessionHasErrors([
            'title', 'hero_caption', 'summary', 'status', 'history',
            'potensi_desc', 'culture_desc', 'since_year', 'manager',
            'focus', 'vision_title', 'vision', 'goal', 'mission',
        ]);
    }

    public function test_validation_errors_when_updating_kontak(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.kontak.update'), [
            'address' => '',
            'whatsapp' => '',
            'email' => 'invalid-email-format',
            'hours' => '',
            'maps_url' => 'not-a-valid-url',
            'instagram' => 'bukan-url',
        ]);

        $response->assertSessionHasErrors(['address', 'whatsapp', 'email', 'hours', 'maps_url', 'instagram']);
    }

    public function test_admin_can_upload_all_photos_for_profil_desa(): void
    {
        Storage::fake('public');

        $mainPhoto = UploadedFile::fake()->image('main.jpg', 600, 400);
        $structPhoto = UploadedFile::fake()->image('struct.png', 800, 600);
        $supportPhoto = UploadedFile::fake()->image('support.jpg', 600, 400);

        $response = $this->actingAs($this->admin, 'admin')->put(route('admin.profil.update'), [
            'title' => 'Profil Uji Lengkap',
            'hero_caption' => 'Caption Uji',
            'summary' => 'Ringkasan uji',
            'status' => 'Tayang',
            'history' => 'Sejarah uji',
            'potensi_desc' => 'Potensi uji',
            'culture_desc' => 'Budaya uji',
            'access_info' => 'Akses uji',
            'since_year' => '2019',
            'manager' => 'BUMDes Uji',
            'focus' => 'Wisata',
            'vision_title' => 'Visi',
            'vision' => 'Visi uji',
            'goal' => 'Tujuan uji',
            'mission' => 'Misi uji',
            'main_photo' => $mainPhoto,
            'structure_photo' => $structPhoto,
            'support_photo' => $supportPhoto,
        ]);

        $response->assertRedirect(route('admin.profil'));
        $response->assertSessionHas('success');

        $profil = ProfilDesa::current();
        $this->assertStringStartsWith('storage/profil/', $profil->main_photo);
        $this->assertStringStartsWith('storage/profil/', $profil->structure_photo);
        $this->assertStringStartsWith('storage/profil/', $profil->support_photo);
    }
}
