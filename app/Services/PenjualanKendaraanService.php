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
        $dataKendaraan = $this->detailKendaraan($request->id_kendaraan);
        if ($dataKendaraan) { //periksa apakah id kendaraan valid
            $dataMobil = $request->only(['nama_mobil', 'mesin', 'kapasitas_penumpang', 'tipe', 'id_kendaraan', 'status'=>'ready']);
            return $this->penjualanKendaraanRepository->menambahkanMobil($dataMobil);
        }

        return 'kendaraan tidak valid';
    }

    public function menambahkanMotor(Request $request)
    {
        $dataKendaraan = $this->detailKendaraan($request->id_kendaraan);
        if($dataKendaraan){
            $dataMotor = $request->only(['nama_motor', 'mesin', 'tipe_suspensi', 'tipe_transmisi', 'id_kendaraan']);
            return $this->penjualanKendaraanRepository->menambahkanMotor($dataMotor);
        }   
        return 'kendaraan tidak valid';
    }

    public function detailKendaraan($id)
    {
        return $this->penjualanKendaraanRepository->detailKendaraan($id);
    }

    public function detailMobil($id)
    {
        return $this->penjualanKendaraanRepository->detailMobil($id);
    }

    public function detailMotor($id)
    {
        return $this->penjualanKendaraanRepository->detailMotor($id);
    }

    public function updateKendaraan(Request $request, $id)
    {
        $dataKendaraan = $request->only(['tahun_keluaran', 'warna', 'harga']);
        return $this->penjualanKendaraanRepository->updateKendaraan($dataKendaraan, $id);   
    }

    public function updateMobil(Request $request, $id)
    {
        $dataMobil = $this->detailMobil($id);
        if (!$dataMobil->status) { //cek apakah mobil dengan id tersebut ada?
            $dataKendaraan = $this->detailKendaraan($request->id_kendaraan);
            if ($dataKendaraan) { //cek apakah id kendaraan valid?
                $dataMobil = $request->only(['nama_mobil', 'mesin', 'kapasitas_penumpang', 'tipe', 'id_kendaraan']);
                return $this->penjualanKendaraanRepository->updateMobil($dataMobil, $id);   
            }
            return 'kendaraan tidak valid';
        }else {
            return 'tidak bisa mengupdate mobil yang sudah terjual';
        }
    }

    public function updateMotor(Request $request, $id)
    {
        $dataMotor = $this->detailMotor($id);
        if(!$dataMotor->status){ // cek apakah motor dengan id tersebut ada ?
            $dataKendaraan = $this->detailKendaraan($request->id_kendaraan);
            if ($dataKendaraan) { // cek apakah id kendaraan valid?
                $dataMotor = $request->only(['nama_motor', 'mesin', 'tipe_suspensi', 'tipe_transmisi', 'id_kendaraan']);
                return $this->penjualanKendaraanRepository->updateMotor($dataMotor, $id);   
            }
            return 'kendaraan tidak valid';
        }else{
            return 'tidak bisa mengupdate motor yang sudah terjual';
        }
    }

    public function deleteMobil($id)
    {
        return $this->penjualanKendaraanRepository->deleteMobil($id);
    }

    public function deleteMotor($id)
    {
        return $this->penjualanKendaraanRepository->deleteMotor($id);
    }


    // untuk ngeset status kendaraan dan tanggal dibeli
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
