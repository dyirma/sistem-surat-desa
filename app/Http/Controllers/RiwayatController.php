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

    public function exportCsv()
    {
        $riwayats = Surat::with('penduduk')->latest()->get();
        
        $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta charset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Buku Agenda</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>';
        $html .= '<body>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11pt;">';
        
        // Header (Judul Buku Agenda)
        $html .= '<tr>';
        $html .= '<td colspan="6" style="text-align: center; font-size: 16pt; font-weight: bold; padding: 20px; border: none; background-color: #f8f9fa;">BUKU AGENDA SURAT KELUAR<br>DESA JANGGLENGAN</td>';
        $html .= '</tr>';
        $html .= '<tr><td colspan="6" style="border: none;"></td></tr>'; // Spacer

        // Table Header
        $html .= '<tr>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 120px; height: 30px;">Tanggal & Waktu</th>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 180px;">Nomor Surat</th>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 150px;">Jenis Surat</th>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 220px;">Nama Warga</th>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 160px;">NIK</th>';
        $html .= '<th style="background-color: #4CAF50; color: white; width: 300px;">Keperluan</th>';
        $html .= '</tr>';

        foreach ($riwayats as $r) {
            $html .= '<tr>';
            $html .= '<td style="vertical-align: top;">' . \Carbon\Carbon::parse($r->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') . '</td>';
            $html .= '<td style="vertical-align: top;">' . $r->nomor_surat . '</td>';
            $html .= '<td style="vertical-align: top;">' . strtoupper(str_replace('-', ' ', $r->jenis_surat)) . '</td>';
            $html .= '<td style="vertical-align: top;">' . ($r->penduduk ? $r->penduduk->nama : '-') . '</td>';
            $html .= '<td style="vertical-align: top; mso-number-format:\'\@\';">' . ($r->penduduk ? $r->penduduk->nik : '-') . '</td>';
            $html .= '<td style="vertical-align: top;">' . htmlspecialchars($r->keperluan ?? '-') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '</body></html>';

        $headers = [
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=Buku_Agenda_Surat_Keluar.xls",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        return response($html, 200, $headers);
    }

    public function reprint($id)
    {
        $surat = Surat::with('penduduk')->findOrFail($id);
        $penduduk = $surat->penduduk;
        $pengaturan = \App\Models\Pengaturan::first();
        
        // Buat dummy validated array agar view print bisa menggunakannya tanpa error
        $validated = [
            'nama' => $penduduk->nama ?? '-',
            'nik' => $penduduk->nik ?? '-',
            'tempat_lahir' => $penduduk->tempat_lahir ?? '-',
            'tanggal_lahir' => $penduduk->tanggal_lahir ?? date('Y-m-d'),
            'jenis_kelamin' => $penduduk->jenis_kelamin ?? 'L',
            'agama' => $penduduk->agama ?? '-',
            'pekerjaan' => $penduduk->pekerjaan ?? '-',
            'status_perkawinan' => $penduduk->status_perkawinan ?? 'B',
            'alamat' => $penduduk->alamat ?? '-',
            'keperluan' => $surat->keperluan,
            'edited_content' => $surat->edited_content,
        ];
        
        // Pass original values to be printed in header/footer, and edited_content for the body
        return view('surat.print', compact('surat', 'validated', 'pengaturan', 'penduduk'));
    }
}
