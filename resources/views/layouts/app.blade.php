<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Layanan tata naskah dan administrasi persuratan resmi Pemerintah Desa Jangglengan, Kec. Nguter, Kab. Sukoharjo.">
    <meta property="og:title" content="@yield('title', 'Beranda') | SURAJA - Desa Jangglengan">
    <meta property="og:description" content="Layanan tata naskah dan administrasi persuratan resmi Pemerintah Desa Jangglengan.">
    <meta property="og:type" content="website">
    <title>@yield('title', 'Beranda') | SURAJA - Desa Jangglengan</title>
    
    <!-- Favicon dinamis mengambil dari logo_path atau default -->
    @php
        $pengaturan = \App\Models\Pengaturan::first();
        $favicon = ($pengaturan && $pengaturan->logo_path) ? asset($pengaturan->logo_path) : asset('assets/img/default-logo.png');
    @endphp
    <link rel="icon" type="image/png" href="{{ $favicon }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header" style="flex-direction: column; align-items: flex-start; gap: 10px; padding: 20px;">
                <!-- Logo Desa Wisata (Web Branding) -->
                @if(file_exists(public_path('assets/img/logo-wisata-jangglengan.png')))
                    <img src="{{ asset('assets/img/logo-wisata-jangglengan.png') }}" alt="Desa Wisata" style="width: 100%; max-width: 180px; object-fit: contain;">
                @else
                    <div style="display: flex; align-items: center; gap: 8px;">
                        @if($pengaturan && $pengaturan->logo_path)
                            <img src="{{ $favicon }}" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;">
                        @else
                            <i class="ti ti-building-bank" style="font-size: 28px; color: var(--primary-color);"></i>
                        @endif
                        <h2 style="font-size: 18px; font-weight: 700; margin:0;">SURAJA</h2>
                    </div>
                @endif


            </div>
            <div class="sidebar-menu">
                <div class="menu-group-title">Menu Utama</div>
                
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="ti ti-dashboard" style="font-size: 20px;"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('surat.index') }}" class="menu-item {{ request()->routeIs('surat.*') ? 'active' : '' }}">
                    <i class="ti ti-file-description" style="font-size: 20px;"></i>
                    <span>Layanan Surat</span>
                </a>

                <a href="{{ route('penduduk.index') }}" class="menu-item {{ request()->routeIs('penduduk.*') ? 'active' : '' }}">
                    <i class="ti ti-users" style="font-size: 20px;"></i>
                    <span>Data Penduduk</span>
                </a>

                <a href="{{ route('riwayat.index') }}" class="menu-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                    <i class="ti ti-history" style="font-size: 20px;"></i>
                    <span>Riwayat Aktivitas</span>
                </a>

                <a href="{{ route('pengaturan.index') }}" class="menu-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                    <i class="ti ti-settings" style="font-size: 20px;"></i>
                    <span>Pengaturan Surat</span>
                </a>

                <a href="{{ route('template-surat.index') }}" class="menu-item {{ request()->routeIs('template-surat.*') ? 'active' : '' }}">
                    <i class="ti ti-template" style="font-size: 20px;"></i>
                    <span>Template Surat</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="https://ui-avatars.com/api/?name=Admin+Desa&background=0D8ABC&color=fff" alt="Profile" style="width: 36px; border-radius: 50%;">
                    <span style="font-size: 14px; font-weight: 500;">Admin Desa</span>
                </div>
            </header>
            
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>
    
    @yield('scripts')
</body>
</html>
