<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakDesa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kontak_desa';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'address',
        'whatsapp',
        'email',
        'hours',
        'maps_url',
        'maps_embed',
        'instagram',
        'facebook',
        'tiktok',
        'youtube',
    ];

    /**
     * Get or initialize the active Kontak Desa instance.
     */
    public static function current(): self
    {
        /** @var self $contact */
        $contact = static::query()->first();

        if ($contact) {
            return $contact;
        }

        return static::create(static::defaultAttributes());
    }

    /**
     * Default attributes for Kontak Desa.
     *
     * @return array<string, mixed>
     */
    public static function defaultAttributes(): array
    {
        return [
            'address' => 'Karang Jengkol, Karangkemiri, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161',
            'whatsapp' => '0857 0257 3013',
            'email' => 'mandirisejahtera.karangkemiri@gmail.com',
            'hours' => 'Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)',
            'maps_url' => 'https://maps.app.goo.gl/VF9FUXXkzUoiD7YT8',
            'maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.489368405458!2d109.1782712!3d-7.410963700000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65609ae8b98401%3A0xac573850d62e937c!2sWahana%20Edukasi%20%26%20Outbond%20CANDI!5e0!3m2!1sid!2sid!4v1787295836593!5m2!1sid!2sid',
            'instagram' => 'https://instagram.com/desawisatakarangkemiri',
            'facebook' => 'https://facebook.com/desawisatakarangkemiri',
            'tiktok' => 'https://tiktok.com/@desawisatakarangkemiri',
            'youtube' => 'https://youtube.com/@desawisatakarangkemiri',
        ];
    }
}
