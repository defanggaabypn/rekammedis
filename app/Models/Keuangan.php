<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = "keuangans";

    protected $fillable = [
        'jumlah',
        'tanggal',
    ];
}
