<div class="flex-sb-h m-b-30">
  <div class="flex" data-module="Fsp" data-fsp-base-url="<?= $fsp_base_url?>">
    <div style="width:200px;" class="m-r">
      <?= partial('fsp/location', ['on_change'=>true]) ?>
    </div>
    <div style="width: 200px;">
      <?= partial('fsp/subject', ['on_change'=>true]) ?>
    </div>
  </div>

  <div>
    <a href="<?= url('community-event-form') ?>" class="btn btn-pink">Start a conversation</a>
  </div>
</div>
