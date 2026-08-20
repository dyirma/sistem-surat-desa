<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::latest()->paginate(10);
        return view('penduduk.index', compact('penduduks'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new PendudukImport, $request->file('file'));

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diimport dari Excel.');
    }

    public function truncate()
    {
        Penduduk::truncate();
        return redirect()->route('penduduk.index')->with('success', 'Seluruh data penduduk berhasil dikosongkan.');
    }

    public function searchAjax(Request $request)
    {
        $search = $request->input('q');

        if ($search == '') {
            $penduduks = Penduduk::limit(10)->get();
        } else {
            $penduduks = Penduduk::where('nama', 'like', '%' . $search . '%')
                                 ->orWhere('nik', 'like', '%' . $search . '%')
                                 ->limit(15)
                                 ->get();
        }

        $response = array();
        foreach ($penduduks as $penduduk) {
            $alamatText = trim(sprintf("Dukuh %s RT %s/RW %s", $penduduk->dukuh, $penduduk->rt, $penduduk->rw), " DukuhRT/RW");
            $alamatStr = $alamatText ? " - $alamatText" : "";
            $response[] = array(
                "id" => $penduduk->id,
                "text" => $penduduk->nama . " (NIK: " . $penduduk->nik . ")" . $alamatStr
            );
        }

        return response()->json($response);
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:penduduks',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'status_perkawinan' => 'required',
            'no_kk' => 'nullable',
            'hub_kel' => 'nullable',
            'usia' => 'nullable|integer',
            'dukuh' => 'nullable',
            'rt' => 'nullable',
            'rw' => 'nullable',
        ]);

        Penduduk::create($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:penduduks,nik,' . $penduduk->id,
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'status_perkawinan' => 'required',
            'no_kk' => 'nullable',
            'hub_kel' => 'nullable',
            'usia' => 'nullable|integer',
            'dukuh' => 'nullable',
            'rt' => 'nullable',
            'rw' => 'nullable',
        ]);

        $penduduk->update($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}
