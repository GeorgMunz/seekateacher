<?php

$messages = [
  (object) [
    'receiver_id' => '1',
    'subject' => 'Have you gone through the last thought!',
    'message' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis facere quia tenetur fugit quos quae, ipsa vero praesentium neque ducimus laboriosam totam dolores molestiae? Porro in eum blanditiis. Nulla, odio!</p>',
    'excerpt' => 'Have you gone through the last thought! - Lorem ipsum dolor sit a...',
    'created_at' => '2016-09-09 00:00:00',
    'author' => (object) [
      'name' => 'Me',
    ]
  ],
  (object) [
    'receiver_id' => '2',
    'subject' => 'Jun Gun Man!',
    'message' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis facere quia tenetur fugit quos quae, ipsa vero praesentium neque ducimus laboriosam totam dolores molestiae? Porro in eum blanditiis. Nulla, odio!</p>',
    'excerpt' => 'Jun Gun Man! - Lorem ipsum dolor sit a...',
    'created_at' => '2016-09-09 00:00:00',
    'author' => (object) [
      'name' => 'John R. Marley',
    ]
  ],
  (object) [
    'receiver_id' => '1',
    'subject' => 'Excellent Article by you!',
    'message' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis facere quia tenetur fugit quos quae, ipsa vero praesentium neque ducimus laboriosam totam dolores molestiae? Porro in eum blanditiis. Nulla, odio!</p>',
    'excerpt' => 'Excellent Article by you! - Lorem ipsum dolor sit a...',
    'created_at' => '2016-09-09 00:00:00',
    'author' => (object) [
      'name' => 'John R. Marley',
    ]
  ],
];
$message = $messages[0];
$author = $message->author;

$threads = [
  (object) [
    'detail' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo harum quod dicta illum fugiat quo non quis rerum cupiditate corporis perspiciatis tempore quisquam mollitia a, laudantium quidem nulla officia quos.',
    'created_at' => '2016-09-09 00:00:00',
    'author' => (object) [
      'id' => '2',
      'name' => 'Lory Molla'
    ]
  ],
  (object) [
    'detail' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo harum quod dicta illum fugiat quo non quis rerum cupiditate corporis perspiciatis tempore quisquam mollitia a, laudantium quidem nulla officia quos.',
    'created_at' => '2016-09-09 00:00:00',
    'author' => (object) [
      'id' => '1',
      'name' => 'Lary Page'
    ]
  ]
];
