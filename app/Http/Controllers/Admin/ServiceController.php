<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'nullable|string|unique:services,slug',
            'icon'              => 'nullable|string|max:100',
            'short_description' => 'required|string',
            'content'           => 'nullable|string',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
            'meta_title'        => 'nullable|string|max:70',
            'meta_desc'         => 'nullable|string|max:160',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug']      = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $layanan)
    {
        return view('admin.services.edit', ['service' => $layanan]);
    }

    public function update(Request $request, Service $layanan)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => 'nullable|string|unique:services,slug,' . $layanan->id,
            'icon'              => 'nullable|string|max:100',
            'short_description' => 'required|string',
            'content'           => 'nullable|string',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
            'meta_title'        => 'nullable|string|max:70',
            'meta_desc'         => 'nullable|string|max:160',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug']      = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('services', 'public');
        }

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil dihapus.');
    }
}
