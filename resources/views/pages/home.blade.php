@extends('layouts.app')

@section('content')

{{-- ════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════ --}}
<section class="hero" id="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 hero-content">
                <div class="hero-badge fade-in-up">
                    <i class="bi bi-shield-check-fill"></i>
                    Terpercaya Sejak {{ $settings->founded_year ?? '2010' }} · Surabaya
                </div>

                <h1 class="fade-in-up delay-1">
                    Solusi Rancang Bangun <span>Terpercaya</span> di Surabaya
                </h1>

                <p class="fade-in-up delay-2">
                    Kami mewujudkan visi Anda menjadi bangunan presisi dengan manajemen waktu dan anggaran yang transparan. Dari konsep hingga selesai, bersama Anda.
                </p>

                <div class="d-flex flex-wrap gap-3 fade-in-up delay-3">
                    <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20gratis."
                       class="btn btn-primary btn-lg" target="_blank" rel="noopener" id="hero-wa-btn">
                        <i class="bi bi-whatsapp me-2"></i>Konsultasi Gratis
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="btn btn-lg"
                       style="border:2px solid rgba(255,255,255,0.3); color:#fff;">
                        <i class="bi bi-images me-2"></i>Lihat Portofolio
                    </a>
                </div>

                <div class="hero-stats fade-in-up delay-4">
                    <div class="hero-stat">
                        <div class="number">{{ $settings->projects_completed ?? '150' }}+</div>
                        <div class="label">Proyek Selesai</div>
                    </div>
                    <div class="hero-stat">
                        <div class="number">{{ date('Y') - ($settings->founded_year ?? 2010) }}+</div>
                        <div class="label">Tahun Pengalaman</div>
                    </div>
                    <div class="hero-stat">
                        <div class="number">100%</div>
                        <div class="label">Garansi Kualitas</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block fade-in-up delay-2">
                {{-- Visual decorative element --}}
                <div style="position:relative;">
                    <div style="background:rgba(245,166,35,0.1); border:1px solid rgba(245,166,35,0.2); border-radius:20px; padding:2rem; backdrop-filter:blur(10px);">
                        <div class="d-flex align-items-center gap-3 mb-3 p-3" style="background:rgba(255,255,255,0.05); border-radius:12px;">
                            <div style="width:48px;height:48px;background:var(--gold);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">🏗️</div>
                            <div>
                                <div style="color:#fff;font-family:'Montserrat',sans-serif;font-weight:700;font-size:0.9rem;">Proyek Sedang Berjalan</div>
                                <div style="color:rgba(255,255,255,0.5);font-size:0.8rem;">3 proyek aktif saat ini</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mb-3 p-3" style="background:rgba(255,255,255,0.05); border-radius:12px;">
                            <div style="width:48px;height:48px;background:rgba(37,211,102,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">✅</div>
                            <div>
                                <div style="color:#fff;font-family:'Montserrat',sans-serif;font-weight:700;font-size:0.9rem;">Garansi Retensi Bangunan</div>
                                <div style="color:rgba(255,255,255,0.5);font-size:0.8rem;">Jaminan kualitas tertulis</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3" style="background:rgba(255,255,255,0.05); border-radius:12px;">
                            <div style="width:48px;height:48px;background:rgba(13,110,253,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">📋</div>
                            <div>
                                <div style="color:#fff;font-family:'Montserrat',sans-serif;font-weight:700;font-size:0.9rem;">RAB Transparan</div>
                                <div style="color:rgba(255,255,255,0.5);font-size:0.8rem;">Tidak ada biaya tersembunyi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     STATS BAR
════════════════════════════════════════════ --}}
<section class="stats-bar">
    <div class="container">
        <div class="row g-4 justify-content-center text-center">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">{{ $settings->projects_completed ?? '150' }}<span class="suffix">+</span></div>
                    <div class="label">Proyek Selesai</div>
                </div>
            </div>
            <div class="col-md-auto d-none d-md-flex align-items-center">
                <div class="stat-divider"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">{{ date('Y') - ($settings->founded_year ?? 2010) }}<span class="suffix">+</span></div>
                    <div class="label">Tahun Pengalaman</div>
                </div>
            </div>
            <div class="col-md-auto d-none d-md-flex align-items-center">
                <div class="stat-divider"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">98<span class="suffix">%</span></div>
                    <div class="label">Klien Puas</div>
                </div>
            </div>
            <div class="col-md-auto d-none d-md-flex align-items-center">
                <div class="stat-divider"></div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">24<span class="suffix">h</span></div>
                    <div class="label">Response Time</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     LAYANAN SECTION
════════════════════════════════════════════ --}}
<section class="section" style="background: var(--off-white);">
    <div class="container">
        <div class="row justify-content-between align-items-end mb-5">
            <div class="col-lg-6">
                <div class="section-label">Apa yang Kami Tawarkan</div>
                <h2 class="section-title">Layanan <span>Profesional</span> Kami</h2>
                <p class="section-subtitle">Solusi lengkap dari perencanaan desain hingga konstruksi untuk semua kebutuhan bangunan Anda.</p>
            </div>
            <div class="col-lg-auto">
                <a href="{{ route('services.index') }}" class="btn btn-outline-primary">
                    Semua Layanan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card-service fade-in-up">
                    <div class="icon-wrap">
                        <i class="bi {{ $service->icon ?? 'bi-building' }}"></i>
                    </div>
                    <h5 class="mb-2">{{ $service->title }}</h5>
                    <p style="color:var(--gray-600); font-size:0.9rem; margin-bottom:1rem;">
                        {{ Str::limit($service->short_description, 120) }}
                    </p>
                    <a href="{{ route('services.show', $service->slug) }}"
                       style="color:var(--gold-dark); font-family:'Montserrat',sans-serif; font-weight:600; font-size:0.85rem;">
                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @empty
            {{-- Placeholder saat belum ada data --}}
            @foreach(['Jasa Arsitek', 'Kontraktor Bangunan', 'Desain Interior', 'Renovasi', 'RAB & Estimasi', 'Manajemen Proyek'] as $i => $title)
            <div class="col-md-6 col-lg-4">
                <div class="card-service fade-in-up delay-{{ $i % 4 }}">
                    <div class="icon-wrap">
                        <i class="bi {{ ['bi-building', 'bi-tools', 'bi-palette', 'bi-house-gear', 'bi-calculator', 'bi-clipboard-check'][$i] }}"></i>
                    </div>
                    <h5 class="mb-2">{{ $title }}</h5>
                    <p style="color:var(--gray-600); font-size:0.9rem; margin-bottom:1rem;">
                        Kami menyediakan layanan {{ strtolower($title) }} profesional dengan tim berpengalaman di Surabaya dan sekitarnya.
                    </p>
                    <a href="{{ route('services.index') }}" style="color:var(--gold-dark); font-family:'Montserrat',sans-serif; font-weight:600; font-size:0.85rem;">
                        Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     PORTOFOLIO SECTION
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row justify-content-between align-items-end mb-5">
            <div class="col-lg-6">
                <div class="section-label">Hasil Kerja Nyata</div>
                <h2 class="section-title">Portofolio <span>Terbaru</span></h2>
                <p class="section-subtitle">Dokumentasi proyek nyata yang kami kerjakan. Bukan render 3D, ini hasil karya sungguhan kami.</p>
            </div>
            <div class="col-lg-auto">
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-3">
            @forelse($portfolios as $portfolio)
            <div class="col-6 col-md-4 col-lg-4">
                <a href="{{ route('portfolio.show', $portfolio->slug) }}" class="card-portfolio">
                    @if($portfolio->thumbnail)
                    <img src="{{ asset('storage/'.$portfolio->thumbnail) }}"
                         alt="{{ $portfolio->title }}" loading="lazy">
                    @else
                    <div style="aspect-ratio:4/3; background:var(--gray-100); display:flex; align-items:center; justify-content:center;">
                        <i class="bi bi-image" style="font-size:3rem; color:var(--gray-400);"></i>
                    </div>
                    @endif
                    <div class="card-portfolio-overlay">
                        <span class="badge-cat">{{ $portfolio->category }}</span>
                        <h5>{{ $portfolio->title }}</h5>
                    </div>
                </a>
            </div>
            @empty
            {{-- Placeholder --}}
            @foreach(range(1,6) as $i)
            <div class="col-6 col-md-4">
                <div style="aspect-ratio:4/3; background:var(--gray-100); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; border:1px dashed var(--gray-200);">
                    <div class="text-center">
                        <i class="bi bi-image" style="font-size:2rem; color:var(--gray-400);"></i>
                        <p style="font-size:0.8rem; color:var(--gray-400); margin:0.5rem 0 0;">Foto Proyek {{ $i }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     WHY US SECTION
════════════════════════════════════════════ --}}
<section class="section" style="background: var(--navy);">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="section-label">Mengapa Memilih Kami</div>
                <h2 class="section-title" style="color:#fff;">Komitmen Kami untuk <span>Kepuasan</span> Anda</h2>
                <p style="color:rgba(255,255,255,0.65);">Kami bukan sekadar kontraktor. Kami adalah mitra bangunan Anda yang berkomitmen pada kualitas, waktu, dan transparansi anggaran.</p>
                <a href="{{ route('about') }}" class="btn btn-primary mt-2">
                    Tentang Perusahaan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    @foreach([
                        ['icon' => 'bi-shield-check', 'title' => 'Bergaransi Resmi', 'desc' => 'Setiap proyek dilengkapi surat garansi retensi bangunan tertulis.'],
                        ['icon' => 'bi-clock-history', 'title' => 'Tepat Waktu', 'desc' => 'Komitmen penyelesaian proyek sesuai jadwal yang disepakati di kontrak.'],
                        ['icon' => 'bi-graph-up', 'title' => 'RAB Transparan', 'desc' => 'Rincian anggaran yang jelas. Tidak ada biaya tersembunyi atau kejutan.'],
                        ['icon' => 'bi-people', 'title' => 'Tim Berpengalaman', 'desc' => 'Arsitek dan tenaga ahli bersertifikat dengan portofolio terbukti.'],
                    ] as $why)
                    <div class="col-6">
                        <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); border-radius:var(--radius-md); padding:1.5rem; height:100%;">
                            <i class="bi {{ $why['icon'] }}" style="color:var(--gold); font-size:1.8rem; margin-bottom:0.75rem; display:block;"></i>
                            <h6 style="color:#fff; font-family:'Montserrat',sans-serif; font-weight:700; margin-bottom:0.5rem;">{{ $why['title'] }}</h6>
                            <p style="color:rgba(255,255,255,0.55); font-size:0.85rem; margin:0;">{{ $why['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     ARTIKEL SECTION
════════════════════════════════════════════ --}}
@if($articles->isNotEmpty())
<section class="section" style="background:var(--off-white);">
    <div class="container">
        <div class="row justify-content-between align-items-end mb-5">
            <div class="col-lg-6">
                <div class="section-label">Tips & Edukasi</div>
                <h2 class="section-title">Artikel <span>Terbaru</span></h2>
            </div>
            <div class="col-lg-auto">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">
                    Semua Artikel <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="row g-4">
            @foreach($articles as $article)
            <div class="col-md-4">
                <a href="{{ route('articles.show', $article->slug) }}" class="card-article text-decoration-none d-flex flex-column">
                    @if($article->thumbnail)
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" loading="lazy">
                    @else
                    <div style="aspect-ratio:16/9; background:var(--gray-100); display:flex; align-items:center; justify-content:center;">
                        <i class="bi bi-newspaper" style="font-size:2rem; color:var(--gray-400);"></i>
                    </div>
                    @endif
                    <div class="card-article-body flex-fill">
                        <div class="article-cat">{{ $article->category ?? 'Artikel' }}</div>
                        <h5>{{ $article->title }}</h5>
                        <p style="font-size:0.85rem; color:var(--gray-600);">{{ Str::limit($article->excerpt, 100) }}</p>
                        <div style="font-size:0.8rem; color:var(--gray-400); margin-top:auto;">
                            <i class="bi bi-calendar3 me-1"></i>{{ $article->published_at?->format('d M Y') }}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════
     FAQ SECTION
════════════════════════════════════════════ --}}
@if($faqs->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <div class="section-label justify-content-center">FAQ</div>
                <h2 class="section-title">Pertanyaan yang <span>Sering Ditanyakan</span></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach($faqs as $faq)
                <details class="mb-3" style="border:1px solid var(--gray-200); border-radius:var(--radius-sm); overflow:hidden;">
                    <summary style="padding:1rem 1.25rem; cursor:pointer; font-family:'Montserrat',sans-serif; font-weight:600; font-size:0.95rem; color:var(--navy); list-style:none; display:flex; justify-content:space-between; align-items:center; user-select:none;"
                             class="d-flex">
                        {{ $faq->question }}
                        <i class="bi bi-plus-circle" style="color:var(--gold); flex-shrink:0; margin-left:1rem;"></i>
                    </summary>
                    <div style="padding:0 1.25rem 1rem; color:var(--gray-600); font-size:0.9rem; line-height:1.7; border-top:1px solid var(--gray-200);">
                        <p class="mb-0 pt-3">{{ $faq->answer }}</p>
                    </div>
                </details>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- ════════════════════════════════════════════
     CTA SECTION
════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="container text-center" style="position:relative; z-index:1;">
        <div class="section-label justify-content-center" style="color:var(--gold);">Mulai Proyek Anda</div>
        <h2 style="color:#fff; font-size:clamp(1.8rem, 4vw, 2.8rem); font-weight:800; margin-bottom:1rem;">
            Siap Wujudkan Bangunan <span style="color:var(--gold);">Impian Anda?</span>
        </h2>
        <p style="color:rgba(255,255,255,0.7); font-size:1rem; max-width:500px; margin:0 auto 2rem;">
            Konsultasi pertama gratis. Tim kami siap membantu Anda dari tahap perencanaan hingga selesai.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20gratis."
               class="btn btn-primary btn-lg" target="_blank" rel="noopener" data-wa>
                <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp Sekarang
            </a>
            <a href="{{ route('contact') }}" class="btn btn-lg"
               style="border:2px solid rgba(255,255,255,0.3); color:#fff;">
                <i class="bi bi-envelope me-2"></i>Kirim Pesan
            </a>
        </div>
    </div>
</section>

@endsection
