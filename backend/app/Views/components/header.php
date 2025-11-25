<!-- Header -->
<header class="header">
    <nav class="nav-menu">
        <!-- Converted buttons to anchors using site_url() for proper CI4 routing -->
        <a href="<?= site_url('/') ?>" class="nav-item" style="text-decoration: none;">Home</a>
        <a href="<?= site_url('games') ?>" class="nav-item" style="text-decoration: none;">Consoles</a>
        <a href="<?= site_url('accessories') ?>" class="nav-item" style="text-decoration: none;">Accessories</a>
        <a href="<?= site_url('support') ?>" class="nav-item" style="text-decoration: none;">Support</a>
        <a href="<?= site_url('about-us') ?>" class="nav-item" style="text-decoration: none;">About Us</a>
    </nav>


    <!-- Sign Up Button as a Link -->
    <a href="<?= site_url('signup') ?>" class="signup-btn" style="text-decoration: none;">Sign Up</a>
</header>