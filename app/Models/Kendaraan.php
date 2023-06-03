<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga',
    ];

    public function motor()
    {
        return $this->hasOne(Motor::class);
    }

    public function mobil()
    {
        return $this->hasOne(Mobil::class);
    }
}
