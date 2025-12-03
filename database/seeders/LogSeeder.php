<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('logs')->insert([
            [
                'user_id' => 1,
                'action' => 'User "Michael Anderson" added a found item: Black Leather Wallet',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'action' => 'User "Sarah Johnson" added a found item: Motorcycle Key',
                'created_at' => now(),
            ],
            [
                'user_id' => 3,
                'action' => 'User "David Thompson" bookmarked item ID 5',
                'created_at' => now(),
            ],
            [
                'user_id' => 4,
                'action' => 'User "Emily Carter" viewed item details for ID 2',
                'created_at' => now(),
            ],
            [
                'user_id' => null,
                'action' => 'System initialized database seeders',
                'created_at' => now(),
            ],
        ]);
    }
}