<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\UsersModel;
use App\Models\RequestsModel;

class Admin extends BaseController
{
    /**
     * 1. Show Dashboard
     */
    public function showDashboardPage()
    {
        try {
            $requestModel = new RequestsModel();
            $productModel = new ProductModel();
            $userModel    = new UsersModel();

            // Count active data
            $requestsCount = $requestModel->where('is_active', 1)->countAllResults();
            $productsCount = $productModel->where('is_available', 1)->countAllResults();
            $usersCount    = $userModel->where('account_status', 1)->countAllResults();
        } catch (\Exception $e) {
            $requestsCount = 0;
            $productsCount = 0;
            $usersCount    = 0;
            log_message('error', 'Dashboard Error: ' . $e->getMessage());
        }

        return view('admin/dashboard', [
            'requestsCount' => $requestsCount,
            'productsCount' => $productsCount,
            'usersCount'    => $usersCount,
            'page_title'    => 'RetroCrypt | Admin Dashboard',
            'counts'        => [
                'requests' => $requestsCount,
                'products' => $productsCount,
                'users'    => $usersCount
            ]
        ]);
    }

    /**
     * 2. Show Products Management
     */
    public function showProductsPage()
    {
        try {
            $productModel = new ProductModel();

            $products = $productModel->orderBy('id', 'ASC')->findAll();

            // Stats
            $productsCount = $productModel->countAllResults();
            $availableProductsCount = $productModel->where('is_available', 1)->countAllResults();
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

    /**
     * 3. Show Accounts/Users Management
     */
    public function showAccountsPage()
    {
        try {
            $userModel = new UsersModel();

            $accounts = $userModel->where('account_status', 1)->orderBy('id', 'ASC')->findAll();

            $accountsCount = $userModel->where('account_status', 1)->countAllResults();
            $verifiedEmailAccountsCount = $userModel->where('account_status', 1)->where('email_activated', 1)->countAllResults();
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

    /**
     * 4. Show Requests (Inbox)
     */
    public function showInquiriesPage()
    {
        try {
            $requestModel = new RequestsModel();
            $productModel = new ProductModel();
            $userModel    = new UsersModel();

            // Fetch Requests with Product Name details
            $requests = $requestModel
                ->select('requests.*, products.name AS product_name, products.price, products.main_image')
                ->join('products', 'products.id = requests.product_id', 'left')
                ->where('requests.is_active', 1)
                ->orderBy('requests.created_at', 'DESC')
                ->findAll();

            // Stats
            $requestsCount = count($requests);
            $pendingRequestsCount = $requestModel->where('status', 'pending')->countAllResults();
        } catch (\Exception $e) {
            log_message('error', 'Admin Inquiries Error: ' . $e->getMessage());
            $requests = [];
            $requestsCount = $pendingRequestsCount = 0;
        }

        return view('admin/inquiries', [
            'requests'             => $requests,
            'requestsCount'        => $requestsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
        ]);
    }

    /**
     * Action: Approve Request
     */
    public function approveRequest($id)
    {
        $requestModel = new RequestsModel();
        $productModel = new ProductModel();

        // 1. Update Status
        $requestModel->update($id, ['status' => 'approved']);

        // 2. Deduct Stock
        $req = $requestModel->find($id);
        if ($req) {
            $product = $productModel->find($req['product_id']);
            if ($product && $product['stock'] >= $req['quantity']) {
                $newStock = $product['stock'] - $req['quantity'];
                $productModel->update($req['product_id'], ['stock' => $newStock]);
            }
        }

        return redirect()->to('/admin/requests')->with('message', 'Request approved and stock updated.');
    }

    /**
     * Action: Delete/Decline Request
     */
    public function deleteRequest($id)
    {
        $requestModel = new RequestsModel();

        // Set status to cancelled to keep history
        $requestModel->update($id, ['status' => 'cancelled']);

        return redirect()->to('/admin/requests')->with('message', 'Request cancelled.');
    }

    /**
     * Action: Delete Account
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
}
