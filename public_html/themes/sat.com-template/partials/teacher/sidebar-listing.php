<div class="sidebar" data-module="Fsp" data-fsp-base-url="/teacher/listing">
    <div class="clearfix">
      <h1 class="sidebar-title bg-gray pull-left"><a href="/job/listing" class="black">Jobs</a></h1>
      <h1 class="sidebar-title bg-gray-light pull-right">Teachers</h1>
    </div>

  <div class="box-gray-light">
    <a class="pull-right" href="<?=fsp('url', '_clear')?>">Clear Filters</a>
    <h2><?= pagi('num_rows') ?> <span class="pink"> Teachers found</span></h2>
    <?php partial('fsp/search', ['prefetch'=>'/page/teachers']) ?>

    <br>

    <?php foreach ($teacher_filters as $key => $filter): $id = "fsp-$key"; ?>
    <hr class="hr-offsetted">
    <h2 class="pink m-t-0 btn-collapse <?=(!$filter['open']) ? 'collapsed' : ''?>" data-toggle="collapse" data-target="#<?=$id?>">
          <?=$filter['title']?>
          <span class="icon-down-2 pull-right"></span>
      </h2>
    <?php partial('fsp/list-style-3', ['id' => $id, 'key2' => $key, 'values' => $filter['values'], 'open' => $filter['open']]) ?>
    <?php endforeach; ?>
  </div>
</div>
