<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\UsersModel;
use App\Models\RequestsModel;

class Admin extends BaseController
{

    /**
     * Show the Admin Dashboard page
     */
    public function showDashboardPage()
    {
        try {
            // Initialize models
            $requestModel = new RequestsModel();
            $productModel = new ProductModel();
            $userModel    = new UsersModel();

            // Count active requests (is_active = 1 is used in your Requests table)
            $requestsCount = $requestModel->where('is_active', 1)->countAllResults();

            // Count products (Using is_available as the 'active' metric for products)
            $productsCount = $productModel->where('is_available', 1)->countAllResults();

            // Count active Users
            $usersCount    = $userModel->where('account_status', 1)->countAllResults();
        } catch (\Exception $e) {
            // Fallback in case of errors
            $requestsCount = "Error";
            $productsCount = "Error";
            $usersCount    = 0;
            log_message('error', 'Dashboard Error: ' . $e->getMessage());
        }

        // Load the dashboard view with data
        return view('admin/dashboard', [
            'requestsCount' => $requestsCount,
            'productsCount' => $productsCount,
            'usersCount'    => $usersCount,
            'page_title'    => 'RetroCrypt | Admin Dashboard',
            // Passing 'counts' array as well to support your dashboard.php view structure
            'counts'        => [
                'requests' => $requestsCount,
                'products' => $productsCount,
                'users'    => $usersCount
            ]
        ]);
    }

    public function showProductsPage()
    {
        try {
            $productModel = new ProductModel();

            // Query all non-deleted products
            $products = $productModel
                ->orderBy('id', 'ASC')
                ->findAll();

            // Count all products
            $productsCount = $productModel->countAllResults();

            // Count available products (is_available = 1)
            $availableProductsCount = $productModel
                ->where('is_available', 1)
                ->countAllResults();

            // Count hidden/unavailable products
            $notAvailableProductsCount = $productsCount - $availableProductsCount;
        } catch (\Exception $e) {
            $products = [];
            $productsCount = $availableProductsCount = $notAvailableProductsCount = 0;
            log_message('error', 'Error fetching products: ' . $e->getMessage());
        }

        return view('admin/products', [
            'title' => 'Products',
            'active' => 'products',
            'products' => $products,
            'productsCount' => $productsCount,
            'availableProductsCount' => $availableProductsCount,
            'notAvailableProductsCount' => $notAvailableProductsCount,
        ]);
    }

    public function showAccountsPage()
    {
        try {
            $userModel = new UsersModel();

            // Fetch active user accounts ordered by ID ascending
            $accounts = $userModel
                ->where('account_status', 1)
                ->orderBy('id', 'ASC')
                ->findAll();

            // Count all active accounts
            $accountsCount = $userModel->where('account_status', 1)->countAllResults();

            // Count verified emails
            $verifiedEmailAccountsCount = $userModel
                ->where('account_status', 1)
                ->where('email_activated', 1)
                ->countAllResults();

            $nonVerifiedEmailAccountsCount = $accountsCount - $verifiedEmailAccountsCount;
        } catch (\Exception $e) {
            $accounts = [];
            $accountsCount = $verifiedEmailAccountsCount = $nonVerifiedEmailAccountsCount = 0;
            log_message('error', 'Error fetching accounts: ' . $e->getMessage());
        }

        return view('admin/accounts', [
            'title' => 'Accounts',
            'active' => 'accounts',
            'accounts' => $accounts,
            'accountsCount' => $accountsCount,
            'verifiedEmailAccountsCount' => $verifiedEmailAccountsCount,
            'nonVerifiedEmailAccountsCount' => $nonVerifiedEmailAccountsCount,
        ]);
    }

    public function showInquiriesPage()
    {
        try {
            // --- Load Models ---
            $requestModel = new RequestsModel();
            $productModel = new ProductModel();
            $userModel    = new UsersModel();

            // --- Load Accounts (Active Only) ---
            $accountList = $userModel
                ->where('account_status', 1)
                ->orderBy('id', 'ASC')
                ->findAll();

            // --- Load Products and Map by ID ---
            $products = $productModel->findAll();
            $productMap = [];
            foreach ($products as $product) {
                // Note: RetroCrypt uses 'name', not 'title'
                $productMap[$product['id']] = $product['name'];
            }

            // --- Load Requests with Product Join ---
            // Joining on 'products.name' as product_name
            $requests = $requestModel
                ->select('requests.*, products.name AS product_name')
                ->join('products', 'products.id = requests.product_id', 'left')
                ->where('requests.is_active', 1)
                ->orderBy('requests.id', 'DESC') // Newer requests first usually
                ->findAll();

            // --- Request Counts ---
            $requestsCount = $requestModel
                ->where('is_active', 1)
                ->countAllResults();

            // Count "Pending" Requests
            $pendingRequestsCount = $requestModel
                ->where('is_active', 1)
                ->where('status', 'pending')
                ->countAllResults();
        } catch (\Exception $e) {
            log_message('error', '[AdminController::showInquiriesPage] ' . $e->getMessage());
            $requests = [];
            $requestsCount = $pendingRequestsCount = 0;
            $accountList = [];
        }

        // --- Return the view with all data ---
        return view('admin/inquiries', [
            'requests'             => $requests,
            'requestsCount'        => $requestsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'accountList'          => $accountList,
            // Kept for compatibility with your view structure, though we removed date logic
            'upcomingRequestsCount' => 0
        ]);
    }

    /**
     * Delete a User Account
     */
    public function deleteAccount($id)
    {
        $userModel = new UsersModel();

        if ($userModel->delete($id)) {
            return redirect()->to('/admin/accounts')->with('message', 'User deleted successfully.');
        } else {
            return redirect()->to('/admin/accounts')->with('error', 'Failed to delete user.');
        }
    }

    public function ajaxEditAccount($id = null)
    {
        $userModel = new \App\Models\UsersModel();

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'error' => 'Invalid request']);
        }

        // Validate input (optional but recommended)
        $rules = [
            'first_name' => 'required|min_length[2]',
            'last_name'  => 'required|min_length[2]',
            'email'      => 'required|valid_email',
            'type'       => 'required',
            'account_status' => 'required|in_list[0,1]',
            'gender'     => 'permit_empty|in_list[Male,Female,]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'error' => implode(', ', $this->validator->getErrors())]);
        }

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'type'           => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status'),
            'gender'         => $this->request->getPost('gender'),
        ];

        try {
            $userModel->update($id, $data);
            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
