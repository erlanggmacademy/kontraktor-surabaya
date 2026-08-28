@extends('layouts.app')

@php
    $meta_title = ($portfolio->meta_title ?? $portfolio->title) . ' — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = $portfolio->meta_description ?? 'Dokumentasi proyek ' . $portfolio->title . ' di ' . ($portfolio->location ?? 'Surabaya') . '. Dikerjakan oleh ' . ($settings->company_name ?? 'Kontraktor Surabaya') . '.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER & BREADCRUMB
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb justify-content-center mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portfolio.index') }}" class="text-white-50 text-decoration-none">Portofolio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $portfolio->title }}</li>
            </ol>
        </nav>
        <div class="text-center">
            <span class="badge px-3 py-2 rounded-pill mb-3" style="background: var(--gold); color: var(--navy); font-weight: 700;">
                {{ $portfolio->category }}
            </span>
            <h1 class="display-5 fw-bold text-white mb-3">{{ $portfolio->title }}</h1>
            @if($portfolio->location)
            <p class="text-white-50 mx-auto">
                <i class="bi bi-geo-alt-fill text-warning me-1"></i>{{ $portfolio->location }}
            </p>
            @endif
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     PROJECT DETAILS & GALLERY
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row g-5">
            {{-- Main Content & Gallery --}}
            <div class="col-lg-8">
                {{-- Main Hero Image --}}
                <div class="rounded-4 overflow-hidden shadow-sm mb-4 border bg-light" style="max-height: 500px;">
                    @if($portfolio->thumbnail)
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="py-5 text-center text-muted">
                            <i class="bi bi-image fs-1 opacity-25 d-block mb-2"></i>
                            <span>Foto Utama Proyek</span>
                        </div>
                    @endif
                </div>

                {{-- Additional Gallery Photos --}}
                @if($portfolio->images && $portfolio->images->count() > 0)
                <h5 class="fw-bold mb-3" style="color: var(--navy);"><i class="bi bi-images me-2" style="color: var(--gold);"></i>Galeri Dokumentasi Proyek</h5>
                <div class="row g-3 mb-5">
                    @foreach($portfolio->images as $img)
                    <div class="col-6 col-md-4">
                        <div class="rounded-3 overflow-hidden border shadow-sm" style="aspect-ratio: 4/3;">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?? $portfolio->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                        @if($img->caption)
                        <small class="text-muted d-block mt-1 text-truncate">{{ $img->caption }}</small>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Description & Scope --}}
                <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm mb-5">
                    <h4 class="fw-bold mb-3" style="color: var(--navy);">Deskripsi & Lingkup Pekerjaan</h4>
                    <div class="text-muted leading-relaxed" style="line-height: 1.8;">
                        {!! nl2br(e($portfolio->description ?? 'Pembangunan proyek konstruksi dengan pengawasan ketat, material mutu standar nasional, dan penyelesaian tepat waktu sesuai kontrak kerja.')) !!}
                    </div>

                    @if($portfolio->client_name)
                    <div class="mt-4 p-3 rounded-3 bg-light border-start border-4 border-warning">
                        <small class="text-muted d-block fw-semibold">Klien / Pemilik:</small>
                        <span class="fw-bold" style="color: var(--navy);">{{ $portfolio->client_name }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Specs & CTA --}}
            <div class="col-lg-4">
                <div class="position-sticky" style="top: 100px;">
                    {{-- Project Specification Card --}}
                    <div class="p-4 rounded-4 bg-white border shadow-sm mb-4">
                        <h5 class="fw-bold mb-3" style="color: var(--navy);"><i class="bi bi-info-circle me-2" style="color: var(--gold);"></i>Spesifikasi Proyek</h5>
                        
                        <table class="table table-borderless small mb-0">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="text-muted ps-0">Kategori</td>
                                    <td class="fw-bold text-end pe-0 text-capitalize" style="color: var(--navy);">{{ $portfolio->category }}</td>
                                </tr>
                                @if($portfolio->location)
                                <tr class="border-bottom">
                                    <td class="text-muted ps-0">Lokasi</td>
                                    <td class="fw-bold text-end pe-0" style="color: var(--navy);">{{ $portfolio->location }}</td>
                                </tr>
                                @endif
                                @if($portfolio->building_area)
                                <tr class="border-bottom">
                                    <td class="text-muted ps-0">Luas Bangunan</td>
                                    <td class="fw-bold text-end pe-0" style="color: var(--navy);">{{ $portfolio->building_area }} m²</td>
                                </tr>
                                @endif
                                @if($portfolio->land_area)
                                <tr class="border-bottom">
                                    <td class="text-muted ps-0">Luas Tanah</td>
                                    <td class="fw-bold text-end pe-0" style="color: var(--navy);">{{ $portfolio->land_area }} m²</td>
                                </tr>
                                @endif
                                @if($portfolio->year_completed)
                                <tr class="border-bottom">
                                    <td class="text-muted ps-0">Tahun Selesai</td>
                                    <td class="fw-bold text-end pe-0" style="color: var(--navy);">{{ $portfolio->year_completed }}</td>
                                </tr>
                                @endif
                                @if($portfolio->duration_months)
                                <tr>
                                    <td class="text-muted ps-0">Durasi Kerja</td>
                                    <td class="fw-bold text-end pe-0" style="color: var(--navy);">{{ $portfolio->duration_months }} Bulan</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- WhatsApp Consultation Card --}}
                    <div class="p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, var(--navy) 0%, #162444 100%); color: #fff;">
                        <h5 class="fw-bold text-white mb-2"><i class="bi bi-chat-dots-fill me-2 text-warning"></i>Ingin Bangun Seperti Ini?</h5>
                        <p class="text-white-50 small mb-3">
                            Konsultasikan perkiraan biaya dan desain untuk proyek seperti <strong>{{ $portfolio->title }}</strong> bersama tim kami.
                        </p>
                        <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20tertarik%20membangun%20proyek%20seperti%20{{ urlencode($portfolio->title) }}."
                           class="btn btn-whatsapp w-100 fw-bold py-2 mb-2" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>Konsultasi via WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light w-100 btn-sm fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Kirim Formulir Rencana
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Projects --}}
        @if(isset($related) && $related->isNotEmpty())
        <div class="mt-5 pt-5 border-top">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <div class="section-label">Rekomendasi</div>
                    <h3 class="fw-bold mb-0" style="color: var(--navy);">Proyek Terkait Lainnya</h3>
                </div>
                <a href="{{ route('portfolio.index') }}" class="btn btn-sm btn-outline-primary fw-semibold">
                    Lihat Semua Portofolio <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-md-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm">
                        <div class="position-relative" style="aspect-ratio: 4/3; background: var(--off-white);">
                            @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->title }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-image fs-2 opacity-25"></i>
                                </div>
                            @endif
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill fw-semibold" style="background: rgba(13,27,53,0.85); font-size: 0.75rem;">
                                {{ $rel->category }}
                            </span>
                        </div>
                        <div class="p-3 bg-white d-flex flex-column flex-fill">
                            <h6 class="fw-bold mb-1 text-truncate" style="color: var(--navy);" title="{{ $rel->title }}">{{ $rel->title }}</h6>
                            <small class="text-muted mb-2"><i class="bi bi-geo-alt text-warning me-1"></i>{{ $rel->location ?? 'Surabaya' }}</small>
                            <a href="{{ route('portfolio.show', $rel->slug) }}" class="btn btn-sm btn-outline-primary mt-auto fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
