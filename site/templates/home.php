<div class="wrapper">
<?php snippet('header', slots: true) ?>
<?php slot() ?><?php endslot() ?>

<?php slot('head') ?>
<!-- addtional meta tags or style if need.  -->
<?php endslot() ?>
<!-- End of head slot -->
<?php endsnippet() ?>


<main class="main-wrapper">


    <h1><?= $page->title() ?></h1>
    <?= $page->text() ?>



    <?php snippet('projectslider', [
        'projects' => collection('featured')
            ->limit(3) /* limit to 3 projects on the home page */
    ]) ?>





<?php snippet('footer') ?>





<!-- TESTING -->
<div class="blocks">
    <?php foreach ($page->blocks()->toBlocks() as $block): ?>

        <div class="block" data-type="<?= $block->type() ?>">

         <?= $block ?>
      
       
        </div>
    <?php endforeach ?>

</div>

</div>