<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $partum_artificium_player->getId() ?></td>
    </tr>
    <tr>
      <th>User name:</th>
      <td><?php echo $partum_artificium_player->getUserName() ?></td>
    </tr>
    <tr>
      <th>Picture path:</th>
      <td><?php echo $partum_artificium_player->getPicturePath() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $partum_artificium_player->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $partum_artificium_player->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('player/edit?id='.$partum_artificium_player->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('player/index') ?>">List</a>
