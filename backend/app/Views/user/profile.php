<?php

/**
 * views/user/profile.php
 *
 * Data contract (optional):
 * - $user: array - user data (name, email, avatar, etc.)
 * - $action: string - form action URL (default: '/profile/update')
 * - $method: string - http method (default: 'post')
 * - $errors: array|null - validation errors keyed by field name
 * - $success: string|null - success message
 */

$user = $user ?? [
    'name' => 'Pharaoh User',
    'email' => 'user@betbocrypt.com',
    'avatar' => '',
    'phone' => '',
    'address' => '',
    'city' => '',
    'country' => 'Egypt',
    'joined' => '2024-01-15',
    'orders' => 12,
    'favorites' => 5
];

$action = $action ?? '/profile/update';
$method = strtoupper($method ?? 'post');
$errors = $errors ?? [];
$success = $success ?? null;
$brandTitle = $brandTitle ?? 'Retrocrypt';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($brandTitle) ?> — Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            overflow-x: hidden;
        }

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

        .avatar-upload-btn svg {
            width: 14px;
            height: 14px;
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

        .edit-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: transparent;
            border: 2px solid #702524;
            border-radius: 8px;
            color: #702524;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            background: #702524;
            color: #f3daac;
        }

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

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 12px 16px;
            background-color: white;
            border: 2px solid #f3daac;
            border-radius: 8px;
            color: #702524;
            font-size: 14px;
            font-family: 'Tajawal', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #702524;
            box-shadow: 0 0 0 3px rgba(112, 37, 36, 0.1);
        }

        .form-group input.error {
            border-color: #ef4444;
        }

        .error-msg {
            color: #f87171;
            font-size: 13px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 2px solid #f3daac;
        }

        .btn-primary,
        .btn-secondary {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Tajawal', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: #702524;
            color: #f3daac;
            box-shadow: 0 4px 12px rgba(112, 37, 36, 0.3);
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            border: 2px solid #f3daac;
            color: #702524;
        }

        .btn-secondary:hover {
            background: #f3daac;
        }

        @media (max-width: 768px) {
            .profile-banner {
                padding: 30px 20px;
            }

            .profile-banner h1 {
                font-size: 2rem;
            }

            .profile-card {
                padding: 24px;
            }

            .avatar-card {
                padding: 20px;
            }

            .banner-icons {
                right: 20px;
            }
        }
    </style>
</head>

<body>
    <?php if ($success): ?>
        <div class="toast toast-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="toast toast-error">
            <?= htmlspecialchars($errors['general']) ?>
        </div>
    <?php endif; ?>

    <div class="egypt-profile">
        <!-- Egyptian Pattern Background -->
        <svg class="egypt-pattern" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="egypt-pattern-profile" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                    <path d="M60 20 L50 35 L45 45 L40 35 L35 45 L30 35 L20 40 L30 50 L35 60 L40 50 L45 60 L50 50 L60 55 L70 50 L75 60 L80 50 L85 60 L90 50 L100 40 L90 35 L85 45 L80 35 L75 45 L70 35 Z" fill="#702524" opacity="0.6" />
                    <circle cx="60" cy="75" r="5" fill="#702524" opacity="0.5" />
                    <rect x="58.5" y="80" width="3" height="20" fill="#702524" opacity="0.5" />
                    <rect x="52" y="87" width="16" height="3" fill="#702524" opacity="0.5" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#egypt-pattern-profile)" />
        </svg>

        <div class="profile-container">
            <!-- Profile Header -->
            <div class="profile-banner">
                <div class="pyramid-logo-small">
                    <div class="pyramid-sm"></div>
                    <div class="pyramid-inner-sm"></div>
                </div>
                <div class="banner-icons">
                    <svg width="24" height="18" viewBox="0 0 32 24" fill="none">
                        <path d="M16 4C10 4 5 12 5 12C5 12 10 20 16 20C22 20 27 12 27 12C27 12 22 4 16 4Z" stroke="#f3daac" stroke-width="1.5" />
                        <circle cx="16" cy="12" r="4" stroke="#f3daac" stroke-width="1.5" />
                    </svg>
                    <svg width="18" height="24" viewBox="0 0 20 32" fill="none">
                        <circle cx="10" cy="6" r="4" stroke="#f3daac" stroke-width="1.5" />
                        <line x1="10" y1="10" x2="10" y2="28" stroke="#f3daac" stroke-width="2" />
                        <line x1="2" y1="16" x2="18" y2="16" stroke="#f3daac" stroke-width="2" />
                    </svg>
                </div>
                <h1>My Profile</h1>
            </div>

            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Avatar Section -->
                <div class="profile-card avatar-card">
                    <div class="card-corner tl"></div>
                    <div class="card-corner tr"></div>
                    <div class="card-corner bl"></div>
                    <div class="card-corner br"></div>

                    <div class="avatar-section">
                        <div class="avatar-wrapper">
                            <?php if (!empty($user['avatar'])): ?>
                                <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="avatar-img">
                            <?php else: ?>
                                <div class="avatar-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#702524" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <button type="button" class="avatar-upload-btn" onclick="document.getElementById('avatarInput').click()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                            </button>
                            <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                        </div>
                        <h2><?= htmlspecialchars($user['name']) ?></h2>
                        <p class="user-email"><?= htmlspecialchars($user['email']) ?></p>
                        <div class="user-stats">
                            <div class="stat-item">
                                <span class="stat-value"><?= htmlspecialchars($user['orders'] ?? 0) ?></span>
                                <span class="stat-label">Orders</span>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item">
                                <span class="stat-value"><?= htmlspecialchars($user['favorites'] ?? 0) ?></span>
                                <span class="stat-label">Favorites</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="profile-card info-card">
                    <div class="card-corner tl"></div>
                    <div class="card-corner tr"></div>
                    <div class="card-corner bl"></div>
                    <div class="card-corner br"></div>

                    <div class="card-header">
                        <h3>Personal Information</h3>
                        <button type="button" class="edit-btn" onclick="toggleEdit('personal')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit
                        </button>
                    </div>

                    <form id="personalForm" action="<?= htmlspecialchars($action) ?>" method="<?= $method === 'GET' ? 'get' : 'post' ?>" class="profile-form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="personal">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input id="name" name="name" type="text" required value="<?= htmlspecialchars($user['name']) ?>" class="<?= isset($errors['name']) ? 'error' : '' ?>">
                                <?php if (!empty($errors['name'])): ?>
                                    <span class="error-msg"><?= htmlspecialchars($errors['name']) ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" type="email" required value="<?= htmlspecialchars($user['email']) ?>" class="<?= isset($errors['email']) ? 'error' : '' ?>">
                                <?php if (!empty($errors['email'])): ?>
                                    <span class="error-msg"><?= htmlspecialchars($errors['email']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input id="phone" name="phone" type="tel" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="+20 123 456 7890">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" name="country" type="text" value="<?= htmlspecialchars($user['country'] ?? '') ?>" placeholder="Egypt">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" name="address" type="text" value="<?= htmlspecialchars($user['address'] ?? '') ?>" placeholder="Street address">
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input id="city" name="city" type="text" value="<?= htmlspecialchars($user['city'] ?? '') ?>" placeholder="Cairo">
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary" onclick="cancelEdit('personal')">Cancel</button>
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(formType) {
            const form = document.getElementById(formType + 'Form');
            const editBtn = form.closest('.profile-card').querySelector('.edit-btn');

            if (editBtn.innerHTML.includes('Cancel')) {
                editBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit';
            } else {
                editBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel';
            }
        }

        function cancelEdit(formType) {
            const form = document.getElementById(formType + 'Form');
            form.reset();
            toggleEdit(formType);
        }

        setTimeout(function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            });
        }, 5000);
    </script>
</body>

</html>