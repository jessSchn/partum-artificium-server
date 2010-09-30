<h1>Partum artificium forums List</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Topics</th>
      <th>Posts</th>
      <th>Last Post</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($partum_artificium_forums as $i => $partum_artificium_forum): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td><a href="<?php echo url_for('forum/show?id='.$partum_artificium_forum->getId()) ?>"><?php echo $partum_artificium_forum->getTitle() ?></a></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('forum/new') ?>">New</a>
