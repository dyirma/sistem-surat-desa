@extends('layouts.app')
@section('title', 'Data Penduduk')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Data Penduduk</h1>
            <p class="page-subtitle">Kelola data penduduk desa</p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data" id="importForm" style="display: flex; align-items: center; gap: 10px;">
                @csrf
                <div class="custom-file-upload">
                    <label for="file-upload" class="btn btn-secondary" style="margin: 0; cursor: pointer; display: flex; align-items: center; gap: 5px; background: white; border: 1px solid var(--border-color); color: var(--text-color);">
                        <i class="ti ti-file-spreadsheet"></i> <span id="file-name">Pilih File Excel</span>
                    </label>
                    <input id="file-upload" type="file" name="file" accept=".xlsx,.xls,.csv" required style="display: none;" onchange="updateFileName(this)">
                </div>
                <button type="submit" class="btn btn-primary" id="btn-import" style="display: none;">
                    <i class="ti ti-upload"></i> Mulai Import
                </button>
            </form>

            <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Penduduk
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 50px; margin-top: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin: 20px 0; display: flex; justify-content: flex-end;">
        <form action="{{ route('penduduk.index') }}" method="GET" style="display: flex; align-items: center; background: white; border: 1px solid var(--border-color); border-radius: 50px; padding: 8px 15px; width: 100%; max-width: 400px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.3s;" onfocusin="this.style.borderColor='var(--primary-color)'; this.style.boxShadow='0 0 0 3px rgba(var(--primary-color-rgb), 0.1)';" onfocusout="this.style.borderColor='var(--border-color)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.02)';">
            <i class="ti ti-search" style="color: var(--text-muted); font-size: 18px; margin-right: 10px;"></i>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berdasarkan nama atau NIK warga..." style="border: none; outline: none; width: 100%; font-family: inherit; font-size: 14px; background: transparent; color: var(--text-color);">
            @if(request('search'))
                <a href="{{ route('penduduk.index') }}" title="Hapus Pencarian" style="color: #ef4444; text-decoration: none; display: flex; align-items: center; margin-left: 10px; padding: 4px; border-radius: 50%; transition: background 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='transparent'">
                    <i class="ti ti-x" style="font-size: 16px;"></i>
                </a>
            @endif
            <button type="submit" style="display: none;"></button>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>L/P</th>
                    <th>Tgl Lahir</th>
                    <th>Pekerjaan</th>
                    <th style="width: 1%; white-space: nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penduduks as $p)
                <tr>
                    <td style="font-size: 15px;">{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ substr($p->jenis_kelamin, 0, 1) }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</td>
                    <td>{{ $p->pekerjaan }}</td>
                    <td style="white-space: nowrap;">
                        <div class="action-btns" style="justify-content: center;">
                            <a href="{{ route('penduduk.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('penduduk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('PERHATIAN: Apakah Anda yakin ingin menghapus data warga bernama {{ $p->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; padding: 6px; color: #9ca3af; cursor: pointer; border-radius: 4px; transition: all 0.2s; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#ef4444'; this.style.background='#fee2e2';" onmouseout="this.style.color='#9ca3af'; this.style.background='none';" title="Hapus Data Warga">
                                    <i class="ti ti-trash" style="font-size: 18px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-muted);">Belum ada data penduduk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $penduduks->links('pagination::bootstrap-4') }}
    </div>
@endsection

@section('scripts')
<script>
    function updateFileName(input) {
        const fileNameSpan = document.getElementById('file-name');
        const importBtn = document.getElementById('btn-import');
        
        if (input.files && input.files.length > 0) {
            fileNameSpan.textContent = input.files[0].name;
            importBtn.style.display = 'inline-flex';
            
            // Optional: change label color to indicate success
            input.parentElement.querySelector('label').style.borderColor = 'var(--primary-color)';
            input.parentElement.querySelector('label').style.color = 'var(--primary-color)';
        } else {
            fileNameSpan.textContent = 'Pilih File Excel';
            importBtn.style.display = 'none';
        }
    }
</script>
@endsection
