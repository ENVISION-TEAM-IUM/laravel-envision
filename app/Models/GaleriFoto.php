<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class GaleriFoto
 *
 * @property int $id
 * @property string $judul
 * @property string $kategori
 * @property string $foto
 * @property string|null $keterangan
 * @property int $urutan
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class GaleriFoto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galeri_foto';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'kategori',
        'foto',
        'keterangan',
        'urutan',
        'status',
    ];
}
