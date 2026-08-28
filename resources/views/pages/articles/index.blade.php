@extends('layouts.app')

@php
    $meta_title = 'Artikel & Tips Konstruksi Bangunan — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = 'Kumpulan artikel edukasi, tips memilih material, panduan renovasi, estimasi biaya bangun rumah, dan tren arsitektur terkini di Surabaya.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container text-center">
        <div class="badge-pill mb-3">Edukasi & Tips Rancang Bangun</div>
        <h1 class="display-5 fw-bold text-white mb-3">Artikel & Berita Konstruksi</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">
            Wawasan seputar teknik bangunan, tips perencanaan anggaran RAB, perizinan PBG, dan tren desain arsitektur rumah modern.
        </p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     ARTICLES GRID & CATEGORIES
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        {{-- Category Filters --}}
        @php
            $currentCat = request('category');
            $filterCategories = ['Semua', 'Tips Bangun Rumah', 'Renovasi', 'Material Bangunan', 'Desain Arsitektur', 'Estimasi Biaya'];
            if(isset($categories) && $categories->isNotEmpty()) {
                $filterCategories = array_unique(array_merge(['Semua'], $categories->toArray()));
            }
        @endphp

        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
            @foreach($filterCategories as $cat)
                @php
                    $isActive = ($cat === 'Semua' && !$currentCat) || ($currentCat === $cat);
                    $filterUrl = ($cat === 'Semua') ? route('articles.index') : route('articles.index', ['category' => $cat]);
                @endphp
                <a href="{{ $filterUrl }}"
                   class="btn btn-sm rounded-pill px-3 py-2 fw-semibold {{ $isActive ? 'btn-primary' : 'btn-outline-secondary' }}"
                   style="{{ $isActive ? 'background: var(--navy); border-color: var(--navy);' : '' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        {{-- Articles Grid --}}
        <div class="row g-4">
            @if(isset($articles) && $articles->isNotEmpty())
                @foreach($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm card-article d-flex flex-column bg-white">
                        <div class="position-relative overflow-hidden" style="aspect-ratio: 16/9; background: var(--off-white);">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-newspaper fs-1 opacity-25"></i>
                                </div>
                            @endif
                            @if($article->category)
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill fw-semibold" style="background: rgba(13,27,53,0.85); font-size: 0.75rem;">
                                {{ $article->category }}
                            </span>
                            @endif
                        </div>

                        <div class="p-4 d-flex flex-column flex-fill">
                            <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-warning"></i>
                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                            </div>

                            <h5 class="fw-bold mb-2" style="color: var(--navy); line-height: 1.4;">
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none text-dark hover-gold">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            
                            <p class="text-muted small mb-4 flex-fill" style="line-height: 1.6;">
                                {{ Str::limit($article->excerpt ?? strip_tags($article->content), 110) }}
                            </p>

                            <div class="pt-3 border-top mt-auto">
                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-sm btn-outline-primary fw-semibold w-100">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Fallback Default Sample Articles --}}
                @php
                    $dummyArticles = [
                        [
                            'title' => 'Panduan Menghitung Estimasi Biaya Bangun Rumah 2 Lantai di Surabaya 2026',
                            'cat' => 'Estimasi Biaya',
                            'excerpt' => 'Ketahui rincian harga borongan per meter, biaya pondasi, struktur beton bertulang, hingga finishing interior agar anggaran tidak jebol.',
                        ],
                        [
                            'title' => '5 Tips Memilih Material Bangunan Tahan Cuaca Tropis & Bebas Lembap',
                            'cat' => 'Material Bangunan',
                            'excerpt' => 'Cuaca panas dan curah hujan tinggi di Surabaya membutuhkan pemilihan semen, cat waterproofing, dan bata berkualitas khusus.',
                        ],
                        [
                            'title' => 'Tahapan Lengkap Mengurus Izin Persetujuan Bangunan Gedung (PBG) di Surabaya',
                            'cat' => 'Tips Bangun Rumah',
                            'excerpt' => 'Langkah praktis pengurusan PBG pengganti IMB mulai dari kelengkapan dokumen arsitektur, gambar kerja DED, hingga verifikasi dinas.',
                        ],
                    ];
                @endphp

                @foreach($dummyArticles as $da)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm d-flex flex-column bg-white">
                        <div class="position-relative d-flex align-items-center justify-content-center" style="aspect-ratio: 16/9; background: #e9ecef;">
                            <div class="text-center text-muted">
                                <i class="bi bi-newspaper fs-1 opacity-50 mb-1 d-block"></i>
                                <span class="small opacity-75">Artikel Edukasi</span>
                            </div>
                            <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill fw-semibold" style="background: rgba(13,27,53,0.85); font-size: 0.75rem;">
                                {{ $da['cat'] }}
                            </span>
                        </div>

                        <div class="p-4 d-flex flex-column flex-fill">
                            <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-warning"></i>
                                <span>{{ date('d M Y') }}</span>
                            </div>

                            <h5 class="fw-bold mb-2" style="color: var(--navy); line-height: 1.4;">
                                {{ $da['title'] }}
                            </h5>
                            
                            <p class="text-muted small mb-4 flex-fill" style="line-height: 1.6;">
                                {{ $da['excerpt'] }}
                            </p>

                            <div class="pt-3 border-top mt-auto">
                                <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-primary fw-semibold w-100">
                                    Konsultasikan Proyek <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        {{-- Pagination Links --}}
        @if(isset($articles) && method_exists($articles, 'hasPages') && $articles->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $articles->withQueryString()->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
