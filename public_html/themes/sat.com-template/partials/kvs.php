<?php
foreach ($kvs as $k=>$v) {
  partial('key-val',['k'=>$k,'v'=>$v]);
}
?>
