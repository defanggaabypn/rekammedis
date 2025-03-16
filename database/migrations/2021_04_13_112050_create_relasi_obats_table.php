<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasiObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasi_obats', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->string('nama');
            $table->string('signa');
            $table->bigInteger('id_rekam_medis')->unsigned();
            $table->bigInteger('id_obat')->unsigned();
            $table->timestamps();
            $table->foreign('id_rekam_medis')
                ->references('id')
                ->on('rekam_medis')
                ->onDelete('cascade');
            $table->foreign('id_obat')
                ->references('id')
                ->on('obats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi_obats');
    }
}
