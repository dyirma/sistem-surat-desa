@extends('layouts.app')
@section('title', 'Buat Surat')

@section('styles')
<!-- Include Select2 CSS for searchable dropdown -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        border-radius: 20px;
        font-family: inherit;
        font-size: 15px;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
    }
    
    /* Select2 customizations to match our theme */
    .select2-container--default .select2-selection--single {
        height: 42px;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal;
        padding-left: 15px;
        font-size: 15px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    
    .btn-submit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 50px;
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
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 600; color: var(--text-color);">Buat Surat Keterangan</h1>
            <p class="text-muted">Jenis: <strong>{{ strtoupper(str_replace('-', ' ', $jenis)) }}</strong></p>
        </div>
        <a href="{{ route('surat.index') }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 6px;">
            <i class="ti ti-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="dashboard-card">
        <form action="{{ route('surat.print') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            
            <div class="form-group">
                <label>NIK / Nama Penduduk <span style="color: red;">*</span></label>
                <select name="penduduk_id" class="form-control select2" required>
                    <!-- Options will be loaded via AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label>Nomor Surat <span style="color: red;">*</span></label>
                <input type="text" name="nomor_surat" class="form-control" value="{{ $nomor_surat }}" required>
                <small class="text-muted" style="display: block; margin-top: 5px;">Nomor surat ini dibuat secara otomatis.</small>
            </div>

            <div class="form-group">
                <label>Keperluan</label>
                <textarea name="keperluan" class="form-control" rows="3" placeholder="Contoh: Melamar Pekerjaan, Pengurusan Beasiswa, dll"></textarea>
            </div>

            <div class="form-group">
                <label>Keterangan Tambahan</label>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Isi jika ada keterangan tambahan (Opsional)"></textarea>
            </div>
            
            <div style="display: flex; gap: 20px;">
                <div class="form-group" style="flex: 1;">
                    <label>Berlaku Dari</label>
                    <input type="date" name="berlaku_dari" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" class="form-control" value="{{ date('Y-m-d', strtotime('+1 month')) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Staf Pemerintah Desa (Penandatangan)</label>
                <select name="staf_id" class="form-control" required>
                    <option value="kades">{{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }} ({{ $pengaturan->nama_kades ?? 'Nama Kades' }})</option>
                    <option value="sekdes">An. {{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }} {{ $pengaturan->nama_desa ?? '' }} - Sekdes ({{ $pengaturan->nama_sekdes ?? 'Nama Sekdes' }})</option>
                </select>
            </div>

            <!-- Dynamic Fields Container -->
            <div id="dynamic-fields-container"></div>

            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 30px 0;">

            <div style="text-align: right;">
                <button type="submit" class="btn-submit" id="btn-cetak"><i class="ti ti-edit"></i> Review & Edit Surat</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<!-- jQuery is required for Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        var jenisSurat = '{{ strtolower(str_replace(' ', '-', $jenis)) }}';
        var dynamicContainer = $('#dynamic-fields-container');
        var html = '';

        if (jenisSurat === 'usaha') {
            html += '<div class="form-group">';
            html += '<label>Nama Usaha <span style="color: red;">*</span></label>';
            html += '<input type="text" name="data_tambahan[nama_usaha]" class="form-control" required>';
            html += '</div>';
            html += '<div class="form-group">';
            html += '<label>Bidang/Jenis Usaha <span style="color: red;">*</span></label>';
            html += '<input type="text" name="data_tambahan[bidang_usaha]" class="form-control" required>';
            html += '</div>';
        } else if (jenisSurat === 'tidak-mampu') {
            html += '<div class="form-group">';
            html += '<label>Tujuan Bantuan <span style="color: red;">*</span></label>';
            html += '<input type="text" name="data_tambahan[tujuan_bantuan]" class="form-control" placeholder="Contoh: Beasiswa Sekolah, Pengobatan, dll" required>';
            html += '</div>';
        } else if (jenisSurat === 'pengantar') {
            html += '<div class="form-group">';
            html += '<label>Tujuan Instansi/Pihak <span style="color: red;">*</span></label>';
            html += '<input type="text" name="data_tambahan[tujuan]" class="form-control" placeholder="Contoh: Ke Muhammad Berlian Aji, Citra Garden" required>';
            html += '</div>';
        }
        
        dynamicContainer.html(html);

        $('.select2').select2({
            width: '100%',
            placeholder: "-- Ketik minimal 3 huruf NIK/Nama --",
            allowClear: true,
            minimumInputLength: 3,
            ajax: {
                url: '{{ route("penduduk.searchAjax") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection
