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
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('kategori_filter')->nullable();
            $table->string('subjudul')->nullable();
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->string('foto')->nullable();
            $table->json('galeri')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('harga_tiket')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->text('maps_url')->nullable();
            $table->text('maps_embed')->nullable();
            $table->json('kegiatan')->nullable();
            $table->string('kontak_wa')->nullable();
            $table->string('status')->default('Tayang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
