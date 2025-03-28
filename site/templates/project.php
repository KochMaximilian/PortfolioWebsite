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
                        <?php if ($embed = $page->embedlink()->isNotEmpty()): ?>
                            <div class="responsive-iframe-container">
                                <?= Html::iframe($page->embedlink(), [
                                    'title' => $page->embedTitle(),
                                    'frameborder' => '0',
                                    'allowfullscreen' => true,
                                    'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope;',
                                    'loading' => 'lazy',
                                    'sandbox' => 'allow-scripts allow-same-origin',
                                    'referrerpolicy' => 'strict-origin-when-cross-origin'
                                ]) ?>
                            </div>
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
                            <div>
                                <dt>Project Type:</dt>
                                <dd><?= $page->type() ?></dd>
                            </div>
                            <?php if ($page->team()->isNotEmpty()): ?>
                                <div>
                                    <dt>Team Size:</dt>
                                    <dd><?= $page->team() ?></dd>
                                </div>
                            <?php endif; ?>
                            <div>
                                <dt>Genre:</dt>
                                <dd><?php foreach ($page->genre() as $genre): ?><span class="project-genre"> <?= $genre ?></span> <?php endforeach; ?></dd>
                            </div>
                            <div>
                                <dt>Platforms:</dt>
                                <dd><?php foreach ($page->platform() as $platform): ?><span class="project-platfrom"><?= $platform ?></span> <?php endforeach; ?></dd>
                            </div>
                            <div>
                                <dt>Release Year:</dt>
                                <dd><?= $page->year() ?></dd>
                            </div>
                            <div>
                                <dt>Project Duration:</dt>
                                <dd><?= $page->duration() ?></dd>
                            </div>
                            <div>
                                <dt>Area of Focus:</dt>
                                <dd><?php foreach ($page->focus() as $focus): ?> <span class="project-focus"><?= $focus ?></span> <?php endforeach; ?></dd>
                            </div>
                            <?php if ($page->awards()->isNotEmpty()): ?>
                                <div>
                                    <dt>Awards:</dt>
                                    <dd><?= $page->awards() ?></dd>
                                </div>
                            <?php endif; ?>
                            <div>
                                <dt>Game Engine:</dt>
                                <dd><?= $page->engine() ?></dd>
                            </div>
                            <?php if ($page->links()->isNotEmpty()): ?>
                                <div>
                                    <dt>Additional Links:</dt>
                                    <dd><a class="additional-link" href="<?= $page->links() ?>" title="<?= $page->links() ?>"><?= preg_replace('/.*\//', ' ', $page->links()->url()->short(22, '…')) ?></a></dd>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </figcaption>
                </figure>
            </section>


            <section class="project-description">
                <details>
                    <summary aria-expanded="false">Project Description<br>
                        <i aria-hidden="true" class="fa-solid fa-caret-down"></i>
                    </summary>
                    <?= $page->description()->kirbytext() ?>
                </details>
            </section>



            <?php
            $showcaseImages = $page->images()->filterBy('template', 'showcase-image');

            if ($showcaseImages->isNotEmpty()): ?>
                <section class="lightbox">
                    <div id="gallery" class="project-image-container">
                        <?php foreach ($showcaseImages as $image): ?>
                            <?php $thumb = $image->thumb([
                                'autoOrient' => true,
                                'width' => 250,
                                'height' => 250,
                                'crop' => true,
                                'quality' => 50,
                                'driver' => 'im',
                                'format' => 'webp'
                            ]); ?>
                            <a class="project-image-link" href="<?= $image->url() ?>"
                                data-pswp-width="<?= $image->width() ?>"
                                data-pswp-height="<?= $image->height() ?>"
                                target="_blank">
                                <div class="image-wrapper">
                                    <img loading="lazy" alt="<?= $image->alt() ?>" class="project-gallary-image" src="<?= $thumb->url() ?>" />
                                </div>
                                <?php if ($image->caption()->isNotEmpty()): ?>
                                    <div class="image-caption-badge"><?= $image->caption() ?></div>
                                <?php endif ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>









        </main>
    </div>
</div>
<?php snippet('footer') ?>