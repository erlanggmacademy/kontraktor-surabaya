@extends('layouts.app')

@php
    $meta_title = 'Tentang Kami — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
    $meta_desc  = 'Mengenal lebih dekat ' . ($settings->company_name ?? 'Kontraktor Surabaya') . ', penyedia jasa arsitek, bangun rumah baru, dan renovasi terpercaya di Surabaya sejak ' . ($settings->founded_year ?? '2010') . '.';
@endphp

@section('content')

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<section class="page-header">
    <div class="container text-center">
        <div class="badge-pill mb-3">Profil Perusahaan</div>
        <h1 class="display-5 fw-bold text-white mb-3">Membangun dengan Kualitas & Kepercayaan</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">
            Mitra rancang bangun terpercaya di Surabaya dan Jawa Timur. Kami menggabungkan estetika arsitektur modern dengan kekuatan struktur presisi.
        </p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     ABOUT STORY & VISION
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="section-label">Tentang Kami</div>
                <h2 class="section-title">Dedikasi Lebih Dari <span>{{ date('Y') - ($settings->founded_year ?? 2010) }} Tahun</span> di Industri Konstruksi</h2>
                <p class="text-muted leading-relaxed mb-4">
                    {{ $settings->company_description ?? 'Kami adalah perusahaan jasa arsitek dan kontraktor profesional yang berdomisili di Surabaya. Kami melayani perencanaan desain, pembangunan rumah tinggal, ruko, gedung komersial, hingga renovasi skala kecil maupun besar.' }}
                </p>
                <p class="text-muted leading-relaxed mb-4">
                    Prinsip kerja kami berlandaskan pada <strong>transparansi Rencana Anggaran Biaya (RAB)</strong>, ketepatan waktu kerja, dan material berkualitas tinggi tanpa kompromi.
                </p>

                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div class="p-3 rounded" style="background: var(--off-white); border-left: 4px solid var(--gold);">
                            <h4 class="fw-bold mb-1" style="color: var(--navy);">{{ $settings->projects_completed ?? '150' }}+ Proyek</h4>
                            <small class="text-muted">Telah sukses diselesaikan di wilayah Jawa Timur</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded" style="background: var(--off-white); border-left: 4px solid var(--gold);">
                            <h4 class="fw-bold mb-1" style="color: var(--navy);">100% Bergaransi</h4>
                            <small class="text-muted">Garansi retensi pemeliharaan bangunan resmi tertulis</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="position-relative p-4 rounded-4 shadow-sm" style="background: var(--navy); color: #fff;">
                    <h3 class="fw-bold mb-4" style="color: var(--gold);"><i class="bi bi-compass me-2"></i>Visi & Misi</h3>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold text-uppercase text-white mb-2" style="letter-spacing: 1px;">Visi Kami</h6>
                        <p class="text-white-50 small mb-0">
                            Menjadi penyedia jasa arsitektur dan kontraktor bangunan nomor satu di Surabaya yang dikenal atas integritas, inovasi desain, dan keunggulan mutu struktur.
                        </p>
                    </div>

                    <hr style="border-color: rgba(255,255,255,0.1);">

                    <div>
                        <h6 class="fw-bold text-uppercase text-white mb-2" style="letter-spacing: 1px;">Misi Kami</h6>
                        <ul class="list-unstyled text-white-50 small mb-0 d-flex flex-column gap-2">
                            <li><i class="bi bi-check-circle-fill text-warning me-2"></i>Menghadirkan perencanaan desain arsitektur yang fungsional, estetis, dan ramah anggaran.</li>
                            <li><i class="bi bi-check-circle-fill text-warning me-2"></i>Menerapkan manajemen konstruksi yang transparan tanpa pembengkakan biaya tersembunyi.</li>
                            <li><i class="bi bi-check-circle-fill text-warning me-2"></i>Menjaga kepuasan klien jangka panjang dengan layanan purna jual dan garansi resmi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     CORE VALUES
════════════════════════════════════════════ --}}
<section class="section" style="background: var(--off-white);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center">Prinsip Kerja</div>
            <h2 class="section-title">Nilai Utama <span>Perusahaan Kami</span></h2>
            <p class="section-subtitle mx-auto">Standar tinggi yang selalu kami terapkan dalam setiap jengkal pekerjaan proyek Anda.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card-service h-100 bg-white p-4">
                    <div class="icon-wrap mb-3"><i class="bi bi-calculator"></i></div>
                    <h5 class="fw-bold mb-2">Transparansi RAB</h5>
                    <p class="text-muted small mb-0">Rincian spesifikasi material dan biaya dibuat jelas sejak awal. Tidak ada biaya siluman di tengah pengerjaan.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-service h-100 bg-white p-4">
                    <div class="icon-wrap mb-3"><i class="bi bi-clock-history"></i></div>
                    <h5 class="fw-bold mb-2">Disiplin Waktu</h5>
                    <p class="text-muted small mb-0">Menggunakan metode <em>Time Schedule (Kurva S)</em> yang ketat agar proyek selesai sesuai deadline kontrak.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-service h-100 bg-white p-4">
                    <div class="icon-wrap mb-3"><i class="bi bi-award"></i></div>
                    <h5 class="fw-bold mb-2">Material SNI</h5>
                    <p class="text-muted small mb-0">Hanya menggunakan material konstruksi standar nasional berkualitas tinggi untuk menjamin kekokohan bangunan puluhan tahun.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card-service h-100 bg-white p-4">
                    <div class="icon-wrap mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold mb-2">Garansi Tertulis</h5>
                    <p class="text-muted small mb-0">Memberikan masa retensi dan surat garansi pemeliharaan bangunan resmi setelah serah terima kunci.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     WORKFLOW / CARA KERJA
════════════════════════════════════════════ --}}
<section class="section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label justify-content-center">Alur Pengerjaan</div>
            <h2 class="section-title">Bagaimana Kami <span>Bekerja Bersama Anda</span></h2>
            <p class="section-subtitle mx-auto">Proses rancang bangun yang sistematis, transparan, dan bebas repot.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-3 h-100 border text-center position-relative">
                    <div class="badge rounded-circle bg-primary text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.1rem; background: var(--navy) !important;">1</div>
                    <h5 class="fw-bold mb-2">Konsultasi & Survei</h5>
                    <p class="text-muted small mb-0">Diskusi kebutuhan, budget, serta survei lokasi lahan langsung di wilayah Surabaya dan sekitarnya (Gratis).</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-3 h-100 border text-center position-relative">
                    <div class="badge rounded-circle bg-warning text-dark mb-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.1rem; background: var(--gold) !important;">2</div>
                    <h5 class="fw-bold mb-2">Desain & RAB</h5>
                    <p class="text-muted small mb-0">Pembuatan denah 2D, 3D visual render, gambar kerja arsitektur, serta perhitungan Rencana Anggaran Biaya.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-3 h-100 border text-center position-relative">
                    <div class="badge rounded-circle bg-primary text-white mb-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.1rem; background: var(--navy) !important;">3</div>
                    <h5 class="fw-bold mb-2">Kontrak Kerja (SPK)</h5>
                    <p class="text-muted small mb-0">Penandatanganan Surat Perjanjian Kerja resmi dengan klausul jadwal, termin pembayaran, dan spesifikasi material.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="p-4 rounded-3 h-100 border text-center position-relative">
                    <div class="badge rounded-circle bg-warning text-dark mb-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.1rem; background: var(--gold) !important;">4</div>
                    <h5 class="fw-bold mb-2">Konstruksi & Garansi</h5>
                    <p class="text-muted small mb-0">Pembangunan diawasi mandor ahli dengan laporan progres berkala hingga serah terima kunci & masa garansi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     CTA SECTION
════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="container text-center position-relative" style="z-index: 1;">
        <div class="section-label justify-content-center text-warning">Mulai Proyek Impian</div>
        <h2 class="text-white fw-bold mb-3">Siap Mewujudkan Bangunan Idaman Anda?</h2>
        <p class="text-white-50 mx-auto mb-4" style="max-width: 550px;">
            Hubungi tim ahli kami untuk survei lokasi dan konsultasi awal secara cuma-cuma tanpa dipungut biaya.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20saya."
               class="btn btn-primary btn-lg" target="_blank" rel="noopener">
                <i class="bi bi-whatsapp me-2"></i>Konsultasi WhatsApp Sekarang
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>

@endsection
