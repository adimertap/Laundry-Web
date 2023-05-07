<?php

use App\Http\Controllers\ApprovalModalController;
use App\Http\Controllers\CurrencyDetailController;
use App\Http\Controllers\JurnalBulananController;
use App\Http\Controllers\JurnalHarianController;
use App\Http\Controllers\JurnalKreditDebitController;
use App\Http\Controllers\Laundry\JurnalBulananController as LaundryJurnalBulananController;
use App\Http\Controllers\Laundry\MasterJenisPenerimaController;
use App\Http\Controllers\Laundry\MasterType;
use App\Http\Controllers\Laundry\MasterTypeController;
use App\Http\Controllers\Laundry\TransaksiController as LaundryTransaksiController;
use App\Http\Controllers\LogEditController;
use App\Http\Controllers\MasterCurrencyController;
use App\Http\Controllers\MasterPegawaiController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/pilih', [App\Http\Controllers\PilihAplikasiController::class, 'index'])->name('pilihAplikasi');
    // LAUNDRY
    Route::get('/laundry', [App\Http\Controllers\Laundry\DashboardController::class, 'index'])->middleware('Owner')->name('dashboard-laundry');
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('Owner')->name('dashboard');
    Route::prefix('owner')->middleware(['Owner'])->group(function(){
        // MASTER DATA
        Route::resource('master-pegawai', MasterPegawaiController::class);
        Route::post('/delete-pegawai', [\App\Http\Controllers\MasterPegawaiController::class, 'hapus'])->name('master-pegawai-delete');
        Route::get('/master-currency', [\App\Http\Controllers\MasterCurrencyController::class, 'index'])->name('master-currency');
        Route::post('/tambah-currency', [\App\Http\Controllers\MasterCurrencyController::class, 'store'])->name('master-currency-store');
        Route::post('/delete-currency', [\App\Http\Controllers\MasterCurrencyController::class, 'hapus']);
        Route::post('/update-currency', [\App\Http\Controllers\MasterCurrencyController::class, 'updatedata']);
        Route::post('/update-nilai-kurs', [\App\Http\Controllers\MasterCurrencyController::class, 'updatekurs']);
        Route::resource('laundry-type', MasterTypeController::class);
        Route::post('/laundry-type/update', [\App\Http\Controllers\Laundry\MasterTypeController::class, 'updateType'])->name('updateType');
        Route::post('/laundry-type/delete', [\App\Http\Controllers\Laundry\MasterTypeController::class, 'deleteType'])->name('deleteType');
        Route::resource('laundry-jenis', MasterJenisPenerimaController::class);
        Route::post('/laundry-jenis/update', [\App\Http\Controllers\Laundry\MasterJenisPenerimaController::class, 'updateJenis'])->name('updateJenis');
        Route::post('/laundry-jenis/delete', [\App\Http\Controllers\Laundry\MasterJenisPenerimaController::class, 'deleteJenis'])->name('deleteJenis');

         // JURNAL
         Route::resource('jurnal-harian', JurnalHarianController::class);
         Route::resource('jurnal-bulanan', JurnalBulananController::class);
         Route::get('/jurnal-bulanan/detail/{id}', [\App\Http\Controllers\JurnalBulananController::class, 'DetailTransaksi'])->name('bulanan-transaksi');
         
          // EXCEL DAN PDF
          Route::get('/download-dokumen', [\App\Http\Controllers\JurnalHarianController::class, 'Export_dokumen'])->name('export-dokumen');
    });

    Route::resource('jurnal-debit-kredit', JurnalKreditDebitController::class);
    Route::post('/delete-jurnal', [\App\Http\Controllers\JurnalKreditDebitController::class, 'hapus'])->name('jurnal-delete');

    //LAUNDRY
    Route::resource('transaksi-laundry', LaundryTransaksiController::class);
    Route::get('/transaksi-laundry-all', [\App\Http\Controllers\Laundry\TransaksiController::class, 'getAll'])->name('transaksi-laundry-all');
    Route::get('/transaksi-laundry-customer', [\App\Http\Controllers\Laundry\TransaksiController::class, 'getCustomer'])->name('transaksi-laundry-customer');
    Route::post('/transaksi-laundry-selesai', [\App\Http\Controllers\Laundry\TransaksiController::class, 'selesai'])->name('transaksi-laundry-selesai');
    Route::post('/transaksi-laundry-diambil', [\App\Http\Controllers\Laundry\TransaksiController::class, 'diambil'])->name('transaksi-laundry-diambil');
    Route::get('/laundry-cetak/{id}', [\App\Http\Controllers\CetakController::class, 'cetak_laundry'])->name('cetak-laundry');
    Route::get('/laundry/download-harian', [\App\Http\Controllers\Laundry\TransaksiController::class, 'export_dokumen'])->name('export-dokumen-harian-laundry');
    Route::get('/laundry/download-tanggal/{tanggal_transaksi}', [\App\Http\Controllers\Laundry\TransaksiController::class, 'export_dokumen_tanggal'])->name('export-dokumen-tanggal-laundry');
    Route::get('/laundry/download-excel/{month}', [\App\Http\Controllers\Laundry\TransaksiController::class, 'export_month'])->name('export-dokumen-month-laundry');
    Route::get('/laundry/download', [\App\Http\Controllers\Laundry\TransaksiController::class, 'export_dokumen_all'])->name('export-dokumen-laundry');
    Route::resource('bulanan-laundry', LaundryJurnalBulananController::class);   
    
    // TRANSAKSI
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksi/getkurs/{id_currency}', [\App\Http\Controllers\TransaksiController::class, 'getkurs']);
    Route::get('/edit/getkurs/{id_currency}', [\App\Http\Controllers\TransaksiController::class, 'getkursedit']);
    Route::post('/delete-transaksi', [\App\Http\Controllers\TransaksiController::class, 'hapus'])->name('transaksi-delete');

    // MODAL
    Route::resource('modal', ModalController::class);
    Route::post('/delete-modal', [\App\Http\Controllers\ModalController::class, 'hapus'])->name('modal-delete');
    Route::post('/transfer-modal', [\App\Http\Controllers\ModalController::class, 'transfer'])->name('modal-transfer');
    Route::post('/tambah-modal', [\App\Http\Controllers\ModalController::class, 'tambah']);
    
    // LOG EDIT
    Route::resource('log-edit', LogEditController::class);
    Route::get('log-edit/getdetail/{id}', [\App\Http\Controllers\LogEditController::class, 'getdetail']);
    Route::get('/filter-log', [\App\Http\Controllers\LogEditController::class, 'filterLog'])->name('filterLog');

    // APPROVAL
    Route::resource('approval-modal', ApprovalModalController::class)->middleware(['Owner']);

    // CETAK DOWNLOAD
    Route::get('/cetak/{id}', [\App\Http\Controllers\CetakController::class, 'cetak'])->name('cetak');
    Route::get('/exportexcel/{today}', [\App\Http\Controllers\CetakController::class, 'exportexcel'])->name('exportexcel');
    
    Route::get('/download-harian', [\App\Http\Controllers\TransaksiController::class, 'Export_dokumen'])->name('export-dokumen-harian');
});