@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div style="padding: 24px;">
    
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 36px; font-weight: 800; color: #1e293b; margin: 0; letter-spacing: -0.5px;">SURAJA</h1>
        <p style="font-size: 16px; color: #64748b; margin: 4px 0 0 0; font-weight: 500;">Surat Administrasi Desa {{ $pengaturan->nama_desa ?? 'Jangglengan' }}</p>
    </div>

    <!-- 4 Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px;">
        
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px;">
                <i class="ti ti-users" style="font-size: 28px; color: #475569;"></i>
            </div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 4px;">Warga Terdaftar</div>
                <div style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1;">{{ number_format($totalPenduduk, 0, ',', '.') }}</div>
                <div style="font-size: 13px; color: #64748b;">{{ number_format($totalLaki, 0, ',', '.') }} L | {{ number_format($totalPerempuan, 0, ',', '.') }} P</div>
            </div>
        </div>

        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px;">
                <i class="ti ti-file-description" style="font-size: 28px; color: #475569;"></i>
            </div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 4px;">Surat Dicetak</div>
                <div style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1;">{{ number_format($suratHariIni, 0, ',', '.') }}</div>
                <div style="font-size: 13px; color: #64748b;">Hari ini</div>
            </div>
        </div>

        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px;">
                <i class="ti ti-printer" style="font-size: 28px; color: #475569;"></i>
            </div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 4px;">Total Surat</div>
                <div style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1;">{{ number_format($totalSurat, 0, ',', '.') }}</div>
                <div style="font-size: 13px; color: #64748b;">Keseluruhan tercetak</div>
            </div>
        </div>

        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; align-items: flex-start; gap: 16px;">
            <div style="background: #f1f5f9; padding: 12px; border-radius: 8px;">
                <i class="ti ti-file-text" style="font-size: 28px; color: #475569;"></i>
            </div>
            <div>
                <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 4px;">Total Templat</div>
                <div style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 4px; line-height: 1;">{{ number_format($totalTemplate, 0, ',', '.') }}</div>
                <div style="font-size: 13px; color: #64748b;">Templat aktif</div>
            </div>
        </div>

    </div>

    <!-- 2 Buttons -->
    <div style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
        <a href="{{ route('surat.index') }}" style="flex: 1; text-align: center; background: #0d6efd; color: white; padding: 14px 24px; border-radius: 30px; font-weight: 600; font-size: 16px; text-decoration: none; min-width: 200px; display: inline-block;">
            Buat Surat Baru
        </a>
        <a href="{{ route('penduduk.index') }}" style="flex: 1; text-align: center; background: white; color: #0d6efd; border: 2px solid #0d6efd; padding: 12px 24px; border-radius: 30px; font-weight: 600; font-size: 16px; text-decoration: none; min-width: 200px; display: inline-block;">
            Cek Data Penduduk
        </a>
    </div>

    <!-- Table -->
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px;">
        <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-top: 0; margin-bottom: 20px;">Aktivitas Terakhir Layanan Surat</h2>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 14px;">Jenis Surat</th>
                        <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 14px;">Warga</th>
                        <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 14px;">Tanggal</th>
                        <th style="padding: 12px 16px; font-weight: 600; color: #475569; font-size: 14px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatSurat as $surat)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px; font-size: 14px; color: #334155;">{{ ucwords(str_replace('_', ' ', $surat->jenis_surat)) }}</td>
                        <td style="padding: 16px; font-size: 14px; color: #334155;">{{ $surat->penduduk->nama ?? '-' }}</td>
                        <td style="padding: 16px; font-size: 14px; color: #334155;">{{ \Carbon\Carbon::parse($surat->tanggal_cetak)->format('d-m-Y H:i') }}</td>
                        <td style="padding: 16px;">
                            <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">Tercetak</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 24px; text-align: center; color: #94a3b8; font-size: 14px;">Belum ada aktivitas cetak surat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
