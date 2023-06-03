<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobils', function (Blueprint $collection) {
            $collection->id();
            $collection->string('nama_mobil', 15);
            $collection->string('mesin', 10);
            $collection->int('kapasitas_penumpang', 2);
            $collection->string('tipe', 10);
            $collection->enum('status',['ready', 'terjual'])->default('ready'); 
            $collection->date('tanggal_terjual')->default(null); 
            $collection->foreignId('kendaraan_id')->constrained('kendaraans');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobils');
    }
}
