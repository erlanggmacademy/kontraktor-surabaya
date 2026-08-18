<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::getSettings();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:150',
            'company_tagline'     => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'whatsapp_number'     => 'required|string|max:20',
            'email'               => 'required|email|max:150',
            'address'             => 'nullable|string',
            'google_maps_embed'   => 'nullable|string',
            'ga4_tag_id'          => 'nullable|string|max:50',
            'instagram_url'       => 'nullable|url|max:255',
            'facebook_url'        => 'nullable|url|max:255',
            'youtube_url'         => 'nullable|url|max:255',
            'footer_text'         => 'nullable|string',
            'founded_year'        => 'nullable|integer|min:1900|max:' . date('Y'),
            'projects_completed'  => 'nullable|integer|min:0',
            'logo'                => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'og_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $setting = Setting::getSettings();

        // Handle upload logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // Handle upload OG image
        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('settings', 'public');
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')
                         ->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
