<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'nama'     => 'Ackrya Sibarani',
                'username' => 'ackyras',
                // 'email' => 'ackyrasibarani@gmail.com',
                'role' => 'superadmin',
                'password' => bcrypt('lshc'),
            ],
            [
                'nama'     => 'Superadmin',
                'username' => 'superadmin',
                // 'email' => 'ackyrasibarani2@gmail.com',
                'role' => 'superadmin',
                'password' => bcrypt('lshc'),
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
