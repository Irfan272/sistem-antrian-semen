<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('showlogin');


Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Bagian Admin

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']);

// Route Akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index']);
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create']);
Route::post('akun/store', [App\Http\Controllers\AkunController::class, 'store']);
Route::get('akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit']);
Route::patch('akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update']);
Route::delete('akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete']);

// Jenis
Route::get('/jenis', [App\Http\Controllers\JenisSemenController::class, 'index']);
Route::get('/jenis/create', [App\Http\Controllers\JenisSemenController::class, 'create']);
Route::post('/jenis/store', [App\Http\Controllers\JenisSemenController::class, 'store']);
Route::get('/jenis/edit/{id}', [App\Http\Controllers\JenisSemenController::class, 'edit']);
Route::get('/jenis/view/{id}', [App\Http\Controllers\JenisSemenController::class, 'view']);
Route::patch('/jenis/update/{id}', [App\Http\Controllers\JenisSemenController::class, 'update']);
Route::delete('/jenis/delete/{id}', [App\Http\Controllers\JenisSemenController::class, 'delete']);



// Pelanggan
Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index']);
Route::get('/pelanggan/create', [App\Http\Controllers\PelangganController::class, 'create']);
Route::post('/pelanggan/store', [App\Http\Controllers\PelangganController::class, 'store']);
Route::get('/pelanggan/edit/{id}', [App\Http\Controllers\PelangganController::class, 'edit']);
Route::get('/pelanggan/view/{id}', [App\Http\Controllers\PelangganController::class, 'view']);
Route::patch('/pelanggan/update/{id}', [App\Http\Controllers\PelangganController::class, 'update']);
Route::delete('/pelanggan/delete/{id}', [App\Http\Controllers\PelangganController::class, 'delete']);

// delivery
Route::get('/delivery', [App\Http\Controllers\DeliveryOrderController::class, 'index']);
Route::get('/delivery/create', [App\Http\Controllers\DeliveryOrderController::class, 'create']);
Route::post('/delivery/store', [App\Http\Controllers\DeliveryOrderController::class, 'store']);
Route::get('/delivery/edit/{id}', [App\Http\Controllers\DeliveryOrderController::class, 'edit']);
Route::get('/delivery/view/{id}', [App\Http\Controllers\DeliveryOrderController::class, 'view']);
Route::patch('/delivery/update/{id}', [App\Http\Controllers\DeliveryOrderController::class, 'update']);
Route::delete('/delivery/delete/{id}', [App\Http\Controllers\DeliveryOrderController::class, 'delete']);




// Bagian Security

Route::get('/security/dashboard', [App\Http\Controllers\HomeController::class, 'indexSecurity']);

// antrian
Route::get('/antrian', [App\Http\Controllers\AntrianController::class, 'index']);
Route::get('/antrian/create', [App\Http\Controllers\AntrianController::class, 'create']);
Route::post('/antrian/store', [App\Http\Controllers\AntrianController::class, 'store']);
Route::get('/antrian/edit/{id}', [App\Http\Controllers\AntrianController::class, 'edit']);
Route::get('/antrian/view/{id}', [App\Http\Controllers\AntrianController::class, 'view']);
Route::patch('/antrian/update/{id}', [App\Http\Controllers\AntrianController::class, 'update']);
Route::delete('/antrian/delete/{id}', [App\Http\Controllers\AntrianController::class, 'delete']);

