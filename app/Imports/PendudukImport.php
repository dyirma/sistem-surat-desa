<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendudukImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function batchSize(): int
    {
        return 250; // Insert ke database per 250 baris
    }

    public function chunkSize(): int
    {
        return 250; // Baca memori Excel per 250 baris agar tidak error
    }
    public function model(array $row)
    {
        // NO, NIK, NO_KK, NAMA, DUKUH, RW, RT, HUB_KEL, JENIS_KEL, AGAMA, PEKERJAAN, TEMP_LAHIR, TGL. LAHIR, USIA, STS KWN

        // Skip baris jika NIK kosong
        if (empty($row['nik'])) {
            return null;
        }

        // Mencegah error duplicate NIK dalam satu file Excel yang sama saat proses upload
        if (in_array($row['nik'], $this->importedNiks)) {
            return null; // Skip duplikat di dalam file yang sama
        }
        $this->importedNiks[] = $row['nik'];

        // Cek apakah NIK sudah ada (HAPUS fungsi ini agar Upsert bisa jalan untuk update data lama)
        // if (Penduduk::where('nik', $row['nik'])->exists()) {
        //     return null;
        // }

        // Konversi format tanggal excel ke format Y-m-d
        $tglLahir = $row['tgl_lahir'] ?? null;
        if (is_numeric($tglLahir)) {
            $tglLahir = Date::excelToDateTimeObject($tglLahir)->format('Y-m-d');
        } else if ($tglLahir) {
            $tglLahir = date('Y-m-d', strtotime(str_replace('/', '-', $tglLahir)));
        }

        return new Penduduk([
            'nik' => $row['nik'],
            'no_kk' => !empty($row['no_kk']) ? $row['no_kk'] : null,
            'nama' => !empty($row['nama']) ? $row['nama'] : '-',
            'dukuh' => !empty($row['dukuh']) ? $row['dukuh'] : null,
            'rw' => !empty($row['rw']) ? $row['rw'] : null,
            'rt' => !empty($row['rt']) ? $row['rt'] : null,
            'hub_kel' => !empty($row['hub_kel']) ? $row['hub_kel'] : null,
            'jenis_kelamin' => !empty($row['jenis_kel']) ? $row['jenis_kel'] : '-',
            'agama' => !empty($row['agama']) ? $row['agama'] : '-',
            'pekerjaan' => !empty($row['pekerjaan']) ? $row['pekerjaan'] : '-',
            'tempat_lahir' => !empty($row['temp_lahir']) ? $row['temp_lahir'] : '-',
            'tanggal_lahir' => $tglLahir ?? date('Y-m-d'),
            'usia' => !empty($row['usia']) ? $row['usia'] : null,
            'status_perkawinan' => !empty($row['sts_kwn']) ? $row['sts_kwn'] : '-',
            'alamat' => "Dukuh " . (!empty($row['dukuh']) ? $row['dukuh'] : '-') . ", RT " . (!empty($row['rt']) ? $row['rt'] : '-') . "/RW " . (!empty($row['rw']) ? $row['rw'] : '-'),
        ]);
    }
}
