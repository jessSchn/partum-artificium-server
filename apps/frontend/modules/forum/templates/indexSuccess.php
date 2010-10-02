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
      <td><?php echo $forum ?></td>
      <td><?php echo $forum->getModerator() ?></td>
      <td><?php echo $forum->getThreadCount() ?></td>
      <td><?php echo $forum->getEntryCount() ?></td>
      <td><?php /** TODO Link to Entry */ echo $forum->getLatestEntry() ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

