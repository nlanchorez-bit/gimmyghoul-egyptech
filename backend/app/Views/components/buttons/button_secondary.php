<?php
// app/Views/components/buttons/button_secondary.php
$label   = $label ?? 'Secondary Button';
$href    = $href  ?? '#';
$disable = $disable ?? false;
$id      = $id ?? uniqid('btn-');
?>

<a href="<?= $disable ? 'javascript:void(0)' : htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
    id="<?= esc($id) ?>"
    class="btn btn-secondary <?= $disable ? 'disabled' : '' ?>"
    <?= $disable ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
</a>

<style>
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

    .btn-secondary {
        background: #f3daac;
        /* Gold Accent */
        color: #42221a;
        /* Dark Brown text */
        border: 1px solid transparent;
        border-radius: 12px;
    }

    .btn-secondary:hover {
        background: #ffeebf;
        color: #702524;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(243, 218, 172, 0.4);
    }

    .btn-secondary.disabled {
        background: #eee;
        color: #aaa;
        pointer-events: none;
    }

    .btn-secondary:active {
        transform: translateY(0);
    }
</style>