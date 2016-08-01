<?php layout(['rec'=>'recruiter-profile', 'tch'=>'teacher-profile', 'guest'=>'default']) ?>

<div class="col-xs-4">
    <?php partial('job/sidebar-listing', ['fsp_base_url'=>'/job/listing', 'typeahead_prefetch'=>'/page/jobs']) ?>
</div>

<div class="col-xs-8">
    <div class="row">
        <div class="col-xs-6">
            <?php
            if (fsp('data', 'search')) {
                echo '<h1>'.pagi('num_rows').' Jobs found for <span class="pink">"' . fsp('data','search') . '"</span></h1>';
            }
            ?>
        </div>
        <div class="col-xs-5 col-xs-offset-1 text-right">
            <a class="<?= fsp('data', 'timeline') == 'New' ? 'pink' : 'blue'?> font-bold font-22" style="margin-right:15px;" href="/job/listing/timeline/New">New Ads</a>
            <a class="<?= fsp('data', 'timeline') == 'Expiring' ? 'pink' : 'blue'?> font-bold font-22" href="/job/listing/timeline/Expiring">Expiring Ads</a>
        </div>
    </div>
    <div class="cards box-gray-light">

        <?php

        if (count($jobs)) {
            foreach ($jobs as $job) {
                partial('job/card-lg-6', ['job'=>$job, 'user'=>$job->user]);
            }
        } else {
            echo '<h1 class="pink">No Job Found</h1>';
        }

        partial('paginations/pagination-center');
        ?>

    </div>
</div>
