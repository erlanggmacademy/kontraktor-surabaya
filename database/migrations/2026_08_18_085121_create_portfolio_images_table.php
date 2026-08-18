<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel portfolio_images menyimpan banyak gambar (galeri) untuk setiap proyek.
     * Relasi: Many-to-One dengan tabel portfolios.
     */
    public function up(): void
    {
        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')               // FK ke tabel portfolios
                  ->constrained()
                  ->onDelete('cascade');                    // Hapus gambar jika proyek dihapus
            $table->string('image_path');                   // Path ke file gambar (storage)
            $table->string('caption')->nullable();          // Alt text / keterangan gambar
            $table->integer('order')->default(0);           // Urutan tampil di galeri
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_images');
    }
};
