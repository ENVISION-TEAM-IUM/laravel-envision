<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Umkm
 *
 * @property int $id
 * @property string $slug
 * @property string $nama_usaha
 * @property string $nama_pemilik
 * @property string $sektor_usaha
 * @property string $nomor_wa
 * @property string|null $jam_operasional
 * @property string|null $alamat
 * @property string|null $deskripsi
 * @property string|null $foto
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Umkm extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'nama_usaha',
        'nama_pemilik',
        'sektor_usaha',
        'nomor_wa',
        'jam_operasional',
        'alamat',
        'deskripsi',
        'foto',
        'status',
    ];

    /**
     * Get the products owned by this UMKM.
     *
     * @return HasMany<ProdukUmkm, $this>
     */
    public function produk(): HasMany
    {
        return $this->hasMany(ProdukUmkm::class, 'umkm_id');
    }
}
