<?php
// app/Views/components/cards/product_card.php
// Data contract:
//   $product : object or array with keys:
//     id, slug, title, description, image, price, type, available, created_at

// 1. Data Normalization
if (!isset($product)) {
    $product = (object)[
        'id'          => null,
        'slug'        => '',
        'title'       => 'Untitled',
        'description' => 'No description available.',
        'image'       => '',
        'price'       => null,
        'type'        => 'product',
        'available'   => false,
        'created_at'  => ''
    ];
}

// Convert array to object if necessary
if (is_array($product)) {
    $product = (object) $product;
}

// 2. Prepare Display Logic
$desc       = $product->description ?? '';
$maxLen     = 120; // Shorter length for better grid alignment
$short_desc = (mb_strlen($desc) > $maxLen) ? mb_substr($desc, 0, $maxLen) . '…' : $desc;

// Image logic
$img = !empty($product->image) ? $product->image : 'https://via.placeholder.com/800x600?text=No+Image';

// Link Logic
$link = !empty($product->available) ? base_url('product/' . urlencode($product->slug ?? $product->id)) : null;

// Type Badge Logic
$typeLabelMap = [
    'print'      => 'Print',
    'original'   => 'Original',
    'commission' => 'Commission',
    'product'    => 'Product'
];
$typeLabel = $typeLabelMap[$product->type ?? 'product'] ?? ucfirst($product->type ?? 'Product');

// Price Logic
$price = (isset($product->price) && is_numeric($product->price))
    ? number_format((float)$product->price, 2)
    : null;

// Availability Class
$availabilityClass = (!empty($product->available)) ? '' : 'unavailable';
?>

<!-- Component Styles -->
<style>
    .gh-card {
        background: #fff;
        border: 1px solid rgba(112, 37, 36, 0.1);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .gh-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(112, 37, 36, 0.15);
        border-color: rgba(112, 37, 36, 0.3);
    }

    /* Unavailable State */
    .gh-card.unavailable {
        opacity: 0.8;
        background: #fcfcfc;
    }

    .gh-card.unavailable img {
        filter: grayscale(100%);
        opacity: 0.7;
    }

    /* Image Wrapper */
    .gh-card-img-wrap {
        position: relative;
        padding-top: 65%;
        /* 3:2 Aspect Ratio */
        overflow: hidden;
        background: #f3daac;
        /* Placeholder bg */
    }

    .gh-card-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gh-card:hover .gh-card-img {
        transform: scale(1.05);
    }

    /* Content */
    .gh-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .gh-card-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #702524;
        /* Brand Red */
        margin: 0 0 8px 0;
        line-height: 1.3;
    }

    .gh-card-desc {
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: #555;
        margin: 0 0 16px 0;
        line-height: 1.6;
        flex-grow: 1;
    }

    /* Footer / Metadata */
    .gh-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .gh-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'Tajawal', sans-serif;
        background: #fff5e6;
        color: #702524;
        border: 1px solid rgba(112, 37, 36, 0.1);
    }

    .gh-price {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        color: #161616;
        font-size: 16px;
    }

    .gh-unavailable-tag {
        font-size: 12px;
        color: #999;
        font-style: italic;
    }

    /* Link wrapper */
    .gh-card-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
</style>

<article class="gh-card <?= $availabilityClass ?>"
    data-id="<?= esc($product->id ?? '') ?>"
    data-type="<?= esc($product->type ?? '') ?>">

    <?php if ($link): ?>
        <a href="<?= esc($link) ?>" class="gh-card-link">
        <?php else: ?>
            <div class="gh-card-link">
            <?php endif; ?>

            <!-- Image -->
            <div class="gh-card-img-wrap">
                <img class="gh-card-img"
                    src="<?= esc($img) ?>"
                    alt="<?= esc($product->title ?? 'Product image') ?>"
                    loading="lazy">
            </div>

            <!-- Body -->
            <div class="gh-card-body">
                <h4 class="gh-card-title">
                    <?= esc($product->title ?? 'Untitled') ?>
                    <?php if (empty($product->available)): ?>
                        <span class="gh-unavailable-tag">(Unavailable)</span>
                    <?php endif; ?>
                </h4>

                <p class="gh-card-desc">
                    <?= esc($short_desc) ?>
                </p>

                <div class="gh-card-footer">
                    <span class="gh-badge">
                        <?= esc($typeLabel) ?>
                    </span>

                    <span class="gh-price">
                        <?php if ($price !== null && $price !== ''): ?>
                            ₱<?= esc($price) ?>
                        <?php else: ?>
                            <span style="font-size: 14px; font-weight: normal; color: #666;">Ask for price</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <?php if ($link): ?>
        </a>
    <?php else: ?>
        </div>
    <?php endif; ?>
</article>