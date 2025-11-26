<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Default password for everyone: 'Password123!'
        $password = password_hash('Password123!', PASSWORD_DEFAULT);

        $users = [
            // --- 1. The Main Admin Account (YOU) ---
            [
                'first_name'      => 'Admin',
                'middle_name'     => null,
                'last_name'       => 'User',
                'email'           => 'admin@retrocrypt.com',
                'password_hash'   => $password,
                'type'            => 'admin', // Full access
                'account_status'  => 1,
                'email_activated' => 1,
                'newsletter'      => 0,
                'gender'          => 'Male',
                'profile_image'   => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            // --- 2. Clients (Buyers & Sellers) ---
            [
                'first_name'      => 'Mario',
                'middle_name'     => null,
                'last_name'       => 'Rossi',
                'email'           => 'mario@nintendo.test',
                'password_hash'   => $password,
                'type'            => 'client',
                'account_status'  => 1,
                'email_activated' => 1,
                'newsletter'      => 1,
                'gender'          => 'Male',
                'profile_image'   => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'first_name'      => 'Lara',
                'middle_name'     => 'C',
                'last_name'       => 'Croft',
                'email'           => 'lara@tomb.test',
                'password_hash'   => $password,
                'type'            => 'client',
                'account_status'  => 1,
                'email_activated' => 0, // Email not verified yet
                'newsletter'      => 0,
                'gender'          => 'Female',
                'profile_image'   => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'first_name'      => 'Sonic',
                'middle_name'     => null,
                'last_name'       => 'Hedgehog',
                'email'           => 'sonic@sega.test',
                'password_hash'   => $password,
                'type'            => 'client',
                'account_status'  => 0, // Banned or inactive user
                'email_activated' => 1,
                'newsletter'      => 1,
                'gender'          => 'Male',
                'profile_image'   => null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];

        // Using table() allows us to insert raw arrays easily
        $this->db->table('users')->insertBatch($users);
    }
}
