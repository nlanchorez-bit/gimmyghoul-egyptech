<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\RequestsModel;
use App\Models\ProductModel;
use App\Models\UsersModel;

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
    use DatabaseTestTrait; // This handles all the database setup/teardown now

    // Tell CI4 to run migrations and refresh the DB automatically
    protected $migrate   = true;
    protected $refresh   = true;
    protected $DBGroup   = 'tests';
    protected $namespace = 'App';

    public function testHistoryRequiresLogin()
    {
        $result = $this->get('/orders');
        $result->assertRedirectTo('/login');
    }

    public function testHistoryShowsOnlyUserOrders()
    {
        // 1. Create the Users to satisfy the Foreign Key constraint
        $userModel = new UsersModel(); 

        $userId1 = $userModel->insert([
            'first_name'    => 'Alice',
            'last_name'     => 'User',
            'email'         => 'alice@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active',
        ]);

        $userId2 = $userModel->insert([
            'first_name'    => 'Bob',
            'last_name'     => 'Other',
            'email'         => 'bob@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active',
        ]);

        // 2. Create a product to satisfy the join
        $product = new ProductModel();
        $pid = $product->insert([
            'name'     => 'Test Product',
            'slug'     => 'test-product',
            'category' => 'test',
            'price'    => 10,
            'stock'    => 100,
        ]);

        // 3. Create the requests using the dynamically generated IDs
        $requests = new RequestsModel();
        
        $requests->insert([
            'product_id' => $pid,
            'user_id'    => $userId1, // Uses Alice's dynamic ID
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
            'user_id'    => $userId2, // Uses Bob's dynamic ID
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
}
