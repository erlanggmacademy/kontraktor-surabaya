<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Article;
use App\Models\Setting;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $settings   = Setting::getSettings();
        $services   = Service::active()->take(6)->get();
        $portfolios = Portfolio::featured()->with('images')->take(6)->get();
        $articles   = Article::published()->take(3)->get();
        $faqs       = Faq::general()->take(8)->get();

        return view('pages.home', compact(
            'settings', 'services', 'portfolios', 'articles', 'faqs'
        ));
    }

    public function about()
    {
        $settings = Setting::getSettings();

        return view('pages.about', compact('settings'));
    }
}
