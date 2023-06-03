<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $table = 'motors';

    protected $fillable = [
        'nama_motor',
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'status',
        'tanggal_terjual',
        'id_kendaraan'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
