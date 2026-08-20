<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimpelDesa - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="ti ti-home-shield" style="font-size: 28px; color: var(--primary-color);"></i>
                <h2 style="font-size: 18px; font-weight: 700; margin:0;">SimpelDesa</h2>
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
