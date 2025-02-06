<?php snippet('header') ?>
    
    <main class="main-wrapper">
        <h1><?= $page->title() ?></h1>
        <?= $page->text() ?>

        <?php snippet('projects', [
            'projects' => collection('featured')
            ->limit(3) /* limit to 3 projects on the home page */
        ] )?>
  
    </main>

<?php snippet('footer') ?>


