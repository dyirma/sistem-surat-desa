<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $fillable = [
        'nama_kabupaten',
        'nama_kecamatan',
        'nama_desa',
        'kode_pos',
        'alamat_desa',
        'kode_desa',
        'email_desa',
        'website_desa',
        'jabatan_kades',
        'nama_kades',
        'nip_kades',
        'nama_sekdes',
        'nip_sekdes',
        'nama_kaur_tu',
        'nip_kaur_tu',
        'nama_kasi_kesra',
        'nip_kasi_kesra',
        'nama_kasi_pemerintahan',
        'nip_kasi_pemerintahan',
        'penandatangan_aktif',
        'format_nomor_surat',
        'logo_path'
    ];
}
