@extends('layouts.admin')
@section('title', 'Pengaturan Website')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1" style="color: var(--navy);">Pengaturan Global Website</h4>
    <p class="text-muted small mb-0">Ubah identitas profil perusahaan, kontak WhatsApp, alamat, logo, dan tracking analitik.</p>
</div>

<div class="form-card">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ─── 1. Identitas Perusahaan ─── --}}
        <h5 class="fw-bold mb-3 pb-2 border-bottom" style="color: var(--navy);"><i class="bi bi-building me-2 text-warning"></i>Identitas Perusahaan</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label for="company_name" class="form-label">Nama Perusahaan / Brand <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name"
                       value="{{ old('company_name', $setting->company_name) }}" required>
                @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="company_tagline" class="form-label">Tagline Slogan</label>
                <input type="text" class="form-control @error('company_tagline') is-invalid @enderror" id="company_tagline" name="company_tagline"
                       value="{{ old('company_tagline', $setting->company_tagline) }}" placeholder="Membangun dengan Kualitas & Kepercayaan">
                @error('company_tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="company_description" class="form-label">Deskripsi Profil Singkat Perusahaan</label>
                <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description" name="company_description" rows="3">{{ old('company_description', $setting->company_description) }}</textarea>
                @error('company_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="founded_year" class="form-label">Tahun Berdiri</label>
                <input type="number" class="form-control @error('founded_year') is-invalid @enderror" id="founded_year" name="founded_year"
                       value="{{ old('founded_year', $setting->founded_year) }}" placeholder="2010">
                <small class="text-muted">Untuk menghitung otomatis "X+ Tahun Pengalaman" di Beranda.</small>
                @error('founded_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="projects_completed" class="form-label">Jumlah Proyek Selesai</label>
                <input type="number" class="form-control @error('projects_completed') is-invalid @enderror" id="projects_completed" name="projects_completed"
                       value="{{ old('projects_completed', $setting->projects_completed) }}" placeholder="150">
                <small class="text-muted">Tampil di statistik bar Beranda (misal: 150+ Proyek Selesai).</small>
                @error('projects_completed') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- ─── 2. Kontak & Alamat ─── --}}
        <h5 class="fw-bold mb-3 pb-2 border-bottom pt-3" style="color: var(--navy);"><i class="bi bi-telephone-fill me-2 text-warning"></i>Kontak & Operasional</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label for="whatsapp_number" class="form-label">Nomor WhatsApp CS / Admin <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number"
                       value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" placeholder="6281234567890 (format tanpa tanda +)" required>
                <small class="text-muted">Format: Awali dengan 62 (contoh: <code>6281234567890</code>).</small>
                @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email Resmi Perusahaan <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                       value="{{ old('email', $setting->email) }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
                <label for="address" class="form-label">Alamat Kantor / Workshop</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $setting->address) }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- ─── 3. Media Sosial & Analitik ─── --}}
        <h5 class="fw-bold mb-3 pb-2 border-bottom pt-3" style="color: var(--navy);"><i class="bi bi-globe me-2 text-warning"></i>Media Sosial & Google Analytics</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <label for="instagram_url" class="form-label">Link Instagram</label>
                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url"
                       value="{{ old('instagram_url', $setting->instagram_url) }}" placeholder="https://instagram.com/akun">
                @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="facebook_url" class="form-label">Link Facebook</label>
                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url"
                       value="{{ old('facebook_url', $setting->facebook_url) }}" placeholder="https://facebook.com/halaman">
                @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="youtube_url" class="form-label">Link YouTube</label>
                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url"
                       value="{{ old('youtube_url', $setting->youtube_url) }}" placeholder="https://youtube.com/@channel">
                @error('youtube_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="ga4_tag_id" class="form-label">Google Analytics 4 Measurement ID</label>
                <input type="text" class="form-control @error('ga4_tag_id') is-invalid @enderror" id="ga4_tag_id" name="ga4_tag_id"
                       value="{{ old('ga4_tag_id', $setting->ga4_tag_id) }}" placeholder="G-XXXXXXXXXX">
                <small class="text-muted">Opsional. Masukkan ID tag GA4 Anda.</small>
                @error('ga4_tag_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="footer_text" class="form-label">Teks Hak Cipta Footer</label>
                <input type="text" class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" name="footer_text"
                       value="{{ old('footer_text', $setting->footer_text) }}">
                @error('footer_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- ─── 4. Logo & Gambar ─── --}}
        <h5 class="fw-bold mb-3 pb-2 border-bottom pt-3" style="color: var(--navy);"><i class="bi bi-image me-2 text-warning"></i>Logo Perusahaan</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label for="logo" class="form-label">Upload Logo Header (PNG Transparan / SVG)</label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                @if($setting->logo)
                    <div class="mt-2 p-2 bg-dark rounded d-inline-block">
                        <small class="text-white-50 d-block mb-1">Logo saat ini:</small>
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" style="max-height: 45px;">
                    </div>
                @endif
                @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="pt-3 border-top d-flex gap-2">
            <button type="submit" class="btn btn-primary fw-bold px-4">
                <i class="bi bi-check-circle-fill me-1"></i>Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

@endsection
