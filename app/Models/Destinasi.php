<?php

namespace App\Models;

use Database\Factories\DestinasiFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    /** @use HasFactory<DestinasiFactory> */
    use HasFactory;

    /**
     * Nama tabel yang digunakan secara eksplisit.
     *
     * @var string
     */
    protected $table = 'destinasi';

    /**
     * Nilai default atribut model.
     * Kebijakan default: destinasi baru berstatus 'Draf' agar tidak langsung dipublikasikan.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => 'Draf',
    ];

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'slug',
        'kategori',
        'kategori_filter',
        'subjudul',
        'deskripsi',
        'lokasi',
        'foto',
        'galeri',
        'fasilitas',
        'harga_tiket',
        'jam_operasional',
        'maps_url',
        'maps_embed',
        'kegiatan',
        'kontak_wa',
        'status',
    ];

    /**
     * Dapatkan atribut yang harus di-cast ke tipe data tertentu.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'kategori_filter' => 'array',
            'galeri' => 'array',
            'fasilitas' => 'array',
            'kegiatan' => 'array',
        ];
    }

    /**
     * Mutator untuk memastikan kategori_filter selalu tersimpan sebagai format JSON array yang bersih.
     * Mendukung input berupa array ['alam', 'edukasi'], string dipisah koma 'alam, edukasi',
     * JSON array string '["alam","edukasi"]', maupun scalar '"alam"' tanpa double encoding.
     */
    public function setKategoriFilterAttribute($value): void
    {
        if (is_array($value)) {
            $items = array_values(array_filter(array_map('strtolower', array_map('trim', array_filter($value, 'is_scalar')))));
            $this->attributes['kategori_filter'] = !empty($items) ? json_encode($items) : null;
            return;
        }

        if (is_string($value)) {
            $trimmed = trim($value);
            if ($trimmed === '') {
                $this->attributes['kategori_filter'] = null;
                return;
            }

            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                if (is_array($decoded)) {
                    $items = array_values(array_filter(array_map('strtolower', array_map('trim', array_filter($decoded, 'is_scalar')))));
                    $this->attributes['kategori_filter'] = !empty($items) ? json_encode($items) : null;
                } elseif (is_scalar($decoded)) {
                    $str = strtolower(trim((string) $decoded));
                    $this->attributes['kategori_filter'] = $str !== '' ? json_encode([$str]) : null;
                } else {
                    $this->attributes['kategori_filter'] = null;
                }
            } else {
                $items = array_values(array_filter(array_map('strtolower', array_map('trim', explode(',', $value)))));
                $this->attributes['kategori_filter'] = !empty($items) ? json_encode($items) : null;
            }
            return;
        }

        $this->attributes['kategori_filter'] = null;
    }

    /**
     * Gunakan slug sebagai route key default untuk route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope query untuk hanya menyaring destinasi yang berstatus tayang.
     */
    public function scopeTayang(Builder $query): Builder
    {
        return $query->whereIn('status', ['Tayang', 'tayang']);
    }

    /**
     * Scope query untuk hanya menyaring destinasi yang berstatus draf.
     */
    public function scopeDraf(Builder $query): Builder
    {
        return $query->whereIn('status', ['Draf', 'draf']);
    }

    /**
     * Scope query untuk menyaring destinasi berdasarkan kategori tampilan atau kategori_filter.
     * Mendukung string tunggal ('alam'), string koma ('alam,edukasi'), atau array (['alam', 'edukasi']).
     */
    public function scopeKategori(Builder $query, string|array $kategori): Builder
    {
        $categories = is_array($kategori) ? $kategori : explode(',', $kategori);
        $categories = array_values(array_filter(array_map('strtolower', array_map('trim', $categories))));

        if (empty($categories)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($categories) {
            foreach ($categories as $cat) {
                $q->orWhere(function (Builder $sub) use ($cat) {
                    $sub->whereRaw('LOWER(kategori) LIKE ?', ["%{$cat}%"])
                        ->orWhereJsonContains('kategori_filter', $cat);
                });
            }
        });
    }

    /**
     * Cek apakah destinasi sedang aktif / tayang.
     */
    public function isTayang(): bool
    {
        return in_array(strtolower($this->status), ['tayang', 'published', 'active'], true);
    }

    /**
     * Cek apakah destinasi berstatus draf.
     */
    public function isDraf(): bool
    {
        return in_array(strtolower($this->status), ['draf', 'draft'], true);
    }
}
