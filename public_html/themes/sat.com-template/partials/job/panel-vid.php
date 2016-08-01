<div class="panel panel-pink">
  <div class="panel-heading">
    <h2 class="panel-title">Videos</h2>
  </div>
  <div class="container-gray">
    <div class="panel-body">
      <?php if ($job->upload_video): ?>
        <video width="330" controls>
          <source src="<?= $job->upload_video->uri?>" type="<?=$job->upload_video->mime?>">
          Your browser does not support the video tag.
        </video>
      <?php endif; ?>
    </div>
  </div>
</div>
