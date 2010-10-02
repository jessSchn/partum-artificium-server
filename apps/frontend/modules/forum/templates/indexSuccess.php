<?php slot('title', sprintf('Partum Artificium Forums')) ?>
<ul id="forums">
  <li><ul id="forum_header">
    <li class="first">Title</li>
    <li>Moderator</li>
    <li>Thread Count</li>
    <li>Entry Count</li>
    <li>Latest Entry</li>
  </ul></li>
  <?php foreach ($forums as $i => $forum): ?>
  <li class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>"><ul class="forum_entry">
    <li class="first"><?php echo $forum ?></li>
    <li><?php echo $forum->getModerator() ?><li>
    <li><?php echo $forum->getThreadCount() ?></li>
    <li><?php echo $forum->getEntryCount() ?></li>
    <li><?php /** TODO Link to Entry */ echo $forum->getLatestEntry() ?></li>
  </ul></li>
  <?php endforeach ?>
</ul>

