<?php slot('title', sprintf('Partum Artificium Forum > %s', $forum->getTitle())) ?>
<table id="threads">
  <thead id="thread_header">
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>View Count</th>
      <th>Entry Count</th>
      <th>Latest Entry</th>
    <tr>
  </thead>
  <tbody>
    <?php foreach ($forum->getThreads() as $i => $thread): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?> thread_entry">
      <td><?php echo link_to($thread, 'thread', array("forum_slug" => $forum->getSlug(), "thread_slug" => $thread->getSlug())) ?></td>
      <td><?php echo link_to($thread->getLatestEntry()->getAuthor(), 'player', array("user_name" => $thread->getLatestEntry()->getAuthor())) ?></td>
      <td></td>
      <td><?php echo $thread->getEntryCount() ?></td>
      <?php if (!is_null($thread->getLatestEntry())): ?>
      <td><?php echo $thread->getLatestEntry()->getCreatedAt() ?></td>
      <?php else: ?>
      <td>No Entries!</td>
      <?php endif ?>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

