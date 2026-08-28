@extends('layouts.admin')
@section('title', 'Edit Layanan — ' . $service->title)

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.layanan.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Layanan
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Edit Layanan: {{ $service->title }}</h4>
</div>

<div class="form-card">
    <form action="{{ route('admin.layanan.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Judul Layanan --}}
            <div class="col-md-8">
                <label for="title" class="form-label">Nama / Judul Layanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                       value="{{ old('title', $service->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Urutan Tampil --}}
            <div class="col-md-4">
                <label for="order" class="form-label">Nomor Urutan Tampil</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                       value="{{ old('order', $service->order) }}">
                @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Icon Bootstrap --}}
            <div class="col-md-6">
                <label for="icon" class="form-label">Icon Bootstrap Class</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon"
                       value="{{ old('icon', $service->icon) }}">
                <small class="text-muted">Gunakan nama class dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</small>
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="col-md-6 d-flex align-items-center pt-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktifkan & Tampilkan di Website</label>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="col-12">
                <label for="short_description" class="form-label">Deskripsi Singkat (Ringkasan) <span class="text-danger">*</span></label>
                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2" required>{{ old('short_description', $service->short_description) }}</textarea>
                @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Konten / Deskripsi Lengkap --}}
            <div class="col-12">
                <label for="content" class="form-label">Deskripsi Lengkap Layanan</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6">{{ old('content', $service->content) }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Foto Thumbnail --}}
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Ganti Foto / Banner (Opsional)</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                @if($service->thumbnail)
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1">Foto saat ini:</small>
                        <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->title }}" class="rounded border" style="max-height: 80px;">
                    </div>
                @endif
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Custom Slug --}}
            <div class="col-md-6">
                <label for="slug" class="form-label">URL Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                       value="{{ old('slug', $service->slug) }}">
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold px-4">
                    <i class="bi bi-save me-1"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

@endsection
