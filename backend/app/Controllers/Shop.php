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
        $request = \Config\Services::request();

        // Start the query builder
        $builder = $productsModel->where('is_available', 1);

        // --- APPLY FILTERS ---

        // 1. Price Filter
        $minPrice = $request->getGet('min_price');
        $maxPrice = $request->getGet('max_price');

        if (isset($minPrice) && is_numeric($minPrice)) {
            $builder->where('price >=', $minPrice);
        }

        if (isset($maxPrice) && is_numeric($maxPrice)) {
            $builder->where('price <=', $maxPrice);
        }

        // Execute Query
        $products = $builder->orderBy('created_at', 'DESC')->findAll();

        // --- PREPARE DATA FOR VIEW COMPONENT ---
        if (!empty($products)) {
            foreach ($products as &$p) {
                // 1. Generate Full Image URL
                if (!empty($p['main_image'])) {
                    $p['image'] = base_url('uploads/products/' . $p['main_image']);
                } else {
                    $p['image'] = null;
                }

                // 2. Map Name to Title
                if (isset($p['name'])) {
                    $p['title'] = $p['name'];
                }

                // 3. Map is_available to available
                if (isset($p['is_available'])) {
                    $p['available'] = $p['is_available'];
                }
            }
        }

        $data = [
            'page_title' => 'RetroCrypt | Consoles Catalog',
            'products'   => $products,
            'currentUserId' => session()->get('user.id'),
            'filters'    => [
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
            ]
        ];

        return view('user/shop', $data);
    }

    /**
     * 2. Show the "Upload Product" Form
     */
    public function create()
    {
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Please login to sell an item.');
        }
        return view('user/product_upload');
    }

    /**
     * 3. Process the Product Upload
     */
    public function store()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/login');
        }

        $rules = [
            'name'        => 'required|min_length[3]|max_length[255]',
            'category'    => 'required',
            'price'       => 'required|decimal',
            'description' => 'required',
            'main_image'  => 'uploaded[main_image]|is_image[main_image]|max_size[main_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('main_image');
        $newName = null;

        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            if (!is_dir(FCPATH . 'uploads/products')) {
                mkdir(FCPATH . 'uploads/products', 0777, true);
            }
            $img->move(FCPATH . 'uploads/products', $newName);
        }

        $productsModel = new ProductModel();
        $slug = url_title($this->request->getPost('name'), '-', true);

        if ($productsModel->where('slug', $slug)->first()) {
            $slug .= '-' .  substr(md5(uniqid()), 0, 5);
        }

        $data = [
            'name'         => $this->request->getPost('name'),
            'slug'         => $slug,
            'category'     => $this->request->getPost('category'),
            'brand'        => $this->request->getPost('brand'),
            'description'  => $this->request->getPost('description'),
            'inclusions'   => $this->request->getPost('inclusions'),
            'condition'    => $this->request->getPost('condition') ?? 'Used',
            'price'        => $this->request->getPost('price'),
            'stock'        => $this->request->getPost('stock') ?? 1,
            'is_available' => 1,
            'main_image'   => $newName,
            'created_by'   => $session->get('user.id'),
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

        $creatorId = is_array($product) ? $product['created_by'] : $product->created_by;
        $imageName = is_array($product) ? ($product['main_image'] ?? null) : ($product->main_image ?? null);

        if ($currentUser['type'] === 'admin' || $creatorId == $currentUser['id']) {
            if (!empty($imageName) && file_exists(FCPATH . 'uploads/products/' . $imageName)) {
                unlink(FCPATH . 'uploads/products/' . $imageName);
            }

            $productsModel->delete($id);
            return redirect()->to('/shop')->with('success', 'Product deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this item.');
    }

    /**
     * 5. View Product Details
     */
    public function details($slug)
    {
        $productsModel = new ProductModel();

        // Join with Users table to get the seller's first name
        $builder = $productsModel->select('products.*, users.first_name as seller_name')
            ->join('users', 'users.id = products.created_by', 'left');

        // Try to find by slug first
        $product = $builder->where('slug', $slug)->first();

        // Fallback: Try to find by ID if slug fails
        if (!$product && is_numeric($slug)) {
            // Re-initialize query for fallback to avoid builder state issues
            $product = $productsModel->select('products.*, users.first_name as seller_name')
                ->join('users', 'users.id = products.created_by', 'left')
                ->where('products.id', $slug)
                ->first();
        }

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Cast to object to match view expectations
        $product = (object) $product;

        return view('products/details', [
            'product' => $product
        ]);
    }
}
