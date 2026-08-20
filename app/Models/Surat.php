<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'penduduk_id',
        'jenis_surat',
        'keperluan',
        'tanggal_cetak',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
