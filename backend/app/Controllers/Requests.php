<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;
use App\Models\ProductModel;

class Requests extends BaseController
{
    /**
     * 1. Show the Checkout Form (Single Item)
     */
    public function checkout($productId)
    {
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login to place an order.');
        }

        $productsModel = new ProductModel();
        $product = $productsModel->find($productId);

        if (!$product) {
            return redirect()->to('/shop')->with('error', 'Product not found.');
        }

        $stock = is_array($product) ? $product['stock'] : $product->stock;

        if ($stock <= 0) {
            return redirect()->back()->with('error', 'This item is currently out of stock.');
        }

        return view('user/checkout', [
            'product' => $product,
            'user'    => session()->get('user')
        ]);
    }

    /**
     * 2. Process the Order (Single Item)
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

        $productsModel = new ProductModel();
        $product = $productsModel->find($request->getPost('product_id'));
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
            'status'              => 'pending',
            'is_active'           => 1
        ];

        if ($requestsModel->insert($data)) {
            return redirect()->to('/requests/success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to place order.');
        }
    }

    /**
     * 3. Show the Checkout Form (Entire Cart)
     */
    public function checkoutCart()
    {
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login to place an order.');
        }

        $session = session();
        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        $productsModel = new ProductModel();
        $cartItems = [];
        $subtotal = 0;
        $totalItems = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $productsModel->find($productId);
            if ($product) {
                $item = is_array($product) ? (object)$product : $product;
                $item->cart_quantity = $quantity;
                $cartItems[] = $item;
                $subtotal += ($item->price * $quantity);
                $totalItems += $quantity;
            }
        }

        return view('user/checkout_cart', [
            'cartItems'  => $cartItems,
            'subtotal'   => $subtotal,
            'totalItems' => $totalItems,
            'user'       => session()->get('user')
        ]);
    }

    /**
     * 4. Process the Order (Entire Cart)
     */
    public function placeCartOrder()
    {
        $request = \Config\Services::request();
        $session = session();

        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|valid_email',
            'phone'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $cart = $session->get('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        $productsModel = new ProductModel();
        $requestsModel = new RequestsModel();

        // Pass 1: Verify all items have enough stock before creating ANY orders
        foreach ($cart as $productId => $quantity) {
            $product = $productsModel->find($productId);
            if (!$product) {
                return redirect()->back()->withInput()->with('error', 'An item in your cart no longer exists.');
            }
            $currentStock = is_array($product) ? $product['stock'] : $product->stock;
            if ($quantity > $currentStock) {
                $pName = is_array($product) ? $product['name'] : $product->name;
                return redirect()->back()->withInput()->with('error', "Not enough stock available for {$pName}.");
            }
        }

        // Pass 2: Insert each item as its own request
        foreach ($cart as $productId => $quantity) {
            $data = [
                'product_id'          => $productId,
                'user_id'             => $session->get('user.id'),
                'first_name'          => $request->getPost('first_name'),
                'last_name'           => $request->getPost('last_name'),
                'email'               => $request->getPost('email'),
                'phone'               => $request->getPost('phone'),
                'quantity'            => $quantity,
                'additional_requests' => $request->getPost('additional_requests'),
                'status'              => 'pending',
                'is_active'           => 1
            ];
            $requestsModel->insert($data);
        }

        // Clear the cart since checkout was successful
        $session->remove('cart');

        return redirect()->to('/requests/success');
    }

    /**
     * 5. Success Page
     */
    public function success()
    {
        return view('user/request_success');
    }

    /**
     * 6. Order History / Tracking
     */
    public function history()
    {
        if (! session()->has('user')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user')['id'] ?? null;
        $requestsModel = new RequestsModel();

        $requests = $requestsModel
            ->select('requests.*, products.name AS product_name, products.main_image')
            ->join('products', 'products.id = requests.product_id', 'left')
            ->where('requests.user_id', $userId)
            ->orderBy('requests.created_at', 'DESC')
            ->findAll();

        return view('user/ordertracking', ['requests' => $requests]);
    }
}
