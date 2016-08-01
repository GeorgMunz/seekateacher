<div class="sidebar" data-module="Fsp" data-fsp-base-url="<?= $fsp_base_url?>">
  <div class="clearfix">
    <h1 class="sidebar-title bg-gray-light pull-left">Jobs</h1>
    <h1 class="sidebar-title bg-gray pull-right"><a href="/teacher/listing" class="black">Teachers</a></h1>
  </div>

  <div class="box-gray-light">
    <a class="pull-right" href="<?=fsp('url', '_clear')?>">Clear Filters</a>
    <h2><?= pagi('num_rows') ?> <span class="pink"> Jobs found</span></h2>
    <?php partial('fsp/search', ['prefetch' => '/page/jobs']) ?>


    <br>

    <?php partial('fsp/postcode_2', ['prefetch' => '/page/post_codes']) ?>

    <?php foreach ($job_filters as $key => $filter): $id = "fsp-$key"; ?>
    <hr class="hr-offsetted">
    <h2 class="pink m-t-0 btn-collapse <?=(!$filter['open']) ? 'collapsed' : ''?>" data-toggle="collapse" data-target="#<?=$id?>">
          <?=$filter['title']?>
          <span class="icon-down-2 pull-right"></span>
      </h2>
    <?php partial('fsp/list-style-2', ['id' => $id, 'key2' => $key, 'values' => $filter['values'], 'open' => $filter['open']]) ?>
    <?php endforeach; ?>

  </div>
</div>
