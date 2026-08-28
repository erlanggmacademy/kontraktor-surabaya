@extends('layouts.admin')
@section('title', 'Tambah Layanan')

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.layanan.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Layanan
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Tambah Layanan Baru</h4>
</div>

<div class="form-card">
    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            {{-- Judul Layanan --}}
            <div class="col-md-8">
                <label for="title" class="form-label">Nama / Judul Layanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                       value="{{ old('title') }}" placeholder="Contoh: Jasa Arsitek & Desain Rumah" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Urutan Tampil --}}
            <div class="col-md-4">
                <label for="order" class="form-label">Nomor Urutan Tampil</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                       value="{{ old('order', 1) }}">
                @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Icon Bootstrap --}}
            <div class="col-md-6">
                <label for="icon" class="form-label">Icon Bootstrap Class</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon"
                       value="{{ old('icon', 'bi-building') }}" placeholder="bi-building, bi-tools, bi-house-gear">
                <small class="text-muted">Gunakan nama class dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</small>
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="col-md-6 d-flex align-items-center pt-md-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktifkan & Tampilkan di Website</label>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="col-12">
                <label for="short_description" class="form-label">Deskripsi Singkat (Ringkasan) <span class="text-danger">*</span></label>
                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2"
                          placeholder="Ringkasan 1-2 kalimat yang tampil di kartu katalog layanan..." required>{{ old('short_description') }}</textarea>
                @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Konten / Deskripsi Lengkap --}}
            <div class="col-12">
                <label for="content" class="form-label">Deskripsi Lengkap Layanan</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="6"
                          placeholder="Jelaskan detail cakupan kerja, keuntungan, dan spesifikasi dari layanan ini...">{{ old('content') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Foto Thumbnail --}}
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Foto / Banner Layanan (Opsional)</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                <small class="text-muted">Format: JPG, PNG, WebP. Maks 2MB.</small>
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Custom Slug (Opsional) --}}
            <div class="col-md-6">
                <label for="slug" class="form-label">Custom URL Slug (Opsional)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                       value="{{ old('slug') }}" placeholder="Otomatis digenerate jika dikosongkan">
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold px-4">
                    <i class="bi bi-save me-1"></i>Simpan Layanan
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

@endsection
