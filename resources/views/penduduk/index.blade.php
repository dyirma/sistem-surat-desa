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
            <form action="{{ route('penduduk.truncate') }}" method="POST" onsubmit="return confirm('PERINGATAN BAHAYA: Anda yakin ingin mengosongkan SELURUH data penduduk (menghapus ribuan data sekaligus)?')">
                @csrf
                <button type="submit" class="btn btn-danger" style="display: flex; align-items: center; gap: 5px;">
                    <i class="ti ti-trash"></i> Kosongkan Data
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
                            <form action="{{ route('penduduk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
