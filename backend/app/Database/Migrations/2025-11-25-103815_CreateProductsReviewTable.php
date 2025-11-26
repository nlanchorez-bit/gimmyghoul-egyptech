<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductReviewsTable extends Migration
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
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Nullable to keep reviews if user is deleted
            ],
            'rating' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 5, // 1 to 5 scale
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'published', // published, pending, hidden
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
        $this->forge->addKey('product_id'); // Index for faster retrieval of reviews per product

        // --- FOREIGN KEYS ---

        // Link to Products Table
        // ON DELETE CASCADE: If the product is deleted, delete all its reviews
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');

        // Link to Users Table
        // ON DELETE SET NULL: If user is deleted, keep the review but set user_id to NULL
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');

        $this->forge->createTable('product_reviews', true);
    }

    public function down()
    {
        $this->forge->dropTable('product_reviews', true);
    }
}
