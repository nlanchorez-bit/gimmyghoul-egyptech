<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\ClearDatabaseSeeder');

        $this->call('UsersSeeder');

        $this->call('ProductsSeeder');

        $this->call('RequestsSeeder');
        $this->call('ProductsReviewSeeder');
    }
}
