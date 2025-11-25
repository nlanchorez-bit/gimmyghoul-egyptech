<!-- Include HEAD & HEADER -->
<?= $this->include('components/head') ?>
<?= $this->include('components/header') ?>

<style>
    :root {
        --brand: #702524;
        --brand-light: #8b2f2e;
        --accent: #f3daac;
        --bg-page: #f8f9fa;
        --text-main: #161616;
    }

    .admin-wrapper {
        background-color: var(--bg-page);
        min-height: calc(100vh - 70px - 200px);
        padding: 60px 20px;
    }

    .admin-container {
        max-width: 1400px;
        /* Wider container for the large table */
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 32px;
        color: var(--brand);
        margin: 0;
    }

    /* Table Card Styles */
    .table-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border-top: 5px solid var(--brand);
        overflow: hidden;
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    .gh-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
        /* Ensure spacing on small screens */
    }

    .gh-table th {
        background: #fffcf5;
        text-align: left;
        padding: 16px 20px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: var(--brand);
        border-bottom: 2px solid var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .gh-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #eee;
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--text-main);
        vertical-align: middle;
    }

    .gh-table tr:hover {
        background-color: #fafafa;
    }

    /* Status Badges */
    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        font-family: 'Tajawal', sans-serif;
        text-transform: uppercase;
    }

    .badge-admin {
        background: var(--brand);
        color: white;
    }

    .badge-user {
        background: var(--accent);
        color: var(--brand);
    }

    .badge-active {
        background: #dcfce7;
        color: #166534;
    }

    .badge-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Action Buttons */
    .actions-cell {
        white-space: nowrap;
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        font-size: 12px;
        text-decoration: none;
        border: 1px solid transparent;
        transition: all 0.2s;
    }

    .btn-edit {
        background: #eff6ff;
        color: #1d4ed8;
        border-color: #dbeafe;
    }

    .btn-edit:hover {
        background: #dbeafe;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fee2e2;
    }

    .btn-delete:hover {
        background: #fee2e2;
    }

    /* Avatar Circle */
    .avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--accent);
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
    }
</style>

<main class="admin-wrapper">
    <div class="admin-container">

        <div class="page-header">
            <h1 class="page-title">User Base</h1>
            <a href="<?= site_url('users/create') ?>" class="cta-button" style="text-decoration:none; font-size:14px; padding: 10px 24px;">
                + Add New User
            </a>
        </div>

        <!-- User Table -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="gh-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Gender</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><span style="font-weight:bold; color:#999;">#<?= esc($user['id']) ?></span></td>
                                    <td>
                                        <div class="avatar-circle">
                                            <?= strtoupper(substr($user['first_name'] ?? 'U', 0, 1)) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600;"><?= esc($user['first_name']) ?> <?= esc($user['last_name']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (strtolower($user['type']) === 'admin'): ?>
                                            <span class="badge badge-admin">Admin</span>
                                        <?php else: ?>
                                            <span class="badge badge-user">Client</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td>
                                        <?php if ($user['account_status'] == 1): ?>
                                            <span class="badge badge-active">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-inactive">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($user['gender'] ?? '-') ?></td>
                                    <td style="font-size: 14px; color: #666;">
                                        <?= date('M d, Y H:i', strtotime($user['created_at'])) ?>
                                    </td>
                                    <td>
                                        <div class="actions-cell">
                                            <a href="<?= site_url('users/edit/' . $user['id']) ?>" class="btn-action btn-edit">Edit</a>
                                            <a href="<?= site_url('users/delete/' . $user['id']) ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align:center; padding: 40px; color: #666;">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Include FOOTER -->
<?= $this->include('components/footer') ?>