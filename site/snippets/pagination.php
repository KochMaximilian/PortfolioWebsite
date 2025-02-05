<?php if ($pagination->hasPages()): ?>
        <nav class="pagination">
            <?php if ($pagination->hasPrevPage()): ?>
                <a href="<?= $pagination->prevPageUrl() ?>" aria-label="Previous page">&larr;</a> <!-- Todo: replace arrows with svg -->
            <?php else: ?>
                <span aria-hidden="true">&larr;</span>
            <?php endif ?>

            <span>Page <?= $pagination->page() ?> of <?= $pagination->pages() ?></span>

            <?php if ($pagination->hasNextPage()): ?>
                <a href="<?= $pagination->nextPageUrl() ?>" aria-label="Next page">&rarr;</a> <!-- Todo: replace arrows with svg -->
            <?php else: ?>
                <span aria-hidden="true">&rarr;</span>
            <?php endif ?>
        </nav>
<?php endif ?>