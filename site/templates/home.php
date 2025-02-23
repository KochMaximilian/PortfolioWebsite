<?php snippet('header') ?>
<div class="wrapper">
    
    <div class="main-content">
   
      
      

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

</div>
<div class="footer-wrapper">
<?php snippet('footer') ?>
</div>


