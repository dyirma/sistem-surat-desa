@extends('layouts.app')
@section('title', 'Edit Template Surat')

@section('styles')
<!-- TinyMCE Open Source CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; }
    .form-control { width: 100%; padding: 10px 15px; border: 1px solid var(--border-color); border-radius: 20px; font-size: 15px; }
    .btn-submit { background-color: var(--primary-color); color: white; border: none; padding: 12px 24px; border-radius: 50px; font-weight: 600; cursor: pointer; }
    .btn-cancel { background-color: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 50px; font-weight: 600; text-decoration: none; margin-right: 10px; display: inline-block;}
    .tox-notifications-container { display: none !important; }
    
    .variable-card {
        background: #f8fafc; border: 1px solid var(--border-color); border-radius: 20px; padding: 15px; margin-bottom: 20px;
    }
    .variable-badge {
        display: inline-block; background: #e2e8f0; padding: 4px 8px; border-radius: 20px; font-family: monospace; font-size: 12px; margin: 0 4px 8px 0; cursor: pointer; color: #334155; border: 1px solid #cbd5e1;
    }
    .variable-badge:hover { background: #cbd5e1; }
</style>
@endsection

@section('content')
<div style="margin-bottom: 24px;">
    <h1 style="font-size: 24px; font-weight: 600; margin-bottom: 5px;">Edit Template: {{ $template->nama_template }}</h1>
    <p class="text-muted">Kode Jenis Surat: <strong>{{ $template->jenis_surat }}</strong></p>
</div>

@if ($errors->any())
    <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 20px; margin-bottom: 20px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="variable-card">
    <h4 style="margin-top: 0; margin-bottom: 10px; font-size: 14px; color: var(--text-color);">Daftar Variabel (Klik untuk menyalin)</h4>
    <p style="font-size: 13px; color: #64748b; margin-bottom: 15px;">Variabel di bawah ini akan otomatis diganti dengan data penduduk saat surat dibuat.</p>
    
    <div id="variable-list">
        <div style="margin-bottom: 5px;">
            <strong>Data Penduduk:</strong><br>
            <span class="variable-badge">[NIK]</span> 
            <span class="variable-badge">[NO_KK]</span> 
            <span class="variable-badge">[NAMA]</span> 
            <span class="variable-badge">[DUKUH]</span> 
            <span class="variable-badge">[RW]</span> 
            <span class="variable-badge">[RT]</span> 
            <span class="variable-badge">[HUB_KEL]</span> 
            <span class="variable-badge">[JENIS_KEL]</span> 
            <span class="variable-badge">[AGAMA]</span> 
            <span class="variable-badge">[PEKERJAAN]</span> 
            <span class="variable-badge">[TEMP_LAHIR]</span> 
            <span class="variable-badge">[TGL_LAHIR]</span> 
            <span class="variable-badge">[USIA]</span> 
            <span class="variable-badge">[STS_KWN]</span> 
            <span class="variable-badge">[KEWARGANEGARAAN]</span>
        </div>
        <div style="margin-bottom: 5px;">
            <strong>Data Surat & Desa:</strong><br>
            <span class="variable-badge">[ALAMAT]</span>
            <span class="variable-badge">[KEPERLUAN_BLOCK]</span> 
            <span class="variable-badge">[KETERANGAN_TAMBAHAN]</span>
            <span class="variable-badge">[JABATAN_KADES]</span> 
            <span class="variable-badge">[NAMA_DESA]</span>
        </div>
    </div>
</div>

<div class="dashboard-card">
    <form action="{{ route('template-surat.update', $template->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nama Template <span style="color: red;">*</span></label>
            <input type="text" name="nama_template" class="form-control" value="{{ old('nama_template', $template->nama_template) }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Singkat</label>
            <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi', $template->deskripsi) }}" placeholder="Penjelasan kegunaan surat ini untuk warga...">
        </div>

        <div class="form-group">
            <label>Konten Template Dasar (HTML) <span style="color: red;">*</span></label>
            <textarea id="editor" name="konten">{{ old('konten', $template->konten) }}</textarea>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <a href="{{ route('template-surat.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    tinymce.init({
        selector: '#editor',
        height: 600,
        menubar: false,
        plugins: 'lists link table code pagebreak',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | table | bullist numlist | pagebreak | code',
        content_style: `
            body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
            .page-break-separator {
                display: block !important;
                height: 30px !important;
                background-color: #f8fafc !important;
                border-top: 2px dashed #cbd5e1 !important;
                border-bottom: 2px dashed #cbd5e1 !important;
                margin: 40px 0 !important;
                position: relative !important;
                opacity: 1 !important;
            }
            .page-break-separator::after {
                content: '✂️ PEMBATAS HALAMAN (Akan dicetak di lembar baru)' !important;
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                color: #64748b !important;
                font-family: sans-serif !important;
                font-size: 12px !important;
                font-weight: bold !important;
            }
        `,
        branding: false,
        promotion: false
    });

    // Copy variable to clipboard
    document.querySelectorAll('.variable-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            const text = this.innerText;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = this.innerText;
                this.innerText = 'Disalin!';
                this.style.background = '#d1fae5';
                this.style.borderColor = '#34d399';
                setTimeout(() => {
                    this.innerText = originalText;
                    this.style.background = '#e2e8f0';
                    this.style.borderColor = '#cbd5e1';
                }, 1000);
            });
        });
    });
</script>
@endsection
