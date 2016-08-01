<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-before-login'); ?>

  <div class="container-full-width">
    <?php page() ?>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
