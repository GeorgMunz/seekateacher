<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-after-login') ?>
  <?php partial('navs/nav-teacher-profile') ?>
  <div class="container">
    <div class="row p-y">
      <div class="col-xs-2">
        <?php partial('navs/nav-message'); ?>
      </div>
      <div class="col-xs-7">
        <?php page() ?>
      </div>
    </div>
  </div>
  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
