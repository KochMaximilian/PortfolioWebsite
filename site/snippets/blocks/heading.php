<?php $level = $block->level()->or('h2') ?>
<<?= $level ?> class="devlog-heading devlog-heading--<?= $level ?>"><?= $block->text() ?></<?= $level ?>>