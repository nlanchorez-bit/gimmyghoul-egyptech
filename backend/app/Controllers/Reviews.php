<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductReviewsModel;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class Reviews extends BaseController
{
    /**
     * Handle the submission of a new review.
     * Usually POSTed from the Product Details page.
     */
    public function submit()
    {
        $session = session();
        $request = \Config\Services::request();

        // 1. Security Check: Must be logged in
        if (!$session->get('isLoggedIn')) {
            if ($request->isAJAX()) {
                return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Please login to leave a review.']);
            }
            return redirect()->to('/login')->with('error', 'You must be logged in to leave a review.');
        }

        $reviewsModel = new ProductReviewsModel();
        $productsModel = new ProductsModel();

        // 2. Get Input Data
        $productId = $request->getPost('product_id');
        $rating    = $request->getPost('rating');
        $comment   = $request->getPost('comment');
        $userId    = $session->get('id');

        // 3. Validation Rules
        $rules = [
            'product_id' => 'required|is_natural_no_zero',
            'rating'     => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
            'comment'    => 'required|min_length[5]|max_length[1000]',
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();

            if ($request->isAJAX()) {
                return $this->response->setStatusCode(422)->setJSON(['success' => false, 'errors' => $errors]);
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // 4. Prepare Data
        $data = [
            'product_id' => $productId,
            'user_id'    => $userId,
            'rating'     => $rating,
            'comment'    => $comment,
            'status'     => 'published', // Default status, or set to 'pending' if you want moderation
        ];

        // 5. Save to Database
        try {
            if ($reviewsModel->save($data)) {

                // Fetch product to get the slug for redirect
                $product = $productsModel->find($productId);
                $redirectUrl = $product ? base_url("products/details/{$product->slug}") : base_url('products');

                if ($request->isAJAX()) {
                    return $this->response->setJSON([
                        'success'  => true,
                        'message'  => 'Review posted successfully!',
                        'redirect' => $redirectUrl
                    ]);
                }

                return redirect()->to($redirectUrl)->with('success', 'Review posted successfully!');
            } else {
                throw new \Exception('Failed to save review.');
            }
        } catch (\Exception $e) {
            if ($request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Server Error: ' . $e->getMessage()]);
            }
            return redirect()->back()->withInput()->with('error', 'An error occurred while posting your review.');
        }
    }

    /**
     * Delete a review (Optional: For users to delete their own review)
     */
    public function delete($id)
    {
        $session = session();
        $reviewsModel = new ProductReviewsModel();

        $review = $reviewsModel->find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Review not found.');
        }

        // Security: Ensure only the owner (or admin) can delete
        if ($review->user_id != $session->get('id') && $session->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $reviewsModel->delete($id);

        return redirect()->back()->with('success', 'Review deleted.');
    }
}
