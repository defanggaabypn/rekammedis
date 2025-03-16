<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $table = "tindakans";

    public function rekam_medis(){
        return $this->belongsToMany(Rekam_medis::class, 'relasi_tindakans', 'id_tindakan', 'id_rekam_medis');
    }
}
