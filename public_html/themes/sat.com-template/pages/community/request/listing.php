<?php layout('c1') ?>

<div class="col-xs-2">
    <?php partial('navs/nav-community') ?>
</div>

<div class="col-xs-10">
    <?= model('option')->value('template_request') ?>
    <?php partial('community/filter') ?>

    <div class="box-gray-light cards">
        <?php
        foreach ($requests as $request) {
            partial('community/card-lg-3', ['community' => $request, 'user'=>$request->user]);
        }

        partial('paginations/pagination-center')
        ?>
    </div>
</div>
