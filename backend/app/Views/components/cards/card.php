<?php
// Component: cards/card.php
// Data contract:
// $title: string
// $excerpt: string
// $image: string|null
// $href: string|null
?>
<style>
    .card-container {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        background-color: white;
        border: 3px solid rgba(112, 37, 36, 0.3);
        transition: all 0.3s ease;
    }

    .card-container:hover {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(1.05);
    }

    .card-image-wrapper {
        height: 180px;
        background: linear-gradient(135deg, #8b2f2e 0%, #610e0e 100%);
    }

    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-placeholder {
        height: 140px;
        background: linear-gradient(135deg, #8b2f2e 0%, #610e0e 50%, #4c0404 100%);
        position: relative;
        overflow: hidden;
    }

    .card-pattern-overlay {
        position: absolute;
        inset: 0;
        opacity: 0.1;
        background-image: repeating-linear-gradient(0deg,
                transparent,
                transparent 2px,
                rgba(243, 218, 172, 0.5) 2px,
                rgba(243, 218, 172, 0.5) 4px);
    }

    .card-content {
        padding: 1.5rem;
        background: linear-gradient(180deg, #ffffff 0%, #f5f5f5 100%);
    }

    .card-title {
        margin-bottom: 0.75rem;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        color: #702524;
        font-size: 24px;
        line-height: 1.3;
    }

    .card-excerpt {
        margin-bottom: 1rem;
        font-family: 'Scheherazade New', serif;
        color: #42221a;
        font-size: 15px;
        line-height: 1.7;
    }

    .card-link {
        display: inline-flex;
        align-items: center;
        color: #c6242c;
        font-family: 'Scheherazade New', serif;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    .card-arrow {
        margin-left: 6px;
        font-size: 18px;
    }

    .card-border-bottom {
        height: 4px;
        background: linear-gradient(90deg, #f3daac 0%, #c9a669 50%, #f3daac 100%);
    }
</style>
<article class="card-container">
    <?php if (!empty($image)): ?>
        <div class="card-image-wrapper">
            <img src="<?= esc($image) ?>" alt="<?= esc($title ?? '') ?>" class="card-image">
        </div>
    <?php else: ?>
        <div class="card-placeholder">
            <div class="card-pattern-overlay"></div>
        </div>
    <?php endif; ?>

    <div class="card-content">
        <?php if (!empty($title)): ?>
            <h3 class="card-title">
                <?= esc($title) ?>
            </h3>
        <?php endif; ?>

        <?php if (!empty($excerpt)): ?>
            <p class="card-excerpt">
                <?= esc($excerpt) ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($href)): ?>
            <a href="<?= esc($href) ?>" class="card-link">
                Learn more
                <span class="card-arrow">→</span>
            </a>
        <?php endif; ?>
    </div>

    <div class="card-border-bottom"></div>
</article>