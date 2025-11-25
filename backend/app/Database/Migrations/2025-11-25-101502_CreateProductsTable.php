<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true, // Useful for SEO friendly URLs
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // e.g., 'Console', 'Camera', 'MP3 Player'
            ],
            'brand' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // e.g., 'Nintendo', 'Sony', 'Kodak'
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'condition' => [
                'type'       => 'VARCHAR', // e.g., 'Mint', 'Used', 'Refurbished'
                'constraint' => 50,
                'default'    => 'Used',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2', // Allows for cents, e.g., 150.00
                'unsigned'   => true,
                'default'    => 0.00,
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'is_available' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = Available, 0 = Hidden
            ],
            'inclusions' => [
                'type' => 'TEXT', // e.g., 'Charger, Stylus, 4GB Memory Card'
                'null' => true,
            ],
            'main_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // Links to the User who uploaded it
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('slug'); // Index for faster searching
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
