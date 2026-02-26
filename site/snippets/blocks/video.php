<?php
if ($block->url()->isEmpty()) return;
$size = $block->size()->isNotEmpty() ? $block->size()->value() : 'full';
?>
<figure class="devlog-video devlog-video--<?= $size ?>">
  <div class="devlog-video-embed">
    <?= video($block->url(), [], ['loading' => 'lazy', 'allowfullscreen' => true]) ?>
  </div>
  <?php if ($block->caption()->isNotEmpty()): ?>
    <figcaption class="devlog-figcaption"><?= $block->caption() ?></figcaption>
  <?php endif ?>
</figure>