<footer>
    <!--Mobile Nav Start -->
    <?php snippet('navbar-mobile') ?>
    <!--Mobile Nav End -->
    <div class="footer-container">
        <div class="footer-left">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->twitter() ?>"><i class="fa-brands fa-square-x-twitter custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->youtube() ?>"><i class="fa-brands fa-square-youtube custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->itchio() ?>"><i class="fa-brands fa-itch-io custom-icon-size"></i></a>
            </nav>
        </div>

        <div class="footer-center">
        <nav class="mobile-socials left">
                <a class="social-link" target="_blank" href="<?= $site->twitter() ?>"><i class="fa-brands fa-square-x-twitter custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->youtube() ?>"><i class="fa-brands fa-square-youtube custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->itchio() ?>"><i class="fa-brands fa-itch-io custom-icon-size"></i></a>
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
            <img id="wobbleElement" class="wobble-hor-top footer-logo" src="<?= $site->url() ?>/assets/img/<?= $randomLogo ?>" alt="Site Logo">
            <nav class="mobile-socials right">
                <a class="social-link" target="_blank" href="<?= $site->linkedin() ?>"><i class="fa-brands fa-linkedin custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry"><i class="fa-solid fa-square-envelope custom-icon-size"></i></a>
                <a class="social-link" target="_blank" href="<?= $site->github() ?>"><i class="fa-brands fa-square-github custom-icon-size"></i></a>
            </nav>
            <h5 class="slogan">Don't be a Stranger!</h5>
            <span class="copyright"><?= '&copy; ' . date('Y') . ' ' . $site->author() ?></span>
        </div>

        <div class="footer-right">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->linkedin() ?>"><i class="fa-brands fa-linkedin custom-icon-size "></i></a>

                <a class="social-link" target="_blank" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry"><i class="fa-solid fa-square-envelope custom-icon-size"></i></a>

                <a class="social-link" target="_blank" href="<?= $site->github() ?>"><i class="fa-brands fa-square-github  custom-icon-size"></i></a>
            </nav>
        </div>
    </div>
</footer>