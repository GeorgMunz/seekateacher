<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-before-login'); ?>

  <div class="bg-gray-light p-y-30">
    <div class="container text-center" ng-app>
      <div class="bg-white p-y-30 clearfix">
        <div class="col-xs-6 col-xs-offset-3">
          <?php page() ?>
        </div>
      </div>
    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
