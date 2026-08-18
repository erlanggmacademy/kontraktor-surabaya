@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- ─── Stat Cards ─── --}}
<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem; font-weight:600; color:var(--gray-600); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Pesan Belum Dibaca</div>
                    <div class="value">{{ $stats['messages_unread'] }}</div>
                </div>
                <div class="icon" style="background:rgba(220,53,69,0.1);">
                    <i class="bi bi-inbox-fill" style="color:#dc3545;"></i>
                </div>
            </div>
            <div style="margin-top:1rem; font-size:0.8rem; color:var(--gray-600);">
                Total {{ $stats['messages_total'] }} pesan masuk
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem; font-weight:600; color:var(--gray-600); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Total Portofolio</div>
                    <div class="value">{{ $stats['portfolios_total'] }}</div>
                </div>
                <div class="icon" style="background:rgba(13,110,253,0.1);">
                    <i class="bi bi-images" style="color:#0d6efd;"></i>
                </div>
            </div>
            <div style="margin-top:1rem;">
                <a href="{{ route('admin.portofolio.create') }}" style="font-size:0.8rem; color:var(--gold-dark); font-weight:600;">
                    + Tambah Proyek
                </a>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem; font-weight:600; color:var(--gray-600); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Layanan Aktif</div>
                    <div class="value">{{ $stats['services_total'] }}</div>
                </div>
                <div class="icon" style="background:rgba(245,166,35,0.1);">
                    <i class="bi bi-grid-3x3-gap" style="color:var(--gold-dark);"></i>
                </div>
            </div>
            <div style="margin-top:1rem;">
                <a href="{{ route('admin.layanan.create') }}" style="font-size:0.8rem; color:var(--gold-dark); font-weight:600;">
                    + Tambah Layanan
                </a>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem; font-weight:600; color:var(--gray-600); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.5rem;">Artikel Published</div>
                    <div class="value">{{ $stats['articles_published'] }}</div>
                </div>
                <div class="icon" style="background:rgba(25,135,84,0.1);">
                    <i class="bi bi-newspaper" style="color:#198754;"></i>
                </div>
            </div>
            <div style="margin-top:1rem; font-size:0.8rem; color:var(--gray-600);">
                Total {{ $stats['articles_total'] }} artikel
            </div>
        </div>
    </div>
</div>

{{-- ─── Quick Actions ─── --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="form-card">
            <h6 style="font-family:'Montserrat',sans-serif; font-weight:700; color:var(--navy); margin-bottom:1.2rem;">
                <i class="bi bi-lightning-charge me-2" style="color:var(--gold);"></i>Aksi Cepat
            </h6>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.portofolio.create') }}" class="btn btn-sm" style="background:var(--navy);color:#fff;">
                    <i class="bi bi-plus me-1"></i>Tambah Proyek
                </a>
                <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Tambah Layanan
                </a>
                <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Tulis Artikel
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-gear me-1"></i>Pengaturan
                </a>
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Website
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ─── Latest Messages ─── --}}
<div class="row g-4">
    <div class="col-12">
        <div class="admin-table">
            <div class="d-flex justify-content-between align-items-center p-3" style="border-bottom:1px solid #E4E9F0;">
                <h6 class="m-0" style="font-family:'Montserrat',sans-serif; font-weight:700; color:var(--navy);">
                    <i class="bi bi-inbox me-2" style="color:var(--gold);"></i>Pesan Terbaru
                </h6>
                <a href="{{ route('admin.messages.index') }}" style="font-size:0.82rem; color:var(--gold-dark); font-weight:600;">
                    Lihat Semua →
                </a>
            </div>

            @if($latest_messages->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size:3rem; color:var(--gray-400);"></i>
                <p style="color:var(--gray-400); margin-top:0.5rem;">Belum ada pesan masuk.</p>
            </div>
            @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Subjek / Layanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latest_messages as $msg)
                    <tr>
                        <td>
                            <div style="font-weight:600; font-size:0.88rem; color:var(--navy);">{{ $msg->name }}</div>
                            <div style="font-size:0.78rem; color:var(--gray-600);">{{ $msg->email }}</div>
                        </td>
                        <td style="font-size:0.88rem;">
                            {{ $msg->service_interest ?? $msg->subject ?? '—' }}
                        </td>
                        <td style="font-size:0.82rem; color:var(--gray-600);">
                            {{ $msg->created_at->format('d M Y') }}
                        </td>
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge badge-active">Baru</span>
                            @else
                                <span class="badge badge-inactive">Dibaca</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.messages.show', $msg->id) }}"
                               class="btn btn-sm" style="background:var(--navy-mid);color:#fff;">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

@endsection
