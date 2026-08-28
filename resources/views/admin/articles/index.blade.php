@extends('layouts.admin')
@section('title', 'Kelola Artikel & Berita')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--navy);">Daftar Artikel & Berita</h4>
        <p class="text-muted small mb-0">Kelola artikel edukasi konstruksi, tips arsitektur, dan berita SEO.</p>
    </div>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-sm fw-bold">
        <i class="bi bi-plus-lg me-1"></i>Tulis Artikel Baru
    </a>
</div>

<div class="admin-table">
    @if($articles->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-newspaper text-muted opacity-50" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-3">Belum ada artikel yang dibuat.</p>
            <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm btn-primary">
                + Tulis Artikel Pertama
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">Thumbnail</th>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tanggal Terbit</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $art)
                    <tr>
                        <td>
                            @if($art->thumbnail)
                                <img src="{{ asset('storage/' . $art->thumbnail) }}" alt="{{ $art->title }}" class="rounded-2 border object-fit-cover" style="width: 60px; height: 40px;">
                            @else
                                <div class="rounded-2 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 40px;">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold" style="color: var(--navy);">{{ $art->title }}</div>
                            <small class="text-muted">Slug: /artikel/{{ $art->slug }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $art->category ?? 'Umum' }}</span>
                        </td>
                        <td class="small text-muted">
                            {{ $art->author->name ?? 'Admin' }}
                        </td>
                        <td class="small text-muted">
                            {{ $art->published_at ? $art->published_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            @if($art->is_published)
                                <span class="badge badge-active">Published</span>
                            @else
                                <span class="badge badge-inactive">Draft</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.artikel.edit', $art->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.artikel.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
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

        @if($articles->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $articles->links() }}
        </div>
        @endif
    @endif
</div>

@endsection
