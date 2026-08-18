<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order')->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:200',
            'slug'              => 'nullable|string|unique:portfolios,slug',
            'category'          => 'required|string|max:100',
            'client_name'       => 'nullable|string|max:150',
            'location'          => 'nullable|string|max:150',
            'year_completed'    => 'nullable|digits:4|integer',
            'project_value'     => 'nullable|numeric|min:0',
            'short_description' => 'required|string',
            'content'           => 'nullable|string',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:70',
            'meta_desc'         => 'nullable|string|max:160',
            'thumbnail'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');
        $validated['thumbnail']   = $request->file('thumbnail')->store('portfolios', 'public');

        $portfolio = Portfolio::create($validated);

        // Upload gambar galeri
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image_path'   => $image->store('portfolios/gallery', 'public'),
                    'order'        => $index,
                ]);
            }
        }

        return redirect()->route('admin.portofolio.index')
                         ->with('success', 'Proyek portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portofolio)
    {
        $portofolio->load('images');
        return view('admin.portfolios.edit', ['portfolio' => $portofolio]);
    }

    public function update(Request $request, Portfolio $portofolio)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:200',
            'slug'              => 'nullable|string|unique:portfolios,slug,' . $portofolio->id,
            'category'          => 'required|string|max:100',
            'client_name'       => 'nullable|string|max:150',
            'location'          => 'nullable|string|max:150',
            'year_completed'    => 'nullable|digits:4|integer',
            'project_value'     => 'nullable|numeric|min:0',
            'short_description' => 'required|string',
            'content'           => 'nullable|string',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'nullable|integer',
            'meta_title'        => 'nullable|string|max:70',
            'meta_desc'         => 'nullable|string|max:160',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('portfolios', 'public');
        }

        $portofolio->update($validated);

        // Tambah gambar galeri baru
        if ($request->hasFile('gallery')) {
            $lastOrder = $portofolio->images()->max('order') ?? 0;
            foreach ($request->file('gallery') as $index => $image) {
                PortfolioImage::create([
                    'portfolio_id' => $portofolio->id,
                    'image_path'   => $image->store('portfolios/gallery', 'public'),
                    'order'        => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.portofolio.index')
                         ->with('success', 'Proyek portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portofolio)
    {
        $portofolio->delete(); // images dihapus otomatis via cascade
        return redirect()->route('admin.portofolio.index')
                         ->with('success', 'Proyek berhasil dihapus.');
    }
}
