<?php

class User_profile_m extends App\Model {

  public function attach_upload_resume($row) {
    if (isset($row->resume) && $row->resume) {
      $row->upload_resume = model('upload')->get($row->resume);
    }
    return $row;
  }

  public function attach_upload_documents($row) {
    if (isset($row->documents) && $row->documents) {
      $row->documents = explode("\n", $row->documents);
      $row->upload_documents = model('upload')->get_many_by('id', $row->documents);
    }
    return $row;
  }

  public function update_complete() {
    $user_profile = $this->get_by('user_id', auth('id'));
    $points = [
      'dob' => 10,
      'location' => 10,
      'subject_main' => 10,
      'about' => 10,
    ];
    if (auth('is', 'tch')) {
      $points = array_merge($points, [
        'cv_file' => 10,
        'ps_file' => 10,
        'work_files' => 10,
        'achievements' => 10
      ]);
    }
    if (auth('is', 'rec')) {
      $points = array_merge($points, [
        'org_addr' => 10,
        'org_logo' => 10,
        'org_pics' => 10,
        'org_map' => 10,
        'org_about' => 10,
        'org_website' => 10,
        'org_fax' => 10,
        'org_age_range' => 10,
      ]);
    }
    $complete = 20;
    foreach ($points as $key => $val) {
      if ($user_profile->{$key}) {
        $complete += $val;
      }
    }
    $this->update_by('user_id', auth('id'), ['complete'=>$complete]);
    return $complete;
  }
}
