<?php
if ($block->url()->isEmpty()) return;
$size         = $block->size()->isNotEmpty() ? $block->size()->value() : 'full';
$caption      = $block->caption()->isNotEmpty() ? $block->caption()->value() : null;
$captionAlign = $block->caption_align()->isNotEmpty() ? $block->caption_align()->value() : 'center';
?>
<figure class="devlog-video devlog-video--<?= $size ?>">
  <div class="devlog-video-embed">
    <?= video($block->url(), [], ['loading' => 'lazy', 'allowfullscreen' => true]) ?>
  </div>
  <?php if ($caption): ?>
    <figcaption class="devlog-figcaption devlog-figcaption--<?= htmlspecialchars($captionAlign) ?>">
      <span class="devlog-caption-text"><?= htmlspecialchars($caption) ?></span>
    </figcaption>
  <?php endif ?>
</figure>