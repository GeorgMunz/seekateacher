<?php js('recaptcha') ?>
<?php partial('head') ?>
<body class="<?= body_classes()?>">
  <?php partial('site-header/site-header-before-login'); ?>

  <div class="container">
    <div class="row">

      <div class="col-xs-9 p-y-30">
        <h1>Basic Details</h1>
        <div class="box-gray-light">
          <div class="col-xs-12">
            <?= page() ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php partial('site-footer') ?>
  <?php foot() ?>
</body>
</html>
