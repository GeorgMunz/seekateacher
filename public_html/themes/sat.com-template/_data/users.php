<?php

$users = [
  (object) [
    'id' => 1,
    'name' => 'Ran J. Thomson',
    'rec_type' => 'School/College',
    'location' => 'London',
    'borough' => 'Filoberg',
    'location_id' => 1,
    'gender' => 'Male',
    'age' => '12',
    'about' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit repellat provident in ipsum iste ipsa repudiandae et molestiae sed maxime incidunt officia, eius accusantium excepturi saepe? Tempora laudantium saepe placeat.',
    'profile_pic' => '/assets/images/signup/2.jpg',
    'public_profile' => '/recruiter/public-profile',
    'org_about' => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.
       Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque.
        Suspendisse in orci enim.',
    'org_addr' => 'Jungle Mein
Mangal Panday
Fir Tu
Hai Kahan',
    'org_name' => 'Mahashian Di Hatti',
    'org_tel' => '2973487934',
    'org_fax' => '92749379',
    'org_age_range' => '4-7',
    'org_gender' => 'Male',
    'org_type' => 'Nursery',
    'rec_email' => 'slkdfjl@gmail.com',
    'org_website' => 'www.google.com',
    'org_addr_1' => 'lkjsldf',
    'org_addr_2' => 'ksldjf',
    'org_addr_3' => 'lsjdlj',
    'org_addr_4' => 'sdflj',
    'org_location_id' => 1,
    'org_loc' => 'london',
    'org_age_range_1' => 1,
    'org_age_range_2' => 2,
    'job_title' => 'Teacher',
    'username' => '239749',
    'email' => 'dfjl@gmail.com',
    'rec_email' => 'dsjl@gmail.com',
    'marketing_preferences' => 1,
  ],
  (object) [
    'name' => 'Ran J. Thomson',
    'rec_type' => 'School/College',
    'location' => 'London',
    'borough' => 'Filoberg',
    'profile_pic' => '/assets/images/signup/2.jpg',
    'public_profile' => '/recruiter/public-profile',
    'org_about' => 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.
       Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque.
        Suspendisse in orci enim.',
  ],
];

$friends = [
  '1' => 'John H. Resign',
  '2' => 'Bully Man',
  '4' => 'Jurassic'
];

$creator =
(object) [
  'org_type' => 'Nursery Schools',
  'org_gender' => 'Male',
  'org_age_range' => '4-15',
  'org_website' => 'http://www.blinkleschool.com',
  'org_addr' => 'Jungle Mein
Mangal Panday
Fir Tu
Hai Kahan',
  'public_profile' => '/recruiter/public-profile',
];

$recs = $users;
$rec = $recs[0];

$rec->followers = [
  (object) [
    'profile_pic' => '/assets/images/signup/2.jpg'
  ],
  (object) [
    'profile_pic' => '/assets/images/signup/3.jpg'
  ],
];
$rec->num_followers = 2;
$rec->num_following = 2;
$rec->views = 2;

$tch = $users[0];
$tch->subject_main = 'Accountancy';
$tch->dob = '1992-09-09';
$tch->ethnicity = 'Kajaria';
$tch->is_member = 'true';
$tch->data_module = json_encode([
  'tch_id'=>$tch->id,
  'is_member'=>true
]);
// first tch
$tchs[] = $tch;

$tch2 = clone $tch;
// second tch
$tch2->is_member = false;
$tch2->data_module = json_encode([
  'tch_id'=>$tch2->id,
  'is_member'=>false
]);
$tchs[] = $tch2;

$adv_tchs = $tchs;
$supply_tchs = $tchs;
