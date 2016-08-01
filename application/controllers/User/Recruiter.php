<?php
namespace User;

trait Recruiter {

  public function recruiter_dashboard() {
    // TODO: correct the logic
    $adv_teachers = model('user')
    ->teachers()
    ->get_all();

    // TODO: correct the logic
    $supply_teachers = model('user')
    ->teachers()
    ->get_all();

    view()->bc->add('page-recruiter-my-dashboard')
          ->set_layout('recruiter-private-profile')
          ->build('recruiter/dashboard', [
            'adv_tchs' => $adv_teachers,
            'supply_tchs' => $supply_teachers
          ]);
  }

  public function recruiter_profile() {
    $user = model('user')->get(auth('id'));
    $profile = model('user_profile')->get_by('user_id', auth('id'));
    $addrs = explode("\n", $profile->org_addr);
    $profile->org_addr_1 = isset($addrs[0]) ? $addrs[0] : '';
    $profile->org_addr_2 = isset($addrs[1]) ? $addrs[1] : '';
    $profile->org_addr_3 = isset($addrs[2]) ? $addrs[2] : '';
    $profile->org_addr_4 = isset($addrs[3]) ? $addrs[3] : '';

    $range = explode('-', $profile->org_age_range);
    $profile->org_age_range_1 = isset($range[0]) ? $range[0] : '';
    $profile->org_age_range_2 = isset($range[1]) ? $range[1] : '';

    view()->bc->add('page-recruiter-profile')
          ->set_layout('recruiter-private-profile')
          ->build('recruiter/private-profile', [
            'profile' => $profile,
            'user' => $user
          ]);
  }

  public function recruiter_profile_post() {

    // update user
    model('user')->update_only(auth('id'), $_POST);

    // update profile

    // - setting address
    $_POST['org_addr'] = post('org_addr_1') . "\n" . post('org_addr_2') . "\n"
                         . post('org_addr_3') . "\n" . post('org_addr_4');

    // - setting range
    $_POST['org_age_range'] = post('org_age_range_1') . '-' . post('org_age_range_2');

    if (files('org_logo')) {
      $logo_id = upload()->do_upload('org_logo');
      if ($logo_id) {
        $_POST['org_logo'] = $logo_id;
      }
      $org_pics = upload()->do_multi_upload('org_pics');
      if (count($org_pics)) {
        $arr = [];
        foreach ($org_pics as $pic) {
          if ($pic) {
            $arr[] = $pic;
          }
          $_POST['org_pics'] = implode(',', $arr);
        }
      }

      $org_map = upload()->do_upload('org_map');
      if ($org_map) {
        $_POST['org_map'] = $org_map;
      }
    }

    model('user_profile')->update_only_by(['user_id'=>auth('id')], $_POST);

    $this->update_recruiter_complete();

    // redirect('/profile');
  }

  public function update_recruiter_complete() {
    $profile = model('user_profile')->get_by('user_id', auth('id'));
    $user = model('user')->get(auth('id'));
    $complete = 0;
    $arr = [
      'username' => 10,
      'org_addr' => 10,
      'org_logo' => 10,
      'org_pics' => 10,
      'org_map' => 10,
      'org_about' => 10,
      'org_website' => 10,
      'org_fax' => 10,
    ];
    foreach ($arr as $key => $val) {
      if (
        (isset($profile->{$key}) && $profile->{$key}) OR
        (isset($user->{$key}) && $user->{$key})
      ) {
        $complete = $complete + $val;
      }
    }
    model('user_profile')->update_by('user_id', auth('id'), ['complete'=>$complete]);
  }

}
