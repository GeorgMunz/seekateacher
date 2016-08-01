<?php

$jobs = [
  (object) [
    'id' => 1,
    'type' => 'Senior Leadership',
    'subtype' => 'Teacher',
    'organization' => 'Nursery Schools',
    'subject' => 'Accountancy',
    'contract_time' => 'Full Time',
    'contract_days' => 'Mon,Tue',
    'contract_type' => 'Permanent',
    'contract_duration' => '2 Months',
    'salary' => 'Daily Rate',
    'salary_rate' => 15,
    'grade' => 'MRP1',
    'experience' => 'NQTs considered',
    'start_date' => '2016-02-09',
    'end_date' => '2016-09-09',
    'title' => 'Sunehari Job',
    'detail' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam omnis sapiente unde cumque, ipsam repudiandae, tempore repellendus ex impedit a! Illo ipsum, quam tenetur delectus, nulla accusamus ratione voluptates debitis.</p>',
    'status' => 'published',
    'contact_name' => 'Lella Bansali',
    'contact_tel' => '2937489372',
    'contact_email' => 'as@gmail.com',
    'contact_website' => 'abc.com',
    'pics' => '26,27',
    'videos' => '24',
    'application_form' => ''
  ],
  (object) [
    'id' => 2,
    'type' => 'Senior Leadership',
    'subtype' => 'Teacher',
    'organization' => 'Nursery Schools',
    'subject' => 'Accountancy',
    'contract_time' => 'Full Time',
    'contract_days' => 'Mon,Tue',
    'contract_type' => 'Permanent',
    'contract_duration' => '2 Months',
    'salary' => 'Daily Rate',
    'salary_rate' => 15,
    'grade' => 'MRP1',
    'experience' => 'NQTs considered',
    'start_date' => '2016-02-09',
    'end_date' => '2016-09-09',
    'title' => 'Sunehari Job',
    'detail' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam omnis sapiente unde cumque, ipsam repudiandae, tempore repellendus ex impedit a! Illo ipsum, quam tenetur delectus, nulla accusamus ratione voluptates debitis.</p>',
    'status' => 'published',
    'contact_name' => 'Lella Bansali',
    'contact_tel' => '2937489372',
    'contact_email' => 'as@gmail.com',
    'contact_website' => 'abc.com',
    'pics' => '26,27',
    'videos' => '24',
    'application_form' => '25'
  ],
];

$job = $jobs[0];
$job->upload_pics = [
  (object) [
    'uri' => '/assets/images/signup/3.jpg',
  ],
  (object) [
    'uri' => '/assets/images/signup/1.jpg',
  ],
  (object) [
    'uri' => '/assets/images/signup/3.jpg',
  ],
  (object) [
    'uri' => '/assets/images/signup/1.jpg',
  ],
  (object) [
    'uri' => '/assets/images/signup/3.jpg',
  ],
  (object) [
    'uri' => '/assets/images/signup/1.jpg',
  ],
];
$job->upload_video =
  (object) [
  'uri' => '/_uploads/big-buck-bunny_trailer.webm',
  'mime' => 'video/webm'
];
// $job->upload_application_form =
// (object) [
//   'uri' => '/_uploads/1457071234.pdf'
// ];


$job_types = json_decode('[ { "type": "Teaching/Lecturing", "subtypes": [ "Head Teacher", "Deputy Head Teacher" ] }, { "type": "Senior Leadership", "subtypes": [ "Teacher", "Subject Teacher" ] }, { "type": "Academic support staff", "subtypes": [ "Lecturer", "Head of Faculty" ] }, { "type": "Non-academic support staff", "subtypes": [ "Cover/Lunch/Exam Supervisor", "Support/Mentor", "Librarian" ] } ]');

$GLOBALS['job_organizations'] = explode("\n", 'Nursery Schools
Primary Schools
Middle Schools
Secondary Schools
Special Education(inc.PRU)
Independent Preparatory
Independent Secondary
Sixth Form/Colleges(FE/HE)
Local Authorities (LAs)
Universities
Supply Agencies
Examination Authorities
Other organisation');

$GLOBALS['job_subjects'] = explode("\n", 'Accountancy
Art and Design
Biology
Business Studies and Economics
Chemistry
Citizenship
Classic Civilisation
Dance
Design and Technology
Drama
EAL/English as an Additional Language
English');
$GLOBALS['job_subjects'] = array_combine($GLOBALS['job_subjects'], $GLOBALS['job_subjects']);


$job_contract_time = explode("\n", 'Full Time
Part Time
Supply');

$job_contract_days = explode("\n", 'Mon
Tue
Wed
Thr
Fri
Sat
Sun');

$job_contract_types = explode("\n", 'Permanent
Temporary
Fixed Term
Maternity Cover');

$job_salaries = explode("\n", 'Negotiable
Daily Rate
Hourly Rate');

$job_grades = explode("\n", 'MRP1
MRP2
MRP3
MRP4
MRP5
MRP6');

$job_experience = explode("\n", 'NQTs considered
NQTs not considered');
