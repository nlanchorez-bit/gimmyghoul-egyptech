<!-- Include the HEAD fragment (Relative to app/Views) -->
<?= $this->include('components/head') ?>

<!-- Include the HEADER fragment -->
<?= $this->include('components/header') ?>

<!-- Hero Section -->
<section class="hero-section">
    <h1 class="hero-title"></h1>
    <p class="hero-subtitle"></p>
</section>

<!-- Quick Access -->
<div class="quick-access"></div>

<!-- PS5 Section -->
<section class="ps5-section">
    <div class="ps5-image">
        <div class="ps5-image-container">
            <img src="https://i.imgur.com/2aALxX2.png" alt="PlayStation 5">
        </div>
    </div>
    <div class="ps5-content">
        <h2>RetroCrypt's Finest</h2>
        <h3>Pharaoh's Recommended!</h3>
        <p>We sell retro consoles, camera, and other gadgets all blessed by sun god Ra.</p>
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
                <img src="https://i.imgur.com/Dh0cDw8.png" alt="https://i.imgur.com/Dh0cDw8.png" onerror="this.style.display='none'">
            </div>
        </div>
        <div class="scroll-card">
            <div class="scroll-card-badge">Exclusive</div>
            <div class="scroll-card-image-wrapper">
                <img src="https://i.imgur.com/sYTVXxv.png" alt="https://i.imgur.com/sYTVXxv.png" onerror="this.style.display='none'">
            </div>
        </div>
        <div class="scroll-card">
            <div class="scroll-card-badge">Essential</div>
            <div class="scroll-card-image-wrapper">
                <img src="https://i.imgur.com/dud5o3x.png" alt="https://i.imgur.com/dud5o3x.png" onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

<!-- About Us moved above footer -->
<section class="content-section">
    <h2>About Us</h2>
    <p>RetroCrypt is a platform where your gadgets can be sold with a thriving community of egyptian gods and goddesses. We sell and resells all sorts of gadgets from retro consoles, camera, ipods, and other gadgets available from river nile and back.</p>
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
                <p></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Include the FOOTER fragment -->
<?= $this->include('components/footer') ?>