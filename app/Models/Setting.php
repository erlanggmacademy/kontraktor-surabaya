<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'company_tagline',
        'company_description',
        'whatsapp_number',
        'email',
        'address',
        'google_maps_embed',
        'logo',
        'favicon',
        'og_image',
        'ga4_tag_id',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'footer_text',
        'founded_year',
        'projects_completed',
    ];

    /**
     * Ambil pengaturan sebagai instance tunggal (Singleton pattern).
     * Selalu gunakan metode ini daripada Setting::first() agar tidak null.
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate([], [
            'company_name'       => 'Nama Perusahaan',
            'whatsapp_number'    => '6281234567890',
            'email'              => 'info@example.com',
            'projects_completed' => 0,
        ]);
    }
}
