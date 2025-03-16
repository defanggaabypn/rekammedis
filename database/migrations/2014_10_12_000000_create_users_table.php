<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->default('/plugins/images/users/d1.jpg');
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('spesialis')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_telp2')->nullable();
            $table->string('kokab_nama')->nullable();
            $table->string('email')->nullable();
            $table->string('alumni')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'photo', 
                'jenis_kelamin', 
                'tanggal_lahir', 
                'spesialis', 
                'no_telp', 
                'no_telp2', 
                'kokab_nama', 
                'email', 
                'alumni', 
                'pekerjaan', 
                'alamat'
            ]);
        });
    }
}