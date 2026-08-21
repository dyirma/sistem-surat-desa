<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->string('nama_kabupaten')->nullable()->after('id');
            $table->string('nama_kecamatan')->nullable()->after('nama_kabupaten');
            $table->string('kode_pos')->nullable()->after('alamat_desa');
            $table->string('email_desa')->nullable()->after('kode_pos');
            $table->string('website_desa')->nullable()->after('email_desa');
            $table->string('penandatangan_aktif')->nullable()->default('kades')->after('nip_sekdes');
            $table->string('format_nomor_surat')->nullable()->default('145/[NO_URUT]/[KODE_DESA]/[TAHUN]')->after('penandatangan_aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_kabupaten',
                'nama_kecamatan',
                'kode_pos',
                'email_desa',
                'website_desa',
                'penandatangan_aktif',
                'format_nomor_surat',
            ]);
        });
    }
};
