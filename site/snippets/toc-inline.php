<?php
/**
 * Inline Table of Contents — collapsible <details> component
 * Renders above the devlog content, outside the blocks.
 * Enable per-project via the "show_toc" toggle in the blueprint.
 *
 * Expects: $tocItems — array of ['id' => string, 'label' => string, 'level' => string]
 */
if (empty($tocItems)) return;
?>
<details class="toc-inline" id="toc-inline">
    <summary class="toc-inline-summary">
        <i class="fa-solid fa-list" aria-hidden="true"></i>
        <span class="toc-inline-title">Table of Contents</span>
        <i class="fa-solid fa-chevron-down toc-inline-chevron" aria-hidden="true"></i>
    </summary>
    <nav class="toc-inline-nav" aria-label="Table of contents">
        <?php foreach ($tocItems as $item): ?>
            <a href="#<?= htmlspecialchars($item['id']) ?>"
               class="toc-inline-link toc-inline-link--<?= $item['level'] ?>">
                <span class="toc-inline-link-text"><?= htmlspecialchars($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
</details>
