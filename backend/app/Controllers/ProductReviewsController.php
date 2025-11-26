<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsReviewModel;

class ProductReviewsController extends BaseController
{
    public function add()
    {
        if (!session()->has('user')) {
            return redirect()->back()->with('error', 'You must be logged in to write a review.');
        }

        $model = new ProductsReviewModel();

        $data = [
            'product_id' => $this->request->getPost('product_id'),
            'user_id'    => session()->get('user.id'),
            'rating'     => $this->request->getPost('rating'),
            'comment'    => $this->request->getPost('comment'),
            'status'     => 'published'
        ];

        if ($model->insert($data)) {
            return redirect()->back()->with('success', 'Review posted successfully!');
        }

        return redirect()->back()->with('error', 'Failed to submit review.');
    }

    public function edit($id)
    {
        $model = new ProductsReviewModel();
        $review = $model->find($id);

        if (!$review || $review['user_id'] != session()->get('user.id')) {
            return $this->response->setJSON(['success' => false, 'error' => 'Unauthorized']);
        }

        $data = [
            'rating'  => $this->request->getPost('rating'),
            'comment' => $this->request->getPost('comment'),
        ];

        $model->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }

    public function delete($id)
    {
        $currentUserId = session()->get('user.id');

        $model = new ProductsReviewModel();
        $review = $model->find($id);

        if (!$review) {
            return redirect()->back()->with('error', 'Review not found.');
        }

        if ($review['user_id'] != $currentUserId) {
            return redirect()->back()->with('error', 'You can only delete your own reviews.');
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
