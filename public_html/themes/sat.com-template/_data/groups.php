<?php

$groups = [
  (object) [
    'title' => 'How to teach better?',
    'detail' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa porro consectetur vero. Corporis impedit tempora repudiandae corrupti ut explicabo ad est, labore! Magnam quisquam modi nemo mollitia soluta dolores quaerat.',
    'posted_on' => '2014-09-09',
    'author' => (object) [
      'name' => 'John H. Resign',
      'profile_pic' => '/assets/images/signup/2.jpg'
    ]
  ],
  (object) [
    'title' => 'Are Students really learning?',
    'detail' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa porro consectetur vero. Corporis impedit tempora repudiandae corrupti ut explicabo ad est, labore! Magnam quisquam modi nemo mollitia soluta dolores quaerat.',
    'posted_on' => '2014-09-09',
    'author' => (object) [
      'name' => 'RamLila',
      'profile_pic' => '/assets/images/signup/1.jpg'
    ]
  ],
  (object) [
    'title' => 'Better way to teach...',
    'detail' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa porro consectetur vero. Corporis impedit tempora repudiandae corrupti ut explicabo ad est, labore! Magnam quisquam modi nemo mollitia soluta dolores quaerat.',
    'posted_on' => '2014-09-09',
    'author' => (object) [
      'name' => 'Jassey R. Hua',
      'profile_pic' => '/assets/images/signup/3.jpg'
    ]
  ],
];

$group = $groups[0];
$group_id = 1;

$data_module = json_encode([
  'group_id'=>$group_id,
  'url'=>url('group-member-add')
]);
