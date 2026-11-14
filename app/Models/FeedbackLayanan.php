<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class FeedbackLayanan
 *
 * @property int $id
 * @property int|null $destinasi_id
 * @property string $nama_destinasi
 * @property int $rating_fasilitas
 * @property int $rating_kebersihan
 * @property int $rating_pelayanan
 * @property string|null $asal_kota
 * @property string|null $komentar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Destinasi|null $destinasi
 */
class FeedbackLayanan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedback_layanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'destinasi_id',
        'nama_destinasi',
        'rating_fasilitas',
        'rating_kebersihan',
        'rating_pelayanan',
        'asal_kota',
        'komentar',
    ];

    /**
     * Get the destination related to this feedback.
     *
     * @return BelongsTo<Destinasi, $this>
     */
    public function destinasi(): BelongsTo
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }
}
