<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat {{ str_replace('-', ' ', ucwords($surat->jenis_surat ?? '')) }} | SURAJA - Desa Jangglengan</title>
    @php
        $pengaturan = \App\Models\Pengaturan::first();
        $favicon = ($pengaturan && $pengaturan->logo_path) ? asset($pengaturan->logo_path) : asset('assets/img/default-logo.png');
    @endphp
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; color: black; margin: 0; padding: 0; background: #e5e7eb; }
        .page { background: white; width: 21cm; min-height: 29.7cm; padding: 2cm 2cm 2cm 2.5cm; margin: 20px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); box-sizing: border-box; position: relative; }
        
        .kop-surat { display: flex; align-items: center; justify-content: center; text-align: center; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 2px; position: relative; }
        .kop-surat::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 100%; border-bottom: 1px solid black; } /* Double line effect */
        .kop-surat h1 { font-size: 14pt; margin: 0; text-transform: uppercase; font-weight: normal; line-height: 1.1; }
        .kop-surat h2 { font-size: 18pt; margin: 2px 0; text-transform: uppercase; font-weight: bold; letter-spacing: 1px; line-height: 1.1; }
        .kop-surat p { font-size: 11pt; margin: 0; line-height: 1.2; }
        
        .judul-surat { text-align: center; margin: 10px 0 15px; }
        .judul-surat h3 { font-size: 14pt; text-decoration: underline; margin: 0; text-transform: uppercase; font-weight: bold; }
        .judul-surat p { font-size: 12pt; margin: 5px 0 0; }

        .isi-surat { text-align: justify; text-indent: 0; }
        .pembuka { text-indent: 1cm; margin-bottom: 15px; }
        
        .tabel-data { margin: 10px 0 10px 1.5cm; width: calc(100% - 1.5cm); border-collapse: collapse; }
        .tabel-data td { padding: 4px 0; vertical-align: top; }
        .tabel-data td:nth-child(1) { width: 35%; }
        .tabel-data td:nth-child(2) { width: 5%; text-align: center; }
        
        .penutup { text-indent: 1cm; margin-top: 15px; }

        .ttd-container { display: flex; justify-content: flex-end; margin-top: 50px; page-break-inside: avoid; }
        .ttd-box { text-align: center; width: 300px; }
        .ttd-box .tanggal { margin-bottom: 5px; }
        .ttd-box .jabatan { font-weight: bold; margin-bottom: 80px; }
        .ttd-box .nama { font-weight: bold; text-decoration: underline; margin: 0; }
        
        .btn-print { display: block; width: 21cm; margin: 20px auto; padding: 15px; background: #3b82f6; color: white; text-align: center; text-decoration: none; border-radius: 50px; font-family: sans-serif; font-weight: bold; cursor: pointer; border: none; font-size: 16px; }
        
        @media print {
            @page { size: A4; margin: 0; }
            body { background: white; margin: 0; padding: 0; line-height: 1.5; }
            .page { margin: 0; padding: 2cm 2cm 2cm 2.5cm; box-shadow: none; width: 21cm; height: 29.7cm; }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="cetakDanSimpan()">🖨️ Cetak Surat Sekarang</button>
    <div class="page">
        <!-- KOP SURAT DINAMIS -->
        @php
            $pengaturan = \App\Models\Pengaturan::first();
        @endphp
        <div class="kop-surat">
            @if($pengaturan && $pengaturan->logo_path)
                <img src="{{ asset($pengaturan->logo_path) }}" alt="Logo" style="width: 2.5cm; position: absolute; left: 0; top: -15px;">
            @endif
            <div style="flex: 1; padding-left: {{ ($pengaturan && $pengaturan->logo_path) ? '3cm' : '0' }};">
                <h1>PEMERINTAH KABUPATEN SUKOHARJO</h1>
                <h1>KECAMATAN NGUTER</h1>
                <h2>{{ strtoupper($pengaturan->nama_desa ?? 'DESA JANGGLENGAN') }}</h2>
                <p>{{ $pengaturan->alamat_desa ?? 'Jangglengan, Kec. Nguter, Kabupaten Sukoharjo, Jawa Tengah' }}@if($pengaturan && $pengaturan->kode_pos) Kode Pos: {{ $pengaturan->kode_pos }}@endif</p>
                @if(($pengaturan && $pengaturan->email_desa) || ($pengaturan && $pengaturan->website_desa))
                <p style="font-size: 10pt; margin-top: 2px;">
                    @if($pengaturan->website_desa) Website: {{ $pengaturan->website_desa }} @endif
                    @if($pengaturan->website_desa && $pengaturan->email_desa) | @endif
                    @if($pengaturan->email_desa) Email: {{ $pengaturan->email_desa }} @endif
                </p>
                @endif
            </div>
        </div>
        
        @if(isset($surat) && $surat->jenis_surat === 'pengantar')
            <div style="font-size: 11pt; margin-top: 8px; line-height: 1.2;">
                <div>No. Kode Desa/ Kelurahan</div>
                <div>33110520002</div>
            </div>
        @endif

        <div class="judul-surat">
            @php
                $judul = str_replace('-', ' ', $surat->jenis_surat);
                if($judul == 'domisili') $judul = 'Surat Keterangan Domisili';
                elseif($judul == 'usaha') $judul = 'Surat Keterangan Usaha';
                elseif($judul == 'tidak mampu') $judul = 'Surat Keterangan Tidak Mampu';
                elseif($judul == 'nikah') $judul = 'Surat Pengantar Nikah';
                elseif($judul == 'pengantar') $judul = 'Surat Pengantar';
                
                $words = explode(' ', strtoupper($judul));
                $firstWord = array_shift($words) ?? 'SURAT';
                $secondWord = array_shift($words) ?? '';
                $restWords = implode(' ', $words);
            @endphp
            
            <table style="margin: 0 auto; margin-bottom: 5px;">
                <tr>
                    <td rowspan="2" style="font-weight: bold; font-size: 14pt; padding-right: 15px; vertical-align: middle;">{{ $firstWord }}</td>
                    <td style="font-weight: bold; font-size: 14pt; text-align: center; border-bottom: 2px solid black; padding-bottom: 2px;">{{ $secondWord }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 14pt; text-align: center; padding-top: 2px;">{{ $restWords }}</td>
                </tr>
            </table>
            
            <table style="margin: 0 auto;">
                <tr>
                    <td style="width: 80px; text-align: left; font-size: 12pt;">Nomor</td>
                    <td style="text-align: left; font-size: 12pt;">: {{ $surat->nomor_surat }}</td>
                </tr>
            </table>
        </div>

        <div class="isi-surat">
            @if(isset($validated['edited_content']))
                {!! $validated['edited_content'] !!}
            @else
                <p class="pembuka">Yang bertanda tangan di bawah ini {{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }} {{ ucwords(strtolower(str_replace('DESA ', '', $pengaturan->nama_desa ?? 'Jangglengan'))) }}, Kecamatan Nguter, Kabupaten Sukoharjo, menerangkan dengan sebenarnya bahwa:</p>
                
                <table class="tabel-data">
                    <tr><td>Nama Lengkap</td><td>:</td><td><strong>{{ strtoupper($validated['nama']) }}</strong></td></tr>
                    <tr><td>NIK</td><td>:</td><td>{{ $validated['nik'] }}</td></tr>
                    <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $validated['tempat_lahir'] }}, {{ \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('d-m-Y') }}</td></tr>
                    <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $validated['jenis_kelamin'] }}</td></tr>
                    <tr><td>Agama</td><td>:</td><td>{{ $validated['agama'] }}</td></tr>
                    <tr><td>Pekerjaan</td><td>:</td><td>{{ $validated['pekerjaan'] }}</td></tr>
                    <tr><td>Status Perkawinan</td><td>:</td><td>{{ $validated['status_perkawinan'] }}</td></tr>
                    <tr><td>Alamat</td><td>:</td><td>{{ $validated['alamat'] }}</td></tr>
                </table>

                <p class="penutup">Orang tersebut di atas adalah benar-benar penduduk/warga {{ ucwords(strtolower($pengaturan->nama_desa ?? 'Desa Jangglengan')) }} yang berdomisili di alamat tersebut. 
                
                @if($surat->jenis_surat == 'domisili')
                    Surat keterangan ini dibuat untuk menyatakan domisili yang bersangkutan di desa kami.
                @elseif($surat->jenis_surat == 'usaha')
                    Surat keterangan ini dibuat untuk menerangkan bahwa yang bersangkutan benar-benar memiliki usaha di wilayah desa kami.
                @elseif($surat->jenis_surat == 'tidak-mampu')
                    Surat keterangan ini dibuat untuk menerangkan bahwa yang bersangkutan tergolong keluarga kurang mampu (GAKIN).
                @elseif($surat->jenis_surat == 'nikah')
                    Surat keterangan ini dibuat sebagai pengantar kelengkapan persyaratan administrasi pernikahan.
                @endif
                </p>

                @if(!empty($validated['keperluan']))
                <p style="text-indent: 1cm; margin-top: 10px;">Adapun surat keterangan ini diberikan untuk keperluan: <strong>{{ $validated['keperluan'] }}</strong>.</p>
                @endif

                <p class="penutup" style="margin-bottom: 30px;">Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>
            @endif
        </div>
        @if($surat->jenis_surat === 'pengantar')
            <!-- Tanda Tangan 3 Kolom Khusus Pengantar -->
            <div style="margin-top: 50px; text-align: right; width: 100%;">
                <table style="width: 100%; border-collapse: collapse; text-align: center; page-break-inside: avoid;">
                    <tr>
                        <td style="width: 33%;"></td>
                        <td style="width: 33%;"></td>
                        <td style="width: 34%; padding-bottom: 20px;">
                            {{ ucwords(strtolower(str_replace('DESA ', '', $pengaturan->nama_desa ?? 'Jangglengan'))) }}, {{ \Carbon\Carbon::parse($surat->tanggal_cetak)->format('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 33%;">Tanda Tangan Pemegang</td>
                        <td style="width: 33%;">
                            Mengetahui<br>
                            Camat Nguter
                        </td>
                        <td style="width: 34%;">
                            @if($validated['staf_id'] == 'sekdes')
                                an.Pj.Kepala Desa Jangglengan<br>
                                Sekretaris Desa
                            @else
                                {{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 80px;"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; text-decoration: underline; text-transform: uppercase;">{{ $validated['nama'] }}</td>
                        <td>....................................</td>
                        <td style="font-weight: bold; text-decoration: underline;">
                            @if($validated['staf_id'] == 'sekdes')
                                {{ strtoupper($pengaturan->nama_sekdes ?? 'NAMA SEKRETARIS DESA') }}
                            @else
                                {{ strtoupper($pengaturan->nama_kades ?? 'NAMA KEPALA DESA') }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        @else
            <!-- Tanda Tangan 1 Kolom Standar -->
            <div class="ttd-container">
                <div class="ttd-box">
                    <div class="tanggal">{{ ucwords(strtolower(str_replace('DESA ', '', $pengaturan->nama_desa ?? 'Desa Contoh'))) }}, {{ \Carbon\Carbon::parse($surat->tanggal_cetak)->format('d M Y') }}</div>
                    
                    @if($validated['staf_id'] == 'kades')
                        <div class="jabatan">{{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }}</div>
                        <p class="nama">{{ strtoupper($pengaturan->nama_kades ?? 'NAMA KEPALA DESA') }}</p>
                        @if($pengaturan && $pengaturan->nip_kades)
                            <p style="margin:0;">NIP. {{ $pengaturan->nip_kades }}</p>
                        @endif
                    @elseif($validated['staf_id'] == 'sekdes')
                        <div class="jabatan">
                            An. {{ $pengaturan->jabatan_kades ?? 'Kepala Desa' }} {{ $pengaturan->nama_desa ?? '' }}<br>
                            Sekretaris Desa
                        </div>
                        <p class="nama">{{ strtoupper($pengaturan->nama_sekdes ?? 'NAMA SEKRETARIS DESA') }}</p>
                        @if($pengaturan && $pengaturan->nip_sekdes)
                            <p style="margin:0;">NIP. {{ $pengaturan->nip_sekdes }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    </div>

    <script>
        let isSaved = false;
        function cetakDanSimpan() {
            if(isSaved) {
                window.print();
                return;
            }
            
            fetch('{{ route('surat.store_history') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    nomor_surat: '{{ $surat->nomor_surat }}',
                    penduduk_id: '{{ $surat->penduduk_id }}',
                    jenis_surat: '{{ $surat->jenis_surat }}',
                    keperluan: '{{ addslashes($surat->keperluan) }}',
                    data_tambahan: @json($surat->data_tambahan ?? null)
                })
            }).then(response => {
                isSaved = true; // prevent saving duplicate logs on multiple clicks
                window.print();
                
                // Auto refresh/redirect back to surat form after 10 seconds
                setTimeout(() => {
                    window.location.href = "{{ route('surat.index') }}";
                }, 10000);
            }).catch(err => {
                console.error(err);
                window.print(); // Tetap print meskipun gagal simpan
            });
        }
    </script>
</body>
</html>
