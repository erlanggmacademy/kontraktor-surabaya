@extends('layouts.app')

@php
    $meta_title = ($service->meta_title ?? $service->title) . ' — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = $service->meta_description ?? $service->short_description ?? 'Layanan profesional ' . $service->title . ' di wilayah Surabaya dan sekitarnya.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb justify-content-center mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white-50 text-decoration-none">Layanan</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="display-5 fw-bold text-white mb-3">{{ $service->title }}</h1>
            <p class="text-white-50 mx-auto" style="max-width: 650px;">
                {{ $service->short_description }}
            </p>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     SERVICE DETAIL CONTENT
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm mb-5">
                    @if($service->image)
                    <div class="mb-4 rounded-3 overflow-hidden">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                    </div>
                    @endif

                    <h3 class="fw-bold mb-4" style="color: var(--navy);">Deskripsi Layanan</h3>
                    
                    <div class="text-muted leading-relaxed" style="font-size: 1rem; line-height: 1.8;">
                        {!! nl2br(e($service->description ?? $service->short_description)) !!}
                    </div>

                    {{-- Keunggulan Layanan --}}
                    <h4 class="fw-bold mt-5 mb-3" style="color: var(--navy);">Kenapa Memilih Layanan Ini?</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-warning fs-5 flex-shrink-0"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Tenaga Ahli Bersertifikasi</h6>
                                    <p class="text-muted small mb-0">Dikerjakan oleh arsitek & mandor berpengalaman di Surabaya.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-warning fs-5 flex-shrink-0"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">RAB Jelas & Rinci</h6>
                                    <p class="text-muted small mb-0">Perhitungan biaya transparan tanpa markup tersembunyi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-warning fs-5 flex-shrink-0"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Garansi Retensi Bangunan</h6>
                                    <p class="text-muted small mb-0">Surat jaminan pemeliharaan purna jual resmi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded-3 bg-light d-flex align-items-start gap-3">
                                <i class="bi bi-check-circle-fill text-warning fs-5 flex-shrink-0"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Material Standar SNI</h6>
                                    <p class="text-muted small mb-0">Penggunaan bahan bangunan kokoh dan teruji mutunya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FAQ Khusus Layanan Ini (AEO/GEO optimization) --}}
                @if($service->faqs && $service->faqs->count() > 0)
                <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm">
                    <h4 class="fw-bold mb-4" style="color: var(--navy);"><i class="bi bi-question-circle me-2" style="color: var(--gold);"></i>FAQ seputar {{ $service->title }}</h4>
                    
                    <div class="accordion accordion-flush" id="serviceFaqAccordion">
                        @foreach($service->faqs as $idx => $faq)
                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header" id="heading{{ $idx }}">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx }}" aria-expanded="false" aria-controls="collapse{{ $idx }}" style="color: var(--navy);">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $idx }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $idx }}" data-bs-parent="#serviceFaqAccordion">
                                <div class="accordion-body text-muted small leading-relaxed">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar CTA & Contact --}}
            <div class="col-lg-4">
                <div class="position-sticky" style="top: 100px;">
                    {{-- WhatsApp Consultation Card --}}
                    <div class="p-4 rounded-4 shadow-sm mb-4" style="background: linear-gradient(135deg, var(--navy) 0%, #162444 100%); color: #fff;">
                        <h5 class="fw-bold text-white mb-2"><i class="bi bi-whatsapp me-2 text-success"></i>Konsultasi Layanan</h5>
                        <p class="text-white-50 small mb-4">
                            Ingin mengetahui estimasi biaya atau berdiskusi mengenai proyek <strong>{{ $service->title }}</strong> Anda?
                        </p>
                        <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20mengenai%20layanan%20{{ urlencode($service->title) }}."
                           class="btn btn-whatsapp w-100 fw-bold py-2 mb-2" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>Hubungi via WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light w-100 btn-sm fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Kirim Formulir Online
                        </a>
                    </div>

                    {{-- Service Benefits Card --}}
                    <div class="p-4 rounded-4 bg-white border shadow-sm">
                        <h6 class="fw-bold mb-3" style="color: var(--navy);">Keuntungan Bekerjasama</h6>
                        <ul class="list-unstyled text-muted small d-flex flex-column gap-2 mb-0">
                            <li><i class="bi bi-shield-check text-warning me-2"></i>Gratis survei lokasi area Surabaya</li>
                            <li><i class="bi bi-shield-check text-warning me-2"></i>Free konsultasi awal denah & RAB</li>
                            <li><i class="bi bi-shield-check text-warning me-2"></i>Laporan progres berkala foto & video</li>
                            <li><i class="bi bi-shield-check text-warning me-2"></i>Pembayaran bertahap sesuai termin kerja</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
