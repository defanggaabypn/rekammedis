<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = "dokters";

    protected $fillable = [
        'nama',
        'tgl_lahir',
        'kelamin',
        'spesialis',
        'alamat',
        'no_telp',
        'email',
        'alumni',
    ];

    public function rekam_medis()
    {
        return $this->hasMany(Rekam_medis::class, 'id_dokter', 'id');
    }
}
