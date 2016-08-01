<?php layout('c1') ?>

<div class="col-xs-2">
    <?php partial('navs/nav-community') ?>
</div>

<div class="col-xs-10">
    <?= model('option')->value('template_recommendations') ?>
    <?php partial('community/filter') ?>

    <div class="cards box-gray-light">
        <?php
        foreach ($recoms as $recom) {
            partial('community/card-lg-3', ['community'=>$recom, 'user'=>$recom->user]);
        }

        partial('paginations/pagination-center');
        ?>
    </div>

</div>
