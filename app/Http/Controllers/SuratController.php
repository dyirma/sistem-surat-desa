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
        $jenis = $request->jenis;
        if (!$jenis || !\App\Models\TemplateSurat::where('jenis_surat', $jenis)->exists()) {
            return redirect()->route('dashboard')->with('error', 'Jenis surat tidak ditemukan.');
        }

        $lastSurat = Surat::whereYear('created_at', date('Y'))->orderBy('id', 'desc')->first();
        $nextId = $lastSurat ? $lastSurat->id + 1 : 1;
        $noUrut = sprintf('%03d', $nextId);

        $pengaturan = Pengaturan::first();
        $format = $pengaturan->format_nomor_surat ?? '470/[NO_URUT]/[BULAN]/[TAHUN]';

        // Convert current month to Roman numeral
        $romawiBulan = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanSekarang = $romawiBulan[date('n') - 1];

        // Replace placeholders
        $nomor_surat = str_replace(
            ['[NO_URUT]', '[KODE_DESA]', '[BULAN]', '[TAHUN]'],
            [$noUrut, $pengaturan->kode_desa ?? 'DESA', $bulanSekarang, date('Y')],
            $format
        );

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
            'nomor_surat' => 'required|string',
            'staf_id' => 'required|string',
            'format_ttd' => 'required|in:1,2,3',
            'data_tambahan' => 'nullable|array',
            'berlaku_dari' => 'nullable|date',
            'berlaku_sampai' => 'nullable|date',
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

        // Logic for Masa Berlaku
        if (!empty($validated['berlaku_dari'])) {
            \Carbon\Carbon::setLocale('id');
            $dari = \Carbon\Carbon::parse($validated['berlaku_dari'])->translatedFormat('d F Y');
            $sampai = !empty($validated['berlaku_sampai']) ? \Carbon\Carbon::parse($validated['berlaku_sampai'])->translatedFormat('d F Y') : 'Selesai';

            // Masukkan ke array data_tambahan agar otomatis tercetak di tabel dinamis
            if (!isset($validated['data_tambahan'])) {
                $validated['data_tambahan'] = [];
            }
            $validated['data_tambahan']['masa_berlaku'] = $dari . ' s/d ' . $sampai;
        }

        // Map Jenis Kelamin
        $jk_map = ['L' => 'Laki-Laki', 'P' => 'Perempuan'];
        $jk_formatted = $jk_map[strtoupper($validated['jenis_kelamin'])] ?? $validated['jenis_kelamin'];

        // Map Status Perkawinan
        $kwn_map = ['B' => 'Belum Kawin', 'S' => 'Kawin', 'C' => 'Cerai Hidup', 'M' => 'Cerai Mati'];
        $kwn_formatted = $kwn_map[strtoupper($validated['status_perkawinan'])] ?? $validated['status_perkawinan'];

        // Build HTML for data_tambahan
        $htmlTambahan = '';
        if (isset($validated['data_tambahan']) && is_array($validated['data_tambahan'])) {
            $nomor = $validated['jenis'] === 'pengantar' ? 7 : 9; // Lanjutan numbering tabel (Pak Carik 1-6, Standard 1-8)
            foreach ($validated['data_tambahan'] as $k => $v) {
                $label = ucwords(str_replace('_', ' ', $k));
                // Jangan ALL CAPS untuk masa_berlaku agar tidak aneh
                $value = $k === 'masa_berlaku' ? $v : ucwords(strtolower($v));
                $htmlTambahan .= '<tr><td style="padding: 4px 0; vertical-align: top;">' . $nomor . '.</td><td style="padding: 4px 0; vertical-align: top;">' . $label . '</td><td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td><td style="padding: 4px 0; vertical-align: top;">' . $value . '</td></tr>';
                $nomor++;
            }
        }

        // Format Alamat Pintar
        $rawAlamat = $validated['alamat'] ?? '';
        $alamatClean = ucwords(strtolower($rawAlamat)); // Fix PUNTUKREJO -> Puntukrejo
        $alamatClean = str_ireplace(
            ['rt ', 'rw ', 'rt.', 'rw.', 'rt/', 'rt0', 'rt1', 'rt2', 'rt3', 'rt4', 'rt5', 'rt6', 'rt7', 'rt8', 'rt9'],
            ['RT ', 'RW ', 'RT.', 'RW.', 'RT/', 'RT 0', 'RT 1', 'RT 2', 'RT 3', 'RT 4', 'RT 5', 'RT 6', 'RT 7', 'RT 8', 'RT 9'],
            $alamatClean
        );

        // Jangan tambahkan RT/RW ganda jika admin sudah mengetiknya di database
        if (!preg_match('/RT/i', $rawAlamat) && !preg_match('/RW/i', $rawAlamat)) {
            $rtStr = sprintf('%02d', intval($penduduk->rt ?? 0));
            $rwStr = sprintf('%02d', intval($penduduk->rw ?? 0));
            $alamatClean .= ' RT ' . $rtStr . '/' . $rwStr;
        }

        $desaName = ucwords(strtolower(str_replace('DESA ', '', strtoupper($pengaturan->nama_desa ?? 'Jangglengan'))));
        $fullAlamat = $alamatClean . ' Ds ' . $desaName . ' Kec Nguter Kab Sukoharjo';

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
                '[JENIS_KEL]' => $jk_formatted,
                '[JENIS_KELAMIN]' => $jk_formatted,
                '[AGAMA]' => ucwords(strtolower($validated['agama'])),
                '[PEKERJAAN]' => ucwords(strtolower($validated['pekerjaan'])),
                '[TEMP_LAHIR]' => ucwords(strtolower($validated['tempat_lahir'])),
                '[TEMPAT_LAHIR]' => ucwords(strtolower($validated['tempat_lahir'])),
                '[TGL_LAHIR]' => \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('d-m-Y'),
                '[TANGGAL_LAHIR]' => \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('d-m-Y'),
                '[USIA]' => $penduduk->usia ?? '-',
                '[STS_KWN]' => $kwn_formatted,
                '[STATUS_PERKAWINAN]' => $kwn_formatted,
                '[KEWARGANEGARAAN]' => 'WNI',
                '[ALAMAT]' => $fullAlamat,
                '[JABATAN_KADES]' => $pengaturan->jabatan_kades ?? 'Kepala Desa',
                '[NAMA_DESA]' => ucwords(strtolower(str_replace('DESA ', '', $pengaturan->nama_desa ?? 'Jangglengan'))),
                '[KETERANGAN_TAMBAHAN]' => !empty($validated['keterangan']) ? $validated['keterangan'] : '',
                '[DATA_TAMBAHAN]' => $htmlTambahan,
            ];

            // Keperluan Block
            $keperluanBlock = '';
            if (!empty($validated['keperluan'])) {
                $keperluanBlock = '<p style="text-indent: 1cm; margin-top: 10px;">Adapun surat keterangan ini diberikan untuk keperluan: <strong>' . $validated['keperluan'] . '</strong>.</p>';
            }
            $replacements['[KEPERLUAN_BLOCK]'] = $keperluanBlock;

            foreach ($replacements as $key => $val) {
                $processed_content = str_replace($key, $val, $processed_content);
            }
        } else {
            // Fallback content jika template tidak ada
            $processed_content = '<p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>';
            $processed_content .= '<table style="margin: 10px 0 10px 1.5cm; width: calc(100% - 1.5cm); border-collapse: collapse;">';
            $processed_content .= '<tr><td style="width: 35%; padding: 4px 0; vertical-align: top;">Nama</td><td style="width: 5%; text-align: center; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">' . strtoupper($validated['nama']) . '</td></tr>';
            $processed_content .= '<tr><td style="padding: 4px 0; vertical-align: top;">NIK</td><td style="text-align: center; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">' . $validated['nik'] . '</td></tr>';
            $processed_content .= '<tr><td style="padding: 4px 0; vertical-align: top;">Tempat Tinggal</td><td style="text-align: center; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">' . $fullAlamat . '</td></tr>';
            $processed_content .= '</table>';

            if ($htmlTambahan != '') {
                $processed_content .= '<p style="margin-top: 15px;">Adapun data tambahan terkait keterangan ini adalah sebagai berikut:</p>';
                $processed_content .= $htmlTambahan;
            }

            if (!empty($validated['keperluan'])) {
                $processed_content .= '<p style="text-indent: 1cm; margin-top: 15px;">Adapun surat keterangan ini diberikan untuk keperluan: <strong>' . $validated['keperluan'] . '</strong>.</p>';
            }
            $processed_content .= '<p style="text-indent: 1cm; margin-top: 15px;">Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>';
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
            'format_ttd' => 'required|in:1,2,3',
            'edited_content' => 'required', // The raw HTML from TinyMCE
            'data_tambahan' => 'nullable|array',
        ]);

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);

        $surat = new Surat([
            'nomor_surat' => $validated['nomor_surat'],
            'penduduk_id' => $validated['penduduk_id'],
            'jenis_surat' => $validated['jenis'],
            'keperluan' => $validated['keperluan'],
            'tanggal_cetak' => now(),
        ]);

        // Temporarily store it so it can be picked up by the view
        if (isset($validated['data_tambahan'])) {
            $surat->data_tambahan = $validated['data_tambahan'];
        }

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
            'data_tambahan' => $request->data_tambahan, // This will be cast to JSON if Model is set
            'edited_content' => $request->edited_content,
            'tanggal_cetak' => now(),
        ]);
        return response()->json(['success' => true]);
    }
}
