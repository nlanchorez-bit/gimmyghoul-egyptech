<!-- Header -->
<header class="header">
    <nav class="nav-menu">
        <a href="<?= site_url('/') ?>" class="nav-item" style="text-decoration: none;">Home</a>
        <a href="<?= site_url('shop') ?>" class="nav-item" style="text-decoration: none;">Store</a>
        <a href="<?= site_url('support') ?>" class="nav-item" style="text-decoration: none;">Support</a>
        <a href="<?= site_url('about-us') ?>" class="nav-item" style="text-decoration: none;">About Us</a>
    </nav>
    <div style="display:flex; gap:0.75rem; align-items: center;">
        <?php if (session()->has('user')): ?>
            <!-- Logged-in state -->
            <form action="/logout" method="post" style="margin:0;">
                <?= csrf_field() ?>
                <!-- Applied 'signup-btn' class to match the design -->
                <button type="submit" class="signup-btn">
                    Logout
                </button>
            </form>
        <?php else: ?>

            <!-- Sign Up Button as a Link -->
            <a href="<?= site_url('signup') ?>" class="signup-btn" style="text-decoration: none;">Sign Up</a>
        <?php endif; ?>
    </div>
</header>