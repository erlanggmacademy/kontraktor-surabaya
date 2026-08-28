@extends('layouts.app')

@php
    $meta_title = 'Hubungi Kami — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = 'Konsultasikan rencana bangun rumah baru, ruko, atau renovasi Anda bersama ' . ($settings->company_name ?? 'Kontraktor Surabaya') . '. Layanan survei lokasi gratis area Surabaya dan sekitarnya.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container text-center">
        <div class="badge-pill mb-3">Kontak & Konsultasi</div>
        <h1 class="display-5 fw-bold text-white mb-3">Hubungi Tim Ahli Kami</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">
            Diskusikan kebutuhan proyek arsitektur dan konstruksi Anda. Tim kami siap membantu memberikan solusi rancang bangun terbaik dan estimasi biaya transparan.
        </p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     CONTACT INFO CARDS
════════════════════════════════════════════ --}}
<section class="section" style="padding-bottom: 2rem;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100 border text-center bg-white shadow-sm">
                    <div class="icon-wrap mx-auto mb-3" style="width:50px;height:50px;background:rgba(245,166,35,0.12);color:var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Alamat Kantor</h6>
                    <p class="text-muted small mb-0">{{ $settings->address ?? 'Surabaya, Jawa Timur, Indonesia' }}</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100 border text-center bg-white shadow-sm">
                    <div class="icon-wrap mx-auto mb-3" style="width:50px;height:50px;background:rgba(37,211,102,0.12);color:#25D366;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h6 class="fw-bold mb-2">WhatsApp Fast Response</h6>
                    <p class="text-muted small mb-2">Respon cepat dalam jam kerja</p>
                    <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya."
                       class="btn btn-sm btn-outline-success fw-semibold" target="_blank" rel="noopener">
                        +{{ $settings->whatsapp_number ?? '6281234567890' }}
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100 border text-center bg-white shadow-sm">
                    <div class="icon-wrap mx-auto mb-3" style="width:50px;height:50px;background:rgba(13,110,253,0.12);color:#0d6efd;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Email Resmi</h6>
                    <p class="text-muted small mb-2">Untuk penawaran & kerja sama</p>
                    <a href="mailto:{{ $settings->email ?? 'info@kontraktorsurabaya.com' }}" class="text-decoration-none fw-semibold" style="color:var(--navy); font-size:0.9rem;">
                        {{ $settings->email ?? 'info@kontraktorsurabaya.com' }}
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-4 h-100 border text-center bg-white shadow-sm">
                    <div class="icon-wrap mx-auto mb-3" style="width:50px;height:50px;background:rgba(220,53,69,0.12);color:#dc3545;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Jam Kerja</h6>
                    <p class="text-muted small mb-0">Senin - Sabtu: 08.00 - 17.00 WIB<br><span class="text-danger">Minggu / Libur: Janji Temu</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     FORM & MAP SECTION
════════════════════════════════════════════ --}}
<section class="section pt-0">
    <div class="container">
        <div class="row g-5">
            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                    <h3 class="fw-bold mb-2" style="color: var(--navy);">Formulir Konsultasi Proyek</h3>
                    <p class="text-muted small mb-4">Silakan isi formulir berikut. Tim arsitek & estimator kami akan menghubungi Anda kembali dalam kurun waktu 1x24 jam.</p>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>Harap periksa kembali isian formulir Anda.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="row g-3">
                            {{-- Nama Lengkap --}}
                            <div class="col-md-6">
                                <label for="name" class="form-label small fw-bold" style="color:var(--navy);">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                       placeholder="Contoh: Bpk. Hendra" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nomor Telepon / WA --}}
                            <div class="col-md-6">
                                <label for="phone" class="form-label small fw-bold" style="color:var(--navy);">Nomor WhatsApp / Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                       placeholder="081234567890" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-bold" style="color:var(--navy);">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                       placeholder="nama@email.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Lokasi Proyek --}}
                            <div class="col-md-6">
                                <label for="location" class="form-label small fw-bold" style="color:var(--navy);">Lokasi Lahan / Proyek</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                                       placeholder="Contoh: Pakuwon City / Citraland Surabaya" value="{{ old('location') }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pilihan Layanan --}}
                            <div class="col-12">
                                <label for="service_interest" class="form-label small fw-bold" style="color:var(--navy);">Layanan yang Dibutuhkan</label>
                                <select class="form-select @error('service_interest') is-invalid @enderror" id="service_interest" name="service_interest">
                                    <option value="" selected>-- Pilih Jenis Layanan --</option>
                                    @if(isset($services) && count($services) > 0)
                                        @foreach($services as $id => $title)
                                            <option value="{{ $title }}" {{ old('service_interest') == $title ? 'selected' : '' }}>{{ $title }}</option>
                                        @endforeach
                                    @else
                                        <option value="Jasa Arsitek (Desain)">Jasa Arsitek (Desain)</option>
                                        <option value="Bangun Rumah Baru">Bangun Rumah Baru</option>
                                        <option value="Renovasi Bangunan">Renovasi Bangunan</option>
                                        <option value="Desain Interior">Desain Interior</option>
                                        <option value="RAB & Estimasi Biaya">RAB & Estimasi Biaya</option>
                                    @endif
                                </select>
                                @error('service_interest')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pesan / Kebutuhan --}}
                            <div class="col-12">
                                <label for="message" class="form-label small fw-bold" style="color:var(--navy);">Deskripsi Rencana / Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4"
                                          placeholder="Jelaskan kebutuhan Anda (contoh: rencana bangun rumah 2 lantai luas 120m2 di Surabaya Timur, estimasi budget...)" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Pesan Konsultasi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Google Maps & Fast FAQ --}}
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4 h-100">
                    {{-- Google Maps Embed Container --}}
                    <div class="p-3 rounded-4 bg-white border shadow-sm overflow-hidden flex-fill" style="min-height: 280px;">
                        <h6 class="fw-bold mb-3" style="color:var(--navy);"><i class="bi bi-map me-2" style="color:var(--gold);"></i>Peta Lokasi Kantor</h6>
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden border">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.2096092576!2d112.6302816527588!3d-7.275614099999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac015%3A0x3027a76e352be40!2sSurabaya%2C%20Surabaya%20City%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    {{-- WhatsApp Direct Banner --}}
                    <div class="p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, var(--navy) 0%, #162444 100%); color: #fff;">
                        <h5 class="fw-bold text-white mb-2"><i class="bi bi-chat-text-fill me-2" style="color: var(--gold);"></i>Butuh Respons Cepat?</h5>
                        <p class="text-white-50 small mb-3">
                            Ingin langsung berdiskusi dengan tim arsitek dan estimator kami via WhatsApp tanpa menunggu?
                        </p>
                        <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20langsung%20mengenai%20proyek%20saya."
                           class="btn btn-whatsapp w-100 fw-bold" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp Langsung
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
