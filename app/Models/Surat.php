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
        'data_tambahan',
        'tanggal_cetak',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
