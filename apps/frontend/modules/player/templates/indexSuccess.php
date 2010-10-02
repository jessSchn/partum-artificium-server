<h1>Partum artificium players List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User name</th>
      <th>Picture path</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($partum_artificium_players as $partum_artificium_player): ?>
    <tr>
      <td><a href="<?php echo url_for('player/show?id='.$partum_artificium_player->getId()) ?>"><?php echo $partum_artificium_player->getId() ?></a></td>
      <td><?php echo $partum_artificium_player->getUserName() ?></td>
      <td><?php echo $partum_artificium_player->getPicturePath() ?></td>
      <td><?php echo $partum_artificium_player->getCreatedAt() ?></td>
      <td><?php echo $partum_artificium_player->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('player/new') ?>">New</a>
