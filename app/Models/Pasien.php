<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = "pasiens";

    protected $fillable = [
        'nama',
        'NIK',
        'email',
        'tgl_lahir',
        'kelamin',
        'alamat',
        'no_telp',
        'photo',
        'pekerjaan',
        'pj',
    ];

    public function rekam_medis()
    {
        return $this->hasMany(Rekam_medis::class, 'id_pasien', 'id');
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'id_pasien', 'id');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_pasien', 'id');
    }
}
