<?php
foreach ($errors as $error) {
  view()->display_partial('alerts/error', ['error'=>$error]);
}
?>
