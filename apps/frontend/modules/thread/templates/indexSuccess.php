<h1>Partum artificium forum threads List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Subject</th>
      <th>Forum</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($partum_artificium_forum_threads as $partum_artificium_forum_thread): ?>
    <tr>
      <td><a href="<?php echo url_for('thread/show?id='.$partum_artificium_forum_thread->getId()) ?>"><?php echo $partum_artificium_forum_thread->getId() ?></a></td>
      <td><?php echo $partum_artificium_forum_thread->getSubject() ?></td>
      <td><?php echo $partum_artificium_forum_thread->getForumId() ?></td>
      <td><?php echo $partum_artificium_forum_thread->getCreatedAt() ?></td>
      <td><?php echo $partum_artificium_forum_thread->getUpdatedAt() ?></td>
      <td><?php echo $partum_artificium_forum_thread->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('thread/new') ?>">New</a>
