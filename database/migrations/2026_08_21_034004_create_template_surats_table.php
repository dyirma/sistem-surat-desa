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
        Schema::create('template_surats', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_surat')->unique(); // e.g. 'domisili', 'usaha', 'pengantar'
            $table->string('nama_template'); // e.g. 'Surat Keterangan Domisili'
            $table->string('deskripsi')->nullable(); // description for the index page
            $table->longText('konten'); // The HTML template content
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_surats');
    }
};
