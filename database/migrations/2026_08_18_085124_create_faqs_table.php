<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel faqs menyimpan FAQ dinamis per layanan (untuk AEO/GEO - ramah AI).
     */
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')                 // FK ke layanan tertentu (opsional)
                  ->nullable()
                  ->constrained()
                  ->onDelete('set null');                   // Jika layanan dihapus, FAQ tetap ada (service_id jadi null = FAQ umum)
            $table->string('question');                     // Pertanyaan
            $table->text('answer');                         // Jawaban (mendukung teks panjang)
            $table->integer('order')->default(0);           // Urutan tampil
            $table->boolean('is_active')->default(true);    // Tampilkan/sembunyikan FAQ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
