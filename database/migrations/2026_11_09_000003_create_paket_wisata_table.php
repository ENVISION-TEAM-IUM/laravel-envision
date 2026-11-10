<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_wisata', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_paket');
            $table->string('harga');
            $table->string('status')->default('Aktif');
            $table->string('foto')->nullable();
            $table->string('destinasi_terkait')->nullable();
            $table->string('aktivitas_umkm')->nullable();
            $table->string('nomor_wa')->nullable();
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisata');
    }
};
