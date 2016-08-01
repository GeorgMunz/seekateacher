<div class="panel-pink-inverse">
  <h2>Photos</h2>
  <div class="panel-body">
    <?php partial('kvs',['kvs'=>[
      'Maximum file'=>'1MB',
      'File support'=>'JPEG',
      'Max File'=>'3'
      ]]) ?>

    <div data-module="ImgPreview" data-ImgPreview-max-files="3" >
      <?php foreach ($job->upload_pics as $pic): ?>
        <?php partial('thumbnail/thumbnail-sm',['uri'=>$pic->uri]) ?>
      <?php endforeach; ?>
      <div data-ImgPreview-add class="thumbnail-sm">
        <div class="toolbar">
          <span class="glyphicon glyphicon-upload"></span>
        </div>
      </div>
    </div>

  </div>
</div>

<script id="ImgPreviewTemplate" type="text/template">
<?php partial('thumbnail/thumbnail-sm',['uri'=>'#']) ?>
</script>
