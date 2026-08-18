<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabel settings menyimpan konfigurasi global website (nama perusahaan, WA, email, dll)
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_tagline')->nullable();
            $table->text('company_description')->nullable();
            $table->string('whatsapp_number');           // Format: 628xxxxxxxxxx
            $table->string('email');
            $table->text('address')->nullable();
            $table->string('google_maps_embed')->nullable();
            $table->string('logo')->nullable();           // Path ke file logo
            $table->string('favicon')->nullable();        // Path ke file favicon
            $table->string('og_image')->nullable();       // Default OG image
            $table->string('ga4_tag_id')->nullable();     // Google Analytics 4 Tag ID
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('footer_text')->nullable();
            $table->unsignedSmallInteger('founded_year')->nullable();  // Tahun berdiri (Company Facts)
            $table->unsignedInteger('projects_completed')->default(0); // Jumlah proyek selesai (Company Facts)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
