<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── 1. Admin User ────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@kontraktorsurabaya.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // ─── 2. Settings Default ──────────────────────────────
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'company_name'        => 'Kontraktor Surabaya',
                'company_tagline'     => 'Membangun dengan Kualitas, Ketepatan, dan Kepercayaan.',
                'company_description' => 'Solusi rancang bangun terpercaya di Surabaya. Kami mewujudkan visi Anda menjadi bangunan presisi dengan manajemen waktu dan anggaran yang transparan.',
                'whatsapp_number'     => '6281234567890',
                'email'               => 'info@kontraktorsurabaya.com',
                'address'             => 'Jl. Contoh No. 123, Surabaya, Jawa Timur',
                'footer_text'         => '© ' . date('Y') . ' Kontraktor Surabaya. All rights reserved.',
                'founded_year'        => 2010,
                'projects_completed'  => 150,
            ]
        );
    }
}
