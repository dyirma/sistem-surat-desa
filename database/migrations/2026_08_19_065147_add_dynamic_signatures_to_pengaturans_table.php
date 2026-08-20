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
            $table->string('jabatan_kades')->nullable()->default('Kepala Desa')->after('alamat_desa');
            $table->string('nama_sekdes')->nullable()->after('nip_kades');
            $table->string('nip_sekdes')->nullable()->after('nama_sekdes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->dropColumn(['jabatan_kades', 'nama_sekdes', 'nip_sekdes']);
        });
    }
};
