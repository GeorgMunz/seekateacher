<?php
namespace User;

trait Teacher {

  public function teacher_dashboard() {
    // TODO: correct the logic
    $jobs = model('job')->after_get('attach_url')
                        ->get_all();

    view()->bc->add('page-teachers-dashboard')
    ->set_layout('teacher-private-profile')
    ->build('teacher/dashboard', [
      'jobs' => $jobs
    ]);
  }

  public function teacher_profile() {
    $user = model('user')->get(auth('id'));

    $profile = model('user_profile')
    ->after_get('attach_upload_resume', 'attach_upload_documents')
    ->get_by('user_id', auth('id'));

    $addrs = explode("\n", $profile->org_addr);
    $profile->org_addr_1 = isset($addrs[0]) ? $addrs[0] : '';
    $profile->org_addr_2 = isset($addrs[1]) ? $addrs[1] : '';
    $profile->org_addr_3 = isset($addrs[2]) ? $addrs[2] : '';
    $profile->org_addr_4 = isset($addrs[3]) ? $addrs[3] : '';

    $range = explode('-', $profile->org_age_range);
    $profile->org_age_range_1 = isset($range[0]) ? $range[0] : '';
    $profile->org_age_range_2 = isset($range[1]) ? $range[1] : '';

    $profile->additional_subjects = explode("\n", $profile->additional_subjects);

    view()->bc->add('page-teacher-profile')
    ->cj('select2')
    ->build('teacher/private-profile', [
      'profile' => $profile,
      'user' => $user
    ]);
  }

  public function teacher_profile_post() {
    if (post('additional_subjects')) {
      $_POST['additional_subjects'] = implode("\n", $_POST['additional_subjects']);
    }

    // update user
    model('user')->update_only(auth('id'), $_POST);

    // update profile
    if (files('profile_pic_file')) {
      $profile_pic_id = upload()->do_upload('profile_pic_file');
      if ($profile_pic_id) {
        $_POST['profile_pic'] = model('upload')->get($profile_pic_id)->uri;
      }
    }

    if (files('resume')) {
      $resume_id = upload()->do_upload('resume');
      if ($resume_id) {
        $_POST['resume'] = $resume_id;
      }
    }

    if (files('documents')) {
      $documents = upload()->do_multi_upload('documents');
      if (count($documents)) {
        $arr = [];
        foreach ($documents as $doc) {
          if ($doc) {
            $arr[] = $doc;
          }
          $_POST['documents'] = implode("\n", $arr);
        }
      }
    }

    model('user_profile')->update_only_by(['user_id'=>auth('id')], $_POST);

    $this->update_recruiter_complete();

    // redirect('/profile');
  }

}
