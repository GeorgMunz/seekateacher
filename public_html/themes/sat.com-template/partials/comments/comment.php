<hr style="clear:both">
<div class="card m-b" style="width:90%;float:right">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-1 p-r-0">
        <img class="img-responsive" src="<?= $user->profile_pic ?>">
      </div>
      <div class="col-xs-11">
        <div class="flex-sb-h">
          <p class="font-bold pink"><?=$user->name?> <span class="font-regular font-12 gray">(<?=$comment->created_at?>)</span> </p>
          <!-- <div class="dropdown">
            <span class="glyphicon glyphicon-thumbs-up"></span>
            <button class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown">
              <span class="caret dropdown-icon"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Reply to the person</a></li>
              <li><a href="#">Report this post</a></li>
            </ul>
          </div> -->
        </div>
        <div class="detail">
          <?= $comment->comment?>
        </div>
      </div>
    </div>
  </div>
</div>
