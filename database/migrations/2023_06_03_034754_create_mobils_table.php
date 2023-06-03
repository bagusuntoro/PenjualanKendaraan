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
            $collection->index('id');
            $collection->string('nama_mobil', 15);
            $collection->string('mesin', 10);
            $collection->integer('kapasitas_penumpang');
            $collection->string('tipe', 10);
            $collection->string('status');
            $collection->date('tanggal_terjual')->nullable();
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
