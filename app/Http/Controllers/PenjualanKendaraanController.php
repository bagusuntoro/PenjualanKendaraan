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

    public function listAllKendaraan()
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->listAllKendaraan(), 200);
    }

    public function listKendaraanMobil()
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->listKendaraanMobil(), 200);
    }

    public function listKendaraanMotor()
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->listKendaraanMotor(), 200);
    }

    public function penjualanMobil($id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->penjualanMobil($id), 200);
    }

    public function penjualanMotor($id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->penjualanMotor($id), 200);
    }

    public function laporanPenjualanMobil()
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->laporanPenjualanMobil(), 200);
    }

    public function laporanPenjualanMotor()
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->laporanPenjualanMotor(), 200);
    }

    public function menambahkanKendaraan(Request $request)
    {
        $validatedData = $request->validate([
            'tahun_keluaran' => 'required|date',
            'warna' => 'required|string|max:10',
            'harga' => 'required|numeric|max:500000000'
        ]);

        return $this->formatApiResponse($this->penjualanKendaraanService->menambahkanKendaraan($request), 201);
    }

    public function menambahkanMobil(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mobil' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'kapasitas_penumpang' => 'required|numeric|max:10',
            'tipe' => 'required|string|max:10',
            'id_kendaraan' => 'required|string'
        ]);

        return $this->formatApiResponse($this->penjualanKendaraanService->menambahkanMobil($request), 201);
    }

    public function menambahkanMotor(Request $request)
    {
        $validatedData = $request->validate([
            'nama_motor' => 'required|string|max:15',
            'mesin' => 'required|string|max:10',
            'tipe_suspensi' => 'required|string|max:20',
            'tipe_transmisi' => 'required|string|max:10',
            'id_kendaraan' => 'required|string'
        ]);

        return $this->formatApiResponse($this->penjualanKendaraanService->menambahkanMotor($request), 201);
    }

    public function detailKendaraan($id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->detailKendaraan($id), 200);   
    }
    public function detailMobil($id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->detailMobil($id), 200);   
    }
    public function detailMotor($id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->detailMotor($id), 200);   
    }

    public function updateKendaraan(Request $request, $id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->updateKendaraan($request, $id), 200);   
    }

    public function updateMobil(Request $request, $id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->updateMobil($request, $id), 200);   
    }
    
    public function updateMotor(Request $request, $id)
    {
        return $this->formatApiResponse($this->penjualanKendaraanService->updateMotor($request, $id), 200);   
    }



    // format api dengan dinamis data dan status code
    private function formatApiResponse($data, $statusCode)
    {
        if ($data) {
            return FormatApi::ApiCreate($statusCode, 'Success', $data);
        } else {
            return FormatApi::ApiCreate(400, 'Gagal');
        }
    }
}
