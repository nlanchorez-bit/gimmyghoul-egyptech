<?php
// Component: cards/roadmap_card.php

// 1. Data Defaults (Using Null Coalescing for safety)
// This ensures that if the variable is not passed, it falls back to the default string.
$title    = $title    ?? 'Untitled Task';
$excerpt  = $excerpt  ?? 'No details provided.';
$status   = $status   ?? 'Planned';
$priority = $priority ?? 'Medium';
$timeline = $timeline ?? 'TBD';

// 2. Status Configuration
$statusColors = [
    'In Progress' => ['bg' => '#16a34a', 'text' => '#fff'], // Green
    'Planned'     => ['bg' => '#3b82f6', 'text' => '#fff'], // Blue
    'Backlog'     => ['bg' => '#6b7280', 'text' => '#fff'], // Gray
    'Done'        => ['bg' => '#15803d', 'text' => '#fff']  // Dark Green
];

// 3. Priority Configuration
$priorityColors = [
    'High'   => ['bg' => '#c6242c', 'text' => '#fff'],     // Red
    'Medium' => ['bg' => '#c9a669', 'text' => '#161616'], // Gold
    'Low'    => ['bg' => '#c9c9c9', 'text' => '#161616']  // Silver
];

// 4. Color Resolution
$sColor = $statusColors[$status]   ?? ['bg' => '#702524', 'text' => '#f3daac'];
$pColor = $priorityColors[$priority] ?? ['bg' => '#702524', 'text' => '#f3daac'];
?>

<article class="rm-card" data-status="<?= strtolower(esc($status)) ?>">

    <div class="rm-card-header">
        <div class="rm-card-pattern"></div>

        <div class="rm-badges">
            <span class="rm-badge" style="background: <?= $sColor['bg'] ?>; color: <?= $sColor['text'] ?>;">
                <?= esc($status) ?>
            </span>
            <span class="rm-badge" style="background: <?= $pColor['bg'] ?>; color: <?= $pColor['text'] ?>;">
                <?= esc($priority) ?> Priority
            </span>
        </div>

        <div class="rm-badge-timeline">
            📅 <?= esc($timeline) ?>
        </div>
    </div>

    <div class="rm-card-body">
        <h3 class="rm-card-title">
            <?= esc($title) ?>
        </h3>

        <p class="rm-card-excerpt">
            <?= esc($excerpt) ?>
        </p>
    </div>

    <div class="rm-card-footer-line"></div>

</article>