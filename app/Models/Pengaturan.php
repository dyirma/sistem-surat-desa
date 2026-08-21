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
        'email_desa',
        'website_desa',
        'jabatan_kades',
        'nama_kades',
        'nip_kades',
        'nama_sekdes',
        'nip_sekdes',
        'penandatangan_aktif',
        'format_nomor_surat',
        'logo_path'
    ];
}
