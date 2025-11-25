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
            <?php if (!empty($products) && is_array($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="shop-grid-item">
                        <!-- Reuse existing product card component -->
                        <?= view('components/cards/product_card', ['product' => $product]) ?>
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