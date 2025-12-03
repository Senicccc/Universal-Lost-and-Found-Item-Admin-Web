<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('items')->insertOrIgnore([
            [
                'user_id' => 1,
                'title' => 'Black Leather Wallet',
                'description' => 'Found near the university parking area. Contains several cards.',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'address' => 'Jl. Dipatiukur No. 12',
                'image_url' => '/storage/images/item1.jpg',
                'status' => 'unclaimed',
            ],
            [
                'user_id' => 2,
                'title' => 'Motorcycle Key with Keychain',
                'description' => 'Key with a small blue keychain found inside the cafeteria.',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'address' => 'Jl. Ir. H. Juanda (Dago) No. 48',
                'image_url' => '/storage/images/item2.jpg',
                'status' => 'unclaimed',
            ],
            [
                'user_id' => 3,
                'title' => 'JBL Black Earphones',
                'description' => 'Still functioning properly. Found in classroom 204.',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'address' => 'Jl. Tamansari No. 72',
                'image_url' => '/storage/images/item3.jpg',
                'status' => 'unclaimed',
            ],
            [
                'user_id' => 4,
                'title' => 'Student ID Card',
                'description' => 'Found in the auditorium hallway. Belongs to “Ryan Miller”.',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'address' => 'Taman Kampus Utara',
                'image_url' => '/storage/images/item4.jpg',
                'status' => 'unclaimed',
            ],
            [
                'user_id' => 5,
                'title' => 'Black Umbrella',
                'description' => 'Left around the library waiting area.',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'address' => 'Jl. Ganesa No. 10',
                'image_url' => '/storage/images/item5.jpg',
                'status' => 'unclaimed',
            ],
        ]);
    }
}