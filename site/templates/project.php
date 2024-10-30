<?php snippet("header") ?>
<?php 
$width = 600;
$height = 600;
?>
<main>
    <article>
        <h1><?= $page->title() ?></h1>
        <div class="project-layout">
            <div class="project-info">
                <?= $page->context() ?>
                <dl>
                    <dt>Title:</dt>
                    <dd><?= $page->title()->upper() ?></dd>

                    <dt>Description:</dt>
                    <dd><?= $page->description() ?></dd>

                    <dt>Genre:</dt>
                    <dd><?= $page->genre() ?></dd>

                    <dt>Platform:</dt>
                    <dd><?= $page->platform()->upper() ?></dd>

                    <dt>Year:</dt>
                    <dd><?= $page->year() ?></dd>

                    <dt>Project Length:</dt>
                    <dd><?= $page->projectLength() ?></dd>

                    <dt>Area of Focus:</dt>
                    <dd><?= $page->focus() ?></dd>
                    <?php if ($page->links()->isNotEmpty()): ?>
                        <dt>Links:</dt>
                        <dd><a href="<?= $page->links() ?>"><?= $page->links() ?></a></dd>
                    <?php endif ?>
                </dl>
            </div>
            <div class="project-gallery">
                <ul>
                    <?php foreach ($page->images() as $image): ?>
                        <li>
                            <a href="<?= $image->url() ?>">
                                <img alt="<?= $image->alt() ?>" class="project-image" src="<?= $image->resize($width, $height)->url() ?>">
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </article>
</main>
<?php snippet('footer') ?>