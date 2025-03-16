<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = "diagnosas";

    public function rekam_medis(){
        return $this->belongsToMany(Rekam_medis::class, 'relasi_diagnosa', 'id_diagnosa', 'id_rekam_medis');
    }
}
