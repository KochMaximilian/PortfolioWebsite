<?php
$headerRaw  = $block->headers()->isNotEmpty() ? $block->headers()->value() : '';
$rows       = $block->rows()->toStructure();
$size       = $block->size()->isNotEmpty() ? $block->size()->value() : 'full';

$headers    = array_filter(array_map('trim', explode('|', $headerRaw)));
$hasHeaders = !empty($headers);
$colKeys    = ['col1','col2','col3','col4','col5','col6'];
?>
<div class="devlog-table-wrap devlog-table-wrap--<?= $size ?>">
  <table class="devlog-table">
    <?php if ($hasHeaders): ?>
    <thead>
      <tr>
        <?php foreach ($headers as $header): ?>
          <th><?= htmlspecialchars($header) ?></th>
        <?php endforeach ?>
      </tr>
    </thead>
    <?php endif ?>
    <tbody>
      <?php foreach ($rows as $row):
        // Collect all 6 column values
        $cells = array_map(fn($k) => (string)$row->$k()->value(), $colKeys);
        // Find the last non-empty column so we don't render trailing empty cells
        $last = -1;
        foreach ($cells as $i => $c) { if ($c !== '') $last = $i; }
        if ($last === -1) continue; // skip completely empty rows
      ?>
        <tr>
          <?php for ($i = 0; $i <= $last; $i++): ?>
            <td><?= htmlspecialchars($cells[$i]) ?></td>
          <?php endfor ?>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>