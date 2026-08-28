@extends('layouts.app')

@php
    $meta_title = ($article->meta_title ?? $article->title) . ' — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = $article->meta_description ?? $article->excerpt ?? Str::limit(strip_tags($article->content), 150);
    $og_type    = 'article';
    $og_image   = $article->thumbnail;
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER & BREADCRUMB
════════════════════════════════════════════ --}}
<section class="page-header" style="padding: 4rem 0 3rem;">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb justify-content-center mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('articles.index') }}" class="text-white-50 text-decoration-none">Artikel</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($article->title, 35) }}</li>
            </ol>
        </nav>
        <div class="text-center mx-auto" style="max-width: 800px;">
            @if($article->category)
            <span class="badge px-3 py-2 rounded-pill mb-3" style="background: var(--gold); color: var(--navy); font-weight: 700;">
                {{ $article->category }}
            </span>
            @endif
            <h1 class="display-6 fw-bold text-white mb-3" style="line-height: 1.3;">{{ $article->title }}</h1>
            <div class="text-white-50 small d-flex justify-content-center align-items-center gap-3">
                <span><i class="bi bi-person me-1"></i>{{ $article->author->name ?? 'Tim Arsitek & Konstruksi' }}</span>
                <span>•</span>
                <span><i class="bi bi-calendar3 me-1"></i>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     ARTICLE CONTENT SECTION
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row g-5">
            {{-- Main Article --}}
            <div class="col-lg-8">
                <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm mb-5">
                    @if($article->thumbnail)
                    <div class="mb-4 rounded-3 overflow-hidden">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;">
                    </div>
                    @endif

                    {{-- Excerpt Callout --}}
                    @if($article->excerpt)
                    <div class="p-4 rounded-3 mb-4 border-start border-4 border-warning" style="background: var(--off-white); font-size: 1.05rem; font-style: italic; color: var(--navy);">
                        "{{ $article->excerpt }}"
                    </div>
                    @endif

                    {{-- Body Content --}}
                    <div class="article-body leading-relaxed text-muted" style="font-size: 1.05rem; line-height: 1.9;">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    {{-- Share Section --}}
                    <div class="pt-4 mt-5 border-top d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="fw-bold small" style="color: var(--navy);">Bagikan Artikel:</div>
                        <div class="d-flex gap-2">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . url()->current()) }}"
                               class="btn btn-sm btn-outline-success" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp me-1"></i>WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               class="btn btn-sm btn-outline-primary" target="_blank" rel="noopener">
                                <i class="bi bi-facebook me-1"></i>Facebook
                            </a>
                            <button class="btn btn-sm btn-outline-secondary" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');">
                                <i class="bi bi-link-45deg me-1"></i>Salin Link
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Related Articles --}}
                @if(isset($related) && $related->isNotEmpty())
                <div class="mt-5">
                    <h4 class="fw-bold mb-4" style="color: var(--navy);">Artikel Terkait Lainnya</h4>
                    <div class="row g-4">
                        @foreach($related as $rel)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 rounded-3 overflow-hidden shadow-sm d-flex flex-column bg-white">
                                <div class="position-relative" style="aspect-ratio: 16/9; background: var(--off-white);">
                                    @if($rel->thumbnail)
                                        <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->title }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                            <i class="bi bi-newspaper fs-3 opacity-25"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-3 d-flex flex-column flex-fill">
                                    <h6 class="fw-bold mb-2" style="line-height: 1.4;">
                                        <a href="{{ route('articles.show', $rel->slug) }}" class="text-decoration-none text-dark hover-gold">
                                            {{ Str::limit($rel->title, 55) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted mt-auto"><i class="bi bi-calendar3 me-1"></i>{{ $rel->published_at ? $rel->published_at->format('d M Y') : $rel->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar CTA --}}
            <div class="col-lg-4">
                <div class="position-sticky" style="top: 100px;">
                    {{-- Consultation CTA --}}
                    <div class="p-4 rounded-4 shadow-sm mb-4" style="background: linear-gradient(135deg, var(--navy) 0%, #162444 100%); color: #fff;">
                        <h5 class="fw-bold text-white mb-2"><i class="bi bi-building me-2 text-warning"></i>Konsultasi Rancang Bangun</h5>
                        <p class="text-white-50 small mb-3">
                            Punya rencana membangun atau merenovasi properti di wilayah Surabaya? Diskusikan bersama tim ahli kami.
                        </p>
                        <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20membaca%20artikel%20{{ urlencode($article->title) }}%20dan%20ingin%20konsultasi."
                           class="btn btn-whatsapp w-100 fw-bold py-2 mb-2" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp me-2"></i>Konsultasi via WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light w-100 btn-sm fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Hubungi Kami
                        </a>
                    </div>

                    {{-- Categories Widget --}}
                    <div class="p-4 rounded-4 bg-white border shadow-sm">
                        <h6 class="fw-bold mb-3" style="color: var(--navy);">Navigasi Cepat</h6>
                        <ul class="list-unstyled d-flex flex-column gap-2 mb-0 small">
                            <li><a href="{{ route('services.index') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-warning"></i>Semua Layanan Konstruksi</a></li>
                            <li><a href="{{ route('portfolio.index') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-warning"></i>Galeri Portofolio Proyek</a></li>
                            <li><a href="{{ route('about') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-warning"></i>Tentang Perusahaan</a></li>
                            <li><a href="{{ route('contact') }}" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-warning"></i>Lokasi & Kontak Kantor</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
