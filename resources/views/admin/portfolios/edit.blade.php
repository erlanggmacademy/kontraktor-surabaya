@extends('layouts.admin')
@section('title', 'Edit Proyek — ' . $portfolio->title)

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.portofolio.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Portofolio
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Edit Proyek: {{ $portfolio->title }}</h4>
</div>

<div class="form-card">
    <form action="{{ route('admin.portofolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Judul Proyek --}}
            <div class="col-md-8">
                <label for="title" class="form-label">Judul Proyek <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                       value="{{ old('title', $portfolio->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Kategori --}}
            <div class="col-md-4">
                <label for="category" class="form-label">Kategori Proyek <span class="text-danger">*</span></label>
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                    @foreach(['Rumah Mewah', 'Rumah Minimalis', 'Komersial & Ruko', 'Renovasi', 'Interior', 'Gedung / Lainnya'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $portfolio->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Lokasi Proyek --}}
            <div class="col-md-6">
                <label for="location" class="form-label">Lokasi Wilayah / Kota</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                       value="{{ old('location', $portfolio->location) }}">
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Nama Klien / Owner --}}
            <div class="col-md-6">
                <label for="client_name" class="form-label">Nama Klien / Pemilik</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name"
                       value="{{ old('client_name', $portfolio->client_name) }}">
                @error('client_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tahun Selesai & Estimasi Nilai --}}
            <div class="col-md-4">
                <label for="year_completed" class="form-label">Tahun Selesai</label>
                <input type="number" class="form-control @error('year_completed') is-invalid @enderror" id="year_completed" name="year_completed"
                       value="{{ old('year_completed', $portfolio->year_completed) }}">
                @error('year_completed') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="project_value" class="form-label">Estimasi Nilai Proyek (Rp)</label>
                <input type="number" class="form-control @error('project_value') is-invalid @enderror" id="project_value" name="project_value"
                       value="{{ old('project_value', $portfolio->project_value) }}">
                @error('project_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="order" class="form-label">Urutan Tampil</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                       value="{{ old('order', $portfolio->order) }}">
                @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status Featured & Aktif --}}
            <div class="col-md-6">
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_featured">Tampilkan di Beranda (Featured)</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktifkan / Publikasikan Proyek</label>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="col-12">
                <label for="short_description" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2" required>{{ old('short_description', $portfolio->short_description) }}</textarea>
                @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="col-12">
                <label for="content" class="form-label">Deskripsi Lengkap & Spesifikasi</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content', $portfolio->content) }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Foto Utama / Thumbnail --}}
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Ganti Foto Utama (Opsional)</label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                @if($portfolio->thumbnail)
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1">Foto utama saat ini:</small>
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="rounded border" style="max-height: 80px;">
                    </div>
                @endif
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tambah Galeri Foto Baru --}}
            <div class="col-md-6">
                <label for="gallery" class="form-label">Tambah Foto Galeri Baru (Opsional)</label>
                <input type="file" class="form-control @error('gallery.*') is-invalid @enderror" id="gallery" name="gallery[]" accept="image/*" multiple>
                <small class="text-muted">Pilih beberapa foto baru untuk ditambahkan ke galeri.</small>
                @error('gallery.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Preview Galeri Saat Ini --}}
            @if($portfolio->images && $portfolio->images->count() > 0)
            <div class="col-12">
                <label class="form-label fw-semibold">Galeri Foto Tersimpan ({{ $portfolio->images->count() }} foto):</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($portfolio->images as $img)
                        <div class="rounded border p-1 position-relative bg-light" style="width: 90px; height: 70px;">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Galeri" class="w-100 h-100 object-fit-cover rounded">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="col-12 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold px-4">
                    <i class="bi bi-save me-1"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.portofolio.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

@endsection
