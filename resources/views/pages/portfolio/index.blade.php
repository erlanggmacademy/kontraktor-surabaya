@extends('layouts.app')

@php
    $meta_title = 'Portofolio Proyek Rancang Bangun — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = 'Dokumentasi portofolio proyek bangun rumah, renovasi, gedung komersial, dan interior nyata yang telah kami selesaikan di Surabaya dan sekitarnya.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container text-center">
        <div class="badge-pill mb-3">Hasil Karya Nyata</div>
        <h1 class="display-5 fw-bold text-white mb-3">Portofolio Proyek Kami</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">
            Bukti nyata dedikasi dan kualitas konstruksi kami. Jelajahi berbagai proyek residensial, komersial, dan renovasi yang telah selesai kami bangun.
        </p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     PORTFOLIO GRID & FILTER
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        {{-- Category Filters --}}
        @php
            $currentCat = request('category');
            $filterCategories = ['Semua', 'Rumah Mewah', 'Rumah Minimalis', 'Komersial & Ruko', 'Renovasi', 'Interior'];
            if(isset($categories) && $categories->isNotEmpty()) {
                $filterCategories = array_unique(array_merge(['Semua'], $categories->toArray()));
            }
        @endphp

        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
            @foreach($filterCategories as $cat)
                @php
                    $isActive = ($cat === 'Semua' && !$currentCat) || ($currentCat === $cat);
                    $filterUrl = ($cat === 'Semua') ? route('portfolio.index') : route('portfolio.index', ['category' => $cat]);
                @endphp
                <a href="{{ $filterUrl }}"
                   class="btn btn-sm rounded-pill px-3 py-2 fw-semibold {{ $isActive ? 'btn-primary' : 'btn-outline-secondary' }}"
                   style="{{ $isActive ? 'background: var(--navy); border-color: var(--navy);' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        {{-- Projects Grid --}}
        <div class="row g-4">
            @if(isset($portfolios) && $portfolios->isNotEmpty())
                @foreach($portfolios as $portfolio)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm card-portfolio-item">
                        <div class="position-relative overflow-hidden" style="aspect-ratio: 4/3; background: var(--off-white);">
                            @if($portfolio->thumbnail)
                                <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-image fs-1 opacity-25"></i>
                                </div>
                            @endif
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill fw-semibold" style="background: rgba(13,27,53,0.85); backdrop-filter: blur(4px); font-size: 0.75rem;">
                                {{ $portfolio->category }}
                            </span>
                        </div>

                        <div class="p-4 bg-white d-flex flex-column flex-fill">
                            <h5 class="fw-bold mb-2 text-truncate" style="color: var(--navy);" title="{{ $portfolio->title }}">
                                {{ $portfolio->title }}
                            </h5>
                            
                            @if($portfolio->location)
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt text-warning me-1"></i>{{ $portfolio->location }}
                            </p>
                            @endif

                            <div class="pt-3 border-top mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                    Lihat Proyek <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                                @if($portfolio->building_area)
                                <small class="text-muted fw-semibold">
                                    <i class="bi bi-aspect-ratio me-1"></i>{{ $portfolio->building_area }} m²
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Fallback Default Portfolios when DB has no records yet --}}
                @php
                    $dummyProjects = [
                        ['title' => 'Rumah Mewah Modern Tropis Pakuwon', 'cat' => 'Rumah Mewah', 'loc' => 'Pakuwon City, Surabaya Timur', 'area' => '350'],
                        ['title' => 'Pembangunan Ruko 3 Lantai Merr', 'cat' => 'Komersial & Ruko', 'loc' => 'Jl. Dr. Ir. H. Soekarno, Surabaya', 'area' => '420'],
                        ['title' => 'Renovasi Total Hunian CitraLand', 'cat' => 'Renovasi', 'loc' => 'CitraLand, Surabaya Barat', 'area' => '280'],
                        ['title' => 'Desain & Bangun Villa Minimalis', 'cat' => 'Rumah Minimalis', 'loc' => 'Prigen, Pasuruan', 'area' => '190'],
                        ['title' => 'Interior Modern Kafe & Resto', 'cat' => 'Interior', 'loc' => 'Gubeng, Surabaya Pusat', 'area' => '150'],
                        ['title' => 'Hunian Split Level Graha Family', 'cat' => 'Rumah Mewah', 'loc' => 'Graha Family, Surabaya Barat', 'area' => '320'],
                    ];
                @endphp

                @foreach($dummyProjects as $dp)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm">
                        <div class="position-relative d-flex align-items-center justify-content-center" style="aspect-ratio: 4/3; background: #e9ecef;">
                            <div class="text-center text-muted">
                                <i class="bi bi-image fs-1 opacity-50 mb-1 d-block"></i>
                                <span class="small opacity-75">Dokumentasi Proyek</span>
                            </div>
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill fw-semibold" style="background: rgba(13,27,53,0.85); font-size: 0.75rem;">
                                {{ $dp['cat'] }}
                            </span>
                        </div>

                        <div class="p-4 bg-white d-flex flex-column flex-fill">
                            <h5 class="fw-bold mb-2 text-truncate" style="color: var(--navy);">{{ $dp['title'] }}</h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt text-warning me-1"></i>{{ $dp['loc'] }}</p>
                            
                            <div class="pt-3 border-top mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                    Konsultasi Desain <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                                <small class="text-muted fw-semibold">{{ $dp['area'] }} m²</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        {{-- Pagination Links --}}
        @if(isset($portfolios) && method_exists($portfolios, 'hasPages') && $portfolios->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $portfolios->withQueryString()->links() }}
        </div>
        @endif
    </div>
</section>

{{-- ════════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="container text-center position-relative" style="z-index: 1;">
        <div class="section-label justify-content-center text-warning">Bangun Bersama Kami</div>
        <h2 class="text-white fw-bold mb-3">Tertarik Membangun Proyek Seperti Ini?</h2>
        <p class="text-white-50 mx-auto mb-4" style="max-width: 550px;">
            Diskusikan denah impian, spesifikasi material, dan estimasi biaya bangunan Anda bersama tim arsitek kami.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20melihat%20portofolio%20di%20website%20dan%20ingin%20konsultasi%20proyek%20serupa."
               class="btn btn-primary btn-lg" target="_blank" rel="noopener">
                <i class="bi bi-whatsapp me-2"></i>Konsultasi Proyek Serupa via WA
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Kirim Formulir Kontak
            </a>
        </div>
    </div>
</section>

@endsection
