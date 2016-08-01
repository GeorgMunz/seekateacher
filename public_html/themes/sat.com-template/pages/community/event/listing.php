<?php layout('c1') ?>

<div class="col-xs-2">
    <?php partial('navs/nav-community') ?>
</div>
<div class="col-xs-10">
    <?= model('option')->value('template_events') ?>
    <?php partial('community/filter') ?>

    <div class="cards box-gray-light">
        <?php
        foreach ($events as $event) {
            partial('event/card-lg-2', ['community' => $event, 'user' => $event->user]);
        }

        partial('paginations/pagination-center');
        ?>
    </div>

</div>
