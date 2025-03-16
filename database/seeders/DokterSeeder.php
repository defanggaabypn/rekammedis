<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dokter = [
            [
                'nama'      =>  'Dr tirta',
                'tgl_lahir' =>  '2020-01-01',
                'kelamin'   =>  'Laki-Perempuan',
                'email'     =>  'dokter@lshc.com',
                'spesialis' =>  'Senam Jantung',
                'alamat'    =>  'Bandar Lampung',
                'no_telp'   =>  '081124545',
                'alumni'    =>  'yasop',
            ],
            [
                'nama'      =>  'Dr oz',
                'tgl_lahir' =>  '2020-01-01',
                'kelamin'   =>  'Laki-Perempuan',
                'email'     =>  'dokter@lshc.com',
                'spesialis' =>  'Senam Jantung',
                'alamat'    =>  'Bandar Lampung',
                'no_telp'   =>  '081124546',
                'alumni'    =>  'yasop',
            ],
            [
                'nama'      =>  'Dr andus',
                'tgl_lahir' =>  '2020-01-01',
                'kelamin'   =>  'Laki-Perempuan',
                'email'     =>  'dokter@lshc.com',
                'spesialis' =>  'Senam Jantung',
                'alamat'    =>  'Bandar Lampung',
                'no_telp'   =>  '081124547',
                'alumni'    =>  'yasop',
            ],
        ];
        foreach ($dokter as $key => $value) {
            Dokter::create($value);
        }
    }
}
