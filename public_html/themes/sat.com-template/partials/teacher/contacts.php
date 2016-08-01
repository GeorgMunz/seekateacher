<h1 class="pink m-t-30">Contacts</h1>
<div class="box flex-wrap">
  <?php foreach ($tch->followings as $following): ?>
    <div class="thumbnail m-r m-b" style="width:calc(100%/4 - 30px)">
      <img src="<?= $following->profile_pic ?>" alt="">
    </div>
  <?php endforeach; ?>
</div>
