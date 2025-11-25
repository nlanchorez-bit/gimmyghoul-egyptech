<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Shop extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        // Fetch all products where 'available' is true (1)
        // Using findAll() gets all matching records from the database
        $products = $productModel->where('available', true)->findAll();

        $data = [
            'page_title' => 'Gimmighoul | Consoles Catalog',
            'products'   => $products
        ];

        return view('user/shop', $data);
    }
}
