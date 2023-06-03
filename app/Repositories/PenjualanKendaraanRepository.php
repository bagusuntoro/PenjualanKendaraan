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
        return $this->mobil->get();
    }

    

    public function listKendaraanMotor()
    {
        return $this->motor->get();
    }

    public function penjualanMobil($id, array $data)
    {
        $dataPenjualanMobil = $this->mobil->find($id);
        $dataPenjualanMobil->status = $data['status'];
        $dataPenjualanMobil->tanggal_terjual = $data['date'];
        $dataPenjualanMobil->save();

        return $dataPenjualanMobil;
    }

    public function penjualanMotor($id, array $data)
    {
        $dataPenjualanMotor = $this->motor->find($id);
        $dataPenjualanMotor->status = $data['status'];
        $dataPenjualanMotor->tanggal_terjual = $data['date'];
        $dataPenjualanMotor->save();

        return $dataPenjualanMotor;
    }

    public function laporanPenjualanMobil()
    {
        return $this->mobil->where('status', 'terjual')->get();
    }

    public function laporanPenjualanMotor()
    {
        return $this->motor->where('status', 'terjual')->get();
    }

    public function menambahkanKendaraan(array $data)
    {
        $dataKendaraan = $this->kendaraan->create($data);
        return $dataKendaraan;
    }

    public function menambahkanMobil(array $data)
    {
        $dataMobil = $this->mobil->create($data);
        return $dataMobil;
    }

    public function menambahkanMotor(array $data)
    {
        $dataMotor = $this->motor->create($data);
        return $dataMotor;
    }
}
