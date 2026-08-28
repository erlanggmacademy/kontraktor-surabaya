<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Setting;

class ArticleController extends Controller
{
    public function index()
    {
        $settings   = Setting::getSettings();
        $categories = Article::where('is_published', true)->distinct()->pluck('category')->filter();
        $articles   = Article::published()
                             ->when(request('category'), fn($q, $cat) => $q->byCategory($cat))
                             ->paginate(9);

        return view('pages.articles.index', compact('settings', 'articles', 'categories'));
    }

    public function show(string $slug)
    {
        $settings = Setting::getSettings();
        $article  = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // Artikel terkait (kategori sama)
        $related = Article::published()
                          ->where('id', '!=', $article->id)
                          ->when($article->category, fn($q) => $q->byCategory($article->category))
                          ->take(3)
                          ->get();

        return view('pages.articles.show', compact('settings', 'article', 'related'));
    }
}
