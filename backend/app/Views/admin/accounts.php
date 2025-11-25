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
        --text-muted: #666;
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

    /* --- MODERN MODAL STYLES --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.show {
        display: flex;
        opacity: 1;
    }

    .modal-container {
        background: white;
        width: 100%;
        max-width: 500px;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        transform: translateY(20px) scale(0.95);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border-top: 6px solid var(--brand);
    }

    .modal-overlay.show .modal-container {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .modal-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 24px;
        color: var(--brand);
        margin-bottom: 24px;
        border-bottom: 2px solid var(--accent);
        padding-bottom: 10px;
    }

    /* Form Styling inside Modal */
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: var(--text-main);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 16px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--text-main);
        transition: border-color 0.2s;
        outline: none;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--brand);
    }

    .modal-actions {
        margin-top: 32px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .btn-modal {
        padding: 10px 24px;
        border-radius: 50px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        border: none;
        transition: transform 0.1s;
    }

    .btn-modal:active {
        transform: scale(0.98);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
    }

    .btn-save {
        background: var(--brand);
        color: white;
        box-shadow: 0 4px 12px rgba(112, 37, 36, 0.2);
    }

    .btn-save:hover {
        background: var(--brand-light);
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
                                        <a href="javascript:void(0);" class="btn-action btn-edit" onclick='openEditModal(<?= json_encode($user) ?>)'>Edit</a>
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

<!-- Modern Edit Account Modal -->
<div id="editAccountModal" class="modal-overlay">
    <div class="modal-container">
        <h2 class="modal-title">Edit Account</h2>

        <form id="editAccountForm">
            <input type="hidden" name="id" id="editAccountId">

            <div class="form-group">
                <label class="form-label" for="editFirstName">First Name</label>
                <input type="text" name="first_name" id="editFirstName" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="editLastName">Last Name</label>
                <input type="text" name="last_name" id="editLastName" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="editEmail">Email Address</label>
                <input type="email" name="email" id="editEmail" class="form-input" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label" for="editType">Role</label>
                    <select name="type" id="editType" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="editStatus">Status</label>
                    <select name="account_status" id="editStatus" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="editGender">Gender</label>
                <select name="gender" id="editGender" class="form-select">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="">Other/Not Set</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeEditModal()" class="btn-modal btn-cancel">Cancel</button>
                <button type="submit" class="btn-modal btn-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        // Populate form
        document.getElementById('editAccountId').value = user.id;
        document.getElementById('editFirstName').value = user.first_name;
        document.getElementById('editLastName').value = user.last_name;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editType').value = user.type;
        document.getElementById('editStatus').value = user.account_status;
        document.getElementById('editGender').value = user.gender;

        // Show Modal with animation class
        const modal = document.getElementById('editAccountModal');
        modal.style.display = 'flex';
        // Small timeout to allow display:flex to apply before adding opacity class
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    function closeEditModal() {
        const modal = document.getElementById('editAccountModal');
        modal.classList.remove('show');

        // Wait for transition to finish before hiding
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Close on backdrop click
    document.getElementById('editAccountModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // AJAX form submission
    document.getElementById('editAccountForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let id = formData.get('id');

        // Assuming route is /admin/accounts/edit/{id}
        fetch('<?= site_url('admin/accounts/edit/') ?>' + id, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(err => alert('Error: ' + err));
    });
</script>

<?= $this->include('components/footer') ?>