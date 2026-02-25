<?php
$image = $block->image()->toFiles()->first();
if (!$image) return;
$isGif = strtolower($image->extension()) === 'gif';
$src   = $isGif ? $image->url() : $image->thumb([
    'autoOrient' => true,
    'width'      => 1200,
    'quality'    => 80,
    'format'     => 'webp',
    'driver'     => 'im',
])->url();
$slideDesc    = $block->description()->isNotEmpty() ? (string)$block->description()->kirbytext() : null;
$descPosition = $block->desc_position()->isNotEmpty() ? $block->desc_position()->value() : 'bottom';
$altText      = $block->alt()->isNotEmpty() ? $block->alt()->value() : $image->alt()->value();
?>
<figure class="devlog-figure">
  <a href="<?= $image->url() ?>"
    data-gallery="devlog-gallery"
    <?= $slideDesc ? 'data-description="' . str_replace('"', '&quot;', $slideDesc) . '"' : '' ?>
    data-desc-position="<?= $descPosition ?>"
    class="devlog-image-link">
    <img
      src="<?= $src ?>"
      alt="<?= $altText ?>"
      loading="lazy"
      class="devlog-image">
  </a>
  <?php if ($block->caption()->isNotEmpty()): ?>
    <figcaption class="devlog-figcaption"><?= $block->caption() ?></figcaption>
  <?php endif ?>
</figure>