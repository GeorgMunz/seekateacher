<?php
foreach ($successes as $success) {
  view()->display_partial('alerts/success', ['success'=>$success]);
}
?>
