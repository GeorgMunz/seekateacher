<div class="card">
    <?php if ($job->timeline): ?>
        <div class="card-alerts">
            <div class="card-alert">
                <?= $job->timeline?>
            </div>
        </div>
    <?php endif;?>
    <div class="card-body">
        <div class="row flex">
            <div class="col-xs-7">
                <h1 class="pink m-b-10">
                    <?= excerpt($job->title, 35) ?>
                </h1>
                <h2 class="m-t-0"><?= $job->subtype ?></h2>
                <h2 class="blue m-t-0"><?= $user->location ?>, <?= $user->borough ?></h2>
                <?= excerpt($job->detail, 100) ?>
                <div class="flex-sb-h" style="margin-top:15px;">
                    <a href="<?=$job->email_url?>" class="btn btn-outline-pink">Email Friend</a>

                    <?php if (auth('is', 'guest')): ?>
                        <a href="/auth/login" class="btn btn-outline-pink">Save Job</a>
                    <?php elseif ($job->action_saved_status): ?>
                        <button data-module="action-btn" data-action-btn='<?=$job->action_saved?>' class="btn-pink">Saved</button>
                    <?php else: ?>
                        <button data-module="action-btn" data-action-btn='<?=$job->action_saved?>' class="btn btn-outline-pink">Save Job</button>
                    <?php endif; ?>

                    <?php if (auth('is', 'guest')): ?>
                        <a href="/auth/login" class="btn btn-outline-pink">Apply Job</a>
                    <?php elseif ($job->action_apply_status): ?>
                        <button data-module="action-btn" data-action-btn='<?=$job->action_apply?>' class="btn-pink">Applied</button>
                    <?php else: ?>
                        <button data-module="action-btn" data-action-btn='<?=$job->action_apply?>' class="btn btn-outline-pink">Apply Job</button>
                    <?php endif; ?>
                </div>

                <div class="flex-sb-h" style="margin-top:15px;">
                    <p style="margin-bottom:0">
                        <span class="gray-dark">Posted:</span><span class="meta-value"> <?= fdate($job->start_date) ?></span>
                    </p>
                    <p style="margin-bottom:0">
                        <span class="gray-dark">Closing Date:</span><span class="meta-value"> <?= fdate($job->end_date) ?> </span>
                    </p>
                </div>

            </div>
            <div class="col-xs-5">
                <div class="row" style="margin-bottom:30px;">
                    <div class="col-xs-8 border-none">
                        <h2 class="m-t-0"> <?= $user->org_name ?> </h2>
                        <p class="font-bold"><?= $user->location ?></p>
                    </div>
                    <div class="col-xs-4">
                        <img src="<?= $user->org_logo ?>" class="img-responsive">
                    </div>
                </div>

                <div>
                    <p>
                        <span class="gray-dark">Location: </span>
                        <?= $user->location ?>, <?= $user->borough ?>
                    </p>
                    <p>
                        <span class="gray-dark">Term: </span>
                        <?= $job->contract_type ?>
                    </p>
                    <p>
                        <span class="gray-dark">Salary: </span>
                        <?= $job->salary ?>
                    </p>
                    <p class="m-b-0">
                        <span class="gray-dark">Type: </span>
                        <?= $job->contract_type ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if (!isset($detail)): ?>
        <div class="card-footer">
            <a href="<?= $job->url ?>" class="btn btn-blue btn-block r-a-0" target="_blank">View more</a>
        </div>
    <?php endif; ?>
</div>
