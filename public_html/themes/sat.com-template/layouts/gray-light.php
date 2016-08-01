<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-before-login'); ?>

  <div class="bg-gray-light p-y-30">
    <div class="container">
      <div class="row">
        <?php page() ?>
      </div>
    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
