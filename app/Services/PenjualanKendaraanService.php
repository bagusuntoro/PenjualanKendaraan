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

    public function listAllKendaraan()
    {
        return $this->penjualanKendaraanRepository->listAllKendaraan();
    }

    public function listKendaraanMobil()
    {
        return $this->penjualanKendaraanRepository->listKendaraanMobil();
    }

    public function listKendaraanMotor()
    {
        return $this->penjualanKendaraanRepository->listKendaraanMotor();
    }

    public function penjualanMobil($id)
    {
        $dataPenjualanMobil = $this->generatePenjualanData();
        return $this->penjualanKendaraanRepository->penjualanMobil($id, $dataPenjualanMobil);
    }

    public function penjualanMotor($id)
    {
        $dataPenjualanMotor = $this->generatePenjualanData();
        return $this->penjualanKendaraanRepository->penjualanMotor($id, $dataPenjualanMotor);
    }

    public function laporanPenjualanMobil()
    {
        return $this->penjualanKendaraanRepository->laporanPenjualanMobil();
    }

    public function laporanPenjualanMotor()
    {
        return $this->penjualanKendaraanRepository->laporanPenjualanMotor();
    }

    public function menambahkanKendaraan(Request $request)
    {
        $dataKendaraan = $request->only(['tahun_keluaran', 'warna', 'harga']);
        return $this->penjualanKendaraanRepository->menambahkanKendaraan($dataKendaraan);
    }

    public function menambahkanMobil(Request $request)
    {
        $dataMobil = $request->only(['nama_mobil', 'mesin', 'kapasitas_penumpang', 'tipe', 'id_kendaraan']);
        return $this->penjualanKendaraanRepository->menambahkanMobil($dataMobil);
    }

    public function menambahkanMotor(Request $request)
    {
        $dataMotor = $request->only(['nama_motor', 'mesin', 'tipe_suspensi', 'tipe_transmisi', 'id_kendaraan']);
        return $this->penjualanKendaraanRepository->menambahkanMotor($dataMotor);
    }

    private function generatePenjualanData()
    {
        $now = Carbon::now('Asia/Jakarta');
        $formattedDate = $now->format('d/m/Y');
    
        return [
            'status' => 'terjual',
            'date' => $formattedDate,
        ];
    }
    
}
