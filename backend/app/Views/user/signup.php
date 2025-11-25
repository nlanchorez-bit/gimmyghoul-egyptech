signup.php.txt
<?php

/**
 * views/auth/signup.php
 *
 * Data contract (optional):
 * - $action: string - form action URL (default: '/signup')
 * - $method: string - http method (default: 'post')
 * - $errors: array|null - validation errors keyed by field name
 * - $old: array|null - old input values
 */

$action = $action ?? '/signup';
$method = strtoupper($method ?? 'post');
$errors = $errors ?? [];
$old = $old ?? [];
$brandTitle = $brandTitle ?? 'Egypt';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($brandTitle) ?> — Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php if (!empty($success)): ?>
        <div class="toast toast-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="toast toast-error">
            <?= htmlspecialchars($errors['general']) ?>
        </div>
    <?php endif; ?>

    <?= $this->include('components/signup_content') ?>

    <script>
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