<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Requests extends BaseController
{
    /**
     * Displays the checkout/request form for a specific product.
     * Equivalent to 'showReservationRequestPage'
     */
    public function checkout($productId)
    {
        $session = session();
        $productsModel = new ProductsModel();

        // 1. Fetch the specific product being bought
        $product = $productsModel->where('id', $productId)->first();

        if (!$product) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        // 2. Try to prefill user data from session (if logged in)
        $firstName = $session->get('user.first_name'); // e.g. from auth middleware
        $lastName  = $session->get('user.last_name');
        $email     = $session->get('user.email');

        // Fallback: If session data is structured differently (like 'name' string)
        if (empty($firstName) && $session->has('name')) {
            $parts = explode(' ', $session->get('name'), 2);
            $firstName = $parts[0] ?? '';
            $lastName  = $parts[1] ?? '';
        }
        if (empty($email) && $session->has('email')) {
            $email = $session->get('email');
        }

        return view('requests/checkout', [
            'product'    => $product,
            'first_name' => $firstName ?? '',
            'last_name'  => $lastName ?? '',
            'email'      => $email ?? '',
            'productId'  => $productId,
        ]);
    }

    /**
     * Handles the form submission.
     * Equivalent to 'createRequest'
     */
    public function placeOrder()
    {
        $request = \Config\Services::request();
        $session = session();
        $requestModel = new RequestsModel();

        $post = $request->getPost();

        // 1. Validation Rules
        $validation = \Config\Services::validation();
        $rules = [
            'product_id' => [
                'label' => 'Product',
                'rules' => 'required|is_natural_no_zero',
            ],
            'first_name' => [
                'label' => 'First Name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'last_name' => [
                'label' => 'Last Name',
                'rules' => 'required|min_length[2]|max_length[100]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'permit_empty|min_length[7]|max_length[20]',
            ],
            'quantity' => [
                'label' => 'Quantity',
                'rules' => 'required|is_natural_no_zero',
            ],
        ];

        // 2. Run Validation
        if (!$validation->setRules($rules)->run($post)) {
            $errors = $validation->getErrors();

            // AJAX Response
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'ok'     => false,
                    'errors' => $errors,
                    'old'    => $post,
                ])->setStatusCode(422);
            }

            // Standard Response: Reload view with errors
            $productsModel = new ProductsModel();
            $product = $productsModel->find($post['product_id'] ?? null);

            return view('requests/checkout', [
                'product'     => $product,
                'first_name'  => $post['first_name'] ?? '',
                'last_name'   => $post['last_name'] ?? '',
                'email'       => $post['email'] ?? '',
                'productId'   => $post['product_id'] ?? null,
                'errors'      => array_values($errors), // Flatten for simple list
                'fieldErrors' => $errors,               // Key-value for field highlighting
                'old'         => $post,
            ]);
        }

        // 3. Prepare Data for Insertion
        $saveData = [
            'product_id'          => $post['product_id'],
            'first_name'          => $post['first_name'],
            'last_name'           => $post['last_name'],
            'email'               => $post['email'],
            'phone'               => $post['phone'] ?? null,
            'quantity'            => $post['quantity'],
            'additional_requests' => $post['additional_requests'] ?? null,
            'status'              => 'pending',
            'is_active'           => 1,
            'user_id'             => $session->has('id') ? $session->get('id') : null, // Link to logged-in user
        ];

        try {
            // 4. Insert into Database
            if ($requestModel->insert($saveData)) {

                // Success: AJAX
                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'ok' => true,
                        'message' => 'Order placed successfully!',
                        'redirect' => base_url('requests/success')
                    ]);
                }

                // Success: Standard
                return view('requests/success', ['order' => $saveData]);
            } else {
                throw new \Exception('Database insert failed.');
            }
        } catch (\Exception $e) {
            // Error Handling
            if ($request->isAJAX()) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                    ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to place order.');
        }
    }
}
