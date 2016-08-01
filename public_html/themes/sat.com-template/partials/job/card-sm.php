
<div class="card card-style-10">
  <div class="card-body">
    <h1><?= $job->title ?></h1>
    <h2 class="gray-dark"><?= $user->org_name ?></h2>
    <div class="flex-sb-h">
      <h2 class="gray"><?= $user->location ?>, <?= $user->borough ?></h2>
      <a class="btn btn-icon btn-icon-center btn-pink" href="<?=$job->url?>"><i class="icon-search"></i></a>
    </div>
  </div>
</div>
