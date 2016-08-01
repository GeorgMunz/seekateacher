<div class="panel panel-pink">
    <div class="panel-heading">
        <h2 class="panel-title">Apply for job</h2>
    </div>
    <div class="panel-body bg-gray-light">
        <h2 class="m-t-0 pink">Apply through the organisation</h2>
        <p class="font-18 font-lg-regular">Please send your completed application for further information:</p>
        <div class="flex-sb-h">
            <div class="box size-f m-r">
                CONTACT NAME: <span class="blue"><?= $job->contact_name ?></span>
            </div>
            <div class="box size-f m-r">
                CONTACT TEL: <span class="blue"><?= $job->contact_tel ?></span>
            </div>
            <div class="box size-f">
                EMAIL: <span class="blue"><?= $job->contact_email ?></span>
            </div>
        </div>

        <p class="font-18 font-lg-regular m-t">Application Documents</p>
        <p>
            <a href="#" class="btn btn-white btn-icon-left btn-pink"> <i class="icon-document"></i> Application Form</a>
        </p>

        <p class="m-t"><a href="#" class="btn btn-blue" type="submit">Apply via the organisation’s website</a></p>

        <h3 class="darkpink font-lg-regular">Or you can quickly apply through SAT</h3>
        <p>
            <?php if (auth('is', 'guest')): ?>
                <a href="/auth/login" class="btn btn-blue btn-xs">Apply</a>
            <?php elseif ( ! $job->is_applied): ?>
                <a href="<?=$job->apply_url?>" class="btn btn-blue btn-xs">Apply</a>
            <?php else:?>
                <a href="<?=$job->unapply_url?>" class="btn btn-orange btn-xs">Applied</a>
            <?php endif;?>
        </p>
    </div>
</div>
