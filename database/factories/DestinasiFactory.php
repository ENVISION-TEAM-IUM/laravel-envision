<?php

namespace Database\Factories;

use App\Models\Destinasi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destinasi>
 */
class DestinasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Destinasi>
     */
    protected $model = Destinasi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nama = fake()->unique()->words(3, true);

        return [
            'nama' => ucfirst($nama),
            'slug' => Str::slug($nama),
            'kategori' => fake()->randomElement(['Wisata Alam', 'Edukasi & Outbound', 'Agrowisata', 'Wisata Budaya']),
            'kategori_filter' => fake()->randomElement([
                ['alam'],
                ['edukasi'],
                ['budaya'],
                ['alam', 'edukasi'],
            ]),
            'subjudul' => fake()->sentence(6),
            'deskripsi' => fake()->paragraph(3),
            'lokasi' => 'Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
            'foto' => 'images/destinasi/' . Str::slug($nama) . '.jpg',
            'galeri' => [
                'images/destinasi/galeri-1.jpg',
                'images/destinasi/galeri-2.jpg',
            ],
            'fasilitas' => [
                'Area Parkir',
                'Toilet & Mushola',
                'Gazebo Santai',
            ],
            'harga_tiket' => 'Konfirmasi Pengelola BUMDes',
            'jam_operasional' => 'Senin – Minggu, 08:00 – 17:00 WIB',
            'maps_url' => 'https://maps.google.com/?q=' . urlencode($nama),
            'maps_embed' => 'https://maps.google.com/maps?q=' . urlencode($nama) . '&output=embed',
            'kegiatan' => [
                'Wisata alam & bersantai',
                'Edukasi dan outbound kelompok',
            ],
            'kontak_wa' => '6281234567890',
            'status' => 'Draf', // Default kebijakan: Draf
        ];
    }

    /**
     * State untuk destinasi yang berstatus Tayang.
     */
    public function tayang(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Tayang',
        ]);
    }

    /**
     * State untuk destinasi yang berstatus Draf.
     */
    public function draf(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Draf',
        ]);
    }

    /**
     * State untuk destinasi yang berstatus Sembunyikan.
     */
    public function sembunyikan(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Sembunyikan',
        ]);
    }
}
