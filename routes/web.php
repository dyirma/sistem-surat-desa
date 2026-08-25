<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/surat', function () {
    $templates = \App\Models\TemplateSurat::all();
    return view('surat.index', compact('templates'));
})->name('surat.index');

Route::get('/surat/create', [\App\Http\Controllers\SuratController::class, 'create'])->name('surat.create');
Route::post('/surat/preview', [\App\Http\Controllers\SuratController::class, 'preview'])->name('surat.preview');
Route::post('/surat/print', [\App\Http\Controllers\SuratController::class, 'print'])->name('surat.print');
Route::post('/surat/print-final', [\App\Http\Controllers\SuratController::class, 'printFinal'])->name('surat.printFinal');
Route::post('/surat/store-history', [\App\Http\Controllers\SuratController::class, 'storeHistory'])->name('surat.store_history');

Route::post('/penduduk/truncate', [\App\Http\Controllers\PendudukController::class, 'truncate'])->name('penduduk.truncate');
Route::get('/penduduk/search-ajax', [\App\Http\Controllers\PendudukController::class, 'searchAjax'])->name('penduduk.searchAjax');
Route::post('/penduduk/import', [\App\Http\Controllers\PendudukController::class, 'import'])->name('penduduk.import');
Route::resource('penduduk', \App\Http\Controllers\PendudukController::class);
Route::resource('template-surat', \App\Http\Controllers\TemplateSuratController::class);

Route::get('/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'index'])->name('pengaturan.index');
Route::post('/pengaturan/profil', [\App\Http\Controllers\PengaturanController::class, 'updateProfil'])->name('pengaturan.update_profil');
Route::post('/pengaturan/pejabat', [\App\Http\Controllers\PengaturanController::class, 'updatePejabat'])->name('pengaturan.update_pejabat');
Route::post('/pengaturan/penomoran', [\App\Http\Controllers\PengaturanController::class, 'updatePenomoran'])->name('pengaturan.update_penomoran');

Route::get('/riwayat', [\App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat.index');
