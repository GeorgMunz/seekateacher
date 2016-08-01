<div class="panel-pink-inverse">
  <h2>About School</h2>
  <div class="panel-body">
    <?php
    partial('kvs',['kvs'=>['Org. Type'=>$user->org_type,'Gender'=>$user->org_gender,'Age Group'=>$user->org_gender]]);
    ?>
    <a target="_blank" href="<?= $user->org_website ?>" class="btn-detail m-b-10">School Website</a>
    <a target="_blank" href="<?= $user->public_profile ?>" class="btn-detail">Sat profile</a>
  </div>
</div>
