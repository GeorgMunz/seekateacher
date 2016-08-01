<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-3">
        <img src="<?= $course->upload_cover_img->uri ?>" class="img-responsive">
      </div>
      <div class="col-xs-6">
        <h1 class="pink"><?= $course->title ?></h1>
        <h2><?= $user->org_name ?></h2>
        <h2 class="blue"><?= $user->org_loc ?>, <?= $user->borough ?></h2>
      </div>
      <div class="col-xs-3">
        <p><span class="gray-dark">Posted on: </span> <?= $course->posted_on?> </p>
      </div>
    </div>
    <div class="row m-t">
      <div class="col-xs-3">
        <span class="gray-dark">Start Date: </span>
        <?= $course->start_date ?>
      </div>
      <div class="col-xs-3">
        <span class="gray-dark">End Date: </span>
        <?= $course->end_date ?>
      </div>
      <div class="col-xs-6">
        <p class="pull-right">
          <span class="gray-dark">Price: </span>
          <span class="pink"><?= $course->price_f ?></span>
        </p>
      </div>
    </div>

    <h2 class="pink">Description</h2>
    <div class="description">
      <?= $course->detail ?>
    </div>
  </div>
</div>
