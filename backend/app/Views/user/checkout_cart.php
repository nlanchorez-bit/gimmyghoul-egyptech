<?php helper('form'); ?>
<?= $this->include('components/head') ?>
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">

        <!-- Back Button -->
        <div style="margin-bottom: 20px;">
            <a href="<?= base_url('cart') ?>" style="text-decoration: none; color: #702524;">
                &larr; Back to Cart
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

            <!-- LEFT: Request Form -->
            <div style="background: white; padding: 30px; border-radius: 16px; border: 1px solid #ddd;">
                <h2 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-bottom: 20px;">Cart Checkout Details</h2>

                <?php if (session()->has('error')): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('errors')): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Note the action goes to placeCartOrder instead of placeOrder -->
                <?= form_open('requests/placeCartOrder') ?>

                <!-- Contact Info -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">First Name</label>
                        <input type="text" name="first_name" value="<?= esc($user['first_name'] ?? '') ?>" required
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Last Name</label>
                        <input type="text" name="last_name" value="<?= esc($user['last_name'] ?? '') ?>" required
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Email</label>
                    <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Phone Number</label>
                    <input type="text" name="phone" required placeholder="0917..."
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                </div>

                <!-- Shipping Options Dropdown -->
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Shipping Options (Applies to all items)</label>
                    <select name="shipping_option" id="shipping_option" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; cursor: pointer;">
                        <option value="pickup" data-fee="0">Self Pick-Up (No fee)</option>
                        <option value="standard" data-fee="50">Standard Shipping (₱50.00)</option>
                    </select>
                </div>

                <!-- Payment Methods Dropdown -->
                <div style="margin-bottom: 25px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Payment Methods</label>
                    <select name="payment_method" id="payment_method" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; cursor: pointer;">
                        <option value="cod">Cash On Delivery</option>
                        <option value="gcash">Gcash</option>
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Additional Notes / Delivery Instructions</label>
                    <textarea name="additional_requests" rows="3" placeholder="E.g. Please deliver on weekends only"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 16px; background-color: #702524; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                    Place Order For All Items
                </button>
                <?= form_close() ?>
            </div>

            <!-- RIGHT: Cart Summary -->
            <div style="background: #fff5e6; padding: 25px; border-radius: 16px; border: 1px solid #f3daac; height: fit-content; position: sticky; top: 20px;">
                <h3 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-top: 0; margin-bottom: 15px;">Order Summary</h3>

                <!-- Loop through Cart Items -->
                <div style="max-height: 300px; overflow-y: auto; margin-bottom: 20px; padding-right: 10px;">
                    <?php foreach ($cartItems as $item): ?>
                        <div style="display: flex; gap: 10px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e0cdb3;">
                            <?php $imgUrl = !empty($item->main_image) ? base_url('uploads/products/' . $item->main_image) : 'https://via.placeholder.com/100'; ?>
                            <img src="<?= $imgUrl ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                            <div style="flex-grow: 1;">
                                <div style="font-weight: bold; line-height: 1.2; font-size: 14px;"><?= esc($item->name) ?></div>
                                <div style="font-size: 12px; color: #666; margin-top: 2px;">Qty: <?= $item->cart_quantity ?></div>
                                <div style="color: #702524; font-weight: 700; font-size: 14px; margin-top: 2px;">₱<?= number_format($item->price * $item->cart_quantity, 2) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Dynamic Calculation Breakdown -->
                <div style="border-top: 1px solid #e0cdb3; padding-top: 15px; font-size: 15px; color: #333;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal (<?= $totalItems ?> item/s)</span>
                        <span style="font-weight: 600;">₱<?= number_format($subtotal, 2) ?></span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span>Shipping Fee</span>
                        <span style="font-weight: 600;" id="summary_shipping">₱0.00</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; border-top: 1px solid #e0cdb3; padding-top: 15px; align-items: center;">
                        <span style="font-weight: bold; font-size: 18px;">Total</span>
                        <span style="font-weight: bold; font-size: 20px; color: #702524;" id="summary_total">₱<?= number_format($subtotal, 2) ?></span>
                    </div>
                </div>

                <div style="margin-top: 20px; font-size: 13px; color: #666; line-height: 1.5; background: #faebd2; padding: 12px; border-radius: 8px;">
                    <p style="margin: 0;"><strong>Note:</strong> This is a request to purchase. The seller will receive your details and contact you to arrange payment and shipping.</p>
                </div>
            </div>

        </div>
    </div>
</main>

<?= $this->include('components/footer') ?>

<!-- JavaScript to dynamically update the pricing! -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseSubtotal = <?= floatval($subtotal) ?>;

        const shippingSelect = document.getElementById('shipping_option');
        const summaryShipping = document.getElementById('summary_shipping');
        const summaryTotal = document.getElementById('summary_total');

        function formatCurrency(number) {
            return '₱' + number.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function calculateTotal() {
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            const shippingFee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;

            const finalTotal = baseSubtotal + shippingFee;

            summaryShipping.innerText = formatCurrency(shippingFee);
            summaryTotal.innerText = formatCurrency(finalTotal);
        }

        shippingSelect.addEventListener('change', calculateTotal);
        calculateTotal();
    });
</script>