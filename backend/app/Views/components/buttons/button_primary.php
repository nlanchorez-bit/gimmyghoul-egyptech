<?php
// app/Views/components/buttons/button_primary.php
$label   = $label ?? 'Primary Button';
$href    = $href  ?? '#';
$disable = $disable ?? false;
$id      = $id ?? uniqid('btn-');
?>

<a href="<?= $disable ? 'javascript:void(0)' : htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
    id="<?= esc($id) ?>"
    class="btn btn-primary <?= $disable ? 'disabled' : '' ?>"
    <?= $disable ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
</a>

<style>
    /* Ensure .btn base class is consistent if loaded together */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'Scheherazade New', Arial, sans-serif;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        padding: 10px 24px;
        font-size: 16px;
        line-height: 1.5;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
        /* Gimmighoul Gradient */
        color: #ffffff;
        border: none;
        border-radius: 50px;
        /* Pill shape like CTA */
        box-shadow: 0 4px 10px rgba(112, 37, 36, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(112, 37, 36, 0.3);
        color: #ffffff;
    }

    .btn-primary.disabled {
        background: #e0e0e0;
        color: #999;
        box-shadow: none;
        pointer-events: none;
    }

    .btn-primary:active {
        transform: translateY(0);
    }
</style>