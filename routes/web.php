<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manajemen\DokterController;
use App\Http\Controllers\Manajemen\JadwalPasienController;
use App\Http\Controllers\Manajemen\KeuanganController;
use App\Http\Controllers\Manajemen\ObatController;
use App\Http\Controllers\Manajemen\PasienController;
use App\Http\Controllers\Manajemen\PerawatController;
use App\Http\Controllers\Manajemen\RekamMedisController;
use App\Http\Controllers\Manajemen\{UserController, AkunController};
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PendaftaranController;
use App\Models\Rekam_medis;

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

Route::redirect('/', '/login', 301);

Route::get('login',         [AuthController::class, 'index'])->name('login');
Route::post('login',        [AuthController::class, 'login'])->name('loginPost');


Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard',                   [HomeController::class, 'index'])->name('home');
    Route::get('logout',                      [AuthController::class, 'logout'])->name('logout');

    Route::get('/antrian/delete/{id}',        [HomeController::class, 'antriandelete'])->name('home.antrian.delete');
    Route::middleware(['olah_pasien'])->group(function () {
        // Route Sub-menu Pendaftaran
        Route::get('pendaftaran',                 [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::post('pendaftaran/new',            [PendaftaranController::class, 'storenew'])->name('pendaftaran.baru');
        Route::post('pendaftaran/old',            [PendaftaranController::class, 'storeold'])->name('pendaftaran.lama');
    });

    Route::get('/pemeriksaan',                [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');


    Route::prefix('manajemen')->group(function () {
        Route::middleware(['olah_rekmed'])->group(function () {
            Route::get('/rekam-medis',               [RekamMedisController::class, 'index'])->name('manajemen.rm');
            Route::get('/rekam-medis/show/{id}',     [RekamMedisController::class, 'show'])->name('manajemen.rm.show');
            Route::get('/rekam-medis/edit/{id}',     [RekamMedisController::class, 'edit'])->name('manajemen.rm.edit');
            Route::post('/rekam-medis/store',        [RekamMedisController::class, 'store'])->name('manajemen.rm.store');
            Route::post('/rekam-medis/add/obat',     [ObatController::class, 'addtorekmed'])->name('manajemen.rm.add.obat');
        });

        Route::get('/jadwal-pasien',             [JadwalPasienController::class, 'index'])->name('manajemen.jadwalpasien');
        Route::get('/jadwal-pasien/{id}',             [JadwalPasienController::class, 'search'])->name('manajemen.jadwalpasien.show');

        Route::middleware(['olah_obat'])->group(function () {
            Route::get('/obat',                      [ObatController::class, 'index'])->name('manajemen.obat');
            Route::post('/obat/update',              [ObatController::class, 'update'])->name('manajemen.obat.update');
            Route::post('/obat/store',               [ObatController::class, 'store'])->name('manajemen.obat.store');
            Route::post('/obat/riwayat-update',      [ObatController::class, 'index_riwayat'])->name('manajemen.obat.rirwayat');
            Route::get('/pasien',                    [PasienController::class, 'index'])->name('manajemen.pasien');
            Route::post('/pasien/edit',              [PasienController::class, 'edit'])->name('manajemen.pasien.edit');
        });
        Route::middleware(['superadmin'])->group(function () {
            Route::get('/perawat',                   [PerawatController::class, 'index'])->name('manajemen.perawat');
            Route::post('/perawat/store',            [PerawatController::class, 'store'])->name('manajemen.perawat.store');
            Route::get('/perawat/delete/{id}',           [PerawatController::class, 'delete'])->name('manajemen.perawat.delete');

            Route::get('/dokter',                    [DokterController::class, 'index'])->name('manajemen.dokter');
            Route::post('/dokter/store',             [DokterController::class, 'store'])->name('manajemen.dokter.store');
            Route::get('/dokter/delete/{id}',            [DokterController::class, 'delete'])->name('manajemen.dokter.delete');
        });
        Route::middleware(['olah_keuangan'])->group(function () {
            Route::get('/keuangan',                  [KeuanganController::class, 'index'])->name('manajemen.keuangan');
            Route::post('/keuangan/update',          [KeuanganController::class, 'update'])->name('manajemen.keuangan.update');
        });

        Route::prefix('akun')->group(function () {
            Route::middleware(['superadmin'])->group(function () {
                Route::resource('manajemen-akun',         UserController::class)->except('create', 'show');
            });
            Route::get('ganti-password',             [AkunController::class, 'gantiPassword'])->name('akun.ganti-password');
            Route::patch('ganti-password',           [AkunController::class, 'updatePassword'])->name('akun.ganti-password');
            Route::get('profil',                     [AkunController::class, 'profil'])->name('akun.profil');
        });
    });


    // //template test
    // Route::get('rekam-medis/lihat-rm', function () {
    //     return view('/rekam-medis/lihat-rm');
    // });


    // Route::get('pemeriksaan/lihat-pemeriksaan', function () {
    //     return view('pemeriksaan/lihat-pemeriksaan');
    // });

    // Route::get('rekam-medis/edit-rm', function () {
    //     return view('rekam-medis/edit-rm');
    // });

    // Route::get('/profile', function () {
    //     return view('master/profile');
    // });

    // Route::get('/ganti-password', function () {
    //     return view('master/ganti-password');
    // });

    // Route::group(['middleware'=>'Role:superadmin'], function (){
    //     Route::get()
    // });

    // Route::group(['middleware'=>'Role:customerservice'], function (){
    //     Route::get()
    // });

    // Route::group(['middleware'=>'Role:perawat'], function (){
    //     Route::get()
    // });
    // Route::group(['middleware'=>'Role:dokter'], function (){
    //     Route::get()
    // });

});
