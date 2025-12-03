<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'name' => 'Michael Anderson',
                'email' => 'michael@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'David Thompson',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Emily Carter',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james@example.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}