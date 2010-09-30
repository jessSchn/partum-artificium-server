<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $partum_artificium_forum_thread->getId() ?></td>
    </tr>
    <tr>
      <th>Subject:</th>
      <td><?php echo $partum_artificium_forum_thread->getSubject() ?></td>
    </tr>
    <tr>
      <th>Forum:</th>
      <td><?php echo $partum_artificium_forum_thread->getForumId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $partum_artificium_forum_thread->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $partum_artificium_forum_thread->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $partum_artificium_forum_thread->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('thread/edit?id='.$partum_artificium_forum_thread->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('thread/index') ?>">List</a>
