<?php
require_once __DIR__ . '/Attach/Attach_trait.php';
class Community_comment_m extends App\Model {
  use Attach_trait;

  public $__events_callbacks_always = [
    'before_insert' => ['created_at'],
  ];  

}
