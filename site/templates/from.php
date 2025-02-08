<?php snippet('header', slots: true) ?>
<h1 class="h1">ABOUT</h1>

<?php endsnippet() ?>
<?php snippet('form', slots: true) ?>

    <?php snippet('field', ['for' => 'email', 'label' => 'Email'], slots: true) ?>
        <input type="email" name="email" id="email" autofocus>
    <?php endsnippet() ?>

    <?php snippet('field', ['for' => 'name', 'label' => 'Name'], slots: true) ?>
        <input type="text" name="name" id="name">
    <?php endsnippet() ?>

    <?php snippet('field', ['for' => 'message', 'label' => 'Message'], slots: true) ?>
        <textarea type="text" name="email" id="message"></textarea>
    <?php endsnippet() ?>

<?php endsnippet() ?>
<?php snippet('footer', slots: true) ?>