<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Setting;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings   = Setting::getSettings();
        $categories = Portfolio::active()->distinct()->pluck('category');
        $portfolios = Portfolio::active()
                               ->when(request('category'), fn($q, $cat) => $q->byCategory($cat))
                               ->paginate(12);

        return view('pages.portfolio.index', compact('settings', 'portfolios', 'categories'));
    }

    public function show(string $slug)
    {
        $settings  = Setting::getSettings();
        $portfolio = Portfolio::where('slug', $slug)->where('is_active', true)
                              ->with('images')
                              ->firstOrFail();

        // Proyek terkait (kategori sama, bukan proyek ini sendiri)
        $related = Portfolio::active()
                            ->byCategory($portfolio->category)
                            ->where('id', '!=', $portfolio->id)
                            ->take(3)
                            ->get();

        return view('pages.portfolio.show', compact('settings', 'portfolio', 'related'));
    }
}
