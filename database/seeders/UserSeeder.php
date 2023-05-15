<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Max',
            'email' => 'max@gmail.com',
            'role' => 0,
            'password' => Hash::make('1234'),
            'email_verified_at' => '2023-05-15 14:53:15'
        ]);;

        User::create([
            'name' => 'Soso',
            'email' => 'soso@gmail.com',
            'role' => 1,
            'password' => Hash::make('1234'),
            'email_verified_at' => '2023-05-15 14:53:16'
        ]);;
    }
}
