<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel portfolios menyimpan data proyek yang telah dikerjakan.
     */
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');                        // Judul proyek
            $table->string('slug')->unique();               // URL-friendly
            $table->string('category');                     // Kategori: Arsitek, Interior, Renovasi, dll
            $table->string('client_name')->nullable();      // Nama klien (bisa dikosongkan)
            $table->string('location')->nullable();         // Lokasi proyek, misal: Surabaya Barat
            $table->year('year_completed')->nullable();     // Tahun proyek selesai
            $table->decimal('project_value', 15, 2)->nullable(); // Nilai proyek (opsional ditampilkan)
            $table->string('thumbnail');                    // Gambar utama (cover proyek)
            $table->text('short_description');              // Deskripsi singkat untuk card galeri
            $table->longText('content')->nullable();        // Deskripsi lengkap (halaman detail)
            $table->boolean('is_featured')->default(false); // Tampilkan di homepage?
            $table->boolean('is_active')->default(true);    // Publish/hide proyek
            $table->integer('order')->default(0);           // Urutan tampil
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
        Schema::dropIfExists('portfolios');
    }
};
