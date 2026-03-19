<div class="nav-container">
    <nav class="navbar">
        <div class="logo-container">
            <?php
            // Match navbar logo to the site variant (same as footer)
            $logoMap = [
                'piece' => 'LogoPiece.svg',
                'shaka' => 'LogoShaka.svg',
                'ok'    => 'LogoOK.svg',
            ];
            $variant = $GLOBALS['siteVariant'] ?? 'piece';
            $navbarLogo = $logoMap[$variant];
            ?>
            <a class="logo" href="<?= $site->url() ?>">
                <span class="logo-name"><?= $site->author() ?></span>
                <span class="logo-divider">&nbsp; | &nbsp;</span>
                <img class="navbar-logo-mobile" src="<?= $site->url() ?>/assets/img/<?= $navbarLogo ?>" alt="<?= $site->author() ?> logo">
                <span class="logo-banner"><?= $site->banner() ?></span>
            </a>
        </div>
        
        <?php snippet('navbar-desktop') ?>
    </nav>
</div>