<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $fillable = ['nama_desa', 'alamat_desa', 'jabatan_kades', 'nama_kades', 'nip_kades', 'nama_sekdes', 'nip_sekdes', 'logo_path'];
}
