<div class="card">
  <div class="card-body row">

    <div class="col-xs-2">
      <img src="<?= $rec->profile_pic ?>" class="img-responsive">
      <?php if ($rec->action_follow_status): ?>
        <button data-module="action-btn" data-action-btn='<?=$rec->action_follow?>' class="btn-pink m-t">Followed</button>
      <?php else: ?>
        <button data-module="action-btn" data-action-btn='<?=$rec->action_follow?>' class="btn-pink m-t">Follow</button>
      <?php endif; ?>
    </div>

    <div class="col-xs-7">
      <h1><?= $rec->name ?></h1>
      <h2 class="m-b-10"><?= $rec->rec_type ?></h2>
      <h3 class="m-t-0"><?= $rec->gender?>, <?= $rec->location?>, 22 Years old </h3>
    </div>

    <div class="col-xs-3">
      <p>
        <span class="gray-dark">Location:</span> <?= $rec->location ?>, <?= $rec->borough ?>
      </p>
      <div>
        <button class="btn btn-outline-pink btn-block m-b-10">Get in Touch</button>
        <?php if ($rec->action_watchlist_status): ?>
          <button data-module="action-btn" data-action-btn='<?=$rec->action_watchlist?>' class="btn-pink">Watching</button>
        <?php else: ?>
          <button data-module="action-btn" data-action-btn='<?=$rec->action_watchlist?>' class="btn-pink">Add to Watchlist</button>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php if (isset($detail)): ?>
    <div class="detail p-a">
      <?= $rec->about ?>
    </div>
  <?php endif; ?>

  <?php if (!isset($detail)): ?>
    <div class="card-footer">
      <a href="<?=$rec->public_profile?>" class="btn btn-blue btn-block r-a-0">View More</a>
    </div>
  <?php endif; ?>

</div>
