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
$size         = $block->size()->isNotEmpty() ? $block->size()->value() : 'full';
$figid        = $block->figid()->isNotEmpty() ? trim($block->figid()->value()) : null;
$anchorId     = $figid ? 'fig-' . htmlspecialchars($figid) : null;
$captionAlign = $block->caption_align()->isNotEmpty() ? $block->caption_align()->value() : 'center';
$hasCaption   = $block->caption()->isNotEmpty() || $figid;
?>
<figure class="devlog-figure devlog-figure--<?= $size ?>"<?= $anchorId ? ' id="' . $anchorId . '"' : '' ?>>
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
  <?php if ($hasCaption): ?>
    <figcaption class="devlog-figcaption devlog-figcaption--<?= htmlspecialchars($captionAlign) ?>">
      <?php if ($figid): ?>
        <span class="devlog-fig-id">Fig.&nbsp;<?= htmlspecialchars($figid) ?></span>
      <?php endif ?>
      <?php if ($block->caption()->isNotEmpty()): ?>
        <span class="devlog-caption-text"><?= $block->caption() ?></span>
      <?php endif ?>
    </figcaption>
  <?php endif ?>
</figure>