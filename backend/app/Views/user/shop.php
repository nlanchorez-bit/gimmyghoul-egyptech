<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main style="background-color: #f9f9f9; min-height: 100vh;">

    <!-- Shop Hero Section -->
    <div class="shop-hero">
        <div class="shop-hero-overlay"></div>
        <div class="shop-hero-content">
            <h1 class="shop-title">Console Catalog</h1>
            <p class="shop-subtitle">Discover the next generation of gaming. Available now at Gimmighoul.</p>

            <!-- NEW: Upload Button (Visible to logged-in users) -->
            <?php if (session()->has('user')): ?>
                <div style="margin-top: 25px;">
                    <a href="<?= base_url('shop/upload') ?>" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 8px;"></i> Sell Your Console
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="shop-hero-border"></div>
    </div>

    <!-- Main Content Container -->
    <div class="shop-container">

        <!-- Sidebar / Filter Area (Visual Only for UI) -->
        <aside class="shop-sidebar">
            <div class="filter-card">
                <h3 class="filter-title">Categories</h3>
                <ul class="filter-list">
                    <li><a href="#" class="active">All Consoles</a></li>
                    <li><a href="#">PlayStation</a></li>
                    <li><a href="#">Xbox</a></li>
                    <li><a href="#">Nintendo</a></li>
                    <li><a href="#">Handhelds</a></li>
                </ul>
            </div>

            <div class="filter-card">
                <h3 class="filter-title">Price Range</h3>
                <div class="price-inputs">
                    <input type="number" placeholder="Min" class="price-input">
                    <input type="number" placeholder="Max" class="price-input">
                </div>
                <button class="filter-btn">Apply</button>
            </div>
        </aside>

        <!-- Product Grid -->
        <section class="shop-grid">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div style="width: 100%; padding: 15px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="width: 100%; padding: 15px; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($products) && is_array($products)): ?>
                <?php
                // Get user session data for permission checks
                $currentUserId = session()->get('user.id');
                $userType      = session()->get('user.type');
                ?>

                <?php foreach ($products as $product): ?>
                    <?php $product = (object) $product; // <--- FIX: Ensure it is an object so ->created_by works 
                    ?>
                    <div class="shop-grid-item" style="position: relative;">
                        <!-- Reuse existing product card component -->
                        <?= view('components/cards/product_card', ['product' => $product]) ?>

                        <!-- NEW: Delete Button (Overlay) -->
                        <!-- Logic: Show if Admin OR if Current User owns the product -->
                        <?php if ((isset($currentUserId) && $currentUserId == $product->created_by) || (isset($userType) && $userType === 'admin')): ?>
                            <a href="<?= base_url('shop/delete/' . $product->id) ?>"
                                class="btn btn-secondary"
                                onclick="return confirm('Are you sure you want to delete this item? This cannot be undone.');"
                                title="Delete Item"
                                style="
                                   position: absolute; 
                                   top: 10px; 
                                   right: 10px; 
                                   z-index: 10; 
                                   padding: 0; 
                                   width: 32px; 
                                   height: 32px; 
                                   display: flex; 
                                   align-items: center; 
                                   justify-content: center; 
                                   border-radius: 50%; 
                                   box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                                   font-size: 14px;
                               ">
                                <i class="fas fa-trash-alt" style="color: #702524;"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-products">
                    <p>No products found in the catalog.</p>
                </div>
            <?php endif; ?>
        </section>

    </div>

</main>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>