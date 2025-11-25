<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;
use App\Models\ProductModel; // FIX: Changed from ProductsModel to ProductModel

class Requests extends BaseController
{
    /**
     * 1. Show the Checkout Form (For Buyers)
     */
    public function checkout($productId)
    {
        // Require login to buy
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login to place an order.');
        }

        // FIX: Use ProductModel instead of ProductsModel
        $productsModel = new ProductModel();
        $product = $productsModel->find($productId);

        if (!$product) {
            return redirect()->to('/shop')->with('error', 'Product not found.');
        }

        // Check stock (Handle object or array return type safely)
        $stock = is_array($product) ? $product['stock'] : $product->stock;

        if ($stock <= 0) {
            return redirect()->back()->with('error', 'This item is currently out of stock.');
        }

        $user = session()->get('user');

        return view('user/checkout', [
            'product' => $product,
            'user'    => $user
        ]);
    }

    /**
     * 2. Process the Order (Create the Request)
     */
    public function placeOrder()
    {
        $request = \Config\Services::request();
        $session = session();

        $rules = [
            'product_id' => 'required|is_natural_no_zero',
            'quantity'   => 'required|is_natural_no_zero',
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|valid_email',
            'phone'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // FIX: Use ProductModel
        $productsModel = new ProductModel();
        $product = $productsModel->find($request->getPost('product_id'));

        // Check stock again on submission
        $currentStock = is_array($product) ? $product['stock'] : $product->stock;

        if ($request->getPost('quantity') > $currentStock) {
            return redirect()->back()->withInput()->with('error', 'Not enough stock available.');
        }

        $requestsModel = new RequestsModel();
        $data = [
            'product_id'          => $request->getPost('product_id'),
            'user_id'             => $session->get('user.id'),
            'first_name'          => $request->getPost('first_name'),
            'last_name'           => $request->getPost('last_name'),
            'email'               => $request->getPost('email'),
            'phone'               => $request->getPost('phone'),
            'quantity'            => $request->getPost('quantity'),
            'additional_requests' => $request->getPost('additional_requests'),
            'status'              => 'pending', // Default status for Admin review
            'is_active'           => 1
        ];

        if ($requestsModel->insert($data)) {
            return redirect()->to('/requests/success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to place order.');
        }
    }

    /**
     * 3. Success Page
     */
    public function success()
    {
        return view('user/request_success');
    }
}
