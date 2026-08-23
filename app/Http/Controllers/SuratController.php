<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\Pengaturan;

class SuratController extends Controller
{
    public function create(Request $request)
    {
        $jenis = $request->query('jenis', 'domisili');
        
        // Auto generate number (format: 470 / ID / DESA / YEAR)
        $lastSurat = Surat::whereYear('created_at', date('Y'))->orderBy('id', 'desc')->first();
        $nextId = $lastSurat ? $lastSurat->id + 1 : 1;
        $nomor_surat = "470 / " . sprintf('%03d', $nextId) . " / DESA / " . date('Y');

        $pengaturan = Pengaturan::first();

        return view('surat.create', compact('jenis', 'nomor_surat', 'pengaturan'));
    }

    public function preview(Request $request)
    {
        $penduduk_id = $request->input('penduduk_id');
        $jenis = $request->input('jenis');
        
        $penduduk = Penduduk::findOrFail($penduduk_id);
        
        return view('surat.preview', compact('penduduk', 'jenis'));
    }

    public function print(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis' => 'required',
            'keperluan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'nomor_surat' => 'required|string',
            'staf_id' => 'required|string',
        ]);

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);

        // Merge penduduk data into validated array to match the print view's expected format
        $validated['nama'] = $penduduk->nama;
        $validated['tempat_lahir'] = $penduduk->tempat_lahir;
        $validated['tanggal_lahir'] = $penduduk->tanggal_lahir;
        $validated['jenis_kelamin'] = $penduduk->jenis_kelamin;
        $validated['agama'] = $penduduk->agama;
        $validated['pekerjaan'] = $penduduk->pekerjaan;
        $validated['alamat'] = $penduduk->alamat;
        $validated['status_perkawinan'] = $penduduk->status_perkawinan;
        $validated['nik'] = $penduduk->nik;

        // Gunakan nomor surat dari form
        $nomor_surat = $validated['nomor_surat'];

        // Jangan simpan ke DB dulu, hanya passing ke view
        $surat = new Surat([
            'nomor_surat' => $nomor_surat,
            'penduduk_id' => $validated['penduduk_id'],
            'jenis_surat' => $validated['jenis'],
            'keperluan' => $validated['keperluan'],
            'tanggal_cetak' => now(),
        ]);

        $pengaturan = Pengaturan::first();

        // Ambil template dari database
        $template = \App\Models\TemplateSurat::where('jenis_surat', $validated['jenis'])->first();
        $processed_content = '';

        if ($template) {
            $processed_content = $template->konten;
            
            // Lakukan string replacement
            $replacements = [
                '[NAMA]' => strtoupper($validated['nama']),
                '[NIK]' => $validated['nik'],
                '[NO_KK]' => $penduduk->no_kk ?? '-',
                '[DUKUH]' => $penduduk->dukuh ?? '-',
                '[RW]' => $penduduk->rw ?? '-',
                '[RT]' => $penduduk->rt ?? '-',
                '[HUB_KEL]' => $penduduk->hub_kel ?? '-',
                '[JENIS_KEL]' => $validated['jenis_kelamin'],
                '[JENIS_KELAMIN]' => $validated['jenis_kelamin'],
                '[AGAMA]' => $validated['agama'],
                '[PEKERJAAN]' => $validated['pekerjaan'],
                '[TEMP_LAHIR]' => $validated['tempat_lahir'],
                '[TEMPAT_LAHIR]' => $validated['tempat_lahir'],
                '[TGL_LAHIR]' => \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('d-m-Y'),
                '[TANGGAL_LAHIR]' => \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('d-m-Y'),
                '[USIA]' => $penduduk->usia ?? '-',
                '[STS_KWN]' => $validated['status_perkawinan'],
                '[STATUS_PERKAWINAN]' => $validated['status_perkawinan'],
                '[KEWARGANEGARAAN]' => 'WNI',
                '[ALAMAT]' => $validated['alamat'],
                '[JABATAN_KADES]' => $pengaturan->jabatan_kades ?? 'Kepala Desa',
                '[NAMA_DESA]' => ucwords(strtolower(str_replace('DESA ', '', $pengaturan->nama_desa ?? 'Jangglengan'))),
                '[KETERANGAN_TAMBAHAN]' => !empty($validated['keterangan']) ? $validated['keterangan'] : '',
            ];

            // Keperluan Block
            $keperluanBlock = '';
            if(!empty($validated['keperluan'])) {
                $keperluanBlock = '<p style="text-indent: 1cm; margin-top: 10px;">Adapun surat keterangan ini diberikan untuk keperluan: <strong>' . $validated['keperluan'] . '</strong>.</p>';
            }
            $replacements['[KEPERLUAN_BLOCK]'] = $keperluanBlock;

            foreach ($replacements as $key => $val) {
                $processed_content = str_replace($key, $val, $processed_content);
            }
        } else {
            // Fallback content jika template tidak ada
            $processed_content = '<p>Template surat tidak ditemukan. Silakan tambahkan template untuk jenis surat ini di menu Template Surat.</p>';
        }

        return view('surat.editor', compact('surat', 'validated', 'pengaturan', 'processed_content'));
    }

    public function printFinal(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id' => 'required',
            'jenis' => 'required',
            'keperluan' => 'nullable',
            'nomor_surat' => 'required',
            'staf_id' => 'required',
            'edited_content' => 'required', // The raw HTML from TinyMCE
        ]);

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);
        
        $surat = new Surat([
            'nomor_surat' => $validated['nomor_surat'],
            'penduduk_id' => $validated['penduduk_id'],
            'jenis_surat' => $validated['jenis'],
            'keperluan' => $validated['keperluan'],
            'tanggal_cetak' => now(),
        ]);

        $pengaturan = Pengaturan::first();
        
        // Pass original values to be printed in header/footer, and edited_content for the body
        return view('surat.print', compact('surat', 'validated', 'pengaturan', 'penduduk'));
    }

    public function storeHistory(Request $request)
    {
        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'penduduk_id' => $request->penduduk_id,
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'tanggal_cetak' => now(),
        ]);
        return response()->json(['success' => true]);
    }
}
