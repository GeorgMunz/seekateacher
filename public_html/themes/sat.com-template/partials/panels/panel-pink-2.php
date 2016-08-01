<div class="panel-pink-2" data-wizard-panel>
  <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#<?=$id?>">
    <h4 class="panel-title">
      <?=$title?>
    </h4>
    <span class="glyphicon glyphicon-plus"></span>
  </div>
  <div id="<?=$id?>" class="panel-collapse collapse in">
    <div class="panel-body">
      <?php partial($partial) ?>
    </div>
  </div>
</div>
