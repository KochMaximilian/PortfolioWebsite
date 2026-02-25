<blockquote class="devlog-quote">
  <p><?= $block->text() ?></p>
  <?php if ($block->citation()->isNotEmpty()): ?>
    <cite><?= $block->citation() ?></cite>
  <?php endif ?>
</blockquote>