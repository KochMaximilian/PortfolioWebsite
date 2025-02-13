
<div class="wrapper">
    <div class="main-content">
        <?php snippet('header', slots: true) ?>
        <?php slot() ?><?php endslot() ?>

        <?php slot('head') ?>
        <!-- additional meta tags or style if needed -->
        <?php endslot() ?>
        <!-- End of head slot -->
        <?php endsnippet() ?>

        <main class="main-wrapper">
            <section class="content-block">
            <h1>Recent Projects</h1>
            </section>
            <section class="slider-block">
                <?php snippet('projectslider', [
                    'projects' => collection('featured')->limit(3) // limit to 3 projects on the home page
                ]) ?>
                  
            </section>
          
        </main>

    </div>
    <?php snippet('footer') ?>
</div>