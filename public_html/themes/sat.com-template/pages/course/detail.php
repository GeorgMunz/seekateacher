<?php layout(['tch'=>'teacher-profile-gray','rec'=>'recruiter-profile-gray','guest'=>'default-gray']); ?>

<div class="col-xs-8">
  <?php partial('course/card-detail') ?>
</div>

<div class="col-xs-4">

  <div class="panel panel-pink">
    <div class="panel-heading">
      <h2 class="panel-title">Location &amp; Contact</h2>
    </div>
    <div class="container-gray">
      <div class="panel-body">
        <?php partial('key-val', ['k'=>'Address','v'=>$user->org_addr]) ?>
        <?php partial('key-val', ['k'=>'Telephone','v'=> $user->org_tel]) ?>
        <?php partial('key-val', ['k'=>'Fax No.','v'=> $user->org_fax]) ?>
      </div>
    </div>
  </div>

</div>
