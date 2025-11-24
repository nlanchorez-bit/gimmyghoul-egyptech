<!-- Include the HEAD component (Contains all global CSS and <body start>) -->
<?= $this->include('components/head') ?>

<!-- Include the HEADER component -->
<?= $this->include('components/header') ?>

<style>
    /* Dashboard Specific Styles matching Gimmighoul Theme */
    :root {
        --brand: #702524;
        --accent: #f3daac;
        --bg-color: #f5f5f5;
        --text-color: #161616;
    }

    .admin-wrap {
        padding: 50px;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 80vh;
    }

    .greeting {
        text-align: center;
        margin-bottom: 40px;
    }

    .greeting h1 {
        margin: 0;
        font-size: 36px;
        font-weight: 700;
        color: var(--brand);
        font-family: 'Tajawal', sans-serif;
    }

    .greeting p {
        margin-top: 10px;
        color: #666;
        font-size: 18px;
        font-family: 'Scheherazade New', serif;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    /* Card Styling based on Theme */
    .tile {
        background: #fff;
        border: 1px solid rgba(112, 37, 36, 0.15);
        /* Low opacity brand color */
        border-radius: 24px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .tile:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(112, 37, 36, 0.15);
        border-color: var(--brand);
    }

    .row {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .icon {
        width: 50px;
        height: 50px;
        background: var(--accent);
        /* Gold Accent */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
    }

    .tile .title a {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--brand);
        text-decoration: none;
    }

    .tile .title a:hover {
        text-decoration: underline;
    }

    .meta {
        color: #666;
        font-size: 15px;
        font-family: 'Scheherazade New', serif;
    }

    .count {
        font-size: 42px;
        font-weight: 700;
        color: var(--brand);
        font-family: 'Tajawal', sans-serif;
        line-height: 1;
    }

    .actions {
        margin-top: auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-plain {
        padding: 8px 16px;
        border-radius: 50px;
        border: 1px solid rgba(112, 37, 36, 0.2);
        background: transparent;
        font-weight: 600;
        text-decoration: none;
        color: var(--text-color);
        font-size: 14px;
        font-family: 'Scheherazade New', serif;
        transition: all 0.2s ease;
    }

    .btn-plain:hover {
        background: rgba(112, 37, 36, 0.05);
        color: var(--brand);
    }

    .btn-primary {
        background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        font-size: 14px;
        font-family: 'Scheherazade New', serif;
        box-shadow: 0 2px 8px rgba(112, 37, 36, 0.2);
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(112, 37, 36, 0.3);
    }

    @media (max-width: 720px) {
        .admin-wrap {
            padding: 20px;
        }
    }
</style>

<main class="admin-wrap">
    <div class="greeting">
        <h1>Welcome back, Administrator</h1>
        <p>Quick overview and shortcuts to manage system activity.</p>
    </div>

    <section class="dashboard-grid">

        <!-- HOME -->
        <div class="tile">
            <div class="row">
                <div class="icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 10.5L12 4l9 6.5" />
                        <path d="M5 21V11h14v10" />
                    </svg>
                </div>
                <div>
                    <div class="title"><a href="#">Home</a></div>
                    <div class="meta">Overview</div>
                </div>
            </div>

            <?php
            $totalEntities = ($counts['users'] ?? 0) + ($counts['products'] ?? 0) + ($counts['requests'] ?? 0);
            ?>
            <div class="count"><?= esc($totalEntities) ?></div>
            <div class="meta">Total entities</div>

            <div class="actions">
                <a class="btn-plain" href="#">Users</a>
                <a class="btn-plain" href="#">Shop</a>
                <a class="btn-primary" href="#">Open</a>
            </div>
        </div>

        <!-- SHOP PAGE -->
        <div class="tile">
            <div class="row">
                <div class="icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 7h18" />
                        <path d="M5 7v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7" />
                        <path d="M9 11h.01" />
                    </svg>
                </div>
                <div>
                    <div class="title"><a href="#">Shop Page</a></div>
                    <div class="meta">Products</div>
                </div>
            </div>

            <div class="count"><?= esc($counts['products'] ?? 0) ?></div>
            <div class="meta">Products in catalog</div>

            <div class="actions">
                <a class="btn-plain" href="#">Catalog</a>
                <a class="btn-primary" href="#">New product</a>
            </div>
        </div>

        <!-- USERS -->
        <div class="tile">
            <div class="row">
                <div class="icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 11a4 4 0 1 0-8 0" />
                        <path d="M2 21v-2a4 4 0 0 1 4-4h6" />
                    </svg>
                </div>
                <div>
                    <div class="title"><a href="#">Users</a></div>
                    <div class="meta">Accounts</div>
                </div>
            </div>

            <div class="count"><?= esc($counts['users'] ?? 0) ?></div>
            <div class="meta">Registered users</div>

            <div class="actions">
                <a class="btn-plain" href="#">Manage</a>
                <a class="btn-primary" href="#">Add</a>
            </div>
        </div>

        <!-- REQUESTS -->
        <div class="tile">
            <div class="row">
                <div class="icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10v6a2 2 0 0 1-2 2H9l-4 4V6a2 2 0 0 1 2-2h11" />
                    </svg>
                </div>
                <div>
                    <div class="title"><a href="#">Requests</a></div>
                    <div class="meta">Commissions</div>
                </div>
            </div>

            <div class="count"><?= esc($counts['requests'] ?? 0) ?></div>
            <div class="meta">Pending requests</div>

            <div class="actions">
                <a class="btn-plain" href="#">Open</a>
                <a class="btn-primary" href="#">New</a>
            </div>
        </div>

    </section>
</main>

<!-- Include the FOOTER component -->
<?= $this->include('components/footer') ?>