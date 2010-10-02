<?php foreach ($partum_artificium_thread_entries as $i => $entry): ?>
  <div class="entry <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
    <ul class="entry_heading">
      <li><?php echo $entry->getPartumArtificiumPlayer()->getUserName() ?></li>
      <li><?php echo $entry->getUpdatedAt() ?></li>
    </ul>
    <p class="entry_body"><?php echo $entry->getBody() ?></p>
  </div>
<?php endforeach ?>
