<?php
$image        = $block->image()->toFiles()->first();
$videoUrl     = $block->video_url()->isNotEmpty() ? $block->video_url()->value() : null;
$position     = $block->position()->value() ?: 'right';
$slideDesc    = $block->description()->isNotEmpty() ? (string)$block->description()->kirbytext() : null;
$descPosition = $block->desc_position()->isNotEmpty() ? $block->desc_position()->value() : 'bottom';
$altText      = $block->alt()->isNotEmpty() ? $block->alt()->value() : ($image ? $image->alt()->value() : '');
$caption      = $block->caption()->isNotEmpty() ? $block->caption()->value() : null;
$figid        = $block->figid()->isNotEmpty() ? trim($block->figid()->value()) : null;
$anchorId     = $figid ? 'fig-' . htmlspecialchars($figid) : null;
$captionAlign = $block->caption_align()->isNotEmpty() ? $block->caption_align()->value() : 'center';
$hasMedia     = $image || $videoUrl;
$hasCaption   = $caption || $figid;
?>
<div class="devlog-sidebyside devlog-sidebyside--<?= $position ?>">

  <div class="devlog-sidebyside-text">
    <?= $block->text() ?>
  </div>

  <?php if ($hasMedia): ?>
    <div class="devlog-sidebyside-media">

      <?php if ($videoUrl): ?>
        <figure class="devlog-video">
          <div class="devlog-video-embed">
            <?= video($videoUrl, [], ['loading' => 'lazy', 'allowfullscreen' => true]) ?>
          </div>
          <?php if ($hasCaption): ?>
            <figcaption class="devlog-figcaption devlog-figcaption--<?= htmlspecialchars($captionAlign) ?>">
              <?php if ($figid): ?>
                <span class="devlog-fig-id">Fig.&nbsp;<?= htmlspecialchars($figid) ?></span>
              <?php endif ?>
              <?php if ($caption): ?>
                <span class="devlog-caption-text"><?= htmlspecialchars($caption) ?></span>
              <?php endif ?>
            </figcaption>
          <?php endif ?>
        </figure>

      <?php elseif ($image): ?>
        <?php
        $isGif = strtolower($image->extension()) === 'gif';
        $imgUrl = $isGif ? $image->url() : $image->thumb([
            'autoOrient' => true,
            'width'      => 800,
            'quality'    => 80,
            'format'     => 'webp',
            'driver'     => 'im',
        ])->url();
        ?>
        <figure class="devlog-figure"<?= $anchorId ? ' id="' . $anchorId . '"' : '' ?>>
          <a href="<?= $image->url() ?>"
            data-gallery="devlog-gallery"
            <?= $slideDesc ? 'data-description="' . str_replace('"', '&quot;', $slideDesc) . '"' : '' ?>
            data-desc-position="<?= $descPosition ?>"
            class="devlog-image-link">
            <img
              src="<?= $imgUrl ?>"
              alt="<?= $altText ?>"
              loading="lazy"
              class="devlog-image">
          </a>
          <?php if ($hasCaption): ?>
            <figcaption class="devlog-figcaption devlog-figcaption--<?= htmlspecialchars($captionAlign) ?>">
              <?php if ($figid): ?>
                <span class="devlog-fig-id">Fig.&nbsp;<?= htmlspecialchars($figid) ?></span>
              <?php endif ?>
              <?php if ($caption): ?>
                <span class="devlog-caption-text"><?= htmlspecialchars($caption) ?></span>
              <?php endif ?>
            </figcaption>
          <?php endif ?>
        </figure>
      <?php endif ?>

    </div>
  <?php endif ?>

</div>