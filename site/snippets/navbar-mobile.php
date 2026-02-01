<div class="navbar-mobile">
    <ul class="navbar-nav">
        <?php foreach ($site->children()->listed() as $item): ?>
            <li class="navbar-item">
                <a class="nav-link <?= $item->isOpen() ? 'active' : '' ?>" href="<?= $item->url() ?>"><?= $item->title() ?></a>
            </li>
        <?php endforeach ?>
    </ul>
</div>