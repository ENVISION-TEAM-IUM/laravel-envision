<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Destinasi
 *
 * @property int $id
 * @property string $slug
 * @property string $nama
 * @property string $kategori
 * @property string|null $lokasi
 * @property string|null $jam_buka
 * @property string|null $harga_tiket
 * @property string|null $deskripsi
 * @property string|null $foto
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Destinasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'nama',
        'kategori',
        'lokasi',
        'jam_buka',
        'harga_tiket',
        'deskripsi',
        'foto',
        'status',
    ];
}
