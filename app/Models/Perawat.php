<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    use HasFactory;

    protected $table = 'perawats';

    protected $fillable=[
        'nama',
        'tgl_lahir',
        'kelamin',
        'alamat',
        'no_telp',
        'email',
        'alumni',
        'photo',
    ];
}
