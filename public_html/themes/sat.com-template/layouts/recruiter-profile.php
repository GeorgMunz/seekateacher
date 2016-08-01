<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-after-login'); ?>
  <?php partial('navs/nav-recruiter-profile'); ?>
  <div class="container">
    <div class="row p-t-30">
      <?php page() ?>
    </div>
  </div>
  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
