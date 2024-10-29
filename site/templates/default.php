<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $page->title()->html() ?> | <?= $site->title()->html() ?> </title>
    <?= css('assets/css/style.css') ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a class="logo" href="<?= $site->url() ?>"> Maximilian Koch </a>
        <nav class="navbar">
            <ul>
              <?php foreach ($site->children()->listed() as $item): ?>
                <li><a href="<?= $item->url() ?>"><?= $item->title() ?></a></li>
              <?php endforeach ?>
            </ul>
        </nav>
    </header>

    <main class="main-wrapper">
        <p>This is placeholder text. Add content here.</p>
    </main>

    <footer class="footer-wrapper">
        <p><?= $site->copyright()->html() ?></p>
        <a href="https://x.com/<?= $site->twitter() ?>">Follow me on Twitter</a>
    </footer>
</body>
</html>


