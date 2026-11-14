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
        Schema::create('feedback_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinasi_id')->nullable()->constrained('destinasi')->nullOnDelete();
            $table->string('nama_destinasi');
            $table->unsignedTinyInteger('rating_fasilitas')->default(0);
            $table->unsignedTinyInteger('rating_kebersihan')->default(0);
            $table->unsignedTinyInteger('rating_pelayanan')->default(0);
            $table->string('asal_kota')->nullable();
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_layanan');
    }
};
