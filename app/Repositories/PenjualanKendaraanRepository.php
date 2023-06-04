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

    // awal list
    public function listAllKendaraan()
    {
        return $this->kendaraan->get();
    }

    public function listKendaraanMobil()
    {
        return $this->mobil->select('_id', 'nama_mobil')->get();
    }

    public function listKendaraanMotor()
    {
        return $this->motor->select('_id', 'nama_motor')->get();
    } //akhir list





    public function penjualanKendaraan($id, array $data, $model) //method ini dugunakan untuk penjualan
    {
        $dataPenjualan = $model->find($id);

        if ($dataPenjualan && !$dataPenjualan->status) {
            $dataPenjualan->status = $data['status'];
            $dataPenjualan->tanggal_terjual = $data['date'];
            $dataPenjualan->save();

            return $dataPenjualan;
        }

        return 'kendaraan tidak tersedia';
    }

    public function penjualanMobil($id, array $data)
    {
        return $this->penjualanKendaraan($id, $data, $this->mobil);
    }

    public function penjualanMotor($id, array $data)
    {
        return $this->penjualanKendaraan($id, $data, $this->motor);
    } //akhir penjualan






    public function laporanPenjualan($model) //method digunakan untuk laporan
    {
        return $model->where('status', 'terjual')->get();
    }

    public function laporanPenjualanMobil()
    {
        return $this->laporanPenjualan($this->mobil);
    }

    public function laporanPenjualanMotor()
    {
        return $this->laporanPenjualan($this->motor);
    } //akhir laporan



    

    public function createData($model, array $data) //method digunakan untuk membuat data
    {
        return $model->create($data);
    }

    public function menambahkanKendaraan(array $data)
    {
        return $this->createData($this->kendaraan, $data);
    }

    public function menambahkanMobil(array $data)
    {
        return $this->createData($this->mobil, $data);
    }

    public function menambahkanMotor(array $data)
    {
        return $this->createData($this->motor, $data);
    } //akhir dari pembuatan data





    public function getDetail($model, $id)  // method digunakan untuk mengambil data detail
    {
        return $model->find($id);
    }

    public function detailKendaraan($id)
    {
        return $this->getDetail($this->kendaraan, $id);
    }

    public function detailMobil($id)
    {
        return $this->getDetail($this->mobil, $id);
    }

    public function detailMotor($id)
    {
        return $this->getDetail($this->motor, $id);
    }//akhir dari detail data




    public function updateData($model, array $data, $id) //method digunakan untuk update data
    {
        $dataModel = $model->find($id);
        $dataModel->update($data);

        return $dataModel;
    }

    public function updateKendaraan(array $data, $id)
    {
        return $this->updateData($this->kendaraan, $data, $id);
    }

    public function updateMobil(array $data, $id)
    {
        return $this->updateData($this->mobil, $data, $id);
    }

    public function updateMotor(array $data, $id)
    {
        return $this->updateData($this->motor, $data, $id);
    } //akhir dari update data




    public function deleteData($model, $id) //method ini digunakan untuk delete data
    {
        $dataModel = $model->find($id);

        if ($dataModel) {
            $dataModel->delete();
            return 'data berhasil dihapus';
        }

        return 'data tidak ditemukan!!';
    }

    public function deleteMobil($id)
    {
        return $this->deleteData($this->mobil, $id);
    }

    public function deleteMotor($id)
    {
        return $this->deleteData($this->motor, $id);
    } //akhir dari delete data
}
