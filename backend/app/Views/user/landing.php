<!-- Include the HEAD fragment (Relative to app/Views) -->
<?= $this->include('components/head') ?>

<!-- Include the HEADER fragment -->
<?= $this->include('components/header') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-logo">Insert Logo Here</div>
    <h1 class="hero-title">Gimmighoul</h1>
    <p class="hero-subtitle">Egypt's Digital Heritage Portal · Knowledge Bank for Heritage and Modern Egyptian History</p>
</section>

<!-- Quick Access -->
<div class="quick-access"></div>

<!-- PS5 Section -->
<section class="ps5-section">
    <div class="ps5-image">
        <div class="ps5-image-container">
            <img src="https://cdn.mos.cms.futurecdn.net/jjvkMQXMWXhtRzTxoMS67G.jpg" alt="PlayStation 5">
        </div>
    </div>
    <div class="ps5-content">
        <h2>Introducing the PS5 console and accessories</h2>
        <h3>PlayStation 5 Console</h3>
        <p>Experience an all-new generation of incredible PlayStation games.</p>
        <button class="cta-button">Find out more</button>
    </div>
</section>

<!-- Tech Section with Cards -->
<section class="tech-section">
    <div class="scroll-card-scroll">
        <div class="scroll-card">
            <div class="scroll-card-badge">New</div>
            <div class="scroll-card-image-wrapper">
                <!-- Added placeholder logic just in case src is empty -->
                <img src="" alt="Insert Image Here" onerror="this.style.display='none'">
            </div>
        </div>
        <div class="scroll-card">
            <div class="scroll-card-badge">Exclusive</div>
            <div class="scroll-card-image-wrapper">
                <img src="" alt="Insert Image Here" onerror="this.style.display='none'">
            </div>
        </div>
        <div class="scroll-card">
            <div class="scroll-card-badge">Essential</div>
            <div class="scroll-card-image-wrapper">
                <img src="" alt="Insert Image Here" onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

<!-- About Us moved above footer -->
<section class="content-section">
    <h2>About Us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
    <div class="content-types">
        <?php
        // Example of Dynamic PHP Loop for repetitive content
        $icons = range(1, 5);
        foreach ($icons as $icon):
        ?>
            <div class="content-type">
                <div class="content-icon">
                    <span class="content-icon-text"></span>
                </div>
                <p>Insert Text</p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Include the FOOTER fragment -->
<?= $this->include('components/footer') ?>