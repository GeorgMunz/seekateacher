<?php layout(['tch'=>'teacher-profile','rec'=>'recruiter-profile','guest'=>'default']); ?>
<div class="col-xs-12 flex">

  <div class="col-xs-8 bg-gray-light p-y">
    <?php partial('teacher/card-lg', ['detail'=>true]); ?>

    <div class="row p-y">
      <div class="col-xs-6">
        <h1 class="pink">About</h1>
        <?php
        $kvs = [
          'TEACHING AT' => $tch->org_name,
          'TEACHING' => $tch->subject_main,
          'CV' => $tch->org_gender,
        ];
        ?>
        <?php foreach ($kvs as $k => $v): ?>
        <div class="flex bg-white m-b">
          <div class="p-a p-r-0 black"><?=$k?></div>
          <div class="p-a blue"><?= $v ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="col-xs-6">
        <h1 class="pink">Social Stuff</h1>
        <?php
        $kvs = [
          'EMAIL ADDRESS' => $tch->email,
          'WEBSITE' => $tch->website,
          'BLOG' => $tch->blogs,
        ];
        ?>
        <?php foreach ($kvs as $k => $v): ?>
        <div class="flex bg-white m-b">
          <div class="p-a p-r-0 black"><?=$k?></div>
          <div class="p-a blue"><?= $v ?></div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>

  <div class="col-xs-4 bg-gray-light p-y">
    <?= partial('teacher/stats'); ?>
    <?= partial('teacher/contacts'); ?>
  </div>

</div>
