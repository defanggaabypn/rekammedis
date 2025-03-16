<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_bag_rekmed')->nullable();
            $table->text('subyektif')->nullable();
            $table->text('obyektif')->nullable();
            $table->text('asessment')->nullable();
            $table->text('plan')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('tensi')->nullable();
            $table->string('nadi')->nullable();
            $table->string('nafas')->nullable();
            $table->string('suhu')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('bmi')->nullable();
            $table->integer('berat')->nullable();
            $table->integer('tinggi')->nullable();
            $table->date('tgl_rekam')->nullable();
            $table->boolean('status')->default(false);
            $table->bigInteger('id_dokter')->unsigned();
            $table->foreign('id_dokter')
                ->references('id')
                ->on('dokters')
                ->onDelete('cascade');
            $table->bigInteger('id_pasien')->unsigned();
            $table->foreign('id_pasien')
                ->references('id')
                ->on('pasiens')
                ->onDelete('cascade');
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
        Schema::dropIfExists('rekam_medis');
    }
}
