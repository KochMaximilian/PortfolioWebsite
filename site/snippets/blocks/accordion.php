<div class="accordion">
<?php foreach ($block->items()->toStructure() as $item): ?>
    <details>
        <summary><?= $item->summary() ?></summary>
        <?= $item->details() ?>
    </details>
<?php endforeach ?>
</div>  