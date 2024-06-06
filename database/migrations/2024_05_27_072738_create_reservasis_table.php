<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_reservasi');
            $table->integer('jumlah_orang');
            $table->bigInteger('id_pengunjung')->unsigned();
            $table->foreign('id_pengunjung')->references('id')->on('pengunjungs')->ondelete('cascade');
            $table->bigInteger('id_destinasi')->unsigned();
            $table->foreign('id_destinasi')->references('id')->on('destinasis')->ondelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
