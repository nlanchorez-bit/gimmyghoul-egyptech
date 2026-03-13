<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\RequestsModel;
use App\Models\ProductModel;

/**
 * Basic tests for the Requests controller history() action.
 *
 * These are not exhaustive but ensure the page is protected and
 * only shows requests belonging to the signed‑in user.
 *
 * @internal
 */
final class RequestsControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        // make sure table exists (migrations should normally handle this)
        // and clear any leftover rows so tests are idempotent
        $this->resetDatabase();
    }

    private function resetDatabase()
    {
        // this helper comes from ExampleDatabaseTest and is available
        // because our phpunit.xml config loads \Tests\Support\Traits\DatabaseTrait
        // (see ExampleDatabaseTest for reference). If this isn't wired
        // up yet you can manually truncate.
        $db = \Config\Database::connect();
        $db->table('requests')->truncate();
        $db->table('products')->truncate();
    }

    public function testHistoryRequiresLogin()
    {
        $result = $this->get('/orders');
        $result->assertRedirectTo('/login');
    }

    public function testHistoryShowsOnlyUserOrders()
    {
        // 1. Create users using your exact UsersModel and allowed fields
        $userModel = new \App\Models\UsersModel(); 

        $userId1 = $userModel->insert([
            'first_name'    => 'Alice',
            'last_name'     => 'User',
            'email'         => 'alice@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active', // Optional: added just in case your DB requires it
        ]);

        $userId2 = $userModel->insert([
            'first_name'    => 'Bob',
            'last_name'     => 'Other',
            'email'         => 'bob@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active',
        ]);

        // 2. Create a product to satisfy the join on product_id
        $product = new \App\Models\ProductModel();
        $pid = $product->insert([
            'name'     => 'Test Product',
            'slug'     => 'test-product',
            'category' => 'test',
            'price'    => 10,
            'stock'    => 100,
        ]);

        // 3. Create the requests using the dynamically generated user IDs
        $requests = new \App\Models\RequestsModel();
        
        $requests->insert([
            'product_id' => $pid,
            'user_id'    => $userId1, // Matches Alice's dynamic ID
            'first_name' => 'Alice',
            'last_name'  => 'User',
            'phone'      => '123',
            'email'      => 'alice@example.com',
            'quantity'   => 1,
            'status'     => 'pending',
            'is_active'  => 1,
        ]);
        
        $requests->insert([
            'product_id' => $pid,
            'user_id'    => $userId2, // Matches Bob's dynamic ID
            'first_name' => 'Bob',
            'last_name'  => 'Other',
            'phone'      => '456',
            'email'      => 'bob@example.com',
            'quantity'   => 2,
            'status'     => 'pending',
            'is_active'  => 1,
        ]);

        // 4. Update session data to use Alice's dynamic user ID
        $sessionData = ['user' => ['id' => $userId1, 'email' => 'alice@example.com']];

        // 5. Execute the request and assert the results
        $result = $this->withSession($sessionData)->get('/orders');
        $result->assertOK();
        $result->assertSee('My Orders');
        $result->assertSee('Test Product');
        $result->assertSee('Alice');
        $result->assertDontSee('Bob');
    }
