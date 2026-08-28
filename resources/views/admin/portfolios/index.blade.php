@extends('layouts.admin')
@section('title', 'Kelola Portofolio')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--navy);">Daftar Portofolio Proyek</h4>
        <p class="text-muted small mb-0">Kelola dokumentasi proyek bangunan yang telah selesai dan tampil di website.</p>
    </div>
    <a href="{{ route('admin.portofolio.create') }}" class="btn btn-primary btn-sm fw-bold">
        <i class="bi bi-plus-lg me-1"></i>Tambah Proyek Baru
    </a>
</div>

<div class="admin-table">
    @if($portfolios->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-images text-muted opacity-50" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-3">Belum ada portofolio proyek yang ditambahkan.</p>
            <a href="{{ route('admin.portofolio.create') }}" class="btn btn-sm btn-primary">
                + Tambah Proyek Pertama
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">Foto</th>
                        <th>Judul Proyek</th>
                        <th>Kategori</th>
                        <th>Lokasi & Tahun</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($portfolios as $p)
                    <tr>
                        <td>
                            @if($p->thumbnail)
                                <img src="{{ asset('storage/' . $p->thumbnail) }}" alt="{{ $p->title }}" class="rounded-2 border object-fit-cover" style="width: 60px; height: 45px;">
                            @else
                                <div class="rounded-2 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 45px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold" style="color: var(--navy);">{{ $p->title }}</div>
                            <small class="text-muted">Slug: /portofolio/{{ $p->slug }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border fw-semibold">{{ $p->category }}</span>
                        </td>
                        <td class="small text-muted">
                            <div><i class="bi bi-geo-alt me-1 text-warning"></i>{{ $p->location ?? '-' }}</div>
                            <div><i class="bi bi-calendar3 me-1"></i>{{ $p->year_completed ?? '-' }}</div>
                        </td>
                        <td>
                            @if($p->is_featured)
                                <span class="badge" style="background: rgba(245,166,35,0.15); color: var(--gold-dark); font-weight: 700;">★ Featured</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($p->is_active)
                                <span class="badge badge-active">Aktif</span>
                            @else
                                <span class="badge badge-inactive">Draft</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.portofolio.edit', $p->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.portofolio.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
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
