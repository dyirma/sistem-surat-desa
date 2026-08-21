<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendudukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // NO, NIK, NO_KK, NAMA, DUKUH, RW, RT, HUB_KEL, JENIS_KEL, AGAMA, PEKERJAAN, TEMP_LAHIR, TGL. LAHIR, USIA, STS KWN

        // Skip baris jika NIK kosong
        if (empty($row['nik'])) {
            return null;
        }

        // Cek apakah NIK sudah ada, jika ya lewati
        if (Penduduk::where('nik', $row['nik'])->exists()) {
            return null;
        }

        // Konversi format tanggal excel ke format Y-m-d
        $tglLahir = $row['tgl_lahir'] ?? null;
        if (is_numeric($tglLahir)) {
            $tglLahir = Date::excelToDateTimeObject($tglLahir)->format('Y-m-d');
        } else if ($tglLahir) {
            $tglLahir = date('Y-m-d', strtotime(str_replace('/', '-', $tglLahir)));
        }

        return new Penduduk([
            'nik' => $row['nik'],
            'no_kk' => $row['no_kk'] ?? null,
            'nama' => $row['nama'] ?? '-',
            'dukuh' => $row['dukuh'] ?? null,
            'rw' => $row['rw'] ?? null,
            'rt' => $row['rt'] ?? null,
            'hub_kel' => $row['hub_kel'] ?? null,
            'jenis_kelamin' => $row['jenis_kel'] ?? '-',
            'agama' => $row['agama'] ?? '-',
            'pekerjaan' => $row['pekerjaan'] ?? '-',
            'tempat_lahir' => $row['temp_lahir'] ?? '-',
            'tanggal_lahir' => $tglLahir ?? date('Y-m-d'),
            'usia' => $row['usia'] ?? null,
            'status_perkawinan' => $row['sts_kwn'] ?? '-',
            'alamat' => "Dukuh " . ($row['dukuh'] ?? '-') . ", RT " . ($row['rt'] ?? '-') . "/RW " . ($row['rw'] ?? '-'),
        ]);
    }
}
