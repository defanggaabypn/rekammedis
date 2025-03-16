<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = "obats";

    protected $fillable = [
        'nama',
        'pabrikan',
        'golongan',
        'stok',
    ];

    public function rekam_medis()
    {
        return $this->belongsToMany(Rekam_medis::class, 'relasi_obats', 'id_obat', 'id_rekam_medis')->withPivot('jumlah', 'signa', 'nama');
    }

    public function riwayat_obat()
    {
        return $this->hasMany(Riwayat_Obat::class, 'id_obat', 'id');
    }
}
