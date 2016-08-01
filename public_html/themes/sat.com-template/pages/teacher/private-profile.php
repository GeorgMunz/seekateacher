<?php layout('teacher-profile') ?>

<div class="col-xs-12">

  <div class="flex-sb-h">
    <h1>My Details</h1>
    <div>
      <?php partial('widgets/widget-progress-bar') ?>
    </div>
  </div>

  <div data-module="wizard" class="panel-group box-gray-light" id="accordion">

    <?php partial('panels/panel-pink-2', ['id'=>'p1','title'=>'Public Profile','partial'=>'teacher/form-basic-information']) ?>
		<?php partial('panels/panel-pink-2', ['id'=>'p2','title'=>'Experience','partial'=>'teacher/form-experience']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p3','title'=>'Attachments','partial'=>'teacher/form-attachment']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p4','title'=>'Marketing Preferences','partial'=>'user/form-marketing-preference']) ?>
    <?php partial('panels/panel-pink-2', ['id'=>'p5','title'=>'Deactivate Account','partial'=>'user/form-deactivate']) ?>

  </div>

</div>
