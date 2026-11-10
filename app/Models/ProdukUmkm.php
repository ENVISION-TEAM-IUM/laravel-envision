<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class ProdukUmkm
 *
 * @property int $id
 * @property int $umkm_id
 * @property string $slug
 * @property string $nama_produk
 * @property string $kategori
 * @property string $harga
 * @property string $status
 * @property string|null $foto
 * @property string|null $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Umkm $umkm
 */
class ProdukUmkm extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk_umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'umkm_id',
        'slug',
        'nama_produk',
        'kategori',
        'harga',
        'status',
        'foto',
        'deskripsi',
    ];

    /**
     * Get the UMKM that owns this product.
     *
     * @return BelongsTo<Umkm, $this>
     */
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}
