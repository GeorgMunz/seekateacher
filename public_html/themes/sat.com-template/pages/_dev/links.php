<?php layout('blank') ?>


<div class="container">
  <ul class="list-group">
    <?php foreach (XL\Template::links() as $link): ?>
    <li class="list-group-item">
      <a href="<?=$link?>" target="_blank" class="btn btn-md btn-block"><?=$link?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
