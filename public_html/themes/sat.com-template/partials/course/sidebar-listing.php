<div class="sidebar" data-module="Fsp" data-fsp-base-url="/course/listing">
  <h1 class="sidebar-title">Courses</h1>

  <div class="box-gray-light">
    <?php partial('fsp/search', ['prefetch'=>'/page/courses']) ?>

    <h2><?= pagi('num_rows') ?> <span class="pink">Course Found</span></h2>

    <div class="box-15">
      <?php partial('fsp/subject', ['on_change'=>true]) ?>
    </div>
  </div>
</div>
