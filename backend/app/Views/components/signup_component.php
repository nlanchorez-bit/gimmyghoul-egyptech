<?php
$action = $action ?? '/signup';
$method = strtoupper($method ?? 'post');
$errors = $errors ?? [];
$old = $old ?? [];
?>

<div class="egypt-login">
    <svg class="egypt-pattern" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="egypt-pattern" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                <path d="M60 20 L50 35 L45 45 L40 35 L35 45 L30 35 L20 40 L30 50 L35 60 L40 50 L45 60 L50 50 L60 55 L70 50 L75 60 L80 50 L85 60 L90 50 L100 40 L90 35 L85 45 L80 35 L75 45 L70 35 Z" fill="#702524" opacity="0.6" />
                <circle cx="60" cy="75" r="5" fill="#702524" opacity="0.5" />
                <rect x="58.5" y="80" width="3" height="20" fill="#702524" opacity="0.5" />
                <rect x="52" y="87" width="16" height="3" fill="#702524" opacity="0.5" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#egypt-pattern)" />
    </svg>

    <div class="egypt-form-container">
        <div class="egypt-form-wrap">
            <div class="egypt-header">
                <div class="egypt-logo">
                    <div class="pyramid"></div>
                    <div class="pyramid-inner"></div>
                </div>
                <div class="egypt-icons">
                    <!-- SVG icons remain unchanged -->
                </div>

                <h1>Sign Up</h1>
                <p>Create your account to get started</p>
                <div class="egypt-divider">
                    <span></span><i></i><span></span>
                </div>
            </div>

            <div class="egypt-card">
                <!-- Corner SVGs remain unchanged -->

                <form action="<?= htmlspecialchars($action) ?>" method="<?= $method === 'GET' ? 'get' : 'post' ?>" class="egypt-form" novalidate>
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input id="first_name" name="first_name" type="text" required value="<?= htmlspecialchars($old['first_name'] ?? '') ?>" placeholder="Enter your first name" class="<?= isset($errors['first_name']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['first_name']) ? 'true' : 'false' ?>">
                        <?php if (!empty($errors['first_name'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['first_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" name="middle_name" type="text" value="<?= htmlspecialchars($old['middle_name'] ?? '') ?>" placeholder="Middle name (optional)" class="<?= isset($errors['middle_name']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['middle_name']) ? 'true' : 'false' ?>">
                        <?php if (!empty($errors['middle_name'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['middle_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" required value="<?= htmlspecialchars($old['last_name'] ?? '') ?>" placeholder="Enter your last name" class="<?= isset($errors['last_name']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['last_name']) ? 'true' : 'false' ?>">
                        <?php if (!empty($errors['last_name'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['last_name']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" name="email" type="email" required value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="your.email@example.com" class="<?= isset($errors['email']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['email']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <input id="password" name="password" type="password" required placeholder="Create a password" class="<?= isset($errors['password']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'false' ?>">
                            <button type="button" class="toggle-pwd" onclick="togglePwd('password')">
                                <!-- Eye icon SVG -->
                            </button>
                        </div>
                        <?php if (!empty($errors['password'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['password']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirm Password</label>
                        <div class="input-wrap">
                            <input id="password_confirm" name="password_confirm" type="password" required placeholder="Confirm your password" class="<?= isset($errors['password_confirm']) ? 'error' : '' ?>" aria-invalid="<?= isset($errors['password_confirm']) ? 'true' : 'false' ?>">
                            <button type="button" class="toggle-pwd" onclick="togglePwd('password_confirm')">
                                <!-- Eye icon SVG -->
                            </button>
                        </div>
                        <?php if (!empty($errors['password_confirm'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['password_confirm']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-row">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" value="1" <?= !empty($old['terms']) ? 'checked' : '' ?> required>
                            <span>I agree to the <a href="/terms" target="_blank">Terms & Conditions</a></span>
                        </label>
                        <?php if (!empty($errors['terms'])): ?>
                            <span class="error-msg"><?= htmlspecialchars($errors['terms']) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="submit-btn">Create Account</button>

                    <div class="form-footer">
                        <p>Already have an account? <a href="/login">Login here</a></p>
                    </div>
                </form>
            </div>

            <div class="egypt-dots">
                <i class="d1"></i><i class="d2"></i><i class="d3"></i><span></span><i class="d3"></i><i class="d2"></i><i class="d1"></i>
            </div>
        </div>
    </div>
</div>

<!-- Keep your CSS and JS as-is -->


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

    .egypt-login {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background-color: #f3daac;
    }

    .egypt-pattern {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0.1;
        pointer-events: none;
    }

    .egypt-form-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px;
        position: relative;
        z-index: 10;
    }

    .egypt-form-wrap {
        width: 100%;
        max-width: 448px;
    }

    .egypt-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .egypt-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 24px;
        position: relative;
    }

    .pyramid {
        width: 96px;
        height: 96px;
        background: linear-gradient(135deg, #702524 0%, #8b3a38 100%);
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .pyramid-inner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: #f3daac;
        clip-path: polygon(50% 15%, 15% 85%, 85% 85%);
    }

    .egypt-icons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .egypt-header h1 {
        font-family: 'Scheherazade New', serif;
        font-size: 3rem;
        color: #702524;
        margin-bottom: 12px;
    }

    .egypt-header p {
        font-size: 1.125rem;
        color: #702524;
        opacity: 0.8;
    }

    .egypt-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 16px;
    }

    .egypt-divider span {
        height: 1px;
        width: 48px;
        background-color: #702524;
        opacity: 0.3;
    }

    .egypt-divider i {
        width: 8px;
        height: 8px;
        background-color: #702524;
        opacity: 0.5;
        transform: rotate(45deg);
    }

    .egypt-card {
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 32px;
        backdrop-filter: blur(8px);
        position: relative;
        overflow: hidden;
        background-color: rgba(255, 255, 255, 0.95);
        border: 4px solid #702524;
    }

    .egypt-card svg[class^="corner-"] {
        position: absolute;
        width: 80px;
        height: 80px;
        opacity: 0.2;
    }

    .corner-tl {
        top: 0;
        left: 0;
    }

    .corner-tr {
        top: 0;
        right: 0;
    }

    .corner-bl {
        bottom: 0;
        left: 0;
    }

    .corner-br {
        bottom: 0;
        right: 0;
    }

    .egypt-form {
        position: relative;
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        color: #702524;
        font-size: 14px;
    }

    .input-wrap {
        position: relative;
    }

    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group input[type="text"] {
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

    .toggle-pwd {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #702524;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        transition: opacity 0.2s ease;
    }

    .toggle-pwd:hover {
        opacity: 0.7;
    }

    .error-msg {
        color: #f87171;
        font-size: 13px;
    }

    .form-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        cursor: pointer;
        color: #702524;
        font-size: 14px;
        line-height: 1.5;
    }

    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #702524;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .checkbox-label a {
        color: #702524;
        text-decoration: underline;
    }

    .submit-btn {
        width: 100%;
        padding: 14px 24px;
        background-color: #702524;
        color: #f3daac;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-family: 'Tajawal', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 8px 20px rgba(112, 37, 36, 0.3);
    }

    .submit-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(112, 37, 36, 0.4);
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
        color: #702524;
        font-size: 14px;
    }

    .form-footer a {
        color: #702524;
        text-decoration: none;
        opacity: 0.8;
        transition: all 0.2s ease;
    }

    .form-footer a:hover {
        text-decoration: underline;
        opacity: 1;
    }

    .egypt-dots {
        margin-top: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .egypt-dots i {
        border-radius: 50%;
        background-color: #702524;
    }

    .egypt-dots .d1 {
        width: 12px;
        height: 12px;
    }

    .egypt-dots .d2 {
        width: 8px;
        height: 8px;
        opacity: 0.6;
    }

    .egypt-dots .d3 {
        width: 6px;
        height: 6px;
        opacity: 0.4;
    }

    .egypt-dots span {
        height: 1px;
        width: 64px;
        background-color: #702524;
        opacity: 0.3;
    }

    @media (max-width: 480px) {
        .egypt-card {
            padding: 24px 20px;
        }

        .egypt-header h1 {
            font-size: 2rem;
        }

        .pyramid {
            width: 72px;
            height: 72px;
        }
    }
</style>

<script>
    function togglePwd(id) {
        const input = document.getElementById(id);
        const btn = input.parentElement.querySelector('.toggle-pwd');
        if (input.type === 'password') {
            input.type = 'text';
            btn.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
        } else {
            input.type = 'password';
            btn.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        }
    }
</script>