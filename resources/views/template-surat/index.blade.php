@extends('layouts.app')
@section('title', 'Template Surat')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
        <h1 class="page-title">Master Template Surat</h1>
        <p class="page-subtitle">Kelola format dasar untuk berbagai jenis layanan surat</p>
    </div>
    <a href="{{ route('template-surat.create') }}" class="btn" style="background-color: var(--primary-color); color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px;">
        <i class="ti ti-plus"></i> Tambah Template Baru
    </a>
</div>

@if(session('success'))
    <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
        <i class="ti ti-check" style="margin-right: 5px;"></i> {{ session('success') }}
    </div>
@endif

<div class="dashboard-card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background-color: #f8fafc; border-bottom: 1px solid var(--border-color);">
            <tr>
                <th style="padding: 15px 20px; color: var(--text-color); font-weight: 600; font-size: 14px;">Jenis Surat</th>
                <th style="padding: 15px 20px; color: var(--text-color); font-weight: 600; font-size: 14px;">Nama Template</th>
                <th style="padding: 15px 20px; color: var(--text-color); font-weight: 600; font-size: 14px;">Deskripsi Singkat</th>
                <th style="padding: 15px 20px; color: var(--text-color); font-weight: 600; font-size: 14px; width: 150px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($templates as $item)
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 15px 20px; font-size: 14px;"><code>{{ $item->jenis_surat }}</code></td>
                <td style="padding: 15px 20px; font-size: 14px; font-weight: 500;">{{ $item->nama_template }}</td>
                <td style="padding: 15px 20px; font-size: 14px; color: #64748b;">{{ $item->deskripsi ?? '-' }}</td>
                <td style="padding: 15px 20px; text-align: center;">
                    <div style="display: flex; gap: 8px; justify-content: center;">
                        <a href="{{ route('template-surat.edit', $item->id) }}" style="color: #3b82f6; text-decoration: none; padding: 6px; border-radius: 4px; background: #eff6ff;" title="Edit Template">
                            <i class="ti ti-edit" style="font-size: 18px;"></i>
                        </a>
                        <form action="{{ route('template-surat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus template ini? Ini juga akan menghapus opsi surat di menu utama.');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: #ef4444; border: none; background: #fef2f2; padding: 6px; border-radius: 4px; cursor: pointer;" title="Hapus Template">
                                <i class="ti ti-trash" style="font-size: 18px;"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @if($templates->isEmpty())
            <tr>
                <td colspan="4" style="padding: 30px; text-align: center; color: #64748b;">Belum ada template surat.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
