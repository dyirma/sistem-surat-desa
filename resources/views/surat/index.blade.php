@extends('layouts.app')
@section('title', 'Layanan Surat')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Buat Surat</h1>
            <p class="page-subtitle">Silakan pilih jenis surat yang ingin Anda buat</p>
        </div>
    </div>
    <!-- Search Bar (Visual Only for this screen) -->
    <div style="margin-top: 20px; background: white; padding: 12px 20px; border-radius: 8px; border: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px;">
        <i class="ti ti-search text-muted"></i>
        <input type="text" placeholder="Cari jenis surat yang Anda inginkan..." style="border: none; outline: none; width: 100%; font-size: 15px; font-family: inherit;">
    </div>

    <div style="margin-top: 30px;">
        <div style="font-size: 13px; font-weight: 600; color: var(--primary-color); display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
            <i class="ti ti-file-text"></i>
            SURAT KETERANGAN & PENGANTAR
        </div>
        
        <div class="surat-grid">
            <a href="{{ route('surat.create', ['jenis' => 'domisili']) }}" class="surat-card">
                <div class="surat-card-header">
                    <div class="surat-card-title">Surat Keterangan Domisili</div>
                    <i class="ti ti-chevron-right text-muted"></i>
                </div>
                <div class="surat-card-desc">
                    Surat yang menyatakan kebenaran alamat tinggal seseorang di wilayah desa.
                </div>
            </a>
            
            <a href="{{ route('surat.create', ['jenis' => 'usaha']) }}" class="surat-card">
                <div class="surat-card-header">
                    <div class="surat-card-title">Surat Keterangan Usaha</div>
                    <i class="ti ti-chevron-right text-muted"></i>
                </div>
                <div class="surat-card-desc">
                    Surat untuk menerangkan bahwa sebuah usaha terdaftar dalam administratif desa.
                </div>
            </a>
            
            <a href="{{ route('surat.create', ['jenis' => 'tidak-mampu']) }}" class="surat-card">
                <div class="surat-card-header">
                    <div class="surat-card-title">Surat Ket. Tidak Mampu</div>
                    <i class="ti ti-chevron-right text-muted"></i>
                </div>
                <div class="surat-card-desc">
                    Surat pengantar bagi warga kurang mampu untuk keperluan administrasi tertentu.
                </div>
            </a>

            <a href="{{ route('surat.create', ['jenis' => 'nikah']) }}" class="surat-card">
                <div class="surat-card-header">
                    <div class="surat-card-title">Surat Pengantar Nikah</div>
                    <i class="ti ti-chevron-right text-muted"></i>
                </div>
                <div class="surat-card-desc">
                    Surat pengantar untuk melengkapi persyaratan pernikahan warga.
                </div>
            </a>
        </div>
    </div>
@endsection
