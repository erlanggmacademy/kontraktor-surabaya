@extends('layouts.admin')
@section('title', 'Kelola Layanan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--navy);">Daftar Layanan</h4>
        <p class="text-muted small mb-0">Kelola semua jenis layanan arsitek dan konstruksi yang tampil di website.</p>
    </div>
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary btn-sm fw-bold">
        <i class="bi bi-plus-lg me-1"></i>Tambah Layanan Baru
    </a>
</div>

<div class="admin-table">
    @if($services->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-grid-3x3-gap text-muted opacity-50" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-3">Belum ada layanan yang ditambahkan.</p>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-primary">
                + Buat Layanan Pertama
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">Urutan</th>
                        <th>Layanan</th>
                        <th>Deskripsi Singkat</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $svc)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $svc->order ?? '-' }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-2 d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width: 36px; height: 36px; background: rgba(245,166,35,0.12); color: var(--gold-dark); font-size: 1.1rem;">
                                    <i class="bi {{ $svc->icon ?? 'bi-building' }}"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="color: var(--navy);">{{ $svc->title }}</div>
                                    <small class="text-muted">Slug: /layanan/{{ $svc->slug }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted small">
                            {{ Str::limit($svc->short_description, 90) }}
                        </td>
                        <td>
                            @if($svc->is_active)
                                <span class="badge badge-active">Aktif</span>
                            @else
                                <span class="badge badge-inactive">Draft / Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.layanan.edit', $svc->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $svc->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
