<div class="card">
    <div class="card-body row">

        <div class="col-xs-2">
            <img src="<?= $tch->profile_pic ?>" class="img-responsive">
            <?php if (auth('is', 'guest')): ?>
                <a href="/auth/login" class="btn-pink m-t">Follow</a>
            <?php elseif ($tch->action_follow_status): ?>
                <button data-module="action-btn" data-action-btn='<?=$tch->action_follow?>' class="btn-pink m-t">Followed</button>
            <?php else: ?>
                <button data-module="action-btn" data-action-btn='<?=$tch->action_follow?>' class="btn-pink m-t">Follow</button>
            <?php endif; ?>
        </div>

        <div class="col-xs-7">
            <h1><?= $tch->name ?></h1>
            <h2 class="m-b-10"><?= $tch->subject_main ?></h2>
            <h3 class="m-t-0"><?= $tch->gender?>, <?= $tch->location?>, <?= $tch->age?> Years old </h3>
            <?php if ( ! isset($detail)):?>
                <p class="word-break"><?= excerpt($tch->about, 70)?></p>
            <?php endif;?>
        </div>

        <div class="col-xs-3">
            <p>
                <span class="gray-dark">Location:</span> <?= $tch->location ?>, <?= $tch->borough ?>
            </p>
            <ul class="list-reset flex-sb-h">
                <li>
                    <label class="rc-custom-2">
                        <?= form_radio('color_'.$tch->id, 0, $tch->avail == 1, 'disabled')?>
                        <span></span>
                    </label>
                </li>
                <li>
                    <label class="rc-custom-2">
                        <?= form_radio('color_'.$tch->id, 1, $tch->avail == 2, 'disabled')?>
                        <span></span>
                    </label>
                </li>
                <li>
                    <label class="rc-custom-2">
                        <?= form_radio('color_'.$tch->id, 2, $tch->avail == 3, 'disabled')?>
                        <span></span>
                    </label>
                </li>
            </ul>
            <div>
                <?php partial('action-btn/get-in-touch', ['user'=>$tch]) ?>
                <?php if (auth('is', 'guest')): ?>
                    <a href="/auth/login" class="btn-pink">Add to Watchlist</a>
                <?php elseif ($tch->action_watchlist_status): ?>
                    <button data-module="action-btn" data-action-btn='<?=$tch->action_watchlist?>' class="btn-pink">Watching</button>
                <?php else: ?>
                    <button data-module="action-btn" data-action-btn='<?=$tch->action_watchlist?>' class="btn-pink">Add to Watchlist</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (isset($detail)): ?>
        <div class="detail p-a">
            <?= $tch->about ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($detail)): ?>
        <div class="card-footer">
            <a target="_blank" href="<?=$tch->public_profile?>" class="btn btn-blue btn-block r-a-0">View More</a>
        </div>
    <?php endif; ?>

</div>
