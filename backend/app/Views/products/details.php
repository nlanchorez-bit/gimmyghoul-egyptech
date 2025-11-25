<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh; padding: 40px 0;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

        <!-- Breadcrumb -->
        <nav style="margin-bottom: 30px; font-size: 14px; color: #666;">
            <a href="<?= base_url('/') ?>" style="text-decoration: none; color: #666;">Home</a> &rsaquo;
            <a href="<?= base_url('shop') ?>" style="text-decoration: none; color: #666;">Catalog</a> &rsaquo;
            <span style="color: #702524; font-weight: 600;"><?= esc($product->name) ?></span>
        </nav>

        <!-- Product Layout -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">

            <!-- LEFT: Image Gallery -->
            <div style="background: white; border-radius: 16px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid rgba(112, 37, 36, 0.1);">
                <div style="position: relative; padding-top: 75%; overflow: hidden; border-radius: 12px; background: #f3daac;">
                    <?php
                    // Handle Image URL logic
                    $imgUrl = !empty($product->main_image)
                        ? base_url('uploads/products/' . $product->main_image)
                        : 'https://via.placeholder.com/800x600?text=No+Image';
                    ?>
                    <img src="<?= esc($imgUrl) ?>" alt="<?= esc($product->name) ?>"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            <!-- RIGHT: Product Info -->
            <div>
                <!-- Title & Price -->
                <h1 style="font-family: 'Tajawal', sans-serif; color: #161616; font-size: 36px; margin: 0 0 10px 0; line-height: 1.2;">
                    <?= esc($product->name) ?>
                </h1>

                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <span style="font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 28px; color: #702524;">
                        ₱<?= number_format($product->price, 2) ?>
                    </span>

                    <!-- Condition Badge -->
                    <span style="background: #fff5e6; color: #702524; padding: 5px 12px; border-radius: 50px; font-size: 14px; font-weight: 600; border: 1px solid rgba(112, 37, 36, 0.1);">
                        <?= esc($product->condition) ?>
                    </span>
                </div>

                <!-- Stock Status -->
                <div style="margin-bottom: 25px; font-size: 15px; color: #555;">
                    <?php if ($product->stock > 0): ?>
                        <span style="color: #155724; font-weight: 600;">
                            <i class="fas fa-check-circle"></i> In Stock (<?= esc($product->stock) ?> available)
                        </span>
                    <?php else: ?>
                        <span style="color: #721c24; font-weight: 600;">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div style="margin-bottom: 30px;">
                    <h3 style="font-family: 'Tajawal', sans-serif; font-size: 18px; color: #333; margin-bottom: 8px; border-bottom: 2px solid #f3daac; display: inline-block; padding-bottom: 4px;">Description</h3>
                    <p style="font-family: 'Scheherazade New', serif; font-size: 18px; line-height: 1.6; color: #444;">
                        <?= nl2br(esc($product->description)) ?>
                    </p>
                </div>

                <!-- Inclusions -->
                <?php if (!empty($product->inclusions)): ?>
                    <div style="margin-bottom: 30px; background: #fdfdfd; padding: 20px; border-radius: 12px; border-left: 4px solid #f3daac;">
                        <h3 style="font-family: 'Tajawal', sans-serif; font-size: 16px; color: #333; margin: 0 0 8px 0; font-weight: 700;">
                            <i class="fas fa-box-open" style="margin-right: 8px; color: #702524;"></i> What's in the box:
                        </h3>
                        <p style="font-family: 'Scheherazade New', serif; font-size: 17px; color: #555; margin: 0;">
                            <?= nl2br(esc($product->inclusions)) ?>
                        </p>
                    </div>
                <?php endif; ?>

                <!-- Seller Info -->
                <div style="margin-bottom: 30px; font-size: 14px; color: #888; font-style: italic;">
                    Listed by: <?= esc($product->seller_name ?? 'Unknown') ?> <br>
                    Posted on: <?= date('F j, Y', strtotime($product->created_at)) ?>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 15px;">
                    <?php if ($product->stock > 0): ?>
                        <!-- Buy Now Button -->
                        <a href="<?= base_url('checkout/' . $product->id) ?>"
                            style="flex: 1; text-align: center; background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%); color: white; padding: 15px 30px; border-radius: 50px; text-decoration: none; font-family: 'Tajawal', sans-serif; font-weight: 700; font-size: 18px; box-shadow: 0 4px 15px rgba(112, 37, 36, 0.3); transition: transform 0.2s;"
                            onmouseover="this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.transform='translateY(0)'">
                            Buy Now
                        </a>
                    <?php else: ?>
                        <button disabled style="flex: 1; padding: 15px 30px; border-radius: 50px; border: none; background: #ccc; color: #666; font-weight: 700; cursor: not-allowed;">
                            Sold Out
                        </button>
                    <?php endif; ?>

                    <a href="<?= base_url('shop') ?>"
                        style="padding: 15px 25px; border-radius: 50px; text-decoration: none; color: #702524; border: 2px solid #702524; font-weight: 600; display: flex; align-items: center; justify-content: center;">
                        Back
                    </a>
                </div>

            </div>
        </div>

    </div>
</main>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>