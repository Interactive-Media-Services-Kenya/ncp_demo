<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'first_name'         => 'Stephen',
                'email'              => 'steveowago@gmail.com',
                'password'           => bcrypt('Owagostv@123'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => \Carbon\Carbon::now(),
                'verification_token' => '',
                'phone'              => '254713218312',
                'last_name'          => 'Owago',
            ],
        ];

        User::insert($users);
    }
}
