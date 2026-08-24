@extends('layouts.app')
@section('title', 'Riwayat Aktivitas')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Riwayat Cetak Surat</h1>
            <p class="page-subtitle">Log aktivitas pencetakan surat di sistem.</p>
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
                </tr>
            </thead>
            <tbody>
                @forelse($riwayats as $r)
                <tr>
                    <td style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($r->created_at)->format('d M Y, H:i') }}</td>
                    <td>{{ $r->nomor_surat }}</td>
                    <td><span class="badge">{{ strtoupper(str_replace('-', ' ', $r->jenis_surat)) }}</span></td>
                    <td>
                        <div>{{ $r->penduduk->nama ?? 'Tidak Diketahui' }}</div>
                        <div style="font-size: 13px; color: var(--text-muted);">{{ $r->penduduk->nik ?? '-' }}</div>
                    </td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $r->keperluan }}">{{ $r->keperluan ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--text-muted);">Belum ada riwayat pencetakan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $riwayats->links('pagination::bootstrap-4') }}
    </div>
@endsection
