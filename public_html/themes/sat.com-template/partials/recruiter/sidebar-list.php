<div class="sidebar" data-module="Fsp" data-fsp-base-url="/recruiter/listing/<?=$type?>">
  <h1 class="sidebar-title"><?= $sidebar_title?></h1>

  <div class="box-gray-light">
    <?php partial('fsp/search', ['prefetch'=>'/page/recruiter']) ?>

    <h2><?= pagi('num_rows') ?> <span class="pink"><?= $sidebar_title?> found</span></h2>

    <div class="box">
      <h2 class="darkpink">Location</h2>
      <?php partial('fsp/location') ?>
    </div>
  </div>
</div>
