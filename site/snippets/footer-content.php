<footer>
    <!--Mobile Nav Start -->
    <div>
        <ul class="navbar-nav">
            <?php foreach ($site->children()->listed() as $item): ?>
                <li class="navbar-item">
                    <a class="nav-link <?= $item->url() == $page->url() ? 'active' : '' ?>" href="<?= $item->url() ?>"><?= $item->title() ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
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
            <img id="wobbleElement" class="wobble-hor-top footer-logo" src="<?= $site->url() ?>/assets/favicon/favicon.ico">
            <h5 class="slogan">Don't be a Stranger!</h5>
            <span class="copyright"><?= $site->copyright() ?></span>
        </div>

        <div class="footer-right">
            <nav class="socials">
                <a class="social-link" target="_blank" href="<?= $site->linkedin() ?>"><i class="fa-brands fa-linkedin custom-icon-size "></i></a>

                <a class="social-link" target="_blank" href="mailto:<?= Str::encode($site->mail()) ?>?subject=Game Design Portfolio Inquiry"><i class="fa-solid fa-square-envelope custom-icon-size"></i></a>

                <a class="social-link" target="_blank" href="<?= $site->github() ?>"><i class="fa-brands fa-square-github custom-icon-size"></i></a>
            </nav>
        </div>
    </div>
</footer>