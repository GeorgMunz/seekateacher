<?php

$courses = [
  (object) [
    'title' => 'Basics of Computer',
    'detail' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur natus dignissimos vero in ex molestiae adipisci dolorem illum quam ab doloremque, quibusdam optio dolor eveniet a necessitatibus. Alias, dolores, perspiciatis.</p>',
    'subject' => 'Account',
    'start_date' => '2015-09-09',
    'end_date' => '2016-09-09',
    'posted_on' => '2016-09-09',
    'price' => '20',
    'price_f' => '$ 20',
    'url' => '/course/detail',
    'author' => (object) [
      'org_name' => 'Duke Company',
      'org_loc' => 'London',
      'borough' => 'Engfield'
    ],
  ],
  (object) [
    'title' => 'Advanced English Grammer',
    'detail' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora itaque neque accusamus quis aperiam unde rerum voluptas ea temporibus, iste dolorem laudantium quae consequuntur fugiat quaerat velit possimus deleniti voluptatibus.</p>',
    'subject' => 'Account',
    'start_date' => '2015-09-09',
    'end_date' => '2016-09-09',
    'posted_on' => '2016-09-09',
    'price' => '20',
    'price_f' => '$ 20',
    'url' => '/course/detail',
    'author' => (object) [
      'org_name' => 'Rice Company',
      'org_loc' => 'London',
      'borough' => 'Engfield'
    ],
  ],
];

$course = $courses[0];

$author = (object) [
  'profile_pic' => '/assets/images/signup/6.jpg',
  'org_name' => 'Rice Company',
  'org_loc' => 'London',
  'borough' => 'Engfield'
];
