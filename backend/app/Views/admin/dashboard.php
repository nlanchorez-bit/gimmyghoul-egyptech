<!-- Include the HEAD component (Contains all global CSS and <body start>) -->
<?= $this->include('components/head') ?>

<!-- Include the HEADER component -->
<?= $this->include('components/header') ?>

<style>
    :root {
        --brand: #702524;
        --brand-light: #8b2f2e;
        --accent: #f3daac;
        --accent-light: #fdf6e3;
        --text-main: #161616;
        --text-muted: #666;
        --bg-page: #f8f9fa;
    }

    /* Page Layout */
    .admin-wrapper {
        background-color: var(--bg-page);
        min-height: calc(100vh - 70px - 200px);
        /* Approx header/footer height deduction */
        padding: 60px 20px;
    }

    .admin-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header Section */
    .admin-header {
        text-align: center;
        margin-bottom: 60px;
        position: relative;
    }

    .admin-header h1 {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 42px;
        color: var(--brand);
        margin: 0 0 12px 0;
        letter-spacing: -0.5px;
    }

    .admin-header p {
        font-family: 'Scheherazade New', serif;
        font-size: 20px;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.5;
    }

    .admin-header::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: var(--accent);
        margin: 25px auto 0;
        border-radius: 2px;
    }

    /* Grid Layout */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    /* Card Component */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.03);
        border-top: 5px solid var(--brand);
        /* Brand accent top */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(112, 37, 36, 0.1);
    }

    /* Card Header: Icon + Title */
    .stat-header {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        background: var(--accent-light);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
        background: var(--accent);
    }

    .stat-details {
        flex-grow: 1;
    }

    .stat-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--text-main);
        margin-bottom: 4px;
        line-height: 1.2;
    }

    .stat-title a {
        text-decoration: none;
        color: inherit;
        transition: color 0.2s;
    }

    .stat-title a:hover {
        color: var(--brand);
    }

    .stat-subtitle {
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1;
    }

    /* Card Body: Numbers */
    .stat-body {
        margin-bottom: 30px;
    }

    .stat-number {
        display: block;
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 48px;
        color: var(--brand);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-label {
        font-family: 'Scheherazade New', serif;
        font-size: 15px;
        color: var(--text-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Card Actions: Buttons */
    .stat-actions {
        display: flex;
        gap: 12px;
        margin-top: auto;
        /* Pushes actions to bottom */
    }

    .btn-dash {
        padding: 10px 20px;
        border-radius: 12px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
        text-align: center;
        flex: 1;
        /* Buttons take equal width */
    }

    .btn-dash-primary {
        background: var(--brand);
        color: white;
        border: 2px solid var(--brand);
        box-shadow: 0 4px 12px rgba(112, 37, 36, 0.2);
    }

    .btn-dash-primary:hover {
        background: var(--brand-light);
        border-color: var(--brand-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(112, 37, 36, 0.3);
        color: white;
    }

    .btn-dash-outline {
        background: transparent;
        color: var(--text-main);
        border: 2px solid #eee;
    }

    .btn-dash-outline:hover {
        border-color: var(--brand);
        color: var(--brand);
        background: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .admin-header h1 {
            font-size: 32px;
        }

        .stat-number {
            font-size: 36px;
        }
    }
</style>

<main class="admin-wrapper">
    <div class="admin-container">

        <div class="admin-header">
            <h1>Dashboard Overview</h1>
            <p>Welcome back, Administrator. Here is a quick summary of your system's performance and quick actions.</p>
        </div>

        <div class="dashboard-grid">

            <!-- 1. HOME / OVERVIEW CARD -->
            <article class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <div class="stat-details">
                        <div class="stat-title"><a href="<?= site_url('/') ?>">Home Page</a></div>
                        <div class="stat-subtitle">System Overview</div>
                    </div>
                </div>

                <div class="stat-body">
                    <?php
                    $totalEntities = ($counts['users'] ?? 0) + ($counts['products'] ?? 0) + ($counts['requests'] ?? 0);
                    ?>
                    <span class="stat-number"><?= esc($totalEntities) ?></span>
                    <span class="stat-label">Total Records</span>
                </div>

                <div class="stat-actions">
                    <a href="<?= site_url('/') ?>" class="btn-dash btn-dash-primary" target="_blank">
                        View Live Site
                    </a>
                </div>
            </article>

            <!-- 2. SHOP CARD -->
            <article class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <!-- Shopping Bag Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                            <path d="M3 6h18" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                    </div>
                    <div class="stat-details">
                        <div class="stat-title"><a href="<?= site_url('shop') ?>">Shop Catalog</a></div>
                        <div class="stat-subtitle">Product Management</div>
                    </div>
                </div>

                <div class="stat-body">
                    <span class="stat-number"><?= esc($counts['products'] ?? 0) ?></span>
                    <span class="stat-label">Active Products</span>
                </div>

                <div class="stat-actions">
                    <a href="<?= site_url('shop') ?>" class="btn-dash-outline btn-dash">View Catalog</a>
                    <!-- Points to Shop controller for uploading -->
                    <a href="<?= site_url('shop/upload') ?>" class="btn-dash btn-dash-primary">+ Add Product</a>
                </div>
            </article>

            <!-- 3. USERS CARD -->
            <article class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <!-- Users Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div class="stat-details">
                        <!-- FIX: Added 'admin/' prefix -->
                        <div class="stat-title"><a href="<?= site_url('admin/accounts') ?>">User Base</a></div>
                        <div class="stat-subtitle">Account & Roles</div>
                    </div>
                </div>

                <div class="stat-body">
                    <span class="stat-number"><?= esc($counts['users'] ?? 0) ?></span>
                    <span class="stat-label">Registered Users</span>
                </div>

                <div class="stat-actions">
                    <!-- FIX: Added 'admin/' prefix -->
                    <a href="<?= site_url('admin/accounts') ?>" class="btn-dash-outline btn-dash">Manage</a>
                    <a href="<?= site_url('admin/accounts') ?>" class="btn-dash btn-dash-primary">View Users</a>
                </div>
            </article>

            <!-- 4. REQUESTS CARD -->
            <article class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <!-- Inbox/Requests Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                            <circle cx="12" cy="14" r="3" />
                        </svg>
                    </div>
                    <div class="stat-details">
                        <!-- FIX: Added 'admin/' prefix -->
                        <div class="stat-title"><a href="<?= site_url('admin/requests') ?>">Requests</a></div>
                        <div class="stat-subtitle">Commissions & Orders</div>
                    </div>
                </div>

                <div class="stat-body">
                    <span class="stat-number"><?= esc($counts['requests'] ?? 0) ?></span>
                    <span class="stat-label">Pending Reviews</span>
                </div>

                <div class="stat-actions">
                    <!-- FIX: Added 'admin/' prefix -->
                    <a href="<?= site_url('admin/requests') ?>" class="btn-dash-outline btn-dash">View All</a>
                    <!-- Removed 'New Request' button since Admins manage requests, buyers create them -->
                </div>
            </article>

        </div>
    </div>
</main>

<!-- Include the FOOTER component -->
<?= $this->include('components/footer') ?>