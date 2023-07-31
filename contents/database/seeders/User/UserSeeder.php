<?php

namespace Database\Seeders\User;

use App\Domains\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => \Hash::make('password1234')
        ]);
        User::factory()->create([
            'name'              => 'pikimaru',
            'email'             => 'pikimaru@example.com',
            'password'          => \Hash::make('password1234'),
        ]);
    }
}
