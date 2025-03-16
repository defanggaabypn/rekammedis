<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pasien')->unsigned();
            $table->bigInteger('id_rekmed')->unsigned();
            $table->date('tgl_antri');
            $table->boolean('status')->default(false);
            $table->foreign('id_pasien')
                ->references('id')
                ->on('pasiens')
                ->delete('cascade');
            $table->foreign('id_rekmed')
                ->references('id')
                ->on('rekam_medis')
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
        Schema::dropIfExists('antrians');
    }
}
