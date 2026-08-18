<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel services menyimpan data layanan yang ditawarkan perusahaan.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');                        // Judul layanan, misal: "Jasa Arsitek"
            $table->string('slug')->unique();               // URL-friendly, misal: jasa-arsitek-surabaya
            $table->string('icon')->nullable();             // Nama ikon Bootstrap Icons, misal: bi-building
            $table->string('thumbnail')->nullable();        // Gambar thumbnail layanan
            $table->text('short_description');              // Deskripsi singkat untuk card
            $table->longText('content')->nullable();        // Konten lengkap (untuk halaman detail)
            $table->integer('order')->default(0);           // Urutan tampil di homepage
            $table->boolean('is_active')->default(true);    // Tampilkan/sembunyikan layanan
            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
