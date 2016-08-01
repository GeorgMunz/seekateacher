<h1 class="pink">Social Stuff</h1>
<?php
$kvs = [
  'RECRUITMENT EMAIL' => $rec->rec_email,
  'WEBSITE' => $rec->org_website,
  'TEL' => $rec->org_tel,
  'FAX NO' => $rec->org_fax
];
?>
<?php foreach ($kvs as $k => $v): ?>
<div class="flex bg-white m-b">
  <div class="p-a p-r-0 black"><?=$k?></div>
  <div class="p-a blue"><?= $v ?></div>
</div>
<?php endforeach; ?>
