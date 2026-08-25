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
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-suraja-warna.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- Alpine.js Core & Collapse Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @yield('styles')
</head>
<body>
    <div class="app-container" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'collapsed': !sidebarOpen }">
            <div class="sidebar-header" @click="sidebarOpen = !sidebarOpen" style="cursor: pointer; flex-direction: column; align-items: flex-start; gap: 10px; padding: 20px;" title="Toggle Sidebar">
                <!-- Logo Utama (Web Branding) -->
                <div style="display: flex; align-items: center; gap: 10px;">
                    @if(file_exists(public_path('assets/img/logo-suraja-putih.png')))
                        <img src="{{ asset('assets/img/logo-suraja-putih.png') }}" alt="Logo" style="width: 42px; height: 42px; object-fit: contain;">
                    @else
                        @if(isset($pengaturan) && $pengaturan->logo_path)
                            <img src="{{ asset($pengaturan->logo_path) }}" alt="Logo" style="width: 42px; height: 42px; object-fit: contain;">
                        @else
                            <i class="ti ti-building-bank" style="font-size: 32px; color: var(--primary-color);"></i>
                        @endif
                    @endif
                    <h2 class="menu-text" style="font-size: 22px; font-weight: 700; margin:0; color: white; letter-spacing: 1px;">SURAJA</h2>
                </div>
            </div>

            <div class="sidebar-menu" style="flex: 1;">
                <div class="menu-group-title menu-text">Menu Utama</div>
                
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="ti ti-dashboard" style="font-size: 20px;"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                
                <!-- Layanan Surat (Dropdown) -->
                <div x-data="{ dropdownOpen: {{ request()->routeIs('surat.*') || request()->routeIs('template-surat.*') ? 'true' : 'false' }} }" class="menu-dropdown">
                    <a href="#" @click.prevent="dropdownOpen = !dropdownOpen; if(!sidebarOpen) sidebarOpen = true;" class="menu-item {{ (request()->routeIs('surat.*') || request()->routeIs('template-surat.*')) ? 'active-parent' : '' }}" title="Layanan Surat">
                        <i class="ti ti-file-description" style="font-size: 20px;"></i>
                        <span class="menu-text">Layanan Surat</span>
                        <i class="ti menu-text" :class="dropdownOpen ? 'ti-chevron-down' : 'ti-chevron-right'" style="margin-left: auto; font-size: 16px;"></i>
                    </a>
                    
                    <div x-show="dropdownOpen" x-collapse class="dropdown-content menu-text">
                        <a href="{{ route('surat.index') }}" class="sub-menu-item {{ request()->routeIs('surat.*') ? 'active' : '' }}">
                            Cetak Surat
                        </a>
                        <a href="{{ route('template-surat.index') }}" class="sub-menu-item {{ request()->routeIs('template-surat.*') ? 'active' : '' }}">
                            Template Surat
                        </a>
                    </div>
                </div>

                <a href="{{ route('penduduk.index') }}" class="menu-item {{ request()->routeIs('penduduk.*') ? 'active' : '' }}" title="Data Penduduk">
                    <i class="ti ti-users" style="font-size: 20px;"></i>
                    <span class="menu-text">Data Penduduk</span>
                </a>

                <a href="{{ route('riwayat.index') }}" class="menu-item {{ request()->routeIs('riwayat.*') ? 'active' : '' }}" title="Riwayat Aktivitas">
                    <i class="ti ti-history" style="font-size: 20px;"></i>
                    <span class="menu-text">Riwayat Aktivitas</span>
                </a>

                <div class="menu-group-title menu-text" style="margin-top: 16px;">Lainnya</div>

                <a href="{{ route('pengaturan.index') }}" class="menu-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}" title="Pengaturan Sistem">
                    <i class="ti ti-settings" style="font-size: 20px;"></i>
                    <span class="menu-text">Pengaturan Sistem</span>
                </a>

                <div style="margin-top: auto; padding-bottom: 12px;">
                    <style>
                        .logout-item::after { display: none !important; }
                    </style>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-item logout-item" style="color: #fca5a5; margin-bottom: 0;" title="Logout">
                        <i class="ti ti-logout" style="font-size: 20px;"></i>
                        <span class="menu-text">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <div style="display: flex; align-items: center; justify-content: flex-end; width: 100%;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 14px; font-weight: 500;">Admin Desa Jangglengan</span>
                    </div>
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
