<?php

namespace Database\Seeders;

use App\Models\BerandaSetting;
use App\Models\Destinasi;
use App\Models\KontakDesa;
use App\Models\PaketWisata;
use App\Models\ProdukUmkm;
use App\Models\ProfilDesa;
use App\Models\Umkm;
use App\Models\GaleriFoto;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Destinasi Wisata
        Destinasi::updateOrCreate(
            ['slug' => 'candi'],
            [
                'nama' => 'Wahana Edukasi & Outbound Candi',
                'kategori' => 'Edukasi & Outbound',
                'lokasi' => 'Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
                'jam_buka' => 'Senin–Ahad, 08.00–17.00 WIB',
                'harga_tiket' => 'Mulai Rp 75.000 – Rp 100.000',
                'deskripsi' => 'Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, flying fox, panahan, serta edukasi kelompok di area terbuka yang asri.',
                'foto' => 'assets/images/candi.png',
                'status' => 'Tayang',
            ]
        );

        Destinasi::updateOrCreate(
            ['slug' => 'embung'],
            [
                'nama' => 'Embung Prabawulan',
                'kategori' => 'Wisata Alam',
                'lokasi' => 'Dusun Karang Jengkol, Desa Karangkemiri',
                'jam_buka' => 'Setiap Hari, 06.00–18.00 WIB',
                'harga_tiket' => 'Mulai Rp 5.000 / orang',
                'deskripsi' => 'Danau buatan penampung air dengan panorama perbukitan hijau, camping ground, serta spot foto matahari terbit yang menyejukkan.',
                'foto' => 'assets/images/camping-ground.jpeg',
                'status' => 'Tayang',
            ]
        );

        Destinasi::updateOrCreate(
            ['slug' => 'kelengkeng'],
            [
                'nama' => 'Agrowisata Kelengkeng Thabet',
                'kategori' => 'Agrowisata',
                'lokasi' => 'Area Perkebunan Karangkemiri',
                'jam_buka' => 'Musim Panen / Akhir Pekan, 08.00–16.00 WIB',
                'harga_tiket' => 'Tiket Masuk Rp 15.000 / orang',
                'deskripsi' => 'Wisata petik buah kelengkeng langsung dari pohon, edukasi budidaya tanaman buah, dan pembelian hasil kebun segar.',
                'foto' => 'assets/images/whatsapp-image-2025-12-30-at-16.55.33.jpeg',
                'status' => 'Tayang',
            ]
        );

        Destinasi::updateOrCreate(
            ['slug' => 'petilasan'],
            [
                'nama' => 'Petilasan Mbah Siti Benter',
                'kategori' => 'Budaya & Religi',
                'lokasi' => 'Kompleks Cagar Budaya Karangkemiri',
                'jam_buka' => 'Setiap Hari, 08.00–17.00 WIB',
                'harga_tiket' => 'Donasi Sukarela / Pemeliharaan',
                'deskripsi' => 'Situs bersejarah dan warisan budaya leluhur desa dengan tradisi sadranan, napak tilas sejarah, dan ketenangan suasana pedesaan.',
                'foto' => 'assets/images/sadranan.jpeg',
                'status' => 'Tayang',
            ]
        );

        // 2. Paket Wisata
        PaketWisata::updateOrCreate(
            ['slug' => 'paket-outbound'],
            [
                'nama_paket' => 'Paket Outbound',
                'harga' => 'mulai Rp 100.000 ,- / Orang',
                'status' => 'Aktif',
                'foto' => 'assets/images/paket-1.jpeg',
                'destinasi_terkait' => 'Wahana Edukasi & Outbound Candi',
                'aktivitas_umkm' => 'Kriya Kain Perca & Kerajinan Lokal',
                'nomor_wa' => '085702573013',
                'fasilitas' => "Pilihan: Paket Edukasi Ceria, Team Building & Petualang Muda\nWahana outbound, flying fox, ketapel & panahan\nPermainan kelompok & pendamping instruktur berpengalaman\nPenggunaan area outbound & pendopo luas",
                'deskripsi' => 'Nikmati pengalaman seru penuh kebersamaan melalui Paket Outbound di Desa Wisata Karangkemiri. Beragam aktivitas menantang dan menyenangkan di alam terbuka yang dirancang untuk melatih kerja sama, kepemimpinan, dan kekompakan tim.',
            ]
        );

        // 3. UMKM
        $umkm = Umkm::updateOrCreate(
            ['slug' => 'umkm-sari-kedelai'],
            [
                'nama_usaha' => 'UMKM Sari Kedelai Karangkemiri',
                'nama_pemilik' => 'Ibu Siti Khodijah',
                'sektor_usaha' => 'Makanan Olahan',
                'nomor_wa' => '085702573013',
                'jam_operasional' => 'Setiap Hari, 07:00 – 17:00 WIB',
                'alamat' => 'RT 03 / RW 01 Dusun Karang Jengkol, Desa Karangkemiri',
                'deskripsi' => 'Produsen tahu dan olahan kedelai khas desa Karangkemiri dengan bahan alami tanpa pengawet.',
                'foto' => 'assets/images/paket-1.jpeg',
                'status' => 'Tayang',
            ]
        );

        // 4. Produk UMKM
        ProdukUmkm::updateOrCreate(
            ['slug' => 'tahu-karangkemiri-super'],
            [
                'umkm_id' => $umkm->id,
                'nama_produk' => 'Tahu Karangkemiri Super',
                'kategori' => 'makanan',
                'harga' => 'Rp 15.000 / bungkus',
                'status' => 'Tayang',
                'foto' => 'assets/images/paket-1.jpeg',
                'deskripsi' => 'Tahu gurih dan lembut khas olahan pengrajin desa, digoreng renyah atau untuk masakan keluarga.',
            ]
        );

        // 5. Beranda Settings
        BerandaSetting::firstOrCreate([], BerandaSetting::defaultAttributes());

        // 6. Profil Desa
        ProfilDesa::firstOrCreate([], ProfilDesa::defaultAttributes());

        // 7. Kontak & Lokasi Desa
        KontakDesa::firstOrCreate([], KontakDesa::defaultAttributes());

        // 8. Galeri Foto Dokumentasi & Tradisi
        $galeriItems = [
            [
                'judul' => 'Ketapel & Panahan Outbound',
                'kategori' => 'wisata',
                'foto' => 'assets/images/ketapel-panahan.jpeg',
                'keterangan' => 'Wahana permainan ketangkasan outbound Candi Karangkemiri.',
                'urutan' => 1,
                'status' => 'Tayang',
            ],
            [
                'judul' => 'Penghargaan LDWN Peringkat ke-13 Nasional 2023',
                'kategori' => 'tradisi',
                'foto' => 'assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg',
                'keterangan' => 'Prestasi membanggakan Desa Wisata Karangkemiri di tingkat nasional.',
                'urutan' => 2,
                'status' => 'Tayang',
            ],
            [
                'judul' => 'Wahana Flying Fox Candi',
                'kategori' => 'wisata',
                'foto' => 'assets/images/flying-fox-2.jpeg',
                'keterangan' => 'Sensasi meluncur di atas pepohonan hijau yang sejuk.',
                'urutan' => 3,
                'status' => 'Tayang',
            ],
            [
                'judul' => 'Tradisi Budaya Sadranan',
                'kategori' => 'tradisi',
                'foto' => 'assets/images/sadranan.jpeg',
                'keterangan' => 'Pelestarian adat dan budaya leluhur masyarakat desa.',
                'urutan' => 4,
                'status' => 'Tayang',
            ],
            [
                'judul' => 'Kegiatan Outbound Candi',
                'kategori' => 'wisata',
                'foto' => 'assets/images/outbound.jpeg',
                'keterangan' => 'Kegiatan edukatif kelompok dan instansi.',
                'urutan' => 5,
                'status' => 'Tayang',
            ],
            [
                'judul' => 'Area Camping Ground & Alam',
                'kategori' => 'wisata',
                'foto' => 'assets/images/camping-ground.jpeg',
                'keterangan' => 'Bumi perkemahan asri berlatar perbukitan hijau.',
                'urutan' => 6,
                'status' => 'Tayang',
            ],
        ];

        foreach ($galeriItems as $item) {
            GaleriFoto::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
