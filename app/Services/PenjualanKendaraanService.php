<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Repositories\PenjualanKendaraanRepository;

class PenjualanKendaraanService
{
    private $penjualanKendaraanRepository;

    public function __construct(PenjualanKendaraanRepository $penjualanKendaraanRepository)
    {
        $this->penjualanKendaraanRepository = $penjualanKendaraanRepository;
    }

    public function listAllKendaraan() //list untuk semua kendaraan
    {
        return $this->penjualanKendaraanRepository->listAllKendaraan();
    }

    public function listKendaraanMobil() //list untuk kendaraan mobil
    {
        return $this->penjualanKendaraanRepository->listKendaraanMobil();
    }


    public function listKendaraanMotor() //list kendaraan untuk motor
    {
        return $this->penjualanKendaraanRepository->listKendaraanMotor();
    }

    public function penjualanMobil($id) //penjualan mobil
    {
        $dataPenjualanMobil = [
            'status' => 'terjual',
            'date' => Carbon::now(),
        ];
        return $this->penjualanKendaraanRepository->penjualanMobil($id, $dataPenjualanMobil);
    }    

    public function penjualanMotor($id) //penjualan motor
    {
        $dataPenjualanMotor = [
            'status' => 'terjual',
            'date' => Carbon::now(),
        ];
        return $this->penjualanKendaraanRepository->penjualanMotor($id, $dataPenjualanMotor);
    }    

    public function laporanPenjualanMobil() //laporan penjualan mobil
    {
        return $this->penjualanKendaraanRepository->laporanPenjualanMobil();
    }

    public function laporanPenjualanMotor() //laporan penjualan motor
    {
        return $this->penjualanKendaraanRepository->laporanPenjualanMotor();
    }


    // fitur tambahan
    public function menambahkanKendaraan(Request $request)
    {
        $dataKendaraan = [
            'tahun_keluaran' => $request->tahun_keluaran,
            'warna' => $request->warna,
            'harga' => $request->harga
        ];

        return $this->penjualanKendaraanRepository->menambahkanKendaraan($dataKendaraan);
    }

    public function menambahkanMobil(Request $request)
    {
        $dataMobil = [
            'nama_mobil' => $request->nama_mobil,
            'mesin' => $request->mesin,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'tipe' => $request->tipe
        ];

        return $this->penjualanKendaraanRepository->menambahkanMobil($dataMobil);
    }

    public function menambahkanMotor(Request $request)
    {
        $dataMotor = [
            'nama_motor' => $request->nama_motor,
            'mesin' => $request->mesin,
            'tipe_suspensi' => $request->tipe_suspensi,
            'tipe_transmisi' => $request->tipe_transmisi
        ];

        return $this->penjualanKendaraanRepository->menambahkanMotor($dataMotor);
    }
}