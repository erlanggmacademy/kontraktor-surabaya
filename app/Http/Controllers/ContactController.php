<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::getSettings();
        $services = Service::active()->pluck('title', 'id');

        return view('pages.contact', compact('settings', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|max:150',
            'phone'            => 'nullable|string|max:20',
            'subject'          => 'nullable|string|max:200',
            'service_interest' => 'nullable|string|max:100',
            'message'          => 'required|string|min:10|max:2000',
            'location'         => 'nullable|string|max:100',
        ]);

        $validated['ip_address'] = $request->ip();

        Message::create($validated);

        // TODO Minggu 3: Kirim email notifikasi ke admin
        // Mail::to(Setting::getSettings()->email)->send(new NewMessageMail($message));

        return redirect()->route('contact.thankyou');
    }

    public function thankyou()
    {
        $settings = Setting::getSettings();

        return view('pages.contact-thankyou', compact('settings'));
    }
}
