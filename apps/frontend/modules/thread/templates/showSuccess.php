<?php foreach ($entries as $i => $entry): ?>
  <div class="entry <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
    <ul class="entry_heading">
      <li><?php echo $entry->getAuthor() ?></li>
      <li><?php echo $entry->getCreatedAt() ?></li>
    </ul>
    <p class="entry_body"><?php echo $entry->getBody() ?></p>
  </div>
<?php endforeach ?>
