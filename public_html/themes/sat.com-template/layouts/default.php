<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-before-login'); ?>

  <div class="container p-t-30">
    <div class="row">
      <?php page() ?>
    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
