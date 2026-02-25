<?php if ($block->url()->isNotEmpty()): ?>
<figure class="devlog-video">
  <div class="devlog-video-embed">
    <?= video($block->url(), [], ['loading' => 'lazy', 'allowfullscreen' => true]) ?>
  </div>
  <?php if ($block->caption()->isNotEmpty()): ?>
    <figcaption class="devlog-figcaption"><?= $block->caption() ?></figcaption>
  <?php endif ?>
</figure>
<?php endif ?>