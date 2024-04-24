<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpersonateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', function () {
    if (auth()->user()->role == 'Petugas') {
        return redirect()->route('transaksi');
    } else {
        return redirect()->route('dashboard');
    }
})->name('home');

Route::controller(ImpersonateController::class)->group(function () {
    Route::middleware(['auth', 'user-access:Admin'])->group(function () {
        Route::get('impersonate/{user}', 'impersonate')->name('admin.impersonate');
    });
    Route::get('stop-impersonating', 'stopImpersonating')->name('admin.stop-impersonating');
});

Route::controller(PdfController::class)->group(function () {
    Route::get('orderan', 'orderan')->name('orderan');
    Route::get('/barcode/{id}', 'barcode')->name('barcode');
});

Route::controller(Controller::class)->group(function () {
    Route::middleware(['auth', 'user-access:Admin,Petugas'])->group(function () {
        Route::get('/transaksi', 'transaksi')->name('transaksi');
    });
    Route::middleware(['auth', 'user-access:Admin,Pimpinan'])->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::middleware(['auth', 'user-access:Admin'])->group(function () {
        Route::get('/pengguna', 'pengguna')->name('pengguna');
        Route::get('/layanan', 'layanan')->name('layanan');
    });
    Route::get('/konsumen', 'konsumen')->name('konsumen');
});
