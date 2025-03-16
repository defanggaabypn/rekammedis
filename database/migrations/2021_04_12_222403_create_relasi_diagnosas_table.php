<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasiDiagnosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasi_diagnosas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rekam_medis')->unsigned();
            $table->bigInteger('id_diagnosa')->unsigned();
            $table->timestamps();
            $table->foreign('id_rekam_medis')
                ->references('id')
                ->on('rekam_medis')
                ->onDelete('cascade');
            $table->foreign('id_diagnosa')
                ->references('id')
                ->on('diagnosas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi_diagnosas');
    }
}
