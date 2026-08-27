<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function updateProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_kabupaten' => 'nullable',
            'nama_kecamatan' => 'nullable',
            'nama_desa' => 'required',
            'kode_pos' => 'nullable',
            'alamat_desa' => 'required',
            'kode_desa' => 'nullable',
            'email_desa' => 'nullable|email',
            'website_desa' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        $pengaturan->nama_kabupaten = $validated['nama_kabupaten'] ?? null;
        $pengaturan->nama_kecamatan = $validated['nama_kecamatan'] ?? null;
        $pengaturan->nama_desa = $validated['nama_desa'];
        $pengaturan->kode_pos = $validated['kode_pos'] ?? null;
        $pengaturan->alamat_desa = $validated['alamat_desa'];
        $pengaturan->kode_desa = $validated['kode_desa'] ?? null;
        $pengaturan->email_desa = $validated['email_desa'] ?? null;
        $pengaturan->website_desa = $validated['website_desa'] ?? null;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $pengaturan->logo_path = 'storage/' . $path;
        }

        $pengaturan->save();
        session()->flash('active_tab', 'tab-profil');
        return redirect()->back()->with('success', 'Profil Instansi & Kop Surat berhasil disimpan.');
    }

    public function updatePejabat(Request $request)
    {
        $validated = $request->validate([
            'jabatan_kades' => 'required',
            'nama_kades' => 'required',
            'nip_kades' => 'nullable',
            'nama_sekdes' => 'required',
            'nip_sekdes' => 'nullable',
            'nama_kaur_tu' => 'required',
            'nip_kaur_tu' => 'nullable',
            'nama_kasi_kesra' => 'required',
            'nip_kasi_kesra' => 'nullable',
            'nama_kasi_pemerintahan' => 'required',
            'nip_kasi_pemerintahan' => 'nullable',
            'penandatangan_aktif' => 'required|in:kades,sekdes,kaur_tu,kasi_kesra,kasi_pemerintahan',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        $pengaturan->jabatan_kades = $validated['jabatan_kades'];
        $pengaturan->nama_kades = $validated['nama_kades'];
        $pengaturan->nip_kades = $validated['nip_kades'];
        $pengaturan->nama_sekdes = $validated['nama_sekdes'];
        $pengaturan->nip_sekdes = $validated['nip_sekdes'];
        $pengaturan->nama_kaur_tu = $validated['nama_kaur_tu'];
        $pengaturan->nip_kaur_tu = $validated['nip_kaur_tu'];
        $pengaturan->nama_kasi_kesra = $validated['nama_kasi_kesra'];
        $pengaturan->nip_kasi_kesra = $validated['nip_kasi_kesra'];
        $pengaturan->nama_kasi_pemerintahan = $validated['nama_kasi_pemerintahan'];
        $pengaturan->nip_kasi_pemerintahan = $validated['nip_kasi_pemerintahan'];
        $pengaturan->penandatangan_aktif = $validated['penandatangan_aktif'];

        $pengaturan->save();
        session()->flash('active_tab', 'tab-pejabat');
        return redirect()->back()->with('success', 'Data Pejabat Penandatangan berhasil disimpan.');
    }

    public function updatePenomoran(Request $request)
    {
        $validated = $request->validate([
            'format_nomor_surat' => 'required',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        $pengaturan->format_nomor_surat = $validated['format_nomor_surat'];

        $pengaturan->save();
        session()->flash('active_tab', 'tab-nomor');
        return redirect()->back()->with('success', 'Format Sistem Penomoran berhasil disimpan.');
    }
}
