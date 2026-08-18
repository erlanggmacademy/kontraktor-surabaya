<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- ─── Dynamic SEO Meta Tags ─── --}}
    <title>{{ $meta_title ?? config('app.name', 'Jasa Kontraktor Surabaya') }}</title>
    <meta name="description" content="{{ $meta_desc ?? 'Solusi rancang bangun terpercaya di Surabaya. Jasa arsitek, kontraktor, renovasi dengan kualitas dan manajemen transparan.' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ─── Open Graph ─── --}}
    <meta property="og:type"        content="{{ $og_type ?? 'website' }}">
    <meta property="og:title"       content="{{ $og_title ?? $meta_title ?? config('app.name') }}">
    <meta property="og:description" content="{{ $og_desc ?? $meta_desc ?? '' }}">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:image"       content="{{ isset($og_image) ? asset('storage/'.$og_image) : asset('assets/img/og-default.jpg') }}">
    <meta property="og:locale"      content="id_ID">
    <meta name="twitter:card"       content="summary_large_image">

    {{-- ─── Favicon ─── --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- ─── Bootstrap 5 CSS ─── --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ─── Bootstrap Icons ─── --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- ─── Custom Design System ─── --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{-- ─── Google Analytics 4 ─── --}}
    @if(!empty($settings->ga4_tag_id))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->ga4_tag_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings->ga4_tag_id }}');
    </script>
    @endif

    {{-- ─── Schema Markup JSON-LD ─── --}}
    @if(Route::is('home'))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GeneralContractor",
        "name": "{{ $settings->company_name ?? config('app.name') }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ $settings->whatsapp_number ?? '' }}",
        "email": "{{ $settings->email ?? '' }}",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Surabaya",
            "addressRegion": "Jawa Timur",
            "addressCountry": "ID",
            "streetAddress": "{{ $settings->address ?? '' }}"
        },
        "description": "{{ $settings->company_description ?? 'Solusi rancang bangun terpercaya di Surabaya.' }}",
        "foundingDate": "{{ $settings->founded_year ?? '' }}"
    }
    </script>
    @endif

    @stack('styles')
</head>
<body>

{{-- ════════════════════════════════════════════
     NAVBAR
════════════════════════════════════════════ --}}
<nav class="navbar navbar-main navbar-expand-lg fixed-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(!empty($settings->logo))
                <img src="{{ asset('storage/'.$settings->logo) }}" alt="{{ $settings->company_name }}" height="40" class="me-2">
            @else
                <span>Kontraktor</span><span>Surabaya</span>
            @endif
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('portfolio.*') ? 'active' : '' }}" href="{{ route('portfolio.index') }}">Portofolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Artikel</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="nav-link nav-cta" href="{{ route('contact') }}">
                        <i class="bi bi-chat-dots me-1"></i>Konsultasi Gratis
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- ════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════ --}}
<main>
    @yield('content')
</main>

{{-- ════════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ --}}
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand mb-3">
                    <span>Kontraktor</span><span>Surabaya</span>
                </div>
                <p>{{ $settings->company_tagline ?? 'Membangun dengan Kualitas, Ketepatan, dan Kepercayaan.' }}</p>
                <div class="d-flex gap-2 mt-3">
                    @if(!empty($settings->instagram_url))
                    <a href="{{ $settings->instagram_url }}" target="_blank" class="btn btn-sm" style="border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.6);" rel="noopener">
                        <i class="bi bi-instagram"></i>
                    </a>
                    @endif
                    @if(!empty($settings->facebook_url))
                    <a href="{{ $settings->facebook_url }}" target="_blank" class="btn btn-sm" style="border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.6);" rel="noopener">
                        <i class="bi bi-facebook"></i>
                    </a>
                    @endif
                    @if(!empty($settings->youtube_url))
                    <a href="{{ $settings->youtube_url }}" target="_blank" class="btn btn-sm" style="border:1px solid rgba(255,255,255,0.2); color:rgba(255,255,255,0.6);" rel="noopener">
                        <i class="bi bi-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6>Navigasi</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('services.index') }}">Layanan</a></li>
                    <li><a href="{{ route('portfolio.index') }}">Portofolio</a></li>
                    <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h6>Layanan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('services.index') }}">Jasa Arsitek</a></li>
                    <li><a href="{{ route('services.index') }}">Kontraktor</a></li>
                    <li><a href="{{ route('services.index') }}">Interior</a></li>
                    <li><a href="{{ route('services.index') }}">Renovasi</a></li>
                    <li><a href="{{ route('services.index') }}">RAB & Estimasi</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6>Hubungi Kami</h6>
                <ul class="footer-links">
                    @if(!empty($settings->address))
                    <li style="color:rgba(255,255,255,0.55); font-size:0.9rem; list-style:none;">
                        <i class="bi bi-geo-alt me-2" style="color:var(--gold)"></i>{{ $settings->address }}
                    </li>
                    @endif
                    @if(!empty($settings->whatsapp_number))
                    <li><a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp me-2" style="color:#25D366"></i>+{{ $settings->whatsapp_number }}
                    </a></li>
                    @endif
                    @if(!empty($settings->email))
                    <li><a href="mailto:{{ $settings->email }}">
                        <i class="bi bi-envelope me-2" style="color:var(--gold)"></i>{{ $settings->email }}
                    </a></li>
                    @endif
                </ul>
                <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya."
                   class="btn btn-whatsapp btn-sm mt-3" target="_blank" rel="noopener" id="footer-wa-btn">
                    <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom mt-4">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p>{{ $settings->footer_text ?? '&copy; ' . date('Y') . ' ' . ($settings->company_name ?? 'Kontraktor Surabaya') . '. All rights reserved.' }}</p>
                <a href="{{ route('admin.dashboard') }}" style="color:rgba(255,255,255,0.2); font-size:0.75rem;">Admin</a>
            </div>
        </div>
    </div>
</footer>

{{-- ─── WhatsApp Float Button ─── --}}
<a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya."
   class="wa-float" target="_blank" rel="noopener" aria-label="Chat WhatsApp" id="wa-float-btn">
    <i class="bi bi-whatsapp"></i>
</a>

{{-- ─── Back to Top ─── --}}
<button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="bi bi-chevron-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="{{ asset('assets/js/main.js') }}" defer></script>

@stack('scripts')
</body>
</html>
