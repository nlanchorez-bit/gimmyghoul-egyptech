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
            $requestModel = new RequestsModel();
            $productModel = new ProductModel();

            // Count active requests and products
            $requestsCount = $requestModel->where('is_active', 1)->countAllResults();
            $productsCount = $productModel->where('is_active', 1)->countAllResults();
        } catch (\Exception $e) {
            // Fallback in case of errors
            $requestsCount = "Server Issue: " . $e->getMessage();
            $productsCount = "Server Issue: " . $e->getMessage();
        }

        // Load the dashboard view with data
        return view('/admin/dashboard', [
            'requestsCount' => $requestsCount,
            'productsCount' => $productsCount,
        ]);
    }

    public function showProductsPage()
    {
        try {
            // Persist product to database using ProductModel
            $productModel = new ProductModel();

            // Query all products that are active
            $products = $productModel
                ->where('is_active', 1)
                ->orderBy('id', 'ASC')
                ->findAll();

            // Count all active products
            $productsCount = $productModel
                ->where('is_active', 1)
                ->countAllResults();

            // Count available products
            $availableProductsCount = $productModel
                ->where('is_active', 1)
                ->where('is_available', 1)
                ->countAllResults();

            // Count not available products
            $notAvailableProductsCount = $productsCount - $availableProductsCount;
        } catch (\Exception $e) {
            // Handle errors gracefully
            $products = [];
            $productsCount = $availableProductsCount = $notAvailableProductsCount = 0;
            log_message('error', 'Error fetching products: ' . $e->getMessage());
        }

        // Load the admin/products view
        return view('/admin/products', [
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
            // Initialize UsersModel
            $userModel = new UsersModel();

            // Fetch active user accounts ordered by ID ascending
            $accounts = $userModel
                ->where('account_status', 1)
                ->orderBy('id', 'ASC')
                ->findAll();

            // Count all active accounts
            $accountsCount = $userModel->where('account_status', 1)->countAllResults();

            // Count verified and non-verified email accounts
            $verifiedEmailAccountsCount = $userModel
                ->where('account_status', 1)
                ->where('email_activated', 1)
                ->countAllResults();

            $nonVerifiedEmailAccountsCount = $accountsCount - $verifiedEmailAccountsCount;
        } catch (\Exception $e) {
            // Handle errors gracefully
            $accounts = [];
            $accountsCount = $verifiedEmailAccountsCount = $nonVerifiedEmailAccountsCount = 0;
            log_message('error', 'Error fetching accounts: ' . $e->getMessage());
        }

        // Load the admin/accounts view
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
                $productMap[$product->id] = $product->title;
            }

            // --- Load Requests with Product Join ---
            $requests = $requestModel
                ->select('requests.*, products.title AS product_name')
                ->join('products', 'products.id = requests.product_id', 'left')
                ->where('requests.is_active', 1)
                ->orderBy('requests.id', 'ASC')
                ->findAll();

            // --- Attach Product Names ---
            foreach ($requests as &$request) {
                $request['product_name'] = $productMap[$request['product_id']] ?? 'Unknown';
            }
            unset($request);

            // --- Request Counts ---
            $requestsCount = $requestModel
                ->where('is_active', 1)
                ->countAllResults();

            $today = date('Y-m-d');
            $upcomingRequestsCount = $requestModel
                ->where('is_active', 1)
                ->where('preferred_date >=', $today)
                ->countAllResults();

            $pendingRequestsCount = $requestModel
                ->where('is_active', 1)
                ->groupStart()
                ->where('status', 'pending')
                ->orWhere('status', 0)
                ->groupEnd()
                ->countAllResults();
        } catch (\Exception $e) {
            // Optional: Log the error for debugging
            log_message('error', '[AdminController::showInquiriesPage] ' . $e->getMessage());
            $requests = [];
            $requestsCount = $upcomingRequestsCount = $pendingRequestsCount = 0;
            $accountList = [];
        }

        // --- Return the view with all data ---
        return view('admin/inquiries', [
            'requests'                => $requests,
            'requestsCount'           => $requestsCount,
            'upcomingRequestsCount'   => $upcomingRequestsCount,
            'pendingRequestsCount'    => $pendingRequestsCount,
            'accountList'             => $accountList
        ]);
    }
}
