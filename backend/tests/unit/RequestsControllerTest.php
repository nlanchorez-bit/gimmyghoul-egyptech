<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
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
    use DatabaseTestTrait;

    // Automatically run migrations before the first test
    protected $migrate     = true;
    // Automatically clear/refresh the database between tests
    protected $refresh     = true;
    // Use the 'tests' group from your database.php
    protected $DBGroup     = 'tests';
    // Ensure this matches the namespace of your migrations (usually 'App')
    protected $namespace   = 'App';

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
        // create a product to satisfy the join
        $product = new ProductModel();
        $pid = $product->insert([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'category' => 'test',
            'price' => 10,
            'stock' => 100,
        ]);

        $requests = new RequestsModel();
        $requests->insert([
            'product_id' => $pid,
            'user_id'    => 1,
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
            'user_id'    => 2,
            'first_name' => 'Bob',
            'last_name'  => 'Other',
            'phone'      => '456',
            'email'      => 'bob@example.com',
            'quantity'   => 2,
            'status'     => 'pending',
            'is_active'  => 1,
        ]);

        $sessionData = ['user' => ['id' => 1, 'email' => 'alice@example.com']];

        $result = $this->withSession($sessionData)->get('/orders');
        $result->assertOK();
        $result->assertSee('My Orders');
        $result->assertSee('Test Product');
        $result->assertSee('Alice');
        $result->assertDontSee('Bob');
    }
}
