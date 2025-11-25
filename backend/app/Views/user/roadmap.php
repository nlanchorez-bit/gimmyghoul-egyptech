<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<main class="rm-page-bg">

    <!-- Hero Header with Egyptian Aesthetic -->
    <div class="rm-hero">
        <div class="rm-hero-overlay"></div>

        <div class="rm-hero-content">
            <div class="rm-pill-label">
                DEVELOPMENT ROADMAP
            </div>
            <h1 class="rm-hero-title">
                Road map
            </h1>
            <p class="rm-hero-desc">
                High-level plan and status for upcoming features.
            </p>
        </div>

        <!-- Decorative Egyptian-style border -->
        <div class="rm-border-bottom"></div>
    </div>

    <div class="rm-container">
        <!-- Filter Section -->
        <div class="rm-filter-bar">
            <div class="rm-filter-group">
                <label class="rm-filter-label" for="statusFilter">Filter:</label>
                <select id="statusFilter" class="rm-select">
                    <option value="all">All</option>
                    <option value="backlog">Backlog</option>
                    <option value="planned">Planned</option>
                    <option value="in progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="rm-filter-note">
                This is a UI-only roadmap for planning.
            </div>
        </div>

        <!-- Roadmap List -->
        <section id="roadmapList" class="rm-grid">
            <!-- Using view() helper explicitly to ensure data extraction works -->
            <?= view('components/cards/roadmap_card', [
                'title'    => 'User Management (CRUD)',
                'excerpt'  => 'Complete authentication system with signup, login, profile management, and user roles.',
                'status'   => 'In Progress',
                'priority' => 'High',
                'timeline' => 'Phase 1 - Q1 2024'
            ]) ?>

            <?= view('components/cards/roadmap_card', [
                'title'    => 'Products Management',
                'excerpt'  => 'Full product catalog system allowing admins to create, read, update, and delete products.',
                'status'   => 'Planned',
                'priority' => 'High',
                'timeline' => 'Phase 2 - Q2 2024'
            ]) ?>

            <?= view('components/cards/roadmap_card', [
                'title'    => 'Inventory Management System',
                'excerpt'  => 'Track product stock levels, manage inventory updates, and receive low-stock alerts.',
                'status'   => 'Planned',
                'priority' => 'Medium',
                'timeline' => 'Phase 3 - Q3 2024'
            ]) ?>

            <?= view('components/cards/roadmap_card', [
                'title'    => 'Product Review System',
                'excerpt'  => 'Allow customers to leave reviews and ratings for products.',
                'status'   => 'Backlog',
                'priority' => 'Medium',
                'timeline' => 'Phase 3 - Q3 2024'
            ]) ?>
        </section>
    </div>

</main>

<script>
    (function() {
        const select = document.getElementById('statusFilter');

        function normalize(s) {
            return String(s || '').trim().toLowerCase();
        }

        if (select) {
            select.addEventListener('change', function(e) {
                const v = normalize(e.target.value);
                document.querySelectorAll('#roadmapList article').forEach(function(el) {
                    const s = normalize(el.dataset.status);
                    if (v === 'all' || s === v) el.style.display = '';
                    else el.style.display = 'none';
                });
            });
        }
    })();
</script>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>