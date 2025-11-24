<?php
// app/Views/components/buttons/button_border.php
$label   = $label ?? 'Border Button';
$href    = $href  ?? '#';
$disable = $disable ?? false;
$id      = $id ?? uniqid('btn-');
?>

<a href="<?= $disable ? 'javascript:void(0)' : htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
    id="<?= esc($id) ?>"
    class="btn btn-border <?= $disable ? 'disabled' : '' ?>"
    <?= $disable ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
</a>

<style>
    /* Scoped roughly by class, but global in effect */
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

    .btn-border {
        background: transparent;
        border: 2px solid #702524;
        /* Brand Color */
        border-radius: 12px;
        /* Matching Sign Up button */
        color: #702524;
    }

    .btn-border:hover {
        background: #702524;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(112, 37, 36, 0.15);
    }

    .btn-border.disabled {
        opacity: 0.5;
        pointer-events: none;
        border-color: #ccc;
        color: #999;
    }

    .btn-border:active {
        transform: translateY(0);
    }
</style>