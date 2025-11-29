<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;

class Products extends BaseController
{
    public function index()
    {
        $model = new ProductsModel();

        // Fetch all products that are marked as "Available"
        // We use the Model to get real data from the database
        $data = [
            'products' => $model->where('is_available', 1)->findAll(),
            'title'    => 'RetroCrypt | Catalog'
        ];

        // This corresponds to your 'obituaryList' view
        return view('products/index', $data);
    }

    public function details($slug = null)
    {
        $model = new ProductsModel();

        // We search by 'slug' (e.g., 'nintendo-3ds-xl') instead of ID for better URLs
        $product = $model->where('slug', $slug)->first();

        // If product doesn't exist or is hidden, redirect back to catalog
        if (!$product) {
            return redirect()->to('/products');
        }

        // This corresponds to your 'showClassic' view, but dynamic for any product
        return view('products/details', [
            'product' => $product,
            'title'   => $product->name
        ]);
    }

    // --- Search / Filter Functionality (Bonus) ---
    public function search()
    {
        $model = new ProductsModel();
        $query = $this->request->getGet('q');

        if ($query) {
            $data['products'] = $model->like('name', $query)
                ->orLike('description', $query)
                ->where('is_available', 1)
                ->findAll();
        } else {
            $data['products'] = $model->where('is_available', 1)->findAll();
        }

        $data['title'] = 'Search Results';
        return view('products/index', $data);
    }
}
