<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Cart extends BaseController
{
    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        $productModel = new ProductModel();
        $cartItems = [];
        $totalAmount = 0;

        // Loop through session cart data and fetch actual product details
        foreach ($cart as $productId => $quantity) {
            $product = $productModel->find($productId);
            if ($product) {
                // Ensure it acts as an object for the view
                $item = is_array($product) ? (object)$product : $product;
                $item->cart_quantity = $quantity;
                $cartItems[] = $item;
                $totalAmount += ($item->price * $quantity);
            }
        }

        return view('user/cart', [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]);
    }

    public function add($productId)
    {
        $session = session();

        // Retrieve the current cart from the session, or an empty array if none exists
        $cart = $session->get('cart') ?? [];

        // If it's already in the cart, increase quantity. Otherwise, add it with qty 1.
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }

        // Save back to session
        $session->set('cart', $cart);

        return redirect()->to('/cart')->with('success', 'Item successfully added to your cart!');
    }

    public function remove($productId)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $session->set('cart', $cart);
        }

        return redirect()->to('/cart')->with('success', 'Item removed from cart.');
    }
}
