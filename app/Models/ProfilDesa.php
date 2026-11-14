<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profil_desa';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'hero_caption',
        'summary',
        'status',
        'history',
        'potensi_desc',
        'culture_desc',
        'access_info',
        'since_year',
        'manager',
        'focus',
        'vision_title',
        'vision',
        'goal',
        'mission',
        'main_photo',
        'structure_photo',
        'support_photo',
    ];

    /**
     * Get or initialize the active Profil Desa instance.
     */
    public static function current(): self
    {
        /** @var self $profile */
        $profile = static::query()->first();

        if ($profile) {
            return $profile;
        }

        return static::create(static::defaultAttributes());
    }

    /**
     * Default attributes for Profil Desa.
     *
     * @return array<string, mixed>
     */
    public static function defaultAttributes(): array
    {
        return [
            'title' => 'Profil Desa Wisata Karangkemiri',
            'hero_caption' => 'Mengenal desa kami',
            'summary' => 'Pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi.',
            'status' => 'Tayang',
            'history' => 'Desa Wisata Karangkemiri terletak di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, sekitar 15 menit dari pusat Kota Purwokerto. Berada di kawasan pedesaan yang asri dengan hamparan persawahan dan udara yang sejuk, desa ini menawarkan pengalaman wisata berbasis masyarakat yang memadukan alam, budaya, edukasi, dan rekreasi.',
            'potensi_desc' => 'Keunikan Desa Wisata Karangkemiri terletak pada keberagaman potensi yang saling terintegrasi. Daya tarik utamanya meliputi Wahana Edukasi dan Outbound Candi dengan berbagai wahana rekreasi keluarga dan outbound, Embung Prabawulan sebagai ruang rekreasi dan pemancingan, serta Agro Kelengkeng Thabet yang mengangkat potensi pertanian unggulan desa. Desa ini juga memiliki kekayaan sejarah melalui Petilasan Mbah Siti Benter, Panembahan Mbah Suryangalam, dan Makam Buyut Mbah Mertajaya.',
            'culture_desc' => 'Warisan budaya tetap lestari melalui tradisi Sedekah Bumi, Sadranan, Wayang Clebek, Lengger Banyumasan, Kenthongan, dan Hadroh. Wisatawan juga dapat menikmati produk UMKM dan home industry seperti peyek, gula jawa, tahu, anyaman bambu, serta kerajinan kain perca. Seluruh potensi tersebut dikelola oleh BUMDesa Mandiri Sejahtera bersama masyarakat sebagai wujud pengembangan pariwisata yang berkelanjutan, edukatif, dan berdampak pada peningkatan ekonomi desa.',
            'access_info' => 'Desa Wisata Karangkemiri berlokasi di Kecamatan Karanglewas, Kabupaten Banyumas, Jawa Tengah, dengan akses yang mudah dijangkau menggunakan kendaraan pribadi maupun transportasi daring. Dari Stasiun Purwokerto, perjalanan menuju lokasi berjarak sekitar 7 km dengan waktu tempuh kurang lebih 15–20 menit. Dari Bandara Jenderal Besar Soedirman (Purbalingga) sekitar 45–60 menit, dan dari Yogyakarta International Airport (YIA) sekitar 3–4 jam. Akses jalan dalam kondisi baik dan dapat dilalui kendaraan roda dua, roda empat, maupun bus pariwisata.',
            'since_year' => '2017',
            'manager' => 'BUMDesa Mandiri Sejahtera',
            'focus' => 'Wisata & UMKM',
            'vision_title' => 'Visi',
            'vision' => '“Terwujudnya Desa Wisata Karangkemiri yang berbasis potensi lokal, dikelola bersama dengan semangat gotong royong, serta memberikan manfaat bagi masyarakat.”',
            'goal' => 'Mengembangkan Desa Wisata Karangkemiri sebagai ruang wisata, belajar, dan berkegiatan berbasis potensi lokal melalui keterlibatan dan gotong royong masyarakat, sehingga memberikan pengalaman yang baik bagi pengunjung serta manfaat bagi masyarakat desa.',
            'mission' => "Mengembangkan potensi lokal berupa alam, budaya, sejarah, pertanian, dan kearifan masyarakat sebagai daya tarik wisata.\nMeningkatkan kualitas wisata melalui pelayanan, fasilitas, kegiatan edukasi, rekreasi, dan outbound yang aman dan nyaman.\nMendorong keterlibatan masyarakat dan generasi muda dalam pengelolaan dan pengembangan Desa Wisata.\nMendukung UMKM dan usaha masyarakat agar dapat tumbuh melalui kegiatan pariwisata.\nMelestarikan budaya dan tradisi desa sebagai bagian dari identitas dan daya tarik wisata.\nMembangun kerja sama dan gotong royong antara pengelola, masyarakat, pemerintah, pelaku usaha, dan berbagai pihak dalam mengembangkan pariwisata desa.",
            'main_photo' => 'assets/images/candi.png',
            'structure_photo' => 'assets/images/struktur-unit-wisata.png',
            'support_photo' => 'assets/images/penghargaan-ldwn-peringkat-ke-13-nasional-2023.jpeg',
        ];
    }
}
