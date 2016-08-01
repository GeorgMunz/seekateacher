<?php layout('recruiter-profile') ?>

<div class="col-xs-12">

  <div class="flex-sb-h">
    <h1>My Details</h1>
    <div>
      <?php partial('widgets/widget-progress-bar') ?>
    </div>
  </div>

  <div class="panel-group box-gray-light" id="accordion" data-module="wizard">

    <?php partial('panels/panel-pink-2', ['id'=>'p1','title'=>'Public Profile','partial'=>'recruiter/form-basic-information']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p2','title'=>'Contact Details','partial'=>'recruiter/form-contact']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p3','title'=>'Marketing Preferences','partial'=>'user/form-marketing-preference']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p4','title'=>'Deactivate Account','partial'=>'user/form-deactivate']) ?>

  </div>

</div>
