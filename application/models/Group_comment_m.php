<?php
require_once __DIR__ . '/Attach/Attach_trait.php';

class Group_comment_m extends App\Model {
  use Attach_trait;

  public $__events_callbacks_always = [
    'before_insert' => ['created_at'],
  ];
}
