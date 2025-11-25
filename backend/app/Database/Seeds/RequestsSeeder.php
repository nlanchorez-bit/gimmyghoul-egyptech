<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // E-Commerce Statuses
        $statuses = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled', 'returned'];

        // Users Reference (Based on UsersSeeder):
        // 1: Admin
        // 2: Mario (Active Client)
        // 3: Lara (Unverified Client)
        // 4: Sonic (Banned Client)

        $data = [
            // 1. Mario buys a Nintendo Console (Product ID 1) - Pending
            [
                'product_id'          => 1,
                'user_id'             => 2, // Mario
                'first_name'          => 'Mario',
                'last_name'           => 'Rossi',
                'phone'               => '09171234567',
                'email'               => 'mario@nintendo.test',
                'quantity'            => 1,
                'additional_requests' => 'Please include original box.',
                'status'              => 'pending',
                'is_active'           => 1,
                'created_at'          => $now,
                'updated_at'          => $now,
            ],

            // 2. Lara buys a Camera (Product ID 2) - Shipped
            [
                'product_id'          => 2,
                'user_id'             => 3, // Lara
                'first_name'          => 'Lara',
                'last_name'           => 'Croft',
                'phone'               => '09170001111',
                'email'               => 'lara@tomb.test',
                'quantity'            => 1,
                'additional_requests' => null,
                'status'              => 'shipped',
                'is_active'           => 1,
                'created_at'          => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'          => $now,
            ],

            // 3. Guest Checkout (No User ID) - Delivered
            [
                'product_id'          => 1,
                'user_id'             => null, // Guest
                'first_name'          => 'John',
                'last_name'           => 'Doe',
                'phone'               => '09172223333',
                'email'               => 'guest@example.com',
                'quantity'            => 1,
                'additional_requests' => 'Leave at front door.',
                'status'              => 'delivered',
                'is_active'           => 1,
                'created_at'          => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at'          => $now,
            ],

            // 4. Sonic tries to buy something - Cancelled
            [
                'product_id'          => 3,
                'user_id'             => 4, // Sonic
                'first_name'          => 'Sonic',
                'last_name'           => 'Hedgehog',
                'phone'               => '09179998888',
                'email'               => 'sonic@sega.test',
                'quantity'            => 2,
                'additional_requests' => 'Fast delivery please!',
                'status'              => 'cancelled',
                'is_active'           => 1,
                'created_at'          => date('Y-m-d H:i:s', strtotime('-1 month')),
                'updated_at'          => $now,
            ],
        ];

        // Logic to prevent duplicate seeding
        $db = \Config\Database::connect();
        $builder = $db->table('requests');

        $existing = 0;
        try {
            // Check if table is already populated
            $existing = $builder->countAllResults();
        } catch (\Throwable $e) {
            $existing = 0;
        }

        if ($existing === 0) {
            $builder->insertBatch($data);
            echo "RequestsSeeder: Seeded " . count($data) . " rows." . PHP_EOL;
        } else {
            echo "RequestsSeeder: Table is not empty, skipping." . PHP_EOL;
        }
    }
}
