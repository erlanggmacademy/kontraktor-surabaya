@extends('layouts.app')

@php
    $meta_title = 'Layanan Rancang Bangun & Kontraktor — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = 'Daftar layanan jasa arsitek, bangun rumah baru, renovasi bangunan, desain interior, dan perhitungan RAB profesional di Surabaya & sekitarnya.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container text-center">
        <div class="badge-pill mb-3">Layanan Profesional</div>
        <h1 class="display-5 fw-bold text-white mb-3">Solusi Rancang Bangun Lengkap</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">
            Dari tahap sketsa desain arsitektur hingga tahap konstruksi akhir dan serah terima kunci. Kualitas terjamin dengan manajemen transparan.
        </p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     SERVICES CATALOG
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row g-4">
            @if($services->isNotEmpty())
                @foreach($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card-service h-100 d-flex flex-column bg-white p-4">
                        <div class="icon-wrap mb-3">
                            <i class="bi {{ $service->icon ?? 'bi-building' }}"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: var(--navy);">{{ $service->title }}</h4>
                        <p class="text-muted small mb-4 flex-fill">
                            {{ $service->short_description ?? 'Layanan profesional dengan standar pengerjaan bermutu tinggi dan pengawasan berkala.' }}
                        </p>
                        
                        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('services.show', $service->slug) }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                Detail Layanan <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20tertarik%20dengan%20layanan%20{{ urlencode($service->title) }}."
                               class="btn btn-sm btn-outline-success" target="_blank" rel="noopener" title="Konsultasi WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Fallback Default Catalog --}}
                @php
                    $defaultServices = [
                        [
                            'icon' => 'bi-building',
                            'title' => 'Jasa Arsitek & Desain Rumah',
                            'desc' => 'Perencanaan gambar 2D denah, 3D visual render fotorealistik, gambar kerja detail DED, dan pengurusan dokumen PBG / IMB.',
                        ],
                        [
                            'icon' => 'bi-tools',
                            'title' => 'Kontraktor Bangun Rumah Baru',
                            'desc' => 'Pembangunan rumah tinggal, villa, kos-kosan, maupun ruko dari nol dengan mandor berpengalaman dan material SNI bergaransi.',
                        ],
                        [
                            'icon' => 'bi-house-gear',
                            'title' => 'Jasa Renovasi Bangunan',
                            'desc' => 'Renovasi skala ringan hingga total: tambah lantai, perombakan tampak depan (facade), perbaikan struktur bocor/retak, dan perluasan ruang.',
                        ],
                        [
                            'icon' => 'bi-palette',
                            'title' => 'Desain & Pengerjaan Interior',
                            'desc' => 'Pembuatan custom furniture, kitchen set modern, backdrop TV, partisi ruangan, dan finishing interior mewah sesuai keinginan.',
                        ],
                        [
                            'icon' => 'bi-calculator',
                            'title' => 'Penyusunan RAB & Estimasi',
                            'desc' => 'Perhitungan Rencana Anggaran Biaya yang transparan dan akurat untuk estimasi material, upah kerja, dan time schedule proyek.',
                        ],
                        [
                            'icon' => 'bi-clipboard-check',
                            'title' => 'Manajemen & Pengawasan Proyek',
                            'desc' => 'Jasa pengawasan berkala oleh tenaga ahli untuk memastikan kualitas bangunan sesuai spesifikasi kontrak dan gambar arsitek.',
                        ],
                    ];
                @endphp

                @foreach($defaultServices as $ds)
                <div class="col-md-6 col-lg-4">
                    <div class="card-service h-100 d-flex flex-column bg-white p-4">
                        <div class="icon-wrap mb-3">
                            <i class="bi {{ $ds['icon'] }}"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: var(--navy);">{{ $ds['title'] }}</h4>
                        <p class="text-muted small mb-4 flex-fill">
                            {{ $ds['desc'] }}
                        </p>
                        
                        <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('contact') }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                Konsultasikan <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20tertarik%20dengan%20layanan%20{{ urlencode($ds['title']) }}."
                               class="btn btn-sm btn-outline-success" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="container text-center position-relative" style="z-index: 1;">
        <div class="section-label justify-content-center text-warning">Konsultasi Gratis</div>
        <h2 class="text-white fw-bold mb-3">Bingung Menentukan Kebutuhan Bangunan Anda?</h2>
        <p class="text-white-50 mx-auto mb-4" style="max-width: 550px;">
            Konsultasikan ide Anda bersama arsitek kami. Dapatkan saran teknis dan perkiraan estimasi anggaran secara cuma-cuma.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20layanan."
               class="btn btn-primary btn-lg" target="_blank" rel="noopener">
                <i class="bi bi-whatsapp me-2"></i>Tanya via WhatsApp
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Kirim Formulir
            </a>
        </div>
    </div>
</section>

@endsection
