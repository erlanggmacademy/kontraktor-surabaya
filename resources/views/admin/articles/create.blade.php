@extends('layouts.admin')
@section('title', 'Tulis Artikel Baru')

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.artikel.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Artikel
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Tulis Artikel Baru</h4>
</div>

<div class="form-card">
    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            {{-- Judul Artikel --}}
            <div class="col-md-8">
                <label for="title" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                       value="{{ old('title') }}" placeholder="Contoh: Estimasi Biaya Bangun Rumah 2 Lantai di Surabaya" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Kategori --}}
            <div class="col-md-4">
                <label for="category" class="form-label">Kategori</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category"
                       value="{{ old('category') }}" placeholder="Tips Bangun Rumah, Material, Arsitektur, dll">
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Ringkasan / Excerpt --}}
            <div class="col-12">
                <label for="excerpt" class="form-label">Ringkasan Artikel (Excerpt) <span class="text-danger">*</span></label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="2"
                          placeholder="Ringkasan singkat yang menarik minat pembaca di halaman katalog..." required>{{ old('excerpt') }}</textarea>
                @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Isi Konten Artikel --}}
            <div class="col-12">
                <label for="content" class="form-label">Isi Lengkap Artikel <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                          placeholder="Tuliskan isi artikel secara lengkap..." required>{{ old('content') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Thumbnail Image --}}
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Foto Thumbnail (Opsional)</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                <small class="text-muted">Format: JPG, PNG, WebP. Maks 2MB.</small>
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status Publish --}}
            <div class="col-md-6 d-flex align-items-center pt-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_published">Langsung Publikasikan (Publish)</label>
                </div>
            </div>

            <div class="col-12 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold px-4">
                    <i class="bi bi-send me-1"></i>Simpan & Terbitkan Artikel
                </button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

@endsection
