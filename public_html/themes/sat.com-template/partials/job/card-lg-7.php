<div class="card">
  <div class="card-body">
    <div class="flex-row">
      <div class="col-xs-6">
        <h1><?= $job->title ?></h1>
        <?php partial('kvs',['kvs'=>['Posting Date'=>$job->start_date,'Expiration Date'=>$job->end_date,'You invited'=>count($job->invited)]]) ?>
      </div>
      <div class="col-xs-6 flex-sb-v">
        <div class="flex-end">
          <a href="<?=$job->edit_url?>" class="m-r"><span class="icon-edit"></span> Edit</a>
          <a href="<?=$job->delete_url?>"><span class="icon-delete"></span> Delete</a>
        </div>
        <div class="flex-end">
          <a class="btn-outline-blue m-r" href="<?=$job->invite_url?>">Invite teachers</a>
          <a class="btn-outline-blue" href="<?=$job->response_url?>"><?= count($job->responses)?> Responses</a>
        </div>
      </div>
    </div>
  </div>
</div>
