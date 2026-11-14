<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerandaSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'beranda_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'button_text',
        'featured_destinations',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'featured_destinations' => 'array',
        ];
    }

    /**
     * Get or initialize the active Beranda settings instance.
     */
    public static function current(): self
    {
        /** @var self $setting */
        $setting = static::query()->first();

        if ($setting) {
            return $setting;
        }

        return static::create(static::defaultAttributes());
    }

    /**
     * Default attributes for Beranda.
     *
     * @return array<string, mixed>
     */
    public static function defaultAttributes(): array
    {
        return [
            'hero_title' => 'Jelajahi Desa Wisata Karangkemiri',
            'hero_subtitle' => 'Wisata alam, edukasi, budaya, dan produk lokal',
            'button_text' => 'Reservasi Sekarang',
            'featured_destinations' => ['candi', 'embung'],
            'status' => 'Tayang',
        ];
    }
}
