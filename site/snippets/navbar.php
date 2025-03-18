<div class="nav-container">
    <nav class="navbar">
        <div class="logo-container">
            <a class="logo" href="<?= $site->url() ?>"><?= $site->author()?> <span>&nbsp; | &nbsp;</span> <?= $site->banner() ?></a>
        </div>
        
        <?php snippet('navbar-desktop') ?>
    </nav>
</div>