@extends('layouts.app')

@section('title', 'Pengaturan Surat')

@section('styles')
<style>
    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #334155;
        font-size: 14px;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-family: inherit;
        font-size: 15px;
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(13, 138, 188, 0.1);
    }
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        background-color: #0b739e;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 138, 188, 0.2);
    }
    
    .tab-list {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 16px;
        flex-wrap: wrap;
    }
    .tab-button {
        padding: 12px 24px;
        background: transparent;
        border: 1px solid transparent;
        border-radius: 50px;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tab-button.active {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 4px 12px rgba(13, 138, 188, 0.25);
    }
    .tab-button:hover:not(.active) {
        background-color: #f1f5f9;
        color: #334155;
    }
    .tab-content {
        display: none;
        animation: fadeIn 0.4s ease forwards;
    }
    .tab-content.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .section-title {
        font-size: 18px; 
        margin-bottom: 20px; 
        color: #0f172a; 
        font-weight: 700;
    }
    .helper-text {
        font-size: 13px;
        color: #64748b;
        margin-top: 6px;
        display: block;
    }
    
    .radio-group {
        display: flex;
        gap: 24px;
        margin-top: 12px;
    }
    .radio-item {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 12px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: white;
        transition: all 0.2s;
    }
    .radio-item:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }
    .form-footer {
        text-align: right; 
        margin-top: 35px; 
        padding-top: 25px; 
        border-top: 1px solid #e2e8f0;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Pengaturan Sistem</h1>
        <p class="page-subtitle">Kelola profil desa, data pejabat, dan format penomoran surat.</p>
    </div>
</div>

<div class="dashboard-card" style="padding: 30px;">
    @if(session('success'))
        <div style="padding: 16px 20px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; font-weight: 500;">
            <i class="ti ti-circle-check" style="font-size: 20px;"></i> {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div style="padding: 16px 20px; background: #fee2e2; color: #b91c1c; border-radius: 8px; margin-bottom: 25px;">
            <div style="font-weight: 600; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                <i class="ti ti-alert-circle"></i> Terdapat kesalahan pengisian:
            </div>
            <ul style="margin: 0; padding-left: 28px; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Navigasi Tab -->
    <div class="tab-list">
        <button type="button" class="tab-button {{ session('active_tab', 'tab-profil') == 'tab-profil' ? 'active' : '' }}" onclick="openTab(event, 'tab-profil')">
            <i class="ti ti-building"></i> Profil & Kop Surat
        </button>
        <button type="button" class="tab-button {{ session('active_tab') == 'tab-pejabat' ? 'active' : '' }}" onclick="openTab(event, 'tab-pejabat')">
            <i class="ti ti-users"></i> Pejabat Berwenang
        </button>
        <button type="button" class="tab-button {{ session('active_tab') == 'tab-nomor' ? 'active' : '' }}" onclick="openTab(event, 'tab-nomor')">
            <i class="ti ti-hash"></i> Penomoran Surat
        </button>
    </div>

    <!-- TAB 1: Profil & Kop Surat -->
    <div id="tab-profil" class="tab-content {{ session('active_tab', 'tab-profil') == 'tab-profil' ? 'active' : '' }}">
        <form action="{{ route('pengaturan.update_profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3 class="section-title">Informasi Wilayah & Kantor</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label>Kabupaten</label>
                    <input type="text" name="nama_kabupaten" class="form-control" value="{{ old('nama_kabupaten', $pengaturan->nama_kabupaten ?? '') }}" placeholder="Contoh: Sukoharjo">
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" name="nama_kecamatan" class="form-control" value="{{ old('nama_kecamatan', $pengaturan->nama_kecamatan ?? '') }}" placeholder="Contoh: Nguter">
                </div>
                
                <div class="form-group">
                    <label>Nama Desa</label>
                    <input type="text" name="nama_desa" class="form-control" value="{{ old('nama_desa', $pengaturan->nama_desa ?? '') }}" placeholder="Contoh: Jangglengan">
                </div>
                <div class="form-group">
                    <label>Logo Desa</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @if(isset($pengaturan) && $pengaturan->logo_path)
                        <span class="helper-text">Logo telah terpasang. Unggah file baru untuk mengganti.</span>
                    @endif
                </div>
            </div>
            
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_desa" class="form-control" rows="2" placeholder="Contoh: Jl. Raya Jangglengan No. 1">{{ old('alamat_desa', $pengaturan->alamat_desa ?? '') }}</textarea>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $pengaturan->kode_pos ?? '') }}" placeholder="Contoh: 57571">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_desa" class="form-control" value="{{ old('email_desa', $pengaturan->email_desa ?? '') }}" placeholder="opsional@email.com">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website_desa" class="form-control" value="{{ old('website_desa', $pengaturan->website_desa ?? '') }}" placeholder="www.website.com">
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <i class="ti ti-device-floppy"></i> Simpan Profil
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 2: Pejabat Penandatangan -->
    <div id="tab-pejabat" class="tab-content {{ session('active_tab') == 'tab-pejabat' ? 'active' : '' }}">
        <form action="{{ route('pengaturan.update_pejabat') }}" method="POST">
            @csrf
            
            <div style="background: #f8fafc; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 30px;">
                <h3 class="section-title" style="margin-bottom: 8px;">Otoritas Penandatanganan</h3>
                <p style="font-size: 14px; color: #64748b; margin: 0;">Pilih pejabat yang saat ini berwenang menandatangani dokumen.</p>
                
                <div class="radio-group">
                    <label class="radio-item">
                        <input type="radio" name="penandatangan_aktif" value="kades" {{ old('penandatangan_aktif', $pengaturan->penandatangan_aktif ?? 'kades') == 'kades' ? 'checked' : '' }}>
                        <span style="font-weight: 500; color: #1e293b;">Kepala Desa</span>
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="penandatangan_aktif" value="sekdes" {{ old('penandatangan_aktif', $pengaturan->penandatangan_aktif ?? '') == 'sekdes' ? 'checked' : '' }}>
                        <span style="font-weight: 500; color: #1e293b;">Sekretaris Desa (A.n. Kepala Desa)</span>
                    </label>
                </div>
            </div>

            <h3 class="section-title">Data Pimpinan</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label>Status Jabatan Kepala Desa</label>
                    <select name="jabatan_kades" class="form-control">
                        <option value="Kepala Desa" {{ old('jabatan_kades', $pengaturan->jabatan_kades ?? '') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa (Definitif)</option>
                        <option value="PJ Kepala Desa" {{ old('jabatan_kades', $pengaturan->jabatan_kades ?? '') == 'PJ Kepala Desa' ? 'selected' : '' }}>PJ Kepala Desa (Pejabat Sementara)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Kepala Desa</label>
                    <input type="text" name="nama_kades" class="form-control" value="{{ old('nama_kades', $pengaturan->nama_kades ?? '') }}">
                </div>
                <div class="form-group">
                    <label>NIP Kepala Desa</label>
                    <input type="text" name="nip_kades" class="form-control" value="{{ old('nip_kades', $pengaturan->nip_kades ?? '') }}" placeholder="Boleh dikosongkan">
                </div>

                <div class="form-group">
                    <label>Nama Sekretaris Desa</label>
                    <input type="text" name="nama_sekdes" class="form-control" value="{{ old('nama_sekdes', $pengaturan->nama_sekdes ?? '') }}">
                </div>
                <div class="form-group">
                    <label>NIP Sekretaris Desa</label>
                    <input type="text" name="nip_sekdes" class="form-control" value="{{ old('nip_sekdes', $pengaturan->nip_sekdes ?? '') }}" placeholder="Boleh dikosongkan">
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <i class="ti ti-device-floppy"></i> Simpan Pejabat
                </button>
            </div>
        </form>
    </div>

    <!-- TAB 3: Sistem Penomoran -->
    <div id="tab-nomor" class="tab-content {{ session('active_tab') == 'tab-nomor' ? 'active' : '' }}">
        <form action="{{ route('pengaturan.update_penomoran') }}" method="POST">
            @csrf
            <h3 class="section-title">Format Penomoran</h3>
            
            <div class="form-group">
                <label>Struktur Nomor Surat</label>
                <input type="text" name="format_nomor_surat" class="form-control" value="{{ old('format_nomor_surat', $pengaturan->format_nomor_surat ?? '145/[NO_URUT]/[KODE_DESA]/[TAHUN]') }}" style="font-family: monospace; font-size: 16px; padding: 16px;">
                
                <div style="margin-top: 16px; padding: 16px 20px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <span style="font-size: 14px; font-weight: 600; color: #475569;">Gunakan variabel berikut (huruf kapital):</span>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 12px;">
                        <div style="font-size: 14px;"><code style="color: var(--primary-color); font-weight: 600;">[NO_URUT]</code> : Angka urut otomatis</div>
                        <div style="font-size: 14px;"><code style="color: var(--primary-color); font-weight: 600;">[TAHUN]</code> : Tahun berjalan</div>
                        <div style="font-size: 14px;"><code style="color: var(--primary-color); font-weight: 600;">[BULAN]</code> : Bulan (Romawi)</div>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">
                    <i class="ti ti-device-floppy"></i> Simpan Penomoran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openTab(evt, tabName) {
        var tabContents = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.remove("active");
        }
        
        var tabButtons = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove("active");
        }
        
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }
</script>
@endsection
