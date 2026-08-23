<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseTable = '
<table style="margin: 10px 0 10px 1cm; width: 90%; border-collapse: collapse;">
    <tr>
        <td style="width: 5%; padding: 4px 0; vertical-align: top;">1.</td>
        <td style="width: 35%; padding: 4px 0; vertical-align: top;">Nama Lengkap</td>
        <td style="width: 3%; padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;"><strong>[NAMA]</strong></td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">2.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tempat/Tanggal Lahir</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">3.</td>
        <td style="padding: 4px 0; vertical-align: top;">NIK</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[NIK]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">4.</td>
        <td style="padding: 4px 0; vertical-align: top;">Jenis Kelamin</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[JENIS_KELAMIN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">5.</td>
        <td style="padding: 4px 0; vertical-align: top;">Agama</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[AGAMA]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">6.</td>
        <td style="padding: 4px 0; vertical-align: top;">Pekerjaan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[PEKERJAAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">7.</td>
        <td style="padding: 4px 0; vertical-align: top;">Status Perkawinan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[STATUS_PERKAWINAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">8.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tempat Tinggal / Alamat</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[ALAMAT]</td>
    </tr>
</table>';

        $templates = [
            [
                'jenis_surat' => 'domisili',
                'nama_template' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Surat yang menyatakan kebenaran alamat tinggal seseorang di wilayah desa.',
                'konten' => '<p style="text-indent: 1cm; margin-bottom: 15px;">Yang bertanda tangan di bawah ini [JABATAN_KADES] [NAMA_DESA], Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>' . $baseTable . '<p style="text-indent: 1cm; margin-top: 15px;">Orang tersebut di atas adalah benar-benar penduduk/warga [NAMA_DESA] yang berdomisili di alamat tersebut. Surat keterangan ini dibuat untuk menyatakan domisili yang bersangkutan di desa kami.</p>[KEPERLUAN_BLOCK]<p style="text-indent: 1cm; margin-top: 15px; margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>'
            ],
            [
                'jenis_surat' => 'usaha',
                'nama_template' => 'Surat Keterangan Usaha',
                'deskripsi' => 'Surat untuk menerangkan bahwa sebuah usaha terdaftar dalam administratif desa.',
                'konten' => '<p style="text-indent: 1cm; margin-bottom: 15px;">Yang bertanda tangan di bawah ini [JABATAN_KADES] [NAMA_DESA], Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>' . $baseTable . '<p style="text-indent: 1cm; margin-top: 15px;">Orang tersebut di atas adalah benar-benar penduduk/warga [NAMA_DESA] yang berdomisili di alamat tersebut. Surat keterangan ini dibuat untuk menerangkan bahwa yang bersangkutan benar-benar memiliki usaha di wilayah desa kami.</p>[KEPERLUAN_BLOCK]<p style="text-indent: 1cm; margin-top: 15px; margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>'
            ],
            [
                'jenis_surat' => 'tidak-mampu',
                'nama_template' => 'Surat Ket. Tidak Mampu',
                'deskripsi' => 'Surat pengantar bagi warga kurang mampu untuk keperluan administrasi tertentu.',
                'konten' => '<p style="text-indent: 1cm; margin-bottom: 15px;">Yang bertanda tangan di bawah ini [JABATAN_KADES] [NAMA_DESA], Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>' . $baseTable . '<p style="text-indent: 1cm; margin-top: 15px;">Orang tersebut di atas adalah benar-benar penduduk/warga [NAMA_DESA] yang berdomisili di alamat tersebut. Surat keterangan ini dibuat untuk menerangkan bahwa yang bersangkutan tergolong keluarga kurang mampu (GAKIN).</p>[KEPERLUAN_BLOCK]<p style="text-indent: 1cm; margin-top: 15px; margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>'
            ],
            [
                'jenis_surat' => 'nikah',
                'nama_template' => 'Surat Pengantar Nikah',
                'deskripsi' => 'Surat pengantar untuk melengkapi persyaratan pernikahan warga.',
                'konten' => '<p style="text-indent: 1cm; margin-bottom: 15px;">Yang bertanda tangan di bawah ini [JABATAN_KADES] [NAMA_DESA], Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>' . $baseTable . '<p style="text-indent: 1cm; margin-top: 15px;">Orang tersebut di atas adalah benar-benar penduduk/warga [NAMA_DESA] yang berdomisili di alamat tersebut. Surat keterangan ini dibuat sebagai pengantar kelengkapan persyaratan administrasi pernikahan.</p>[KEPERLUAN_BLOCK]<p style="text-indent: 1cm; margin-top: 15px; margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>'
            ],
            [
                'jenis_surat' => 'pengantar',
                'nama_template' => 'Surat Keterangan Pengantar',
                'deskripsi' => 'Surat pengantar umum untuk berbagai keperluan warga.',
                'konten' => '<p style="text-indent: 1cm; margin-bottom: 15px;">Yang bertanda tangan di bawah ini [JABATAN_KADES] [NAMA_DESA], Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>' . $baseTable . '<p style="text-indent: 1cm; margin-top: 15px;">Orang tersebut di atas adalah benar-benar penduduk/warga [NAMA_DESA] yang berdomisili di alamat tersebut. [KETERANGAN_TAMBAHAN]</p>[KEPERLUAN_BLOCK]<p style="text-indent: 1cm; margin-top: 15px; margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>'
            ]
        ];

        foreach ($templates as $template) {
            \App\Models\TemplateSurat::updateOrCreate(
                ['jenis_surat' => $template['jenis_surat']],
                $template
            );
        }
    }
}
