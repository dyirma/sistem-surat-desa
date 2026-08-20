<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = Surat::with('penduduk')->latest()->paginate(15);
        return view('riwayat.index', compact('riwayats'));
    }
}
