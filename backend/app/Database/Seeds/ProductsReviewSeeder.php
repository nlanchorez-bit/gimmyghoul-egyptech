<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsReviewSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Users Reference: 2=Mario, 3=Lara, 4=Sonic
        // Products Reference: 1=3DS, 2=Sony Camera, 3=Sega Genesis, 4=iPod

        $data = [
            // 1. Mario loves the Nintendo 3DS (Product ID 1)
            [
                'product_id' => 1,
                'user_id'    => 2, // Mario
                'rating'     => 5,
                'comment'    => 'Mamma mia! This portable console is fantastic. The metallic blue finish is beautiful.',
                'status'     => 'published',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // 2. Lara reviews the Sony Camera (Product ID 2)
            [
                'product_id' => 2,
                'user_id'    => 3, // Lara
                'rating'     => 4,
                'comment'    => 'Great for capturing artifacts on my travels. Compact and durable, though the battery life could be better.',
                'status'     => 'published',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => $now,
            ],

            // 3. Sonic is biased towards Sega (Product ID 3)
            [
                'product_id' => 3,
                'user_id'    => 4, // Sonic
                'rating'     => 5,
                'comment'    => 'Way past cool! This thing runs fast. Best console ever made, hands down.',
                'status'     => 'published',
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => $now,
            ],

            // 4. Lara also bought a 3DS but was critical (Product ID 1)
            [
                'product_id' => 1,
                'user_id'    => 3, // Lara
                'rating'     => 3,
                'comment'    => 'The 3D effect gives me a headache after a while, but the game library is solid.',
                'status'     => 'published',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => $now,
            ],

            // 5. Anonymous Review on iPod (User deleted or Guest) - Product ID 4
            [
                'product_id' => 4,
                'user_id'    => null, // Simulates a user who deleted their account
                'rating'     => 5,
                'comment'    => 'Nothing beats the click wheel. Sound quality is superior to modern phones.',
                'status'     => 'published',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 month')),
                'updated_at' => $now,
            ],

            // 6. Hidden/Pending Review (Spam check example)
            [
                'product_id' => 1,
                'user_id'    => 4, // Sonic
                'rating'     => 1,
                'comment'    => 'Nintendo is too slow!',
                'status'     => 'hidden', // Admin hid this review
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Logic to prevent duplicate seeding
        $db = \Config\Database::connect();
        $builder = $db->table('product_reviews');

        $existing = 0;
        try {
            $existing = $builder->countAllResults();
        } catch (\Throwable $e) {
            $existing = 0;
        }

        if ($existing === 0) {
            $builder->insertBatch($data);
            echo "ProductsReviewSeeder: Seeded " . count($data) . " rows." . PHP_EOL;
        } else {
            echo "ProductsReviewSeeder: Table is not empty, skipping." . PHP_EOL;
        }
    }
}
