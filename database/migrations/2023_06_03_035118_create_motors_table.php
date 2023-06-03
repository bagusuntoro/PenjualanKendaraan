<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $collection) {
            $collection->id();
            $collection->string('nama_motor', 15);
            $collection->string('mesin', 10);
            $collection->string('tipe_suspensi', 20);
            $collection->string('tipe_transmisi', 10);
            $collection->enum('status',['ready', 'terjual'])->default('ready'); 
            $collection->date('tanggal_terjual'); 
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
        Schema::dropIfExists('motors');
    }
}
