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
        Schema::table('penduduks', function (Blueprint $table) {
            $table->string('no_kk')->nullable()->after('nik');
            $table->string('hub_kel')->nullable()->after('status_perkawinan');
            $table->integer('usia')->nullable()->after('tanggal_lahir');
            $table->string('dukuh')->nullable()->after('alamat');
            $table->string('rt')->nullable()->after('dukuh');
            $table->string('rw')->nullable()->after('rt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn(['no_kk', 'hub_kel', 'usia', 'dukuh', 'rt', 'rw']);
        });
    }
};
