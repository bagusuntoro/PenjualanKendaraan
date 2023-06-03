<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Models\Motor;

class PenjualanKendaraanRepository
{
    private $kendaraan;
    private $mobil;
    private $motor;

    public function __construct(Kendaraan $kendaraan, Mobil $mobil, Motor $motor)
    {
        $this->kendaraan = $kendaraan;
        $this->mobil = $mobil;
        $this->motor = $motor;
    }

    public function listAllKendaraan()
    {
        // $mobil = $this->mobil->get();
        // $motor = $this->motor->get();

        // return $mobil->concat($motor);
        return $this->kendaraan->get();
    }

    public function listKendaraanMobil()
    {
        return $this->mobil->get(['_id', 'nama_mobil']);
    }

    

    public function listKendaraanMotor()
    {
        return $this->motor->get(['_id', 'nama_motor']);
    }

    public function penjualanMobil($id, array $data)
    {
        $dataPenjualanMobil = $this->mobil->find($id);

        // hanya bisa membeli mobil yang statusnya ready
        if ($dataPenjualanMobil && !$dataPenjualanMobil->status) {
            $dataPenjualanMobil->status = $data['status'];
            $dataPenjualanMobil->tanggal_terjual = $data['date'];
            $dataPenjualanMobil->save();

            return $dataPenjualanMobil;
        }

        // selain itu mobil tidak bisa dibeli
        return 'mobil tidak tersedia';
    }

    public function penjualanMotor($id, array $data)
    {
        $dataPenjualanMotor = $this->motor->find($id);

        if ($dataPenjualanMotor && !$dataPenjualanMotor->status) {
            $dataPenjualanMotor->status = $data['status'];
            $dataPenjualanMotor->tanggal_terjual = $data['date'];
            $dataPenjualanMotor->save();
    
            return $dataPenjualanMotor;           
        }

        // selain itu motor tidak bisa dibeli
        return 'motor tidak tersedia';
    }

    public function laporanPenjualanMobil()
    {
        // laporan hanya menampilkan data mobil yang statusnya terjual
        return $this->mobil->where('status', 'terjual')->get();
    }

    public function laporanPenjualanMotor()
    {
        // laporan hanya menampilkan data motor yang statusnya terjual
        return $this->motor->where('status', 'terjual')->get();
    }

    // menambahkan kendaraan
    public function menambahkanKendaraan(array $data)
    {
        $dataKendaraan = $this->kendaraan->create($data);
        return $dataKendaraan;
    }

    // menambahkan mobil
    public function menambahkanMobil(array $data)
    {
        $dataMobil = $this->mobil->create($data);
        return $dataMobil;
    }

    // menambahkan motor
    public function menambahkanMotor(array $data)
    {
        $dataMotor = $this->motor->create($data);
        return $dataMotor;
    }

    public function detailKendaraan($id)
    {
        $dataKendaraan = $this->kendaraan->find($id);

        return $dataKendaraan;
    }

    public function detailMobil($id)
    {
        $dataMobil = $this->mobil->find($id);
        return $dataMobil;
    }

    public function detailMotor($id)
    {
        $dataMotor = $this->motor->find($id);

        return $dataMotor;
    }

    public function updateKendaraan(array $data, $id)
    {
        $dataKendaraan = $this->kendaraan->find($id);
        $dataKendaraan->update($data);
        
        return $dataKendaraan;
    }
    public function updateMobil(array $data, $id)
    {
        $dataMobil = $this->mobil->find($id);
        $dataMobil->update($data);
        
        return $dataMobil;
    }
    public function updateMotor(array $data, $id)
    {
        $dataMotor = $this->motor->find($id);
        $dataMotor->update($data);
        
        return $dataMotor;
    }

    public function deleteMobil($id)
    {
        $dataMobil = $this->mobil->find($id);
        if ($dataMobil) {
            $dataMobil->delete();
            return 'data berhasil dihapus';
        }
        return 'data tidak ditemukan!!';
    }

    public function deleteMotor($id)
    {
        $dataMotor = $this->motor->find($id);
        if ($dataMotor) {
            $dataMotor->delete();
            return 'data berhasil dihapus';
        }
        return 'data tidak ditemukan!!';
    }


}
