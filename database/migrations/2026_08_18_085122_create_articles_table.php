<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel articles menyimpan konten blog/artikel untuk SEO.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')                    // Penulis artikel (admin)
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('title');                        // Judul artikel
            $table->string('slug')->unique();               // URL-friendly
            $table->string('category')->nullable();         // Kategori, misal: Tips Bangun Rumah
            $table->string('tags')->nullable();             // Tags (simpan sebagai CSV atau JSON)
            $table->string('thumbnail')->nullable();        // Gambar utama artikel
            $table->text('excerpt');                        // Ringkasan artikel (untuk listing)
            $table->longText('content');                    // Konten lengkap WYSIWYG
            $table->boolean('is_published')->default(false); // Draft atau Published
            $table->timestamp('published_at')->nullable();  // Tanggal publikasi
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
        Schema::dropIfExists('articles');
    }
};
