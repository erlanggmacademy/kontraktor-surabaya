<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:200',
            'slug'         => 'nullable|string|unique:articles,slug',
            'category'     => 'nullable|string|max:100',
            'tags'         => 'nullable|string',
            'excerpt'      => 'required|string|max:500',
            'content'      => 'required|string',
            'is_published' => 'boolean',
            'meta_title'   => 'nullable|string|max:70',
            'meta_desc'    => 'nullable|string|max:160',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug']         = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['user_id']      = auth()->id();
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $artikel)
    {
        return view('admin.articles.edit', ['article' => $artikel]);
    }

    public function update(Request $request, Article $artikel)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:200',
            'slug'         => 'nullable|string|unique:articles,slug,' . $artikel->id,
            'category'     => 'nullable|string|max:100',
            'tags'         => 'nullable|string',
            'excerpt'      => 'required|string|max:500',
            'content'      => 'required|string',
            'is_published' => 'boolean',
            'meta_title'   => 'nullable|string|max:70',
            'meta_desc'    => 'nullable|string|max:160',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        // Set published_at hanya pertama kali dipublish
        if ($validated['is_published'] && ! $artikel->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $artikel)
    {
        $artikel->delete();
        return redirect()->route('admin.artikel.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }
}
