<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-after-login'); ?>
  <?php partial('navs/nav-recruiter-profile'); ?>

  <div class="bg-pattern">
    <div class="container p-y-30">
      <div class="box">
        <div class="row">
          <?php page() ?>
        </div>
      </div>
    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
