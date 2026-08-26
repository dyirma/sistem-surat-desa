@extends('layouts.app')
@section('title', 'Riwayat Aktivitas')
@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 class="page-title">Riwayat Cetak Surat</h1>
            <p class="page-subtitle">Log aktivitas pencetakan surat di sistem.</p>
        </div>
        <div>
            <a href="{{ route('riwayat.export') }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: white; color: #10b981; border: 1px solid #10b981; border-radius: 50px; text-decoration: none; font-weight: 500; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.background='#f0fdf4'" onmouseout="this.style.background='white'">
                <i class="ti ti-file-spreadsheet" style="font-size: 16px;"></i> Unduh Excel
            </a>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Waktu Cetak</th>
                    <th>Nomor Surat</th>
                    <th>Jenis Surat</th>
                    <th>Pemohon (NIK)</th>
                    <th>Keperluan</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayats as $r)
                <tr>
                    <td style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($r->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</td>
                    <td>{{ $r->nomor_surat }}</td>
                    <td><span class="badge">{{ strtoupper(str_replace('-', ' ', $r->jenis_surat)) }}</span></td>
                    <td>
                        <div>{{ $r->penduduk->nama ?? 'Tidak Diketahui' }}</div>
                        <div style="font-size: 13px; color: var(--text-muted);">{{ $r->penduduk->nik ?? '-' }}</div>
                    </td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $r->keperluan }}">{{ $r->keperluan ?: '-' }}</td>
                    <td style="text-align: center;">
                        <a href="{{ route('riwayat.reprint', $r->id) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; padding: 6px 14px; background: var(--primary-color); color: white; border-radius: 50px; text-decoration: none; font-size: 13px; font-weight: 500; white-space: nowrap; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                            <i class="ti ti-printer" style="font-size: 16px;"></i> Cetak Ulang
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-muted);">Belum ada riwayat pencetakan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $riwayats->links('pagination::bootstrap-4') }}
    </div>
@endsection
