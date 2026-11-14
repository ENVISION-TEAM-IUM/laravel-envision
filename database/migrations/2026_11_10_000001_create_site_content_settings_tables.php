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
        Schema::create('beranda_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Jelajahi Desa Wisata Karangkemiri');
            $table->text('hero_subtitle')->nullable();
            $table->string('button_text')->default('Reservasi Sekarang');
            $table->json('featured_destinations')->nullable();
            $table->string('status', 30)->default('Tayang');
            $table->timestamps();
        });

        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Profil Desa Wisata Karangkemiri');
            $table->string('hero_caption')->default('Mengenal desa kami');
            $table->text('summary')->nullable();
            $table->string('status', 30)->default('Tayang');
            $table->text('history')->nullable();
            $table->text('potensi_desc')->nullable();
            $table->text('culture_desc')->nullable();
            $table->text('access_info')->nullable();
            $table->string('since_year', 20)->default('2017');
            $table->string('manager')->default('BUMDesa Mandiri Sejahtera');
            $table->string('focus')->default('Wisata & UMKM');
            $table->string('vision_title')->default('Visi');
            $table->text('vision')->nullable();
            $table->text('goal')->nullable();
            $table->text('mission')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('structure_photo')->nullable();
            $table->string('support_photo')->nullable();
            $table->timestamps();
        });

        Schema::create('kontak_desa', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('whatsapp')->default('0857 0257 3013');
            $table->string('email')->default('mandirisejahtera.karangkemiri@gmail.com');
            $table->string('hours')->default('Senin – Minggu, 08:00 – 17:00 WIB (Konfirmasi Rombongan)');
            $table->text('maps_url')->nullable();
            $table->text('maps_embed')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_desa');
        Schema::dropIfExists('profil_desa');
        Schema::dropIfExists('beranda_settings');
    }
};
