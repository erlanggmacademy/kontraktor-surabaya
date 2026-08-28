@extends('layouts.admin')
@section('title', 'Tambah Proyek Portofolio')

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.portofolio.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Portofolio
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Tambah Portofolio Proyek Baru</h4>
</div>

<div class="form-card">
    <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            {{-- Judul Proyek --}}
            <div class="col-md-8">
                <label for="title" class="form-label">Judul Proyek <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                       value="{{ old('title') }}" placeholder="Contoh: Rumah Mewah Pakuwon City" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Kategori --}}
            <div class="col-md-4">
                <label for="category" class="form-label">Kategori Proyek <span class="text-danger">*</span></label>
                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                    <option value="" selected disabled>-- Pilih Kategori --</option>
                    @foreach(['Rumah Mewah', 'Rumah Minimalis', 'Komersial & Ruko', 'Renovasi', 'Interior', 'Gedung / Lainnya'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Lokasi Proyek --}}
            <div class="col-md-6">
                <label for="location" class="form-label">Lokasi Wilayah / Kota</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                       value="{{ old('location') }}" placeholder="Contoh: Pakuwon City, Surabaya Timur">
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Nama Klien / Owner (Opsional) --}}
            <div class="col-md-6">
                <label for="client_name" class="form-label">Nama Klien / Pemilik (Opsional)</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name"
                       value="{{ old('client_name') }}" placeholder="Contoh: Bpk. Gunawan / Private">
                @error('client_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tahun Selesai & Estimasi Nilai --}}
            <div class="col-md-4">
                <label for="year_completed" class="form-label">Tahun Selesai</label>
                <input type="number" class="form-control @error('year_completed') is-invalid @enderror" id="year_completed" name="year_completed"
                       value="{{ old('year_completed', date('Y')) }}" placeholder="2026">
                @error('year_completed') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="project_value" class="form-label">Estimasi Nilai Proyek (Rp)</label>
                <input type="number" class="form-control @error('project_value') is-invalid @enderror" id="project_value" name="project_value"
                       value="{{ old('project_value') }}" placeholder="Contoh: 1500000000">
                @error('project_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="order" class="form-label">Urutan Tampil</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order"
                       value="{{ old('order', 1) }}">
                @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status Featured & Aktif --}}
            <div class="col-md-6">
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_featured">Tampilkan di Beranda (Featured Project)</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Aktifkan / Publikasikan Proyek</label>
                </div>
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="col-12">
                <label for="short_description" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2"
                          placeholder="Ringkasan proyek yang tampil di kartu katalog..." required>{{ old('short_description') }}</textarea>
                @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="col-12">
                <label for="content" class="form-label">Deskripsi Lengkap & Spesifikasi Proyek</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5"
                          placeholder="Jelaskan tantangan, konsep desain, bahan yang digunakan, dan hasil pengerjaan proyek...">{{ old('content') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Foto Utama / Thumbnail --}}
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Foto Utama / Thumbnail <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*" required>
                <small class="text-muted">Foto depan utama proyek. Maks 2MB.</small>
                @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Galeri Foto Dokumentasi Multi-upload --}}
            <div class="col-md-6">
                <label for="gallery" class="form-label">Galeri Foto Dokumentasi (Bisa Pilih Banyak)</label>
                <input type="file" class="form-control @error('gallery.*') is-invalid @enderror" id="gallery" name="gallery[]" accept="image/*" multiple>
                <small class="text-muted">Pilih beberapa foto sekaligus untuk galeri pengerjaan.</small>
                @error('gallery.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-primary fw-bold px-4">
                    <i class="bi bi-save me-1"></i>Simpan Proyek Portofolio
                </button>
                <a href="{{ route('admin.portofolio.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

@endsection
