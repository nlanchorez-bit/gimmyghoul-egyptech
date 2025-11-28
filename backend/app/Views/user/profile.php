<?php
// Initialize variables with defaults to prevent "Undefined variable" errors
$user = $user ?? [];
// Fallback for display name if only parts exist
if (!isset($user['display_name']) && isset($user['first_name'])) {
    $user['display_name'] = $user['first_name'] . ' ' . ($user['last_name'] ?? '');
}
$action = $action ?? '/profile/update';
$method = $method ?? 'post';
$errors = $errors ?? [];
$success = session()->getFlashdata('success');
?>
<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<!-- Page-Specific Styles (Rendered in Body) -->
<style>
    /* Toast Notifications */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .toast-success {
        background: #10b981;
    }

    .toast-error {
        background: #ef4444;
    }

    /* Layout */
    .egypt-profile {
        min-height: 100vh;
        position: relative;
        background-color: #f3daac;
        padding: 40px 20px;
    }

    .egypt-pattern {
        position: fixed;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0.1;
        pointer-events: none;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
    }

    /* Banner */
    .profile-banner {
        background: linear-gradient(135deg, #702524 0%, #8b3a38 100%);
        border-radius: 24px 24px 0 0;
        padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 4px solid #702524;
        border-bottom: none;
    }

    .pyramid-logo-small {
        display: inline-flex;
        justify-content: center;
        margin-bottom: 16px;
        position: relative;
    }

    .pyramid-sm {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f3daac 0%, #e6d199 100%);
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .pyramid-inner-sm {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: #702524;
        clip-path: polygon(50% 15%, 15% 85%, 85% 85%);
    }

    .banner-icons {
        position: absolute;
        top: 20px;
        right: 40px;
        display: flex;
        gap: 12px;
        opacity: 0.3;
    }

    .profile-banner h1 {
        font-family: 'Scheherazade New', serif;
        font-size: 2.5rem;
        color: #f3daac;
        margin: 0;
    }

    /* Content Grid */
    .profile-content {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-top: 24px;
    }

    @media (min-width: 768px) {
        .profile-content {
            grid-template-columns: 300px 1fr;
        }
    }

    /* Cards */
    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        padding: 32px;
        border: 3px solid #702524;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .avatar-card {
        padding: 24px;
    }

    /* Corners */
    .card-corner {
        position: absolute;
        width: 40px;
        height: 40px;
        background: #702524;
        opacity: 0.1;
    }

    .card-corner.tl {
        top: 0;
        left: 0;
        clip-path: polygon(0 0, 100% 0, 0 100%);
    }

    .card-corner.tr {
        top: 0;
        right: 0;
        clip-path: polygon(100% 0, 0 0, 100% 100%);
    }

    .card-corner.bl {
        bottom: 0;
        left: 0;
        clip-path: polygon(0 100%, 100% 100%, 0 0);
    }

    .card-corner.br {
        bottom: 0;
        right: 0;
        clip-path: polygon(100% 100%, 0 100%, 100% 0);
    }

    /* Avatar */
    .avatar-section {
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 16px;
    }

    .avatar-img,
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 4px solid #702524;
        object-fit: cover;
    }

    .avatar-placeholder {
        background: #f3daac;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-upload-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #702524;
        color: #f3daac;
        border: 3px solid white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .avatar-upload-btn:hover {
        transform: scale(1.1);
    }

    .avatar-section h2 {
        font-family: 'Scheherazade New', serif;
        font-size: 1.5rem;
        color: #702524;
        margin-bottom: 6px;
    }

    .user-email {
        color: #702524;
        opacity: 0.7;
        font-size: 13px;
        margin-bottom: 20px;
    }

    /* Stats */
    .user-stats {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 24px;
        padding-top: 20px;
        border-top: 2px solid #f3daac;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-value {
        font-family: 'Scheherazade New', serif;
        font-size: 1.75rem;
        color: #702524;
    }

    .stat-label {
        font-size: 11px;
        color: #702524;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-divider {
        width: 1px;
        height: 35px;
        background: #702524;
        opacity: 0.2;
    }

    /* Form Header */
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        position: relative;
        z-index: 10;
    }

    .card-header h3 {
        font-family: 'Scheherazade New', serif;
        font-size: 1.5rem;
        color: #702524;
    }

    /* Form */
    .profile-form {
        position: relative;
        z-index: 10;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-bottom: 16px;
    }

    @media (min-width: 640px) {
        .form-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .form-group label {
        color: #702524;
        font-size: 14px;
    }

    /* Inputs - Readonly Style */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 16px;
        background-color: #fcfcfc;
        /* Slightly darker to indicate readonly */
        border: 2px solid #f3daac;
        border-radius: 8px;
        color: #702524;
        font-size: 14px;
        font-family: 'Tajawal', sans-serif;
        outline: none;
        cursor: default;
    }

    /* Remove focus shadow for readonly inputs */
    .form-group input:focus,
    .form-group select:focus {
        border-color: #f3daac;
        box-shadow: none;
    }
</style>

<?php if (session()->getFlashdata('success')): ?>
    <div class="toast toast-success"><?= htmlspecialchars(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<div class="egypt-profile">
    <!-- Pattern BG -->
    <svg class="egypt-pattern" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="egypt-pattern-profile" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                <path d="M60 20 L50 35 L45 45 L40 35 L35 45 L30 35 L20 40 L30 50 L35 60 L40 50 L45 60 L50 50 L60 55 L70 50 L75 60 L80 50 L85 60 L90 50 L100 40 L90 35 L85 45 L80 35 L75 45 L70 35 Z" fill="#702524" opacity="0.6" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#egypt-pattern-profile)" />
    </svg>

    <div class="profile-container">
        <!-- Banner -->
        <div class="profile-banner">
            <div class="pyramid-logo-small">
                <div class="pyramid-sm"></div>
                <div class="pyramid-inner-sm"></div>
            </div>
            <div class="banner-icons">
                <!-- Deco Icons -->
                <svg width="24" height="18" viewBox="0 0 32 24" fill="none">
                    <path d="M16 4C10 4 5 12 5 12C5 12 10 20 16 20C22 20 27 12 27 12C27 12 22 4 16 4Z" stroke="#f3daac" stroke-width="1.5" />
                    <circle cx="16" cy="12" r="4" stroke="#f3daac" stroke-width="1.5" />
                </svg>
            </div>
            <h1>My Profile</h1>
        </div>

        <div class="profile-content">
            <!-- Avatar Card -->
            <div class="profile-card avatar-card">
                <div class="card-corner tl"></div>
                <div class="card-corner tr"></div>
                <div class="card-corner bl"></div>
                <div class="card-corner br"></div>

                <div class="avatar-section">
                    <div class="avatar-wrapper">
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="avatar-img" id="avatarPreview">
                        <?php else: ?>
                            <div class="avatar-placeholder" id="avatarPlaceholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#702524" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <img src="" alt="Avatar" class="avatar-img" id="avatarPreview" style="display:none;">
                        <?php endif; ?>

                        <!-- Upload Button (Kept as requested) -->
                        <button type="button" class="avatar-upload-btn" onclick="document.getElementById('avatarInput').click()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                    </div>
                    <h2><?= htmlspecialchars($user['display_name'] ?? '') ?></h2>
                    <p class="user-email"><?= htmlspecialchars($user['email'] ?? '') ?></p>

                    <div class="user-stats">
                        <div class="stat-item"><span class="stat-value"><?= htmlspecialchars($user['orders'] ?? 0) ?></span><span class="stat-label">Orders</span></div>
                        <div class="stat-divider"></div>
                        <div class="stat-item"><span class="stat-value"><?= htmlspecialchars($user['favorites'] ?? 0) ?></span><span class="stat-label">Favorites</span></div>
                    </div>
                </div>
            </div>

            <!-- Personal Info Card -->
            <div class="profile-card info-card">
                <div class="card-corner tl"></div>
                <div class="card-corner tr"></div>
                <div class="card-corner bl"></div>
                <div class="card-corner br"></div>

                <div class="card-header">
                    <h3>Personal Information</h3>
                    <!-- Removed Edit Button -->
                </div>

                <form id="personalForm" class="profile-form">
                    <!-- Removed action and CSRF since form is not submittable -->
                    <input type="hidden" name="form_type" value="personal">

                    <!-- Split Name Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" name="first_name" type="text" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" name="last_name" type="text" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
                    </div>

                    <!-- Removed Form Actions (Cancel / Save Changes) -->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.style.opacity = 1;
        toast.innerText = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // Avatar Upload Logic (Kept as requested)
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const formData = new FormData();
            formData.append('avatar', file);

            // Preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                const placeholder = document.getElementById('avatarPlaceholder');

                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);

            // Upload via AJAX
            fetch('<?= base_url('profile/upload-avatar') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Profile picture updated!', 'success');
                    } else {
                        showToast(data.error || 'Upload failed', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred during upload', 'error');
                });
        }
    });

    setTimeout(() => {
        const t = document.querySelector('.toast');
        if (t) {
            t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        }
    }, 5000);
</script>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>