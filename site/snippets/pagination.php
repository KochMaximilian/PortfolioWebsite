<?php if ($pagination->hasPages()): ?>
        <nav>
            <?php if ($pagination->hasPrevPage()): ?>
                <a class="pagination-link" href="<?= $pagination->prevPageUrl() ?>" aria-label="Previous page"><i class="fa-solid fa-caret-left" aria-hidden="true"></i></a>
            <?php else: ?>
                <span class="pagination-dead-link" aria-hidden="true"><i class="fa-solid fa-caret-left"></i></span>
            <?php endif ?>

            <span class="indicate-page-text">Page <span class="pagination-number"><?= $pagination->page() ?></span> of <?= $pagination->pages() ?></span>

            <?php if ($pagination->hasNextPage()): ?>
                <a class="pagination-link" href="<?= $pagination->nextPageUrl() ?>" aria-label="Next page"><i class="fa-solid fa-caret-right" aria-hidden="true"></i></a>
            <?php else: ?>
                <span class="pagination-dead-link" aria-hidden="true"><i class="fa-solid fa-caret-right"></i></span>
            <?php endif ?>
        </nav>
<?php endif ?>