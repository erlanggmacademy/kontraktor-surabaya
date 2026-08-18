<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy:     #0D1B35;
            --navy-mid: #162444;
            --gold:     #F5A623;
            --gold-dark:#D4891A;
            --sidebar-w: 260px;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #F1F4F8;
            color: #2D3A4A;
        }
        h1,h2,h3,h4,h5,h6 { font-family: 'Montserrat', sans-serif; }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--navy);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #fff;
        }
        .sidebar-brand span { color: var(--gold); }
        .sidebar-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            padding: 1.2rem 1.5rem 0.4rem;
        }
        .sidebar-nav { padding: 0.5rem 1rem; flex: 1; }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.65);
            padding: 0.6rem 0.75rem;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .sidebar-nav .nav-link i { font-size: 1rem; width: 20px; }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(245,166,35,0.12);
            color: var(--gold);
        }
        .sidebar-nav .nav-link.active { font-weight: 600; }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #E4E9F0;
            padding: 0.875rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-topbar .page-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--navy);
            margin: 0;
        }
        .admin-content { padding: 2rem; flex: 1; }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #E4E9F0;
            transition: all 0.2s;
        }
        .stat-card:hover { box-shadow: 0 8px 30px rgba(13,27,53,0.1); transform: translateY(-2px); }
        .stat-card .icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .stat-card .value {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
        }

        /* Tables */
        .admin-table { background: #fff; border-radius: 12px; border: 1px solid #E4E9F0; overflow: hidden; }
        .admin-table .table { margin: 0; }
        .admin-table .table thead th {
            background: #F8F9FB;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #5A6B80;
            border-bottom: 1px solid #E4E9F0;
            padding: 0.875rem 1rem;
        }
        .admin-table .table td { padding: 0.875rem 1rem; vertical-align: middle; font-size: 0.9rem; }
        .admin-table .table tr:last-child td { border-bottom: none; }

        /* Form Cards */
        .form-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #E4E9F0;
            padding: 2rem;
        }
        .form-card .form-control, .form-card .form-select {
            border-color: #E4E9F0;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .form-card .form-control:focus, .form-card .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(245,166,35,0.2);
        }
        .form-card .form-label {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--navy);
        }

        /* Badge */
        .badge-active { background: rgba(25,135,84,0.1); color: #198754; font-weight: 600; }
        .badge-inactive { background: rgba(108,117,125,0.1); color: #6c757d; font-weight: 600; }

        /* Responsive */
        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ─── Sidebar ─── --}}
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <span>KS</span> Admin Panel
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-label">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-label">Konten Website</div>

        <a href="{{ route('admin.layanan.index') }}"
           class="nav-link {{ Route::is('admin.layanan.*') ? 'active' : '' }}">
            <i class="bi bi-grid-3x3-gap"></i> Kelola Layanan
        </a>

        <a href="{{ route('admin.portofolio.index') }}"
           class="nav-link {{ Route::is('admin.portofolio.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Kelola Portofolio
        </a>

        <a href="{{ route('admin.artikel.index') }}"
           class="nav-link {{ Route::is('admin.artikel.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Kelola Artikel
        </a>

        <div class="sidebar-label">Operasional</div>

        <a href="{{ route('admin.messages.index') }}"
           class="nav-link {{ Route::is('admin.messages.*') ? 'active' : '' }}">
            <i class="bi bi-inbox"></i> Pesan Masuk
            @php $unread = \App\Models\Message::unread()->count(); @endphp
            @if($unread > 0)
            <span class="ms-auto badge rounded-pill" style="background:var(--gold);color:var(--navy);font-size:0.7rem;">{{ $unread }}</span>
            @endif
        </a>

        <a href="{{ route('admin.settings.edit') }}"
           class="nav-link {{ Route::is('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>

        <div class="sidebar-label">Akses</div>

        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center"
                 style="width:36px;height:36px;background:rgba(245,166,35,0.15);color:var(--gold);font-weight:700;font-size:0.9rem;">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div>
                <div style="font-size:0.82rem;font-weight:600;color:#fff;">{{ auth()->user()->name ?? 'Admin' }}</div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 text-decoration-none"
                            style="font-size:0.75rem;color:rgba(255,255,255,0.4);">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

{{-- ─── Main Content ─── --}}
<div class="admin-main">
    <header class="admin-topbar">
        <h1 class="page-title">@yield('title', 'Dashboard')</h1>
        <div class="d-flex align-items-center gap-3">
            {{-- Mobile menu toggle --}}
            <button class="btn btn-sm d-lg-none" id="sidebarToggle" style="border:1px solid #E4E9F0;">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </header>

    <main class="admin-content">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile sidebar toggle
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('adminSidebar').classList.toggle('show');
    });
</script>

@stack('scripts')
</body>
</html>
