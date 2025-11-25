<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Shop extends BaseController
{
    /**
     * 1. Display the Shop Page
     */
    public function index()
    {
        $productsModel = new ProductModel();

        // Fetch all available products, ordered by newest first
        $products = $productsModel->where('is_available', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // --- FIX: PREPARE DATA FOR VIEW COMPONENT ---
        // The product_card component expects 'image' (full URL) and 'title',
        // but our database stores 'main_image' (filename) and 'name'.
        if (!empty($products)) {
            foreach ($products as &$p) {
                // 1. Generate Full Image URL
                if (!empty($p['main_image'])) {
                    $p['image'] = base_url('uploads/products/' . $p['main_image']);
                } else {
                    // Fallback if no image exists
                    $p['image'] = null;
                }

                // 2. Map Name to Title
                if (isset($p['name'])) {
                    $p['title'] = $p['name'];
                }

                // --- ADD THIS BLOCK ---
                // 3. Map is_available to available
                if (isset($p['is_available'])) {
                    $p['available'] = $p['is_available'];
                }
            }
        }

        $data = [
            'page_title' => 'RetroCrypt | Consoles Catalog',
            'products'   => $products,
            // Pass current user ID to view so we can show/hide 'Delete' buttons
            'currentUserId' => session()->get('user.id')
        ];

        return view('user/shop', $data);
    }

    /**
     * 2. Show the "Upload Product" Form
     */
    public function create()
    {
        // Security: Must be logged in
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login to sell an item.');
        }

        return view('user/product_upload'); // You need to create this view
    }

    /**
     * 3. Process the Product Upload
     */
    public function store()
    {
        $session = session();

        // Security: Must be logged in
        if (!$session->has('user')) {
            return redirect()->to('/login');
        }

        // Validation Rules
        $rules = [
            'name'        => 'required|min_length[3]|max_length[255]',
            'category'    => 'required',
            'price'       => 'required|decimal',
            'description' => 'required',
            'main_image'  => 'uploaded[main_image]|is_image[main_image]|max_size[main_image,2048]', // Max 2MB
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle Image Upload
        $img = $this->request->getFile('main_image');
        $newName = null;

        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            // Ensure directory exists (optional safeguard)
            if (!is_dir(FCPATH . 'uploads/products')) {
                mkdir(FCPATH . 'uploads/products', 0777, true);
            }
            $img->move(FCPATH . 'uploads/products', $newName);
        }

        // Prepare Data
        $productsModel = new ProductModel();

        // Auto-generate slug from name (e.g., "Nintendo 3DS" -> "nintendo-3ds")
        $slug = url_title($this->request->getPost('name'), '-', true);

        // Ensure slug is unique by appending random string if needed
        if ($productsModel->where('slug', $slug)->first()) {
            $slug .= '-' .  substr(md5(uniqid()), 0, 5);
        }

        $data = [
            'name'         => $this->request->getPost('name'),
            'slug'         => $slug,
            'category'     => $this->request->getPost('category'),
            'brand'        => $this->request->getPost('brand'),
            'description'  => $this->request->getPost('description'),
            'inclusions'   => $this->request->getPost('inclusions'), // Added inclusions here
            'condition'    => $this->request->getPost('condition') ?? 'Used',
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock') ?? 1,
            'is_available' => 1,
            'main_image'   => $newName, // Save the filename
            'created_by'   => $session->get('user.id'), // Link to current user
        ];

        $productsModel->insert($data);

        return redirect()->to('/shop')->with('success', 'Product listed successfully!');
    }

    /**
     * 4. Delete a Product
     */
    public function delete($id)
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/login');
        }

        $productsModel = new ProductModel();
        $product = $productsModel->find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $currentUser = $session->get('user');

        // AUTH CHECK:
        // Allow delete if User is ADMIN OR User is the OWNER
        if ($currentUser['type'] === 'admin' || $product['created_by'] == $currentUser['id']) {

            // Optional: Delete the image file from server to save space
            if (!empty($product['main_image']) && file_exists(FCPATH . 'uploads/products/' . $product['main_image'])) {
                unlink(FCPATH . 'uploads/products/' . $product['main_image']);
            }

            $productsModel->delete($id);
            return redirect()->to('/shop')->with('success', 'Product deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this item.');
    }
}
