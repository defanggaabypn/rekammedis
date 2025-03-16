<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_obats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_obat')->unsigned();
            $table->string('tipe');
            $table->integer('jumlah')->default(0);
            $table->integer('stok');
            $table->foreign('id_obat')
                ->references('id')
                ->on('obats')
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
        Schema::dropIfExists('riwayat__obats');
    }
}
