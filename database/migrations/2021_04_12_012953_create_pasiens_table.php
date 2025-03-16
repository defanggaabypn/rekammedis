<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('NIK');
            $table->string('email')->nullable();
            $table->date('tgl_lahir');
            $table->string('kelamin');
            // $table->string('alamat');
            $table->string('no_telp', 12);
            $table->string('photo')->default('../plugins/images/users/d1.jpg');
            $table->string('pekerjaan');
            $table->string('pj')->default(null);
            $table->string('no_rekmed')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
}
