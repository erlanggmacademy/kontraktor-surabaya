@extends('layouts.admin')
@section('title', 'Detail Pesan dari ' . $message->name)

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.pesan.index') }}" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Inbox
    </a>
    <h4 class="fw-bold mt-1" style="color: var(--navy);">Detail Pesan Konsultasi</h4>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm">
            <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                <div>
                    <h5 class="fw-bold mb-1" style="color: var(--navy);">{{ $message->name }}</h5>
                    <div class="text-muted small">
                        <span><i class="bi bi-calendar3 me-1"></i>{{ $message->created_at->format('d F Y, H:i WIB') }}</span>
                        @if($message->location)
                            <span class="ms-3"><i class="bi bi-geo-alt me-1 text-warning"></i>{{ $message->location }}</span>
                        @endif
                    </div>
                </div>
                <span class="badge bg-light text-dark border px-3 py-2">
                    {{ $message->service_interest ?? 'Konsultasi Umum' }}
                </span>
            </div>

            <h6 class="fw-bold text-muted small text-uppercase mb-2">Isi Pesan / Rencana Proyek:</h6>
            <div class="p-4 rounded-3 bg-light text-dark leading-relaxed mb-4" style="font-size: 1rem; line-height: 1.8; white-space: pre-line;">
                {{ $message->message }}
            </div>

            <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                @if($message->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text=Halo%20{{ urlencode($message->name) }},%20terima%20kasih%20telah%20menghubungi%20kami%20mengenai%20konsultasi%20proyek."
                   class="btn btn-success fw-bold" target="_blank" rel="noopener">
                    <i class="bi bi-whatsapp me-2"></i>Balas via WhatsApp
                </a>
                @endif
                <a href="mailto:{{ $message->email }}?subject=Tindak%20Lanjut%20Konsultasi%20Proyek"
                   class="btn btn-outline-primary fw-semibold">
                    <i class="bi bi-envelope me-2"></i>Balas via Email
                </a>
                <form action="{{ route('admin.pesan.destroy', $message->id) }}" method="POST" class="ms-auto" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i>Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="p-4 bg-white rounded-4 border shadow-sm">
            <h6 class="fw-bold mb-3" style="color: var(--navy);"><i class="bi bi-person-lines-fill me-2" style="color: var(--gold);"></i>Data Kontak Pengirim</h6>
            
            <ul class="list-unstyled d-flex flex-column gap-3 mb-0 small">
                <li>
                    <span class="text-muted d-block">Nama Lengkap:</span>
                    <strong style="color: var(--navy);">{{ $message->name }}</strong>
                </li>
                <li>
                    <span class="text-muted d-block">Nomor Telepon / WhatsApp:</span>
                    <strong>{{ $message->phone ?? '-' }}</strong>
                </li>
                <li>
                    <span class="text-muted d-block">Email:</span>
                    <strong>{{ $message->email }}</strong>
                </li>
                <li>
                    <span class="text-muted d-block">Lokasi Lahan / Proyek:</span>
                    <strong>{{ $message->location ?? '-' }}</strong>
                </li>
                <li>
                    <span class="text-muted d-block">IP Address Pengirim:</span>
                    <code>{{ $message->ip_address ?? '-' }}</code>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection
