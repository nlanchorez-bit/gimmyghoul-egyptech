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
        padding: 40px 20px;
    }

    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* --- Quick Nav Tiles --- */
    .nav-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .nav-card {
        background: white;
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        color: var(--text-main);
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
    }

    .nav-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(112, 37, 36, 0.08);
        border-color: rgba(112, 37, 36, 0.1);
    }

    .nav-card.active {
        background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
        color: white;
        border: none;
        box-shadow: 0 8px 20px rgba(112, 37, 36, 0.2);
    }

    .nav-icon {
        width: 40px;
        height: 40px;
        background: #fdf6e3;
        /* Light accent */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
        flex-shrink: 0;
    }

    .nav-card.active .nav-icon {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .nav-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 16px;
        line-height: 1.2;
    }

    .nav-subtitle {
        font-family: 'Scheherazade New', serif;
        font-size: 14px;
        opacity: 0.8;
    }

    /* --- Page Header --- */
    .page-header {
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 28px;
        color: var(--brand);
        margin: 0;
    }

    /* --- Table Styles --- */
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
    }

    .gh-table th {
        background: #fffcf5;
        text-align: left;
        padding: 16px 20px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 13px;
        color: var(--brand);
        border-bottom: 2px solid var(--accent);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .gh-table td {
        padding: 14px 20px;
        border-bottom: 1px solid #eee;
        font-family: 'Scheherazade New', serif;
        font-size: 15px;
        color: var(--text-main);
        vertical-align: middle;
    }

    .gh-table tr:hover {
        background-color: #fafafa;
    }

    /* --- Badges & Buttons --- */
    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 11px;
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

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.2s;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-edit {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #dbeafe;
    }

    .btn-edit:hover {
        background: #dbeafe;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
    }

    .btn-delete:hover {
        background: #fee2e2;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--accent);
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-family: 'Tajawal', sans-serif;
    }
</style>

<main class="admin-wrapper">
    <div class="admin-container">

        <!-- Navigation Tiles -->
        <div class="nav-grid">
            <!-- Dashboard -->
            <a href="<?= site_url('admin') ?>" class="nav-card">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <div>
                    <div class="nav-title">Dashboard</div>
                    <div class="nav-subtitle">Overview</div>
                </div>
            </a>

            <!-- Products -->
            <a href="<?= site_url('admin/products') ?>" class="nav-card">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                        <path d="M3 6h18" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                </div>
                <div>
                    <div class="nav-title">Products</div>
                    <div class="nav-subtitle">Manage Catalog</div>
                </div>
            </a>

            <!-- Users (Active) -->
            <a href="<?= site_url('admin/users') ?>" class="nav-card active">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <div>
                    <div class="nav-title">User Base</div>
                    <div class="nav-subtitle">Accounts & Roles</div>
                </div>
            </a>

            <!-- Requests -->
            <a href="<?= site_url('admin/requests') ?>" class="nav-card">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                        <circle cx="12" cy="14" r="3" />
                    </svg>
                </div>
                <div>
                    <div class="nav-title">Requests</div>
                    <div class="nav-subtitle">Inquiries</div>
                </div>
            </a>
        </div>

        <div class="page-header">
            <h1 class="page-title">Manage User Base</h1>
            <a href="<?= site_url('users/create') ?>" class="cta-button" style="text-decoration:none; font-size:14px; padding: 10px 24px; border-radius:50px; background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%); color:white; font-weight:700;">
                + Add New User
            </a>
        </div>

        <!-- Messages -->
        <?php if (session()->getFlashdata('message')): ?>
            <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-family: 'Tajawal', sans-serif;">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-family: 'Tajawal', sans-serif;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- User Table -->
        <div class="table-card">
            <div class="table-responsive">
                <table class="gh-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th style="width: 60px;">Av.</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Gender</th>
                            <th>Created</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($accounts) && is_array($accounts)): ?>
                            <?php foreach ($accounts as $user): ?>
                                <?php
                                $id = is_object($user) ? $user->id : $user['id'];
                                $fname = is_object($user) ? $user->first_name : $user['first_name'];
                                $lname = is_object($user) ? $user->last_name : $user['last_name'];
                                $email = is_object($user) ? $user->email : $user['email'];
                                $type  = is_object($user) ? $user->type : $user['type'];
                                $status = is_object($user) ? $user->account_status : $user['account_status'];
                                $gender = is_object($user) ? $user->gender : $user['gender'];
                                $created = is_object($user) ? $user->created_at : $user['created_at'];
                                ?>
                                <tr>
                                    <td><span style="font-weight:bold; color:#999;">#<?= esc($id) ?></span></td>
                                    <td>
                                        <div class="avatar-circle">
                                            <?= strtoupper(substr($fname ?? 'U', 0, 1)) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-weight: 600; color:var(--brand);"><?= esc($fname) ?> <?= esc($lname) ?></span>
                                    </td>
                                    <td>
                                        <?php if (strtolower($type) === 'admin'): ?>
                                            <span class="badge badge-admin">Admin</span>
                                        <?php else: ?>
                                            <span class="badge badge-user">Client</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($email) ?></td>
                                    <td>
                                        <?php if ($status == 1): ?>
                                            <span class="badge badge-active">Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-inactive">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($gender ?? '-') ?></td>
                                    <td style="font-size: 13px; color: #666;">
                                        <?= date('M d, Y', strtotime((string)$created)) ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="<?= site_url('admin/accounts/edit/' . $id) ?>" class="btn-action btn-edit">Edit</a>
                                        <a href="<?= site_url('admin/accounts/delete/' . $id) ?>" class="btn-action btn-delete" onclick="return confirm('Delete this user?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align:center; padding: 40px; color: #666;">No users found in the database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<?= $this->include('components/footer') ?>