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
        Schema::create('umkm', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_usaha');
            $table->string('nama_pemilik');
            $table->string('sektor_usaha');
            $table->string('nomor_wa');
            $table->string('jam_operasional')->nullable();
            $table->text('alamat')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('Tayang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
