<?php helper('form'); ?>
<!-- Include HEAD -->
<?= $this->include('components/head') ?>
<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">

        <!-- Back Button -->
        <div style="margin-bottom: 20px;">
            <?php
            // Determine back link (slug preference)
            $slug = is_array($product) ? ($product['slug'] ?? $product['id']) : ($product->slug ?? $product->id);
            $backLink = base_url('product/' . $slug);
            ?>
            <a href="<?= $backLink ?>" style="text-decoration: none; color: #702524;">
                &larr; Back to Product
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

            <!-- LEFT: Request Form -->
            <div style="background: white; padding: 30px; border-radius: 16px; border: 1px solid #ddd;">
                <h2 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-bottom: 20px;">Checkout Details</h2>

                <!-- Error Messages -->
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

                <?= form_open('requests/placeOrder') ?>
                <?php
                // Handle array vs object access for product ID
                $pid = is_array($product) ? $product['id'] : $product->id;
                $pStock = is_array($product) ? $product['stock'] : $product->stock;
                ?>
                <input type="hidden" name="product_id" value="<?= esc($pid) ?>">

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

                <!-- Order Details -->
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Quantity</label>
                    <input type="number" id="qty_input" name="quantity" value="1" min="1" max="<?= esc($pStock) ?>" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                    <small style="color: #666;">Max available: <?= esc($pStock) ?></small>
                </div>

                <!-- NEW: Shipping Options Dropdown -->
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Shipping Options</label>
                    <select name="shipping_option" id="shipping_option" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; cursor: pointer;">
                        <!-- data-fee holds the numerical value we will use in JS calculation -->
                        <option value="pickup" data-fee="0">Self Pick-Up (No fee)</option>
                        <option value="standard" data-fee="50">Standard Shipping (₱50.00)</option>
                    </select>
                </div>

                <!-- NEW: Payment Methods Dropdown -->
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
                    Place Order Request
                </button>
                <?= form_close() ?>
            </div>

            <!-- RIGHT: Product Summary -->
            <div style="background: #fff5e6; padding: 25px; border-radius: 16px; border: 1px solid #f3daac; height: fit-content; position: sticky; top: 20px;">
                <h3 style="font-family: 'Tajawal', sans-serif; color: #702524; margin-top: 0; margin-bottom: 15px;">Order Summary</h3>

                <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                    <?php
                    // Handle array vs object access
                    $pName = is_array($product) ? $product['name'] : $product->name;
                    $pPrice = is_array($product) ? $product['price'] : $product->price;
                    $pCondition = is_array($product) ? $product['condition'] : $product->condition;
                    $pImage = is_array($product) ? ($product['main_image'] ?? '') : ($product->main_image ?? '');

                    $imgUrl = !empty($pImage)
                        ? base_url('uploads/products/' . $pImage)
                        : 'https://via.placeholder.com/100';
                    ?>
                    <img src="<?= $imgUrl ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                    <div>
                        <div style="font-weight: bold; line-height: 1.2; margin-bottom: 5px;"><?= esc($pName) ?></div>
                        <div style="color: #702524; font-weight: 700;">₱<?= number_format($pPrice, 2) ?></div>
                        <div style="font-size: 12px; color: #666; margin-top: 5px;"><?= esc($pCondition) ?></div>
                    </div>
                </div>

                <!-- Dynamic Calculation Breakdown -->
                <div style="border-top: 1px solid #e0cdb3; padding-top: 15px; font-size: 15px; color: #333;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal (<span id="summary_qty">1</span> item/s)</span>
                        <span style="font-weight: 600;" id="summary_subtotal">₱<?= number_format($pPrice, 2) ?></span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span>Shipping Fee</span>
                        <span style="font-weight: 600;" id="summary_shipping">₱0.00</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; border-top: 1px solid #e0cdb3; padding-top: 15px; align-items: center;">
                        <span style="font-weight: bold; font-size: 18px;">Total</span>
                        <span style="font-weight: bold; font-size: 20px; color: #702524;" id="summary_total">₱<?= number_format($pPrice, 2) ?></span>
                    </div>
                </div>

                <div style="margin-top: 20px; font-size: 13px; color: #666; line-height: 1.5; background: #faebd2; padding: 12px; border-radius: 8px;">
                    <p style="margin: 0;"><strong>Note:</strong> This is a request to purchase. The seller will receive your details and contact you to arrange payment and shipping.</p>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Include FOOTER -->
<?= $this->include('components/footer') ?>

<!-- JavaScript to dynamically update the pricing! -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const basePrice = <?= floatval($pPrice) ?>;

        // Inputs
        const qtyInput = document.getElementById('qty_input');
        const shippingSelect = document.getElementById('shipping_option');

        // Summary Displays
        const summaryQty = document.getElementById('summary_qty');
        const summarySubtotal = document.getElementById('summary_subtotal');
        const summaryShipping = document.getElementById('summary_shipping');
        const summaryTotal = document.getElementById('summary_total');

        function formatCurrency(number) {
            return '₱' + number.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function calculateTotal() {
            // 1. Get current values
            let qty = parseInt(qtyInput.value) || 1;

            // Prevent negative or zero quantity from breaking math
            if (qty < 1) {
                qtyInput.value = 1;
                qty = 1;
            }

            // 2. Get the fee from the selected dropdown option's "data-fee" attribute
            const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
            const shippingFee = parseFloat(selectedOption.getAttribute('data-fee')) || 0;

            // 3. Do the math
            const subtotal = basePrice * qty;
            const finalTotal = subtotal + shippingFee;

            // 4. Update the UI
            summaryQty.innerText = qty;
            summarySubtotal.innerText = formatCurrency(subtotal);
            summaryShipping.innerText = formatCurrency(shippingFee);
            summaryTotal.innerText = formatCurrency(finalTotal);
        }

        // Add event listeners to trigger calculation when user changes values
        qtyInput.addEventListener('input', calculateTotal);
        shippingSelect.addEventListener('change', calculateTotal);

        // Run once on load to ensure numbers are set correctly right away
        calculateTotal();
    });
</script>