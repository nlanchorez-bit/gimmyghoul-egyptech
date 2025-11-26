<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<style>
    /* Review Section Styles */
    .reviews-container {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid rgba(112, 37, 36, 0.1);
    }

    .review-header {
        margin-bottom: 30px;
    }

    .review-title {
        font-family: 'Tajawal', sans-serif;
        font-size: 24px;
        color: #702524;
        font-weight: 700;
    }

    /* Review Cards */
    .review-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: #f3daac;
        color: #702524;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-family: 'Tajawal', sans-serif;
    }

    .star-display {
        color: #ffc700;
        font-size: 16px;
        letter-spacing: 2px;
    }

    /* Interactive Star Rating (CSS Only) */
    .rate {
        float: left;
        height: 46px;
        padding: 0;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #fff;
        width: 90%;
        max-width: 500px;
        padding: 30px;
        border-radius: 16px;
        position: relative;
    }
</style>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

        <!-- Breadcrumb -->
        <nav style="margin-bottom: 30px; font-size: 14px;">
            <a href="<?= base_url('shop') ?>" style="text-decoration: none; color: #666;">&larr; Back to Catalog</a>
        </nav>

        <!-- Product Info Section -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
            <!-- Image -->
            <div style="background: white; padding: 20px; border-radius: 16px;">
                <?php $imgUrl = !empty($product->main_image) ? base_url('uploads/products/' . $product->main_image) : 'https://via.placeholder.com/600'; ?>
                <img src="<?= esc($imgUrl) ?>" style="width: 100%; border-radius: 12px;">
            </div>

            <!-- Details -->
            <div>
                <h1 style="font-family: 'Tajawal', sans-serif; color: #161616;"><?= esc($product->name) ?></h1>
                <h2 style="color: #702524;">₱<?= number_format($product->price, 2) ?></h2>
                <p style="color: #555; line-height: 1.6;"><?= nl2br(esc($product->description)) ?></p>

                <?php if ($product->stock > 0): ?>
                    <a href="<?= base_url('checkout/' . $product->id) ?>" class="btn btn-primary" style="padding: 15px 30px; display: inline-block; text-decoration: none; color: white; background: #702524; border-radius: 50px;">Buy Now</a>
                <?php else: ?>
                    <button disabled style="padding: 15px 30px; background: #ccc; border: none; border-radius: 50px;">Sold Out</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- REVIEWS SECTION -->
        <div class="reviews-container">
            <div class="review-header">
                <h2 class="review-title">Customer Reviews</h2>
            </div>

            <!-- Review List -->
            <?php

            use App\Models\ProductsReviewModel;
            use App\Models\UsersModel;

            $reviewsModel = new ProductsReviewModel();
            $reviews = $reviewsModel->where('product_id', $product->id)->orderBy('created_at', 'DESC')->findAll();
            $userModel = new UsersModel();
            $currentUserId = session()->get('user')['id'] ?? null;
            $userHasReviewed = false;
            ?>

            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <?php
                    $reviewer = $userModel->find($review['user_id']);
                    $reviewerName = $reviewer->first_name ?? 'Guest';
                    $initial = strtoupper(substr($reviewerName, 0, 1));
                    if ($currentUserId && $review['user_id'] == $currentUserId) $userHasReviewed = true;
                    ?>
                    <div class="review-card">
                        <div style="display: flex; justify-content: space-between;">
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <div class="user-avatar"><?= $initial ?></div>
                                <div>
                                    <div style="font-weight: bold;"><?= esc($reviewerName) ?></div>
                                    <div class="star-display">
                                        <?php for ($i = 0; $i < $review['rating']; $i++) echo '★'; ?>
                                        <?php for ($i = $review['rating']; $i < 5; $i++) echo '<span style="color:#ddd">★</span>'; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit/Delete for Owner -->
                            <?php if ($currentUserId && $currentUserId == $review['user_id']): ?>
                                <div>
                                    <button onclick="openEditModal(<?= $review['id'] ?>, <?= $review['rating'] ?>, '<?= esc($review['comment'], 'js') ?>')" style="color: #702524; border:none; background:none; cursor:pointer; margin-right: 10px;">Edit</button>
                                    <a href="<?= base_url('reviews/delete/' . $review['id']) ?>" onclick="return confirm('Delete review?')" style="color: #c0392b; text-decoration: none;">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p style="margin-top: 10px; color: #555;"><?= esc($review['comment']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #888; font-style: italic;">No reviews yet.</p>
            <?php endif; ?>

            <!-- Add Review Form -->
            <?php if ($currentUserId && !$userHasReviewed): ?>
                <div class="review-card" style="background: #fff5e6; border-color: #f3daac;">
                    <h3 style="margin-top: 0; color: #702524;">Write a Review</h3>
                    <form action="<?= base_url('reviews/add') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">

                        <div style="margin-bottom: 15px;">
                            <label style="display:block; font-weight:bold; margin-bottom:5px;">Rating</label>
                            <div class="rate">
                                <input type="radio" id="star5" name="rating" value="5" required /><label for="star5">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1">1 star</label>
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display:block; font-weight:bold; margin-bottom:5px;">Comment</label>
                            <textarea name="comment" rows="3" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="background: #702524; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">Submit Review</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- EDIT MODAL -->
<div id="editReviewModal" class="modal-overlay">
    <div class="modal-content">
        <button onclick="closeEditModal()" style="position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
        <h2 style="color: #702524; margin-top: 0;">Edit Review</h2>

        <form id="editReviewForm">
            <?= csrf_field() ?>
            <!-- Note: ID is appended to URL in JS -->
            <input type="hidden" id="editReviewId">

            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Rating</label>
                <div class="rate">
                    <input type="radio" id="edit_star5" name="rating" value="5" required /><label for="edit_star5">5 stars</label>
                    <input type="radio" id="edit_star4" name="rating" value="4" /><label for="edit_star4">4 stars</label>
                    <input type="radio" id="edit_star3" name="rating" value="3" /><label for="edit_star3">3 stars</label>
                    <input type="radio" id="edit_star2" name="rating" value="2" /><label for="edit_star2">2 stars</label>
                    <input type="radio" id="edit_star1" name="rating" value="1" /><label for="edit_star1">1 star</label>
                </div>
                <div style="clear:both;"></div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Comment</label>
                <textarea id="editReviewComment" name="comment" rows="3" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;" required></textarea>
            </div>

            <button type="submit" style="background: #702524; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; width: 100%;">Save Changes</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, rating, comment) {
        document.getElementById('editReviewId').value = id;
        document.getElementById('editReviewComment').value = comment;

        // Reset radio
        document.querySelectorAll('#editReviewForm input[name="rating"]').forEach(el => el.checked = false);
        // Check correct star
        let star = document.querySelector(`#editReviewForm input[name="rating"][value="${rating}"]`);
        if (star) star.checked = true;

        document.getElementById('editReviewModal').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editReviewModal').classList.remove('active');
    }

    document.getElementById('editReviewForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let id = document.getElementById('editReviewId').value;
        let formData = new FormData(this);

        fetch('<?= base_url('reviews/edit/') ?>' + id, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) location.reload();
                else alert(data.message || 'Error');
            })
            .catch(err => alert('Error: ' + err));
    });
</script>

<?= $this->include('components/footer') ?>