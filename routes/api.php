<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualanKendaraanController;

Route::get('list-kendaraan', [PenjualanKendaraanController::class,'listAllKendaraan']);
Route::get('list-mobil', [PenjualanKendaraanController::class,'listKendaraanMobil']);
Route::get('list-motor', [PenjualanKendaraanController::class,'listKendaraanMotor']);

Route::get('detail-mobil/{id}', [PenjualanKendaraanController::class,'detailMobil']);
Route::get('detail-motor/{id}', [PenjualanKendaraanController::class,'detailMotor']);

Route::put('update-kendaraan/{id}', [PenjualanKendaraanController::class,'updateKendaraan']);
Route::put('update-mobil/{id}', [PenjualanKendaraanController::class,'updateMobil']);
Route::put('update-motor/{id}', [PenjualanKendaraanController::class,'updateMotor']);




Route::put('beli-mobil/{id}', [PenjualanKendaraanController::class,'penjualanMobil']);
Route::put('beli-motor/{id}', [PenjualanKendaraanController::class,'penjualanMotor']);

Route::get('laporan-penjualan-mobil', [PenjualanKendaraanController::class,'laporanPenjualanMobil']);
Route::get('laporan-penjualan-motor', [PenjualanKendaraanController::class,'laporanPenjualanMotor']);

Route::post('kendaraan', [PenjualanKendaraanController::class,'menambahkanKendaraan']);
Route::post('mobil', [PenjualanKendaraanController::class,'menambahkanMobil']);
Route::post('motor', [PenjualanKendaraanController::class,'menambahkanMotor']);