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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required',
            'alamat_desa' => 'required',
            'jabatan_kades' => 'required',
            'nama_kades' => 'required',
            'nip_kades' => 'nullable',
            'nama_sekdes' => 'required',
            'nip_sekdes' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();
        $pengaturan->nama_desa = $validated['nama_desa'];
        $pengaturan->alamat_desa = $validated['alamat_desa'];
        $pengaturan->jabatan_kades = $validated['jabatan_kades'];
        $pengaturan->nama_kades = $validated['nama_kades'];
        $pengaturan->nip_kades = $validated['nip_kades'];
        $pengaturan->nama_sekdes = $validated['nama_sekdes'];
        $pengaturan->nip_sekdes = $validated['nip_sekdes'];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logos');
            $pengaturan->logo_path = str_replace('public/', 'storage/', $path);
        }

        $pengaturan->save();
        return redirect()->back()->with('success', 'Pengaturan Profil Desa berhasil disimpan.');
    }
}
