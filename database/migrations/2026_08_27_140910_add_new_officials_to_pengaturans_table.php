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
            $table->string('nama_kaur_tu')->nullable()->after('nip_sekdes');
            $table->string('nip_kaur_tu')->nullable()->after('nama_kaur_tu');
            $table->string('nama_kasi_kesra')->nullable()->after('nip_kaur_tu');
            $table->string('nip_kasi_kesra')->nullable()->after('nama_kasi_kesra');
            $table->string('nama_kasi_pemerintahan')->nullable()->after('nip_kasi_kesra');
            $table->string('nip_kasi_pemerintahan')->nullable()->after('nama_kasi_pemerintahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_kaur_tu', 'nip_kaur_tu',
                'nama_kasi_kesra', 'nip_kasi_kesra',
                'nama_kasi_pemerintahan', 'nip_kasi_pemerintahan',
            ]);
        });
    }
};
