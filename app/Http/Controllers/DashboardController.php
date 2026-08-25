<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Surat;
use App\Models\TemplateSurat;
use App\Models\Pengaturan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();

        // 1. Warga Terdaftar
        $totalPenduduk = Penduduk::count();
        $totalLaki = Penduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Penduduk::where('jenis_kelamin', 'Perempuan')->count();

        // 2. Surat Dicetak Hari Ini
        $suratHariIni = Surat::whereDate('created_at', Carbon::today())->count();

        // 3. Total Surat Tercetak
        $totalSurat = Surat::count();

        // 4. Total Templat
        $totalTemplate = TemplateSurat::count();

        // 5. Riwayat Aktivitas Terakhir
        $riwayatSurat = Surat::with('penduduk')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'pengaturan',
            'totalPenduduk',
            'totalLaki',
            'totalPerempuan',
            'suratHariIni',
            'totalSurat',
            'totalTemplate',
            'riwayatSurat'
        ));
    }
}
