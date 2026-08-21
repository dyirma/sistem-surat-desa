@extends('layouts.app')
@section('title', 'Review & Edit Surat')

@section('styles')
<!-- TinyMCE Open Source CDN (No API Key Required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .btn-submit {
        background-color: #3b82f6;
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
    
    /* Sembunyikan popup peringatan API Key dari TinyMCE */
    .tox-notifications-container {
        display: none !important;
    }
</style>
@endsection

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-size: 24px; font-weight: 600; color: var(--text-color);">Review & Edit Isi Surat</h1>
        <p class="text-muted">Kop Surat dan Tanda Tangan akan disematkan secara otomatis saat Anda mencetak.</p>
    </div>
    <a href="javascript:history.back()" style="color: var(--primary-color); text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 6px;">
        <i class="ti ti-arrow-left"></i> Kembali
    </a>
</div>

<div class="dashboard-card">
    <form action="{{ route('surat.printFinal') }}" method="POST" id="editorForm">
        @csrf
        <!-- Forwarding validated data via manual hidden fields -->

        <!-- Manual hidden fields to avoid issues with array handling if any -->
        <input type="hidden" name="penduduk_id" value="{{ $validated['penduduk_id'] }}">
        <input type="hidden" name="jenis" value="{{ $validated['jenis'] }}">
        <input type="hidden" name="keperluan" value="{{ $validated['keperluan'] ?? '' }}">
        <input type="hidden" name="nomor_surat" value="{{ $validated['nomor_surat'] }}">
        <input type="hidden" name="staf_id" value="{{ $validated['staf_id'] }}">

        <textarea id="editor" name="edited_content">
            {!! $processed_content !!}
        </textarea>

        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn-submit"><i class="ti ti-printer"></i> Simpan & Lanjutkan ke Cetak</button>
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
        plugins: 'lists link table code',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | table | bullist numlist | code',
        content_style: "body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; color: black; text-align: justify; }",
        branding: false,
        promotion: false
    });
</script>
@endsection
