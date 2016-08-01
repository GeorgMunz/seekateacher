<h1 class="pink">About</h1>

<?php
$kvs = [
  'ADDRESS' => $rec->org_addr,
  'AGE RANGE' => $rec->org_age_range,
  'GENDER' => $rec->org_gender,
  'ORGANIZATION TYPE' => $rec->org_type
];
?>
<?php foreach ($kvs as $k => $v): ?>
<div class="flex bg-white m-b">
  <div class="p-a p-r-0 black"><?=$k?></div>
  <div class="p-a blue"><?= $v ?></div>
</div>
<?php endforeach; ?>
