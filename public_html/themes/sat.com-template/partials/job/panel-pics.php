<div class="panel panel-pink mar-b-15">
  <div class="panel-heading">
    <h2 class="panel-title">Photos</h2>
  </div>
  <div class="panel-body">
    <div class="flex-wrap">
      <?php foreach ($job->upload_pics as $pic): ?>
        <div class="thumbnail m-r" style="width:calc(100%/3 - 30px)">
          <a href="<?=$pic->uri?>" data-toggle="lightbox">
            <img src="<?= $pic->uri ?>">
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
