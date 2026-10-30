<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DestinasiMigrationUpgradeTest extends TestCase
{
    protected string $tempDbPath;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Siapkan database SQLite pengujian terpisah
        $this->tempDbPath = sys_get_temp_dir() . '/test_envision_migration_' . uniqid() . '.sqlite';
        touch($this->tempDbPath);

        config(['database.connections.migration_test' => [
            'driver' => 'sqlite',
            'database' => $this->tempDbPath,
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]]);

        DB::setDefaultConnection('migration_test');
    }

    protected function tearDown(): void
    {
        DB::purge('migration_test');

        if (file_exists($this->tempDbPath)) {
            @unlink($this->tempDbPath);
        }

        parent::tearDown();
    }

    /**
     * Menguji proses upgrade migration pada database yang sudah berisi data lama:
     * - 'alam' -> ["alam"]
     * - 'alam, edukasi' -> ["alam","edukasi"]
     * - '' dan whitespace -> NULL
     * - NULL -> NULL
     * - valid JSON array -> tidak terjadi double encoding
     * - valid JSON scalar -> menjadi JSON array
     * - default status baru menjadi 'Draf'
     * - rollback down() aman dan tidak memotong data
     */
    public function test_migration_upgrade_and_rollback_with_legacy_data(): void
    {
        // Jalankan migration 1 (tabel awal)
        $migration1 = require database_path('migrations/2026_10_30_134624_create_destinasi_table.php');
        $migration1->up();

        $this->assertTrue(Schema::connection('migration_test')->hasTable('destinasi'));

        // Masukkan data lama beragam variasi sebelum migration 2
        DB::connection('migration_test')->table('destinasi')->insert([
            [
                'nama' => 'Destinasi Tunggal',
                'slug' => 'destinasi-tunggal',
                'kategori' => 'Wisata Alam',
                'kategori_filter' => 'alam',
                'deskripsi' => 'Data lama satu kategori berupa string biasa.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Agro Kelengkeng Thabet',
                'slug' => 'agro-kelengkeng-thabet',
                'kategori' => 'Agrowisata',
                'kategori_filter' => 'alam, edukasi',
                'deskripsi' => 'Data lama multi-kategori dipisah koma.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Destinasi Kosong',
                'slug' => 'destinasi-kosong',
                'kategori' => 'Wisata Budaya',
                'kategori_filter' => '',
                'deskripsi' => 'Data lama dengan string kosong.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Destinasi Spasi',
                'slug' => 'destinasi-spasi',
                'kategori' => 'Wisata',
                'kategori_filter' => '   ',
                'deskripsi' => 'Data lama dengan spasi kosong.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Destinasi Null',
                'slug' => 'destinasi-null',
                'kategori' => 'Wisata',
                'kategori_filter' => null,
                'deskripsi' => 'Data lama bernilai NULL.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Destinasi JSON Valid',
                'slug' => 'destinasi-json-valid',
                'kategori' => 'Wisata',
                'kategori_filter' => '["alam","edukasi"]',
                'deskripsi' => 'Data yang sudah tersimpan sebagai JSON array.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Destinasi JSON Scalar',
                'slug' => 'destinasi-json-scalar',
                'kategori' => 'Wisata',
                'kategori_filter' => '"alam"',
                'deskripsi' => 'Data yang tersimpan sebagai JSON scalar string.',
                'status' => 'Tayang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Jalankan migration 2 (upgrade normalisasi dan schema)
        $migration2 = require database_path('migrations/2026_10_30_135600_update_destinasi_default_status_and_kategori_filter.php');
        $migration2->up();

        // 1. Verifikasi hasil migrasi data lama
        $records = DB::connection('migration_test')->table('destinasi')->pluck('kategori_filter', 'slug');

        // 'alam' -> ["alam"]
        $this->assertSame('["alam"]', $records['destinasi-tunggal']);

        // 'alam, edukasi' -> ["alam","edukasi"]
        $this->assertSame('["alam","edukasi"]', $records['agro-kelengkeng-thabet']);

        // '' -> NULL
        $this->assertNull($records['destinasi-kosong']);

        // '   ' -> NULL
        $this->assertNull($records['destinasi-spasi']);

        // NULL -> NULL
        $this->assertNull($records['destinasi-null']);

        // valid JSON array -> tetap valid JSON array tanpa double encoding
        $this->assertSame('["alam","edukasi"]', $records['destinasi-json-valid']);

        // valid JSON scalar '"alam"' -> dinormalisasi menjadi array ["alam"] tanpa double encoding
        $this->assertSame('["alam"]', $records['destinasi-json-scalar']);

        // 2. Verifikasi default status baru adalah 'Draf'
        DB::connection('migration_test')->table('destinasi')->insert([
            'nama' => 'Destinasi Baru Pasca Upgrade',
            'slug' => 'destinasi-baru-pasca-upgrade',
            'kategori' => 'Wisata Alam',
            'deskripsi' => 'Menguji default status Draf pada skema baru.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $newRecord = DB::connection('migration_test')->table('destinasi')
            ->where('slug', 'destinasi-baru-pasca-upgrade')
            ->first();

        $this->assertSame('Draf', $newRecord->status);

        // 3. Verifikasi rollback method down()
        $migration2->down();

        $rolledBack = DB::connection('migration_test')->table('destinasi')->pluck('kategori_filter', 'slug');

        // JSON array ["alam","edukasi"] dikembalikan ke representasi teks "alam, edukasi"
        $this->assertSame('alam, edukasi', $rolledBack['agro-kelengkeng-thabet']);
        $this->assertSame('alam', $rolledBack['destinasi-tunggal']);
        $this->assertNull($rolledBack['destinasi-kosong']);
        $this->assertNull($rolledBack['destinasi-null']);
    }
}
