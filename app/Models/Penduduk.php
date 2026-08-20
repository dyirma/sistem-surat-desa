<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'alamat',
        'status_perkawinan',
        'no_kk',
        'hub_kel',
        'usia',
        'dukuh',
        'rt',
        'rw',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
