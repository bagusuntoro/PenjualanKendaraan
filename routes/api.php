<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualanKendaraanController;

Route::get('list-kendaraan', [PenjualanKendaraanController::class,'listAllKendaraan']);
Route::get('list-mobil', [PenjualanKendaraanController::class,'listKendaraanMobil']);
Route::get('list-motor', [PenjualanKendaraanController::class,'listKendaraanMotor']);


Route::get('beli-mobil/{id}', [PenjualanKendaraanController::class,'penjualanMobil']);
Route::get('beli-motor/{id}', [PenjualanKendaraanController::class,'penjualanMotor']);

Route::get('laporan-penjualan-mobil', [PenjualanKendaraanController::class,'laporanPenjualanMobil']);
Route::get('laporan-penjualan-motor', [PenjualanKendaraanController::class,'laporanPenjualanMotor']);

Route::post('kendaraan', [PenjualanKendaraanController::class,'menambahkanKendaraan']);
Route::post('mobil', [PenjualanKendaraanController::class,'menambahkanMobil']);
Route::post('motor', [PenjualanKendaraanController::class,'menambahkanMotor']);