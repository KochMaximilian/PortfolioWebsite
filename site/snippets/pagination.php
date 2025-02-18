<?php if ($pagination->hasPages()): ?>
        <nav>
            <?php if ($pagination->hasPrevPage()): ?>
                <a href="<?= $pagination->prevPageUrl() ?>" aria-label="Previous page"><button class="pagination-link"><i class="fa-solid fa-caret-left"></i></button></a> <!-- Todo: replace arrows with svg -->
            <?php else: ?>
                <button class="pagination-dead-link" aria-hidden="true"><i class="fa-solid fa-caret-left"></i></button>
            <?php endif ?>

            <span class="indicate-page-text">Page <span class="pagination-number"><?= $pagination->page() ?></span> of <?= $pagination->pages() ?></span>

            <?php if ($pagination->hasNextPage()): ?>
                <a href="<?= $pagination->nextPageUrl() ?>" aria-label="Next page"> <button class="pagination-link"><i class="fa-solid fa-caret-right"></i></button> </a><!-- Todo: replace arrows with svg -->
            <?php else: ?>
                <button class="pagination-dead-link" aria-hidden="true"><i class="fa-solid fa-caret-right "></i></button>
            <?php endif ?>
        </nav>
<?php endif ?>