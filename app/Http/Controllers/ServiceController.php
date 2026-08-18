<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;

class ServiceController extends Controller
{
    public function index()
    {
        $settings = Setting::getSettings();
        $services = Service::active()->get();

        return view('pages.services.index', compact('settings', 'services'));
    }

    public function show(string $slug)
    {
        $settings = Setting::getSettings();
        $service  = Service::where('slug', $slug)->where('is_active', true)
                           ->with('faqs')
                           ->firstOrFail();

        return view('pages.services.show', compact('settings', 'service'));
    }
}
