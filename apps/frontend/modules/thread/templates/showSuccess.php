<?php slot('title', $thread->getSlug()) ?>
<ul class="entries_heading">
  <li class="first"><?php echo link_to($forum, 'threads', array("forum_slug" => $forum->getSlug())) ?></li>
  <li><?php echo $thread ?></li>
  <li><?php echo $entries[0]->getAuthor() ?></li>
  <li></li>
  <li><?php echo $thread->getLatestEntry()->getCreatedAt() ?></li>
</ul>
<?php foreach ($entries as $i => $entry): ?>
<div class="entry <?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
  <div class="author"><?php echo $entry->getAuthor() ?></div>
  <p class="entry_body"><?php echo $entry->getBody() ?></p>
</div>
<?php endforeach ?>

