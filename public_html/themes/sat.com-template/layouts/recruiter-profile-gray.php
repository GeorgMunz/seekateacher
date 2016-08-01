<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-after-login'); ?>
  <?php partial('navs/nav-recruiter-profile'); ?>

  <div class="container m-t-30">
    <div class="box-gray-light">
      <div class="row">
        <?php page() ?>
      </div>
    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
