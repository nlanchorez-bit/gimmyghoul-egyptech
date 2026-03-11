<?= $this->include('components/head') ?>
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">

        <!-- Breadcrumb -->
        <nav style="margin-bottom: 20px; font-size: 14px;">
            <a href="<?= base_url('shop') ?>" style="text-decoration: none; color: #666;">&larr; Back to Shop</a>
        </nav>

        <h2 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-bottom: 20px;">Your Cart</h2>

        <?php if (session()->has('success')): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

            <!-- LEFT: Cart Items -->
            <div style="background: white; padding: 30px; border-radius: 16px; border: 1px solid #ddd;">
                <?php if (empty($cartItems)): ?>
                    <p style="color: #666; text-align: center; padding: 40px 0;">Your cart is currently empty.</p>
                    <div style="text-align: center;">
                        <a href="<?= base_url('shop') ?>" class="btn" style="padding: 10px 20px; background: #702524; color: white; text-decoration: none; border-radius: 8px;">Continue Shopping</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($cartItems as $item): ?>
                        <div style="display: flex; gap: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px;">
                            <?php $imgUrl = !empty($item->main_image) ? base_url('uploads/products/' . $item->main_image) : 'https://via.placeholder.com/100'; ?>
                            <img src="<?= esc($imgUrl) ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">

                            <div style="flex-grow: 1;">
                                <h3 style="margin: 0 0 5px 0; font-family: 'Tajawal', sans-serif; color: #161616;"><?= esc($item->name) ?></h3>
                                <div style="color: #702524; font-weight: bold; margin-bottom: 10px;">₱<?= number_format($item->price, 2) ?></div>
                                <div style="font-size: 14px; color: #666; margin-bottom: 15px;">Condition: <?= esc($item->condition) ?></div>

                                <div style="display: flex; gap: 10px;">
                                    <a href="<?= base_url('checkout/' . $item->id) ?>" style="padding: 8px 16px; background: #C4B454; color: #2C1810; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px;">Checkout Item</a>
                                    <a href="<?= base_url('cart/remove/' . $item->id) ?>" style="padding: 8px 16px; background: #f8d7da; color: #721c24; text-decoration: none; border-radius: 6px; font-size: 14px;">Remove</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- RIGHT: Cart Summary -->
            <div style="background: #fff5e6; padding: 25px; border-radius: 16px; border: 1px solid #f3daac; height: fit-content; position: sticky; top: 20px;">
                <h3 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-top: 0; margin-bottom: 15px;">Cart Total</h3>

                <div style="display: flex; justify-content: space-between; border-top: 1px solid #e0cdb3; padding-top: 15px; align-items: center; margin-bottom: 20px;">
                    <span style="font-weight: bold; font-size: 18px;">Total</span>
                    <span style="font-weight: bold; font-size: 20px; color: #702524;">₱<?= number_format($totalAmount ?? 0, 2) ?></span>
                </div>

                <?php if (!empty($cartItems)): ?>
                    <a href="<?= base_url('checkout/cart') ?>" style="display: block; width: 100%; padding: 12px; text-align: center; background-color: #702524; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; margin-bottom: 15px;">
                        Checkout All Items
                    </a>
                <?php endif; ?>

                <div style="font-size: 13px; color: #666; line-height: 1.5; background: #faebd2; padding: 12px; border-radius: 8px;">
                    <p style="margin: 0;"><strong>Note:</strong> You can choose to checkout all items at once using the button above, or checkout items individually if you have specific shipping instructions for each.</p>
                </div>
            </div>

        </div>
    </div>
</main>

<?= $this->include('components/footer') ?>