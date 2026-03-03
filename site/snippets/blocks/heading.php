<?php
$level    = $block->level()->or('h2');
$rawText  = strip_tags((string)$block->text());
$customId = $block->anchorid()->isNotEmpty() ? trim($block->anchorid()->value()) : null;
$anchorId = $customId ? Str::slug($customId) : Str::slug($rawText);
$hasAnchorBadge = $customId !== null;
?>
<<?= $level ?> class="devlog-heading devlog-heading--<?= $level ?><?= $hasAnchorBadge ? ' has-anchor-badge' : '' ?>"<?= $anchorId ? ' id="' . htmlspecialchars($anchorId) . '"' : '' ?>>
  <?php if ($hasAnchorBadge): ?>
    <a href="#<?= htmlspecialchars($anchorId) ?>" class="devlog-heading-anchor"><?= htmlspecialchars($customId) ?></a>
  <?php endif ?>
  <span class="devlog-heading-text"><?= $block->text() ?></span>
</<?= $level ?>>