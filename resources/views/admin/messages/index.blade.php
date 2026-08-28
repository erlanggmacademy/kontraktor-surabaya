@extends('layouts.admin')
@section('title', 'Pesan Masuk (Inbox)')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--navy);">Pesan Masuk (Inbox)</h4>
        <p class="text-muted small mb-0">Daftar calon klien yang mengirim formulir konsultasi melalui website.</p>
    </div>
    @if(isset($unread) && $unread > 0)
        <span class="badge bg-danger rounded-pill px-3 py-2">
            <i class="bi bi-envelope-fill me-1"></i>{{ $unread }} Pesan Baru
        </span>
    @endif
</div>

<div class="admin-table">
    @if($messages->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted opacity-50" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-0">Belum ada pesan masuk dari pengunjung website.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Nama Pengirim</th>
                        <th>Kontak (WA & Email)</th>
                        <th>Layanan Diminati</th>
                        <th>Tanggal Kirim</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-warning bg-opacity-10 fw-bold' : '' }}">
                        <td class="text-center">
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-circle p-1" title="Belum dibaca"> </span>
                            @else
                                <i class="bi bi-check2-all text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div style="color: var(--navy);">{{ $msg->name }}</div>
                            @if($msg->location)
                                <small class="text-muted fw-normal"><i class="bi bi-geo-alt me-1"></i>{{ $msg->location }}</small>
                            @endif
                        </td>
                        <td>
                            <div class="small fw-normal">
                                @if($msg->phone)
                                    <div><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-success text-decoration-none"><i class="bi bi-whatsapp me-1"></i>{{ $msg->phone }}</a></div>
                                @endif
                                <div><a href="mailto:{{ $msg->email }}" class="text-muted text-decoration-none"><i class="bi bi-envelope me-1"></i>{{ $msg->email }}</a></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border fw-normal">{{ $msg->service_interest ?? 'Konsultasi Umum' }}</span>
                        </td>
                        <td class="small text-muted fw-normal">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.pesan.show', $msg->id) }}" class="btn btn-sm btn-outline-primary" title="Buka Pesan">
                                    <i class="bi bi-eye"></i> Baca
                                </a>
                                <form action="{{ route('admin.pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
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

        @if($messages->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $messages->links() }}
        </div>
        @endif
    @endif
</div>

@endsection
