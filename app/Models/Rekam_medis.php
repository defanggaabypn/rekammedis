<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekam_medis extends Model
{
    use HasFactory;

    protected $table = "rekam_medis";

    protected $fillable = [
        'no_bag_rekmed',
        'subyektif',
        'obyektif',
        'asessment',
        'plan',
        'diagnosis',
        'tensi',
        'nadi',
        'nafas',
        'bmi',
        'suhu',
        'berat',
        'tinggi',
        'tindakan',
        'tgl_rekam',
        'id_dokter',
        'id_pasien',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'relasi_obats', 'id_rekam_medis', 'id_obat')->withPivot('jumlah', 'signa', 'nama');
    }

    // public function tindakan()
    // {
    //     return $this->belongsToMany(Tindakan::class, 'relasi_tindakans', 'id_rekam_medis', 'id_tindakan');
    // }

    // public function diagnosa()
    // {
    //     return $this->belongsToMany(Diagnosa::class, 'relasi_diagnosa', 'id_rekam_medis', 'id_diagnosa');
    // }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
}
