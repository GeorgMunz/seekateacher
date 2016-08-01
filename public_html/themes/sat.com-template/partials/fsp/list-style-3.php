<ul id="<?=$id?>" class="<?= ($open) ? 'in' : '' ?> collapse list-style-2">
    <?php foreach ($values as $val): ?>
        <li class="<?= fsp('data', $key2) == $val ? 'active' : '' ?> ">
            <a href="<?=fsp('url', $key2, $val)?>" data-fsp-key="type">
                <?php
                    if ($key2 == 'avail') {
                        $avail = [1=>'Not Avail', 2=>'Maybe', 3=>'Avail'];
                        echo $avail[$val];
                    } else {
                        echo $val;
                    }
                ?>
                <?php
                $count = model('user')
                ->teachers()
                ->where('deactivated', false)
                ->count_by($key2, $val);
                echo "($count)";
                ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
