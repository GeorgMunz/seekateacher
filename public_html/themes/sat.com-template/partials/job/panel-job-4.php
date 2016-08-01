<div class="panel-pink-inverse m-r-0">
  <h2>Videos</h2>
  <div class="panel-body">
    <?php partial('kvs',['kvs'=>[
      'Max file size'=>'10MB',
      'File support'=>'webm, mp4',
      ]]) ?>

    <div class="form-group">
      <?php if ($job->upload_video): ?>
        <video width="200" controls>
          <source src="<?= $job->upload_video->uri?>" type="<?=$job->upload_video->mime?>">
          Your browser does not support the video tag.
        </video>
      <?php endif; ?>
      <input type="file" name="job_video">
    </div>
  </div>
</div>
