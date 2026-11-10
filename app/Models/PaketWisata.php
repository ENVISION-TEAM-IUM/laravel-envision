<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class PaketWisata
 *
 * @property int $id
 * @property string $slug
 * @property string $nama_paket
 * @property string $harga
 * @property string $status
 * @property string|null $foto
 * @property string|null $destinasi_terkait
 * @property string|null $aktivitas_umkm
 * @property string|null $nomor_wa
 * @property string|null $fasilitas
 * @property string|null $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PaketWisata extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paket_wisata';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'nama_paket',
        'harga',
        'status',
        'foto',
        'destinasi_terkait',
        'aktivitas_umkm',
        'nomor_wa',
        'fasilitas',
        'deskripsi',
    ];
}
