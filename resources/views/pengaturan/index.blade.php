@extends('layouts.app')

@section('title', 'Pengaturan Surat')

@section('styles')
<style>
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-color);
        font-size: 14px;
    }
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-family: inherit;
        font-size: 15px;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
    }
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        transition: opacity 0.2s;
    }
    .btn-submit:hover {
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Pengaturan Profil & Tanda Tangan</h1>
        <p class="page-subtitle">Atur detail kop surat desa dan nama pejabat yang berwenang menandatangani surat.</p>
    </div>
</div>

<div class="dashboard-card">
    @if(session('success'))
        <div style="padding: 15px; background: #dcfce7; color: #166534; border-radius: 6px; margin-bottom: 20px;">
            <i class="ti ti-check" style="margin-right: 5px;"></i> {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div style="padding: 15px; background: #fee2e2; color: #b91c1c; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 style="font-size: 18px; margin-bottom: 15px; color: var(--primary-color); border-bottom: 1px solid #eee; padding-bottom: 10px;">Profil Desa (Untuk Kop Surat)</h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Nama Desa <span style="color:red">*</span></label>
                <input type="text" name="nama_desa" class="form-control" value="{{ old('nama_desa', $pengaturan->nama_desa ?? '') }}" required placeholder="Contoh: Desa Jangglengan">
            </div>
            <div class="form-group">
                <label>Logo Desa (Opsional)</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
            </div>
        </div>
        
        <div class="form-group">
            <label>Alamat Lengkap Kantor Desa <span style="color:red">*</span></label>
            <textarea name="alamat_desa" class="form-control" rows="3" required placeholder="Contoh: Jl. Raya Jangglengan No. 1, Kec. Nguter, Kab. Sukoharjo">{{ old('alamat_desa', $pengaturan->alamat_desa ?? '') }}</textarea>
        </div>

        <h3 style="font-size: 18px; margin-top: 30px; margin-bottom: 15px; color: var(--primary-color); border-bottom: 1px solid #eee; padding-bottom: 10px;">Pejabat Penandatangan Surat</h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group" style="grid-column: span 2;">
                <label>Jabatan Pimpinan <span style="color:red">*</span></label>
                <select name="jabatan_kades" class="form-control" required>
                    <option value="Kepala Desa" {{ old('jabatan_kades', $pengaturan->jabatan_kades ?? '') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa (Definitif)</option>
                    <option value="PJ Kepala Desa" {{ old('jabatan_kades', $pengaturan->jabatan_kades ?? '') == 'PJ Kepala Desa' ? 'selected' : '' }}>PJ Kepala Desa (Pejabat Sementara)</option>
                </select>
                <small class="text-muted">Pilih "PJ" jika sedang dijabat oleh pejabat sementara.</small>
            </div>

            <div class="form-group">
                <label>Nama Pimpinan (Kades / PJ Kades) <span style="color:red">*</span></label>
                <input type="text" name="nama_kades" class="form-control" value="{{ old('nama_kades', $pengaturan->nama_kades ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>NIP Pimpinan (Opsional)</label>
                <input type="text" name="nip_kades" class="form-control" value="{{ old('nip_kades', $pengaturan->nip_kades ?? '') }}" placeholder="Kosongkan jika tidak ada">
            </div>

            <div class="form-group">
                <label>Nama Sekretaris Desa (Sekdes) <span style="color:red">*</span></label>
                <input type="text" name="nama_sekdes" class="form-control" value="{{ old('nama_sekdes', $pengaturan->nama_sekdes ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>NIP Sekdes (Opsional)</label>
                <input type="text" name="nip_sekdes" class="form-control" value="{{ old('nip_sekdes', $pengaturan->nip_sekdes ?? '') }}" placeholder="Kosongkan jika tidak ada">
            </div>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn-submit">
                <i class="ti ti-device-floppy"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
