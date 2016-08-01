<?php layout(['tch'=>'teacher-profile','rec'=>'recruiter-profile','guest'=>'default']); ?>
<div class="col-xs-12 flex">

  <div class="col-xs-8 bg-gray-light p-y">
    <?php partial('recruiter/card-lg', ['rec'=>$rec, 'detail'=>true]); ?>

    <h1 class="pink m-t-30">Description</h1>
    <div><?= $rec->org_about ?></div>

    <div class="row p-y-30">
      <div class="col-xs-6">
        <?php partial('recruiter/panel-about') ?>
      </div>
      <div class="col-xs-6">
        <?php partial('recruiter/panel-social-stuff') ?>
      </div>
    </div>
  </div>

  <div class="col-xs-4 bg-gray-light p-y">
    <?php partial('recruiter/panel-stats') ?>

    <?php partial('recruiter/panel-contacts') ?>
  </div>

</div>
