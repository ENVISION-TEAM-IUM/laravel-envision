<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Normalisasi data lama pada kolom kategori_filter SEBELUM alter tipe kolom,
        // guna mencegah error fatal SQLSTATE[22032] (Invalid JSON text) di MySQL.
        $records = DB::table('destinasi')->whereNotNull('kategori_filter')->get();

        foreach ($records as $record) {
            $raw = $record->kategori_filter;
            $trimmed = trim((string) $raw);

            if ($trimmed === '') {
                // String kosong atau whitespace dinormalisasi menjadi NULL
                DB::table('destinasi')->where('id', $record->id)->update([
                    'kategori_filter' => null,
                ]);
                continue;
            }

            $decoded = json_decode($raw, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                if (is_array($decoded)) {
                    // JSON array valid: bersihkan whitespace dan pastikan elemen adalah string lowercase
                    $items = array_values(array_filter(array_map('strtolower', array_map('trim', array_filter($decoded, 'is_scalar')))));
                    $final = !empty($items) ? json_encode($items) : null;
                } elseif (is_scalar($decoded)) {
                    // JSON scalar valid (misal: "alam"): dinormalisasi menjadi JSON array ["alam"]
                    $str = strtolower(trim((string) $decoded));
                    $final = $str !== '' ? json_encode([$str]) : null;
                } else {
                    $final = null;
                }
            } else {
                // String non-JSON (misal: "alam" atau "alam, edukasi"): dipecah menjadi array
                $items = array_values(array_filter(array_map('strtolower', array_map('trim', explode(',', $raw)))));
                $final = !empty($items) ? json_encode($items) : null;
            }

            DB::table('destinasi')->where('id', $record->id)->update([
                'kategori_filter' => $final,
            ]);
        }

        // 2. Lakukan ALTER COLUMN setelah semua data dipastikan berformat JSON array yang valid atau NULL.
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('status')->default('Draf')->change();
            $table->json('kategori_filter')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Ubah tipe kolom kembali ke TEXT (mencegah data terpotong jika > 255 karakter)
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('status')->default('Tayang')->change();
            $table->text('kategori_filter')->nullable()->change();
        });

        // 2. Kembalikan data dari JSON array ke representasi teks (dipisah koma) secara aman
        $records = DB::table('destinasi')->whereNotNull('kategori_filter')->get();

        foreach ($records as $record) {
            $val = $record->kategori_filter;
            $decoded = json_decode($val, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $text = implode(', ', $decoded);
                DB::table('destinasi')->where('id', $record->id)->update([
                    'kategori_filter' => $text !== '' ? $text : null,
                ]);
            }
        }
    }
};
