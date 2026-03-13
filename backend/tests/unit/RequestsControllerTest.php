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
 * @internal
 */
final class RequestsControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    // Automated Database Setup for SQLite :memory:
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
        // 1. Create Users and VERIFY they inserted successfully
        $userModel = new UsersModel(); 

        $userId1 = $userModel->insert([
            'first_name'    => 'Alice',
            'last_name'     => 'User',
            'email'         => 'alice@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active',
        ]);
        $this->assertNotFalse($userId1, 'User 1 insert failed: ' . print_r($userModel->errors(), true));

        $userId2 = $userModel->insert([
            'first_name'    => 'Bob',
            'last_name'     => 'Other',
            'email'         => 'bob@example.com',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'account_status'=> 'active',
        ]);
        $this->assertNotFalse($userId2, 'User 2 insert failed: ' . print_r($userModel->errors(), true));

        // 2. Create a product and VERIFY it inserted successfully
        $product = new ProductModel();
        $pid = $product->insert([
            'name'         => 'Test Product',
            'slug'         => 'test-product',
            'category'     => 'test',
            'price'        => 10,
            'stock'        => 100,
            'is_available' => 1, // Satisfies the model's validation rule
        ]);
        $this->assertNotFalse($pid, 'Product insert failed: ' . print_r($product->errors(), true));

        // 3. Create the requests
        $requests = new RequestsModel();
        
        $req1 = $requests->insert([
            'product_id' => $pid,
            'user_id'    => $userId1, 
            'first_name' => 'Alice',
            'last_name'  => 'User',
            'phone'      => '123',
            'email'      => 'alice@example.com',
            'quantity'   => 1,
            'status'     => 'pending',
            'is_active'  => 1,
        ]);
        $this->assertNotFalse($req1, 'Request 1 insert failed: ' . print_r($requests->errors(), true));
        
        $req2 = $requests->insert([
            'product_id' => $pid,
            'user_id'    => $userId2, 
            'first_name' => 'Bob',
            'last_name'  => 'Other',
            'phone'      => '456',
            'email'      => 'bob@example.com',
            'quantity'   => 2,
            'status'     => 'pending',
            'is_active'  => 1,
        ]);
        $this->assertNotFalse($req2, 'Request 2 insert failed: ' . print_r($requests->errors(), true));

        // 4. Update session data
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
