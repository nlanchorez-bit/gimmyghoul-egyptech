<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // We assume User ID 1 is the Admin who lists these products
        $adminId = 1;

        $data = [
            // ID 1: Nintendo 3DS XL (Linked to Request #1 & #3)
            [
                'name'         => 'Nintendo 3DS XL - Metallic Blue',
                'slug'         => 'nintendo-3ds-xl-metallic-blue',
                'category'     => 'Console',
                'brand'        => 'Nintendo',
                'description'  => 'A classic handheld console in excellent condition. Plays all 3DS and DS games.',
                'condition'    => 'Used',
                'price'        => 150.00,
                'stock'        => 5,
                'is_available' => 1,
                'inclusions'   => 'Stylus, Charger, 4GB SD Card',
                'main_image'   => '3ds_blue.jpg',
                'created_by'   => $adminId,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

            // ID 2: Sony Cyber-shot (Linked to Request #2)
            [
                'name'         => 'Sony Cyber-shot DSC-W830',
                'slug'         => 'sony-cyber-shot-dsc-w830',
                'category'     => 'Camera',
                'brand'        => 'Sony',
                'description'  => 'Compact digital camera, perfect for that 2000s vintage aesthetic.',
                'condition'    => 'Refurbished',
                'price'        => 85.50,
                'stock'        => 2,
                'is_available' => 1,
                'inclusions'   => 'Battery, Wrist Strap',
                'main_image'   => 'sony_cybershot.jpg',
                'created_by'   => $adminId,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

            // ID 3: Sega Genesis Mini (Linked to Request #4)
            [
                'name'         => 'Sega Genesis Mini',
                'slug'         => 'sega-genesis-mini',
                'category'     => 'Console',
                'brand'        => 'Sega',
                'description'  => 'The iconic console that defined a generation of gaming.',
                'condition'    => 'Mint',
                'price'        => 99.99,
                'stock'        => 10,
                'is_available' => 1,
                'inclusions'   => '2 Controllers, HDMI Cable, Power Adapter',
                'main_image'   => 'sega_genesis.jpg',
                'created_by'   => $adminId,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

            // ID 4: iPod Classic (No active requests yet)
            [
                'name'         => 'Apple iPod Classic 6th Gen (160GB)',
                'slug'         => 'apple-ipod-classic-6th-gen',
                'category'     => 'MP3 Player',
                'brand'        => 'Apple',
                'description'  => 'Massive storage for your entire music library. Silver finish.',
                'condition'    => 'Used',
                'price'        => 120.00,
                'stock'        => 3,
                'is_available' => 1,
                'inclusions'   => 'USB Cable',
                'main_image'   => 'ipod_classic.jpg',
                'created_by'   => $adminId,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],

            // ID 5: Game Boy Advance SP (No active requests yet)
            [
                'name'         => 'Game Boy Advance SP - Tribal Edition',
                'slug'         => 'gba-sp-tribal',
                'category'     => 'Console',
                'brand'        => 'Nintendo',
                'description'  => 'Backlit screen flip-model. The shell has some scratches but works perfectly.',
                'condition'    => 'Used',
                'price'        => 75.00,
                'stock'        => 1,
                'is_available' => 1,
                'inclusions'   => 'Charger',
                'main_image'   => 'gba_sp_tribal.jpg',
                'created_by'   => $adminId,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ];

        // Logic to prevent duplicate seeding
        $db = \Config\Database::connect();
        $builder = $db->table('products');

        $existing = 0;
        try {
            $existing = $builder->countAllResults();
        } catch (\Throwable $e) {
            $existing = 0;
        }

        if ($existing === 0) {
            $builder->insertBatch($data);
            echo "ProductsSeeder: Seeded " . count($data) . " rows." . PHP_EOL;
        } else {
            echo "ProductsSeeder: Table is not empty, skipping." . PHP_EOL;
        }
    }
}
