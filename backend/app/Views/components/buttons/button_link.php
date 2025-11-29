<?php
// app/Views/components/buttons/button_link.php
$label   = $label ?? 'Link Button';
$href    = $href  ?? '#';
$disable = $disable ?? false;
$id      = $id ?? uniqid('btn-');
?>

<a href="<?= $disable ? 'javascript:void(0)' : htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
    id="<?= esc($id) ?>"
    class="btn btn-link <?= $disable ? 'disabled' : '' ?>"
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
        /* Maintain padding for hit area, but visually minimal */
        font-size: 16px;
        line-height: 1.5;
        transition: all 0.3s ease;
    }

    .btn-link {
        background: transparent;
        color: #702524;
        /* Brand Color */
        padding-left: 0;
        padding-right: 0;
        min-width: auto;
    }

    .btn-link:hover {
        color: #8b2f2e;
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    .btn-link.disabled {
        color: #999;
        text-decoration: none;
        pointer-events: none;
        cursor: default;
    }
</style>