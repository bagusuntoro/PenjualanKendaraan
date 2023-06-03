<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use App\Models\Mobil;
use App\Models\Motor;

class ApiTest extends BaseTestCase
{
    use CreatesApplication;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Jalankan migrasi sebelum setiap pengujian
        Artisan::call('migrate');
    }

    /**
     * Rollback migrasi setelah setiap pengujian.
     *
     * @return void
     */
    public function tearDown(): void
    {
        // Rollback migrasi setelah setiap pengujian
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_listKendaraan()
    {
        $response = $this->get('/api/list-kendaraan');

        $response->assertStatus(200);
    }
    public function test_listMobil()
    {
        $response = $this->get('/api/list-mobil');

        $response->assertStatus(200);
    }
    public function test_listMotor()
    {
        $response = $this->get('/api/list-motor');

        $response->assertStatus(200);
    }

    public function test_laporanMobil()
    {
        $response = $this->get('/api/laporan-penjualan-mobil');

        $response->assertStatus(200);
    }

    public function test_laporanMotor()
    {
        $response = $this->get('/api/laporan-penjualan-motor');

        $response->assertStatus(200);
    }

    public function test_detailMobil()
    {
        // Membuat data mobil
        $mobil = Mobil::create([
            'nama_mobil' => 'Mobil Test',
            'mesin' => 'Mesin Test',
            'kapasitas_penumpang' => 4,
            'tipe' => 'Tipe Test',
            'tanggal_terjual' => null,
            'kendaraan_id' => 1,
        ]);

        $response = $this->get('/api/detail-mobil/' . $mobil->id);

        $response->assertStatus(200);
    }
    
    public function test_detailMotor()
    {
        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);

        $response = $this->get('/api/detail-motor/' . $motor->id);

        $response->assertStatus(200);
    }

    public function test_tambahKendaraan()
    {
        $kendaraanData = [
            'tahun_keluaran' => '02-02-2023',
            'warna' => 'black',
            'harga' => 100000000
        ];

        $response = $this->post('/api/kendaraan/', $kendaraanData);

        $response->assertStatus(201);
    }

    public function test_tambahMotor()
    {
        $motorData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->post('/api/motor/', $motorData);

        $response->assertStatus(201);
    }

    public function test_tambahMobil()
    {
        $mobilData = [
            'nama_mobil' => 'test',
            'mesin' => 'test',
            'kapasitas_penumpang' => 8,
            'tipe' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->post('/api/mobil/', $mobilData);

        $response->assertStatus(201);
    }

    public function test_updateMotor()
    {
        // Membuat data motor
        $motor = Motor::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);
        $motorData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => '1'
        ];

        $response = $this->put('/api/update-motor/' . $motor->id, $motorData);

        $response->assertStatus(200);
    }

    public function test_updateMobil()
    {
        // Membuat data mobil
        $mobil = Mobil::create([
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 1
        ]);
        $mobilData = [
            'nama_motor' => 'motor test',
            'mesin' => 'mesin test',
            'tipe_suspensi' => 'test',
            'tipe_transmisi' => 'test',
            'id_kendaraan' => 2
        ];

        $response = $this->put('/api/update-mobil/' . $mobil->id, $mobilData);

        $response->assertStatus(200);
    }
}
