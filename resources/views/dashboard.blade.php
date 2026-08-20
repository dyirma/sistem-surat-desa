@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Selamat Datang di SimpelDesa</h1>
        <p class="page-subtitle">Sistem Informasi Manajemen Pelayanan Desa (SimpelDesa) mempermudah pengelolaan data kependudukan dan otomatisasi pembuatan surat keterangan atau pengantar desa.</p>
    </div>
</div>
<div class="dashboard-card">
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 30px;">
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <i class="ti ti-file-description" style="font-size: 24px; color: var(--primary-color);"></i>
                <h3 style="font-size: 16px; font-weight: 600; margin: 0;">Layanan Surat</h3>
            </div>
            <p style="font-size: 14px; color: #64748b; margin-bottom: 16px;">Kelola dan cetak surat keterangan untuk warga dengan cepat.</p>
            <a href="{{ route('surat.index') }}" style="display: inline-block; padding: 8px 16px; background: var(--primary-color); color: white; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: 500;">Buat Surat</a>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <i class="ti ti-users" style="font-size: 24px; color: var(--primary-color);"></i>
                <h3 style="font-size: 16px; font-weight: 600; margin: 0;">Data Penduduk</h3>
            </div>
            <p style="font-size: 14px; color: #64748b; margin-bottom: 16px;">Kelola basis data penduduk desa dengan mudah.</p>
            <a href="{{ route('penduduk.index') }}" style="display: inline-block; padding: 8px 16px; background: var(--primary-color); color: white; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: 500;">Lihat Data</a>
        </div>
    </div>
</div>
@endsection
