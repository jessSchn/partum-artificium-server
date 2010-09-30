<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $partum_artificium_forum->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $partum_artificium_forum->getTitle() ?></td>
    </tr>
    <tr>
      <th>Moderator:</th>
      <td><?php echo $partum_artificium_forum->getModeratorId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $partum_artificium_forum->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $partum_artificium_forum->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $partum_artificium_forum->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('forum/edit?id='.$partum_artificium_forum->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('forum/index') ?>">List</a>
