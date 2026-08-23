<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateSurat;

class TemplateSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = TemplateSurat::all();
        return view('template-surat.index', compact('templates'));
    }

    public function create()
    {
        return view('template-surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|unique:template_surats,jenis_surat|regex:/^[a-z0-9-]+$/',
            'nama_template' => 'required',
            'deskripsi' => 'nullable',
            'konten' => 'required',
        ], [
            'jenis_surat.regex' => 'Jenis surat hanya boleh berisi huruf kecil, angka, dan tanda hubung (-).',
        ]);

        TemplateSurat::create($validated);
        return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $template = TemplateSurat::findOrFail($id);
        return view('template-surat.edit', compact('template'));
    }

    public function update(Request $request, string $id)
    {
        $template = TemplateSurat::findOrFail($id);
        
        $validated = $request->validate([
            'nama_template' => 'required',
            'deskripsi' => 'nullable',
            'konten' => 'required',
        ]);

        $template->update($validated);
        return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $template = TemplateSurat::findOrFail($id);
        $template->delete();
        return redirect()->route('template-surat.index')->with('success', 'Template surat berhasil dihapus.');
    }
}
