<nav class="navbar">
    <ul>
        <?php foreach ($site->children()->listed() as $item): ?>
            <li><a href="<?= $item->url() ?>"><?= $item->title() ?></a></li>
        <?php endforeach ?>
    </ul>
</nav>