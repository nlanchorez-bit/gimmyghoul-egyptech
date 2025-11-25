<?php
// Component: cards/roadmap_card.php
// Data contract: $title, $excerpt, $status, $priority, $timeline

// Status colors
$statusColors = [
    'In Progress' => ['bg' => '#16a34a', 'text' => '#fff'],
    'Planned'     => ['bg' => '#3b82f6', 'text' => '#fff'],
    'Backlog'     => ['bg' => '#6b7280', 'text' => '#fff'],
    'Done'        => ['bg' => '#15803d', 'text' => '#fff']
];

// Priority colors
$priorityColors = [
    'High'   => ['bg' => '#c6242c', 'text' => '#fff'],
    'Medium' => ['bg' => '#c9a669', 'text' => '#161616'],
    'Low'    => ['bg' => '#c9c9c9', 'text' => '#161616']
];

$statusColor   = $statusColors[$status ?? ''] ?? ['bg' => '#702524', 'text' => '#f3daac'];
$priorityColor = $priorityColors[$priority ?? ''] ?? ['bg' => '#702524', 'text' => '#f3daac'];
?>

<article class="rm-card" data-status="<?= strtolower(esc($status ?? '')) ?>">

    <div class="rm-card-header">
        <!-- Decorative pattern overlay -->
        <div class="rm-card-pattern"></div>

        <!-- Status and Priority Badges -->
        <div class="rm-badges">
            <span class="rm-badge" style="background: <?= $statusColor['bg'] ?>; color: <?= $statusColor['text'] ?>;">
                <?= esc($status ?? '') ?>
            </span>
            <span class="rm-badge" style="background: <?= $priorityColor['bg'] ?>; color: <?= $priorityColor['text'] ?>;">
                <?= esc($priority ?? '') ?> Priority
            </span>
        </div>

        <!-- Timeline Badge -->
        <div class="rm-badge-timeline">
            📅 <?= esc($timeline ?? '') ?>
        </div>
    </div>

    <div class="rm-card-body">
        <?php if (!empty($title)): ?>
            <h3 class="rm-card-title">
                <?= esc($title) ?>
            </h3>
        <?php endif; ?>

        <?php if (!empty($excerpt)): ?>
            <p class="rm-card-excerpt">
                <?= esc($excerpt) ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Decorative bottom border -->
    <div class="rm-card-footer-line"></div>

</article>