<?php

class Upload_m extends App\Model {

  // Contain events callbacks
  // [
  //   'after_get'=>['increment_views', function(){}, [$obj, $func]]
  // ]
  protected $__events_callbacks_always = [
      'before_insert' => ['updated_at', 'created_at'],
      'before_update' => ['updated_at']
  ];

}
