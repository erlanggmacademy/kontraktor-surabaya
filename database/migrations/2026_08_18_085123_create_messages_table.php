<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel messages menyimpan pesan dari form kontak / request quote publik.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nama pengirim
            $table->string('email');                        // Email pengirim
            $table->string('phone')->nullable();            // Nomor telepon/WA pengirim
            $table->string('subject')->nullable();          // Subjek pesan
            $table->string('service_interest')->nullable(); // Layanan yang diminati
            $table->text('message');                        // Isi pesan
            $table->string('location')->nullable();         // Lokasi proyek yang diinginkan
            $table->boolean('is_read')->default(false);     // Sudah dibaca admin?
            $table->timestamp('read_at')->nullable();       // Kapan dibaca
            $table->string('ip_address')->nullable();       // IP untuk antisipasi spam
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
