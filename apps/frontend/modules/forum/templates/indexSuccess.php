<?php slot('title', sprintf('Partum Artificium Forums')) ?>

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
      <td><?php echo link_to($partum_artificium_forum->getTitle(), 'threads', array("forum_slug" => $partum_artificium_forum->getSlug())) ?></td>
      <td><?php echo $partum_artificium_forum->getSlug() ?></td>
      <td></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

