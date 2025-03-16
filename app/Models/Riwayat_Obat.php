<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_Obat extends Model
{
    use HasFactory;

    protected $table = "riwayat_obats";

    protected $fillable = [
        'tipe',
        'jumlah',
        'stok'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
