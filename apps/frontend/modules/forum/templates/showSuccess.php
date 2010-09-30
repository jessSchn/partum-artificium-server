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
    <?php echo $partum_artificium_threads ?>
    <?php if (count($partum_artificium_threads) > 0): ?>
    <?php foreach ($partum_artificium_threads as $i => $partum_artificium_thread): ?>
    <a href="<?php echo url_for('thread/edit?id='.$partum_artificium_thread->getId()) ?>">
      <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td><?php echo $partum_artificium_forum->getTitle() ?></td>
        <td><?php echo $partum_artificium_thread ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </a>
    <?php endforeach ?>
    <?php endif ?>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('forum/index') ?>">Forum List</a>
