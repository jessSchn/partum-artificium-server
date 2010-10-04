<?php slot('title', sprintf('Partum Artificium Forums')) ?>
<table id="forums">
  <thead id="forum_header">
    <tr>
      <th>Title</th>
      <th>Moderator</th>
      <th>Thread Count</th>
      <th>Entry Count</th>
      <th>Latest Entry</th>
    <tr>
  </thead>
  <tbody>
    <?php foreach ($forums as $i => $forum): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?> forum_entry">
      <td><?php echo link_to($forum, 'threads', array("forum_slug" => $forum->getSlug())) ?></td>
      <td><?php echo link_to($forum->getModerator(), 'player', array("user_name" => $forum->getModerator())) ?></td>
      <td><?php echo $forum->getThreadCount() ?></td>
      <td><?php echo $forum->getEntryCount() ?></td>
      <?php if (!is_null($forum->getLatestEntry())): ?>
      <td><?php echo $forum->getLatestEntry()->getCreatedAt() ?></td>
      <?php else: ?>
      <td>No Entries!</td>
      <?php endif ?>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

