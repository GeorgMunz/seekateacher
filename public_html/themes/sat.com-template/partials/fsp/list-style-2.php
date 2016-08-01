<ul id="<?=$id?>" class="<?= ($open) ? 'in' : '' ?> collapse list-style-2">
    <?php foreach ($values as $val): ?>
        <?php if (!$val) continue; ?>
        <li class="<?= fsp('data', $key2) == $val ? 'active' : '' ?> ">
            <a href="<?=fsp('url', $key2, $val)?>" data-fsp-key="type"> <?= $val?>
                <?php
                    if (!in_array($key2, ['location', 'timeline'])) {
                        $count = model('job')->where_active()->count_by([$key2=>$val]);
                    } else {
                        if ($key2 == 'location') {
                            $count = model('job')->where_active()->count_by('user_id', model('user_profile')->map('user_id')->get_many_by('location', $val));
                        }
                        if ($key2 == 'timeline') {
                            $count = model('job')->where_active()->where_timeline($val)->count_by('user_id'>0);
                        }
                    }
                    echo "($count)";
                ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
