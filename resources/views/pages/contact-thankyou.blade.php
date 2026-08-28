@extends('layouts.app')

@php
    $meta_title = 'Pesan Terkirim — ' . ($settings->company_name ?? 'Jasa Kontraktor Surabaya');
@endphp

@section('content')

<section class="section d-flex align-items-center" style="min-height: 70vh; background: var(--off-white);">
    <div class="container text-center">
        <div class="p-5 bg-white rounded-4 border shadow-sm mx-auto" style="max-width: 600px;">
            <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle"
                 style="width: 80px; height: 80px; background: rgba(37,211,102,0.15); color: #25D366; font-size: 2.5rem;">
                <i class="bi bi-check-lg"></i>
            </div>

            <h2 class="fw-bold mb-3" style="color: var(--navy);">Terima Kasih!</h2>
            <h5 class="fw-semibold text-muted mb-3">Pesan Anda Berhasil Terkirim</h5>
            
            <p class="text-muted small mb-4">
                Data konsultasi Anda telah diterima oleh tim {{ $settings->company_name ?? 'Kontraktor Surabaya' }}. Kami akan segera meninjau kebutuhan proyek Anda dan menghubungi Anda kembali dalam waktu maksimal 1x24 jam.
            </p>

            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-outline-primary fw-semibold">
                    <i class="bi bi-house me-1"></i>Kembali ke Beranda
                </a>
                <a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}?text=Halo,%20saya%20sudah%20mengirimkan%20formulir%20konsultasi%20di%20website."
                   class="btn btn-whatsapp fw-semibold" target="_blank" rel="noopener">
                    <i class="bi bi-whatsapp me-1"></i>Konfirmasi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
