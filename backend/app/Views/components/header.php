<!-- Header -->
<header class="header">
    <nav class="nav-menu">
        <a href="<?= site_url('/') ?>" class="nav-item" style="text-decoration: none;">Home</a>
        <a href="<?= site_url('shop') ?>" class="nav-item" style="text-decoration: none;">Consoles</a>
        <a href="<?= site_url('accessories') ?>" class="nav-item" style="text-decoration: none;">Accessories</a>
        <a href="<?= site_url('support') ?>" class="nav-item" style="text-decoration: none;">Support</a>
        <a href="<?= site_url('about-us') ?>" class="nav-item" style="text-decoration: none;">About Us</a>
    </nav>
    <div style="display:flex; gap:0.75rem;">
        <?php if (session()->has('user')): ?>
            <!-- Logged-in state -->
            <form action="/logout" method="post" style="margin:0;">
                <?= csrf_field() ?>
                <button type="submit"
                    style="
                        background-color:#d20000ff;
                        color:white;
                        padding:0.5rem 1rem;
                        border:none;
                        border-radius:0.5rem;
                        cursor:pointer;
                        font-weight:500;
                        transition:background-color 0.3s;
                    "
                    onmouseover="this.style.backgroundColor='#a90000ff';"
                    onmouseout="this.style.backgroundColor='#d20000ff';">
                    Logout
                </button>
            </form>
        <?php else: ?>

            <!-- Sign Up Button as a Link -->
            <a href="<?= site_url('signup') ?>" class="signup-btn" style="text-decoration: none;">Sign Up</a>
        <?php endif; ?>
</header>