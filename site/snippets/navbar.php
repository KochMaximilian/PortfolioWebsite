
    <div class="nav-container">
        <nav class="navbar">
            <div class="logo-container">
                <a class="logo" href="<?= $site->url() ?>"><?= $site->author()?> <span>&nbsp; | &nbsp;</span> <?= $site->banner() ?></a>
            </div>
            
            <ul class="navbar-nav">
                <?php foreach ($site->children()->listed() as $item): ?>
                    <li class="navbar-item">
                        <a class="nav-link <?= $item->url() == $page->url() ? 'active' : '' ?>"  href="<?= $item->url() ?>"><?= $item->title() ?></a>
                    </li>
                <?php endforeach ?>
            </ul>

            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
    </div>
