<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function rekmed_awal()
    {
        return $this->belongsTo(Rekam_medis::class, 'id_rekmed_awal');
    }
    public function rekmed_berikutnya()
    {
        return $this->belongsTo(Rekam_medis::class, 'id_rekmed_berikutnya');
    }
}
