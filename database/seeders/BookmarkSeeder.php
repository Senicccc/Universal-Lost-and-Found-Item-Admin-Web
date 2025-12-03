<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bookmarks')->insert([
            [ 'user_id' => 1, 'item_id' => 3 ],
            [ 'user_id' => 2, 'item_id' => 1 ],
            [ 'user_id' => 3, 'item_id' => 5 ],
            [ 'user_id' => 4, 'item_id' => 2 ],
            [ 'user_id' => 5, 'item_id' => 4 ],
        ]);
    }
}