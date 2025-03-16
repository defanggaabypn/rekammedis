<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('agenda');
            $table->date('tgl_agenda');
            $table->foreignId('id_pasien')->references('id')->on('pasiens');
            $table->foreignId('id_rekmed_awal')->references('id')->on('rekam_medis');
            $table->foreignId('id_rekmed_berikutnya')->references('id')->on('rekam_medis');
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
        Schema::dropIfExists('jadwals');
    }
}
