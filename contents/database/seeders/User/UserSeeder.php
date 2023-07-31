<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name'              => 'admin',
                'email'             => 'admin@example.com',
                'password'          => \Hash::make('password1234'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'pikimaru',
                'email'             => 'pikimaru@example.com',
                'password'          => \Hash::make('password1234'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
