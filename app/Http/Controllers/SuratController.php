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

        return view('surat.print', compact('surat', 'validated', 'pengaturan'));
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
