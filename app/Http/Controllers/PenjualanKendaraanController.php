<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FormatApi;
use App\Services\PenjualanKendaraanService;

class PenjualanKendaraanController extends Controller
{
    private $penjualanKendaraanService;

    public function __construct(PenjualanKendaraanService $penjualanKendaraanService)
    {
        $this->penjualanKendaraanService = $penjualanKendaraanService;
    }

    public function listAllKendaraan() //list untuk semua kendaraan
    {
        $dataKendaraan = $this->penjualanKendaraanService->listAllKendaraan();

        if ($dataKendaraan) {
            return FormatApi::ApiCreate(200,'Success', $dataKendaraan);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function listKendaraanMobil() //list untuk kendaraan mobil
    {
        $dataMobil = $this->penjualanKendaraanService->listKendaraanMobil();

        if ($dataMobil) {
            return FormatApi::ApiCreate(200,'Success', $dataMobil);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function listKendaraanMotor() //list kendaraan untuk motor
    {
        $dataMotor = $this->penjualanKendaraanService->listKendaraanMotor();

        if ($dataMotor) {
            return FormatApi::ApiCreate(200,'Success', $dataMotor);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function penjualanMobil($id) //penjualan mobil
    {
        $dataPenjualanMobil = $this->penjualanKendaraanService->penjualanMobil($id);

        if ($dataPenjualanMobil) {
            return FormatApi::ApiCreate(200,'Success', $dataPenjualanMobil);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }    
    public function penjualanMotor($id) //penjualan motor
    {
        $dataPenjualanMotor = $this->penjualanKendaraanService->penjualanMotor($id);

        if ($dataPenjualanMotor) {
            return FormatApi::ApiCreate(200,'Success', $dataPenjualanMotor);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }    

    public function laporanPenjualanMobil() //laporan penjualan mobil
    {
        $laporanPenjualanMobil = $this->penjualanKendaraanService->laporanPenjualanMobil();

        if ($laporanPenjualanMobil) {
            return FormatApi::ApiCreate(200,'Success', $laporanPenjualanMobil);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function laporanPenjualanMotor() //laporan penjualan motor
    {
        $laporanPenjualanMotor = $this->penjualanKendaraanService->laporanPenjualanMotor();

        if ($laporanPenjualanMotor) {
            return FormatApi::ApiCreate(200,'Success', $laporanPenjualanMotor);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }


    // fitur tambahan
    public function menambahkanKendaraan(Request $request)
    {
        $validateData = $request->validate([
            'tahun_keluaran' => 'required|date',
            'warna' => 'required|string|max:10',
            'harga' => 'required|numeric|max:500000000'
        ]);

        $dataKendaraan = $this->penjualanKendaraanService->menambahkanKendaraan($request);
        if ($dataKendaraan) {
            return FormatApi::ApiCreate(200,'Success', $dataKendaraan);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function menambahkanMobil(Request $request)
    {
        $validateData = $request->validate([
            'nama_mobil' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'kapasitas_penumpang' => 'required|numeric|max:2',
            'tipe' => 'required|string|max:10'
        ]);

        $dataMobil = $this->penjualanMobilService->menambahkanMobil($request);
        if ($dataMobil) {
            return FormatApi::ApiCreate(200,'Success', $dataMobil);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

    public function menambahkanMotor(Request $request)
    {
        $validateData = $request->validate([
            'nama_motor' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'tipe_suspensi' => 'required|string|max:20',
            'tipe_transmisi' => 'required|string|max:10'
        ]);

        $dataMotor = $this->penjualanMotorService->menambahkanMotor($request);
        if ($dataMotor) {
            return FormatApi::ApiCreate(200,'Success', $dataMotor);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }

}
