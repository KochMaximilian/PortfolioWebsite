<footer>
    <!--Mobile Nav Start -->
    <?php snippet('navbar-mobile') ?>
    <!--Mobile Nav End -->
    <div class="footer-container">
        <div class="footer-left">
            <nav class="socials">
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->twitter() ?>" aria-label="X (Twitter)"><i class="fa-brands fa-square-x-twitter custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->youtube() ?>" aria-label="YouTube"><i class="fa-brands fa-square-youtube custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->itchio() ?>" aria-label="itch.io"><i class="fa-brands fa-itch-io custom-icon-size" aria-hidden="true"></i></a>
            </nav>
        </div>

        <div class="footer-center">
        <nav class="mobile-socials left">
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->twitter() ?>" aria-label="X (Twitter)"><i class="fa-brands fa-square-x-twitter custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->youtube() ?>" aria-label="YouTube"><i class="fa-brands fa-square-youtube custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->itchio() ?>" aria-label="itch.io"><i class="fa-brands fa-itch-io custom-icon-size" aria-hidden="true"></i></a>
            </nav>
            <?php
            // Match footer logo to the site variant picked in header.php
            $logoMap = [
                'piece' => 'LogoPiece.svg',
                'shaka' => 'LogoShaka.svg',
                'ok'    => 'LogoOK.svg',
            ];
            $variant = $GLOBALS['siteVariant'] ?? 'piece';
            $randomLogo = $logoMap[$variant];
            ?>
            <img id="wobbleElement" class="wobble-hor-top footer-logo" src="<?= $site->url() ?>/assets/img/<?= $randomLogo ?>" alt="<?= $site->author() ?> — Game Designer">
            <nav class="mobile-socials right">
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->linkedin() ?>" aria-label="LinkedIn"><i class="fa-brands fa-linkedin custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry" aria-label="Email"><i class="fa-solid fa-square-envelope custom-icon-size" aria-hidden="true"></i></a>
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->github() ?>" aria-label="GitHub"><i class="fa-brands fa-square-github custom-icon-size" aria-hidden="true"></i></a>
            </nav>
            <span class="slogan">Don't be a Stranger!</span>
            <span class="copyright"><?= '&copy; ' . date('Y') . ' ' . $site->author() ?></span>
        </div>

        <div class="footer-right">
            <nav class="socials">
                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->linkedin() ?>" aria-label="LinkedIn"><i class="fa-brands fa-linkedin custom-icon-size" aria-hidden="true"></i></a>

                <a class="social-link" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry" aria-label="Email"><i class="fa-solid fa-square-envelope custom-icon-size" aria-hidden="true"></i></a>

                <a class="social-link" target="_blank" rel="noopener noreferrer" href="<?= $site->github() ?>" aria-label="GitHub"><i class="fa-brands fa-square-github custom-icon-size" aria-hidden="true"></i></a>
            </nav>
        </div>
    </div>
</footer>