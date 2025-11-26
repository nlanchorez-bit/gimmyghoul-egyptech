<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsReviewModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Reviews extends BaseController
{
    use ResponseTrait;

    public function add()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->back()->with('error', 'You must be logged in to write a review.');
        }

        $userId = $session->get('user')['id'];
        $productId = $this->request->getPost('product_id');

        $model = new ProductsReviewModel();
        $productModel = new ProductModel();

        $model->save([
            'product_id' => $productId,
            'user_id'    => $userId,
            'rating'     => $this->request->getPost('rating'),
            'comment'    => $this->request->getPost('comment'),
            'status'     => 'published',
        ]);

        $product = $productModel->find($productId);
        // Handle array vs object depending on return type
        $slug = is_array($product) ? $product['slug'] : $product->slug;

        return redirect()->to("product/{$slug}")->with('success', 'Review added successfully.');
    }

    public function edit($id)
    {
        $session = session();

        if (!$session->has('user')) {
            return $this->failUnauthorized('Not logged in');
        }

        $userId = $session->get('user')['id'];
        $model = new ProductsReviewModel();
        $review = $model->find($id);

        if (!$review) {
            return $this->failNotFound('Review not found');
        }

        // Ensure user owns the review
        $reviewOwner = is_array($review) ? $review['user_id'] : $review->user_id;

        if ($reviewOwner != $userId) {
            return $this->failForbidden('Cannot edit this review');
        }

        // Update
        $model->update($id, [
            'rating'  => $this->request->getPost('rating'),
            'comment' => $this->request->getPost('comment'),
        ]);

        return $this->respond(['success' => true, 'message' => 'Review updated']);
    }

    public function delete($id)
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/login')->with('error', 'Not logged in');
        }

        $userId = $session->get('user')['id'];
        $userType = $session->get('user')['type'];

        $model = new ProductsReviewModel();
        $review = $model->find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Review not found');
        }

        $reviewOwner = is_array($review) ? $review['user_id'] : $review->user_id;

        // Allow Owner OR Admin to delete
        if ($reviewOwner != $userId && $userType !== 'admin') {
            return redirect()->back()->with('error', 'Cannot delete this review');
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Review deleted successfully');
    }
}
