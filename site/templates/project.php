<?php snippet('header') ?>
<div class="wrapper">
    <div class="project-layout">
        <main class="main-wrapper">
            <section class="content-block">
                <h1><?= $page->name() ?></h1>
            </section>

            <section class="project-main-container">
    <figure class="project-figure">
        <div class="project-gallery">
            <?php if ($embed = $page->embedlink()->toEmbed()): ?>
                <?= $embed->code() ?>
            <?php else: ?>
                <div>
                    <?php $coverImage = $page->images()->template('gallery-image')->limit(1); ?>
                    <?php foreach ($coverImage as $image): ?>
                        <img
                            loading="lazy"
                            alt="<?= $image->alt() ?>"
                            class="project-image"
                            src="<?= $image->resize(600, 600)->url() ?>">
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>

        <figcaption class="project-info">
            <dl>
                <div><dt>Title:</dt> <dd><?= $page->name() ?></dd></div>
                <div><dt>Project Type:</dt> <dd><?= $page->type() ?></dd></div>
                <div><dt>Genre:</dt> <dd><?php foreach ($page->genre()->split(',') as $genre): ?> <span class="project-genre"> <?= $genre ?></span> <?php endforeach; ?></dd></div>
                <div><dt>Platforms:</dt> <dd><?php foreach ($page->platform()->split(',') as $platform): ?> <span class="project-platfrom"><?= $platform ?></span> <?php endforeach; ?></dd></div>
                <div><dt>Release Year:</dt> <dd><?= $page->year() ?></dd></div>
                <div><dt>Project Duration:</dt> <dd><?= $page->duration() ?></dd></div>
                <div><dt>Area of Focus:</dt> <dd><?php foreach ($page->focus()->split(',') as $focus): ?> <span class="project-focus"><?= $focus ?></span> <?php endforeach; ?></dd></div>
                <div><dt>Game Engine:</dt> <dd><?= $page->engine() ?></dd></div>
                <?php if ($page->links()->isNotEmpty()): ?>
                    <div><dt>Additional Links:</dt> <dd><a href="<?= $page->links() ?>"><?= $page->links() ?></a></dd></div>
                <?php endif; ?>
            </dl>
        </figcaption>
    </figure>
</section>


   
        </main>
    </div>
</div>
<div class="footer-wrapper">
    <?php snippet('footer') ?>
</div>