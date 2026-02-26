<?php
$logoMap = [
    'piece' => 'LogoPiece.svg',
    'shaka' => 'LogoShaka.svg',
    'ok'    => 'LogoOK.svg',
];
$variant = $GLOBALS['siteVariant'] ?? 'piece';
$logo = $logoMap[$variant];
?>
<div class="devlog-line" aria-hidden="true">
  <span class="devlog-line-rule"></span>
  <img src="<?= $site->url() ?>/assets/img/<?= $logo ?>" alt="" class="devlog-line-logo">
  <span class="devlog-line-rule"></span>
</div>