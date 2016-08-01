<div class="card">
  <div class="card-body">
    <div class="row flex">
      <div class="col-xs-7">
        <h1 class="pink m-b-10"><?= $job->title ?></h1>
        <h2 class="m-t-0"><?= $job->subtype ?></h2>
        <h2 class="blue"><?= $user->location ?>, <?= $user->borough ?></h2>
        <div class="flex-sb-h">
          <p>
            <span class="gray-dark">Posted:</span><?= fdate($job->start_date)  ?>
          </p>
          <p>
            <span class="gray-dark">Closing Date:</span><?= fdate($job->end_date) ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
