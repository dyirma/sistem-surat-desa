@extends('layouts.app')
@section('title', 'Tambah Penduduk')

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
        font-size: 15px;
        transition: opacity 0.2s;
    }
    .btn-submit:hover { opacity: 0.9; }
</style>
@endsection

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-size: 24px; font-weight: 600; color: var(--text-color);">Tambah Data Penduduk</h1>
        <p class="text-muted">Masukkan data kependudukan warga baru secara lengkap.</p>
    </div>
    <a href="{{ route('penduduk.index') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 6px;">
        <i class="ti ti-arrow-left"></i> Kembali
    </a>
</div>

<div class="dashboard-card">
    @if ($errors->any())
        <div style="padding: 15px; background: #fee2e2; color: #b91c1c; border-radius: 6px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penduduk.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>No. Kartu Keluarga (KK)</label>
                <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk') }}" placeholder="16 digit angka KK">
            </div>
            <div class="form-group">
                <label>NIK <span style="color:red">*</span></label>
                <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required placeholder="16 digit angka NIK">
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap <span style="color:red">*</span></label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Nama sesuai KTP">
            </div>
            <div class="form-group">
                <label>Hubungan Keluarga</label>
                <input type="text" name="hub_kel" class="form-control" value="{{ old('hub_kel') }}" placeholder="Contoh: KEPALA KELUARGA, ISTRI, ANAK">
            </div>
            
            <div class="form-group">
                <label>Tempat Lahir <span style="color:red">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir <span style="color:red">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
            </div>
            <div class="form-group">
                <label>Usia</label>
                <input type="number" name="usia" id="usia" class="form-control" value="{{ old('usia') }}" placeholder="Otomatis terisi" readonly style="background-color: #f3f4f6; cursor: not-allowed;">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin <span style="color:red">*</span></label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Agama <span style="color:red">*</span></label>
                <select name="agama" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Pekerjaan <span style="color:red">*</span></label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" required>
            </div>
            <div class="form-group">
                <label>Status Perkawinan <span style="color:red">*</span></label>
                <select name="status_perkawinan" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 20px;">
            <div class="form-group">
                <label>Dukuh / Dusun</label>
                <input type="text" name="dukuh" class="form-control" value="{{ old('dukuh') }}" placeholder="Contoh: Sumber Makmur">
            </div>
            <div class="form-group">
                <label>RT</label>
                <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="Contoh: 01">
            </div>
            <div class="form-group">
                <label>RW</label>
                <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="Contoh: 02">
            </div>
        </div>

        <div class="form-group">
            <label>Alamat Lengkap <span style="color:red">*</span></label>
            <textarea name="alamat" class="form-control" rows="3" required placeholder="Jl, RT/RW, Dusun">{{ old('alamat') }}</textarea>
        </div>

        <hr style="border:0; border-top: 1px solid var(--border-color); margin: 30px 0;">
        
        <div style="text-align: right;">
            <button type="submit" class="btn-submit"><i class="ti ti-device-floppy"></i> Simpan Data Penduduk</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tglLahirInput = document.getElementById('tanggal_lahir');
        const usiaInput = document.getElementById('usia');

        tglLahirInput.addEventListener('change', function() {
            if (this.value) {
                const birthDate = new Date(this.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                usiaInput.value = age;
            } else {
                usiaInput.value = '';
            }
        });
    });
</script>
@endsection
