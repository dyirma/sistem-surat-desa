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
        <td style="padding: 4px 0; vertical-align: top;">[NAMA]</td>
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
        <td style="padding: 4px 0; vertical-align: top;">Tempat Tinggal</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[ALAMAT]</td>
    </tr>
    [DATA_TAMBAHAN]
</table>';

        $tablePengantar = '
<table style="margin: 5px 0 5px 0; width: 100%; border-collapse: collapse;">
    <tr>
        <td style="width: 5%; padding: 4px 0; vertical-align: top;">1.</td>
        <td style="width: 35%; padding: 4px 0; vertical-align: top;">Nama</td>
        <td style="width: 3%; padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[NAMA]</td>
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
        <td style="padding: 4px 0; vertical-align: top;">Kewarganegaraan & Agama</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KEWARGANEGARAAN] & [AGAMA]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">5.</td>
        <td style="padding: 4px 0; vertical-align: top;">Pekerjaan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[PEKERJAAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">6.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tempat Tinggal</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[ALAMAT]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">7.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tujuan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[TUJUAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">8.</td>
        <td style="padding: 4px 0; vertical-align: top;">Keperluan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KEPERLUAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">9.</td>
        <td style="padding: 4px 0; vertical-align: top;">Berlaku mulai</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[MASA_BERLAKU]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">10.</td>
        <td style="padding: 4px 0; vertical-align: top;">Keterangan lain-lain*)</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KETERANGAN]</td>
    </tr>
</table>';

        $tableNikah = '
<table style="margin: 5px 0 5px 0; width: 100%; border-collapse: collapse;">
    <tr>
        <td style="width: 5%; padding: 4px 0; vertical-align: top;">1.</td>
        <td style="width: 35%; padding: 4px 0; vertical-align: top;">Nama</td>
        <td style="width: 3%; padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[NAMA]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">2.</td>
        <td style="padding: 4px 0; vertical-align: top;">NIK</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[NIK]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">3.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tempat & Tanggal Lahir</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">4.</td>
        <td style="padding: 4px 0; vertical-align: top;">Kewarganegaraan & Agama</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KEWARGANEGARAAN] & [AGAMA]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">5.</td>
        <td style="padding: 4px 0; vertical-align: top;">Pekerjaan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[PEKERJAAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">6.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tempat Tinggal</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[ALAMAT]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">7.</td>
        <td style="padding: 4px 0; vertical-align: top;">Surat Bukti diri</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">KTP dan KK</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">8.</td>
        <td style="padding: 4px 0; vertical-align: top;">Keperluan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KEPERLUAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">9.</td>
        <td style="padding: 4px 0; vertical-align: top;">Tujuan</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[TUJUAN]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">10.</td>
        <td style="padding: 4px 0; vertical-align: top;">Berlaku mulai</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[MASA_BERLAKU]</td>
    </tr>
    <tr>
        <td style="padding: 4px 0; vertical-align: top;">11.</td>
        <td style="padding: 4px 0; vertical-align: top;">Keterangan lain-lain*)</td>
        <td style="padding: 4px 0; vertical-align: top; text-align: center;">:</td>
        <td style="padding: 4px 0; vertical-align: top;">[KETERANGAN]</td>
    </tr>
</table>';

        $formN1 = '
<div class="page-break-separator" style="page-break-before: always;"></div>
<div style="font-size: 10pt; line-height: 1.2;">
    <div style="text-align: left; margin-bottom: 5px; font-size: 9pt;">
        Lampiran I<br>
        Keputusan Direktur Jenderal Bimbingan Masyarakat Islam Nomor 713 Tahun 2018<br>
        Tentang Penetapan Formulir dan Laporan Pencatatan Perkawinan atau Rujuk
    </div>
    
    <div style="text-align: center; font-weight: bold; font-size: 11pt; margin-bottom: 2px;">
        FORMULIR SURAT PENGANTAR PERKAWINAN
    </div>
    <div style="text-align: right; margin-bottom: 10px; font-weight: normal;">
        Model N1
    </div>
    
    <table style="width: 100%; margin-bottom: 5px; border-collapse: collapse;">
        <tr><td style="width: 30%; padding: 1px 0;">KANTOR DESA/KELURAHAN</td><td style="width: 3%; padding: 1px 0;">:</td><td style="padding: 1px 0;">[NAMA_DESA_UPPER]</td></tr>
        <tr><td style="padding: 1px 0;">KECAMATAN</td><td style="padding: 1px 0;">:</td><td style="padding: 1px 0;">[NAMA_KECAMATAN]</td></tr>
        <tr><td style="padding: 1px 0;">KABUPATEN/KOTA</td><td style="padding: 1px 0;">:</td><td style="padding: 1px 0;">[NAMA_KABUPATEN]</td></tr>
    </table>
    
    <div style="text-align: center; margin-bottom: 10px;">
        <div style="text-decoration: underline; margin: 0; font-size: 11pt; font-weight: bold;">SURAT PENGANTAR PERKAWINAN</div>
        <div style="margin: 0; font-size: 10pt;">Nomor : [NOMOR_SURAT]</div>
    </div>
    
    <p style="margin-bottom: 2px;">Yang bertanda tangan di bawah ini menjelaskan dengan sesungguhnya bahwa :</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2px;">
        <tr><td style="width: 5%; vertical-align: top; padding: 1px 0;">1.</td><td style="width: 35%; vertical-align: top; padding: 1px 0;">Nama</td><td style="width: 3%; vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NAMA]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">2.</td><td style="vertical-align: top; padding: 1px 0;">Nomor Induk Kependudukan (NIK)</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NIK]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">3.</td><td style="vertical-align: top; padding: 1px 0;">Jenis Kelamin</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[JENIS_KELAMIN]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">4.</td><td style="vertical-align: top; padding: 1px 0;">Tempat dan tanggal lahir</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">5.</td><td style="vertical-align: top; padding: 1px 0;">Kewarganegaraan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[KEWARGANEGARAAN]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">6.</td><td style="vertical-align: top; padding: 1px 0;">Agama</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[AGAMA]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">7.</td><td style="vertical-align: top; padding: 1px 0;">Pekerjaan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[PEKERJAAN]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">8.</td><td style="vertical-align: top; padding: 1px 0;">Alamat</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[ALAMAT]</td></tr>
        <tr>
            <td style="vertical-align: top; padding: 1px 0;">9.</td><td style="vertical-align: top; padding: 1px 0;" colspan="3">Status Perkawinan :</td>
        </tr>
        <tr>
            <td></td><td style="vertical-align: top; padding: 1px 0;">a. Laki-laki : Jejaka, Duda<br>&nbsp;&nbsp;&nbsp;&nbsp;Atau beristeri ke ……….</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td>
        </tr>
        <tr>
            <td></td><td style="vertical-align: top; padding: 1px 0;">b. Perempuan : Perawan, janda</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td>
        </tr>
        <tr>
            <td></td><td style="vertical-align: top; padding: 1px 0;">Nama isteri / suami terdahulu</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td>
        </tr>
    </table>
    
    <div style="margin-top: 5px; margin-bottom: 2px;">Adalah benar-benar anak dari perkawinan seorang pria :</div>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 2px;">
        <tr><td style="width: 40%; vertical-align: top; padding: 1px 0;">Nama Lengkap dan alias</td><td style="width: 3%; vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Nomor Induk Kependudukan (NIK)</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Tempat dan tanggal lahir</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Kewarganegaraan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Agama</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Pekerjaan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Alamat</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
    </table>
    
    <div style="margin-bottom: 2px;">dengan seorang wanita :</div>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px;">
        <tr><td style="width: 40%; vertical-align: top; padding: 1px 0;">Nama Lengkap dan alias</td><td style="width: 3%; vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Nomor Induk Kependudukan (NIK)</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Tempat dan tanggal lahir</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Kewarganegaraan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Agama</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Pekerjaan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">Alamat</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">...................................................</td></tr>
    </table>
    
    <div style="page-break-inside: avoid;">
        <p style="margin-bottom: 2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat pengantar ini dibuat dengan mengingat sumpah jabatan dan untuk dipergunakan sebagaimana mestinya.</p>
        <div class="ttd-injection" style="margin-top: 10px;"></div>
    </div>
</div>';

        $formBelumNikah = '
<div class="page-break-separator" style="page-break-before: always;"></div>
<div style="font-size: 11.5pt; line-height: 1.3;">
    <div style="text-align: center; margin-bottom: 20px;">
        <h3 style="text-decoration: underline; margin: 0; font-size: 13pt;">SURAT PERNYATAAN BELUM NIKAH</h3>
        <p style="margin: 0; font-size: 11.5pt; font-weight: bold;">No : [NOMOR_SURAT]</p>
    </div>
    
    <p style="margin-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini :</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
        <tr><td style="width: 30%; padding: 4px 0; vertical-align: top;">NIK</td><td style="width: 3%; padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">[NIK]</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Nama</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top; font-weight: bold;">[NAMA]</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Bin/Binti</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">...................................................</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Tempat /Tgl lahir</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Agama</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">[AGAMA]</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Pekerjaan</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">[PEKERJAAN]</td></tr>
        <tr><td style="padding: 4px 0; vertical-align: top;">Alamat</td><td style="padding: 4px 0; vertical-align: top;">:</td><td style="padding: 4px 0; vertical-align: top;">[ALAMAT]</td></tr>
    </table>
    
    <p style="text-indent: 1cm; margin-bottom: 10px; text-align: justify;">Menyatakan dengan sebenarnya bahwa saya sampai saat ini belum pernah menikah dengan siapapun, baik menurut peraturan agama maupun peraturan perundang undangan yang berlaku.</p>
    <p style="text-indent: 1cm; margin-bottom: 10px; text-align: justify;">Apabila di kemudian hari ternyata pernyataan saya ini tidak benar dan atau palsu maka saya bersedia dituntut sesuai dengan Peraturan Perundang Undangan yang berlaku dengan tidak melibatkan aparat Pemerintah yang menangani pernikahan saya ini.</p>
    
    <div style="page-break-inside: avoid;">
        <p style="text-indent: 1cm; margin-bottom: 30px; text-align: justify;">Demikian Surat Pernyataan ini saya buat dengan penuh kesadaran dan tanpa paksaan dari pihak manapun dan akan saya pergunakan sebagai mana mestinya.</p>
        
        <table style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 20px;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;">[NAMA_DESA], [TANGGAL_SURAT]</td>
            </tr>
            <tr>
                <td style="width: 50%;">Mengetahui</td>
                <td style="width: 50%;">Yang membuat Pernyataan</td>
            </tr>
            <tr>
                <td style="width: 50%;">[JABATAN_KADES] [NAMA_DESA]</td>
                <td style="width: 50%;"></td>
            </tr>
            <tr>
                <td style="height: 80px;"></td>
                <td style="height: 80px;"></td>
            </tr>
            <tr>
                <td><b>[NAMA_KADES]</b></td>
                <td><b>[NAMA]</b></td>
            </tr>
            <tr>
                <td>NIP. [NIP_KADES]</td>
                <td></td>
            </tr>
        </table>
    </div>
</div>';

        $formN3 = '
<div class="page-break-separator" style="page-break-before: always;"></div>
<div style="font-size: 10pt; line-height: 1.2;">
    <div style="text-align: left; margin-bottom: 5px; font-size: 9pt;">
        Lampiran III<br>
        Keputusan Direktur Jenderal Bimbingan Masyarakat Islam Nomor 713 Tahun 2018<br>
        Tentang Penetapan Formulir dan Laporan Pencatatan Perkawinan atau Rujuk
    </div>
    
    <div style="text-align: center; font-weight: bold; font-size: 11pt; margin-bottom: 2px;">
        FORMULIR SURAT PERSETUJUAN MEMPELAI
    </div>
    <div style="text-align: right; margin-bottom: 15px; font-weight: normal;">
        Model N3
    </div>
    
    <div style="text-align: center; margin-bottom: 10px;">
        <h3 style="text-decoration: underline; margin: 0; font-size: 12pt;">SURAT PERSETUJUAN MEMPELAI</h3>
    </div>
    
    <p style="margin-bottom: 5px;">Yang bertanda tangan di bawah ini :</p>
    
    <div style="font-weight: bold; margin-bottom: 2px;">A. Calon suami :</div>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <tr><td style="width: 5%; vertical-align: top; padding: 1px 0;">1.</td><td style="width: 35%; vertical-align: top; padding: 1px 0;">Nama lengkap dan alias</td><td style="width: 3%; vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NAMA_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">2.</td><td style="vertical-align: top; padding: 1px 0;">Bin</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[BIN_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">3.</td><td style="vertical-align: top; padding: 1px 0;">Nomor Induk Kependudukan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NIK_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">4.</td><td style="vertical-align: top; padding: 1px 0;">Tempat dan tanggal lahir</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[TTL_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">5.</td><td style="vertical-align: top; padding: 1px 0;">Kewarganegaraan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[WARGA_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">6.</td><td style="vertical-align: top; padding: 1px 0;">Agama</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[AGAMA_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">7.</td><td style="vertical-align: top; padding: 1px 0;">Status</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[STATUS_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">8.</td><td style="vertical-align: top; padding: 1px 0;">Pekerjaan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[PEKERJAAN_SUAMI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">9.</td><td style="vertical-align: top; padding: 1px 0;">Alamat</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[ALAMAT_SUAMI]</td></tr>
    </table>
    
    <div style="font-weight: bold; margin-bottom: 2px;">B. Calon isteri :</div>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <tr><td style="width: 5%; vertical-align: top; padding: 1px 0;">1.</td><td style="width: 35%; vertical-align: top; padding: 1px 0;">Nama lengkap dan alias</td><td style="width: 3%; vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NAMA_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">2.</td><td style="vertical-align: top; padding: 1px 0;">Binti</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[BINTI_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">3.</td><td style="vertical-align: top; padding: 1px 0;">Nomor Induk Kependudukan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[NIK_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">4.</td><td style="vertical-align: top; padding: 1px 0;">Tempat dan Tanggal Lahir</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[TTL_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">5.</td><td style="vertical-align: top; padding: 1px 0;">Kewarganegaraan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[WARGA_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">6.</td><td style="vertical-align: top; padding: 1px 0;">Agama</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[AGAMA_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">7.</td><td style="vertical-align: top; padding: 1px 0;">Status</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[STATUS_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">8.</td><td style="vertical-align: top; padding: 1px 0;">Pekerjaan</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[PEKERJAAN_ISTRI]</td></tr>
        <tr><td style="vertical-align: top; padding: 1px 0;">9.</td><td style="vertical-align: top; padding: 1px 0;">Alamat</td><td style="vertical-align: top; padding: 1px 0;">:</td><td style="vertical-align: top; padding: 1px 0;">[ALAMAT_ISTRI]</td></tr>
    </table>
    
    <p style="margin-bottom: 10px; text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menyatakan dengan sesungguhnya bahwa atas dasar sukarela, dengan kesadaran sendiri, tanpa ada paksaan dari siapapun juga, setuju untuk melangsungkan perkawinan.</p>
    <div style="page-break-inside: avoid;">
        <p style="margin-bottom: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat persetujuan ini dibuat untuk digunakan seperlunya.</p>
        
        <table style="width: 100%; border-collapse: collapse; text-align: center; margin-top: 20px;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;">[NAMA_DESA], [TANGGAL_SURAT]</td>
            </tr>
            <tr>
                <td style="width: 50%;">Calon Suami</td>
                <td style="width: 50%;">Calon Isteri</td>
            </tr>
            <tr>
                <td style="height: 80px;"></td>
                <td style="height: 80px;"></td>
            </tr>
            <tr>
                <td>[NAMA_SUAMI]</td>
                <td>[NAMA_ISTRI]</td>
            </tr>
        </table>
    </div>
</div>';

        $templates = [
            [
                'jenis_surat' => 'nikah',
                'nama_template' => 'Surat Pengantar Nikah',
                'deskripsi' => 'Surat pengantar untuk melengkapi persyaratan pernikahan warga.',
                'konten' => '<p style="margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan di bawah ini menerangkan bahwa:</p>' . $tableNikah . '<div style="page-break-inside: avoid;"><p style="margin-top: 5px; margin-bottom: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian untuk menjadikan maklum bagi yang berkepentingan.</p><div class="ttd-injection" style="margin-top: 20px;"></div></div>' . $formN1 . $formBelumNikah . $formN3
            ],
            [
                'jenis_surat' => 'pengantar',
                'nama_template' => 'Surat Keterangan Pengantar',
                'deskripsi' => 'Surat pengantar serbaguna untuk berbagai keperluan warga (Domisili, Usaha, Pengiriman, dll).',
                'konten' => '<p style="margin-bottom: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>' . $tablePengantar . '<p style="margin-top: 5px; margin-bottom: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat keterangan ini dibuat dan digunakan sebagaimana mestinya.</p><table style="width: 100%; margin-left: 2cm;"><tr><td style="width: 15%;">Nomor</td><td>: .......................................</td></tr><tr><td>Tanggal</td><td>: .......................................</td></tr></table>'
            ]
        ];

        // Hapus template lama yang tidak ada di daftar $templates agar database semua developer sinkron
        $jenis_surat_list = array_column($templates, 'jenis_surat');
        \App\Models\TemplateSurat::whereNotIn('jenis_surat', $jenis_surat_list)->delete();

        foreach ($templates as $template) {
            \App\Models\TemplateSurat::updateOrCreate(
                ['jenis_surat' => $template['jenis_surat']],
                $template
            );
        }
    }
}
