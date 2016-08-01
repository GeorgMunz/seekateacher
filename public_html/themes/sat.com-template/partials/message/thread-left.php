<hr>
<div class="thread">
  <div class="flex-sb-h">
    <h2 class="mar-t-0"><?= $user->name ?></h2>
    <time><?= $thread->created_at ?></time>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <?= $thread->detail ?>
    </div>
  </div>
</div>
