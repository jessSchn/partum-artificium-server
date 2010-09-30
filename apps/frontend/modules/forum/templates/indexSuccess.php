<h1>Partum artificium forums List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Moderator</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($partum_artificium_forums as $partum_artificium_forum): ?>
    <tr>
      <td><a href="<?php echo url_for('forum/show?id='.$partum_artificium_forum->getId()) ?>"><?php echo $partum_artificium_forum->getId() ?></a></td>
      <td><?php echo $partum_artificium_forum->getTitle() ?></td>
      <td><?php echo $partum_artificium_forum->getModeratorId() ?></td>
      <td><?php echo $partum_artificium_forum->getCreatedAt() ?></td>
      <td><?php echo $partum_artificium_forum->getUpdatedAt() ?></td>
      <td><?php echo $partum_artificium_forum->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('forum/new') ?>">New</a>
