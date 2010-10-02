<?php slot('title', sprintf('Partum Artificium Forum > %s', $forum->getTitle())) ?>
<ul id="threads">
  <li><ul id="thread_header">
    <li class="first">Title</li>
    <li>Author</li>
    <li>Thread Count</li>
    <li>Entry Count</li>
    <li>Latest Entry</li>
  </ul></li>
  <?php foreach ($forums as $i => $forum): ?>
  <li class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>"><ul class="forum_entry">
    <li class="first"><?php echo $forum ?></li>
    <li><?php echo $forum->getThreadCount() ?></li>
    <li><?php echo $forum->getEntryCount() ?></li>
    <li><?php /** TODO Link to Entry */ echo $forum->getLatestEntry() ?></li>
  </ul></li>
  <?php endforeach ?>
</ul>


<table>
  <thead>
    <th>Forum</th>
    <th>Subject</th>
    <th>Author</th>
    <th>Replies</th>
    <th>Views</th>
    <th>Last Post</th>
  </thead>
  <tbody>
    <?php if (count($partum_artificium_threads) > 0): ?>
    <?php foreach ($partum_artificium_threads as $i => $partum_artificium_thread): ?>
      <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $partum_artificium_forum->getTitle() ?></td>
        <td><?php echo link_to($partum_artificium_thread->getSubject(), 'thread', array("forum_slug" => $partum_artificium_forum->getSlug(), "thread_slug" => $partum_artificium_thread->getSlug())) ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    <?php endforeach ?>
    <?php endif ?>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('forum/index') ?>">Forum List</a>
