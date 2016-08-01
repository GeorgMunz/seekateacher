<?php

require_once __DIR__ . '/User/Recruiter.php';
require_once __DIR__ . '/User/Teacher.php';

class User extends App\Controller {
  use User\Recruiter;
  use User\Teacher;

  public function profile_post() {
    if (files('profile_pic_file') && files('profile_pic_file')['name']) {
      $id = upload()->do_upload('profile_pic_file');
      post('profile_pic', model('upload')->get($id)->uri);
    }
    if (files('cv_file') && files('cv_file')['name']) {
      $id = upload()->do_upload('cv_file');
      post('cv_file', $id);
    }
    if (files('ps_file') && files('ps_file')['name']) {
      $id = upload()->do_upload('ps_file');
      post('ps_file', $id);
    }
    if (files('work_files') && count(files('work_files')['name'])) {
      $ids = upload()->do_multi_upload('work_files');
      post('work_files', $ids);
    }

    $_POST['org_age_range'] = post('org_age_range_1') . '-' . post('org_age_range_2');

    if (files('org_logo') && files('org_logo')['name']) {
      $id = upload()->do_upload('org_logo');
      post('org_logo', $id);
    }
    if (files('org_pics') && count(files('org_pics')['name'])) {
      $ids = upload()->do_multi_upload('org_pics');
      post('org_pics', $ids);
    }
    if (files('org_map') && files('org_map')['name']) {
      $id = upload()->do_upload('org_map');
      post('org_map', $id);
    }

    model('user_profile')
    ->update_only_by('user_id', auth('id'), $_POST);

    model('user')
    ->update_only(auth('id'), $_POST);

    echo model('user_profile')
    ->update_complete();
  }

  public function get_in_touch_post() {
    model('user_friend')->save([
      'user_id' => auth('id'),
      'friend_id' => post('user_id')
    ]);
    redirect('/message/compose/'.post('user_id'));
  }

  public function sync_contacts() {
    view('user/sync-contacts');
  }

  public function sync_contacts_via($provider) {

    if ( ! in_array($provider, ['Facebook', 'Twitter', 'Google', 'LinkedIn', 'Yahoo'])) {
      show_404();
    }

    // include HybridAuth library
    $this->config->load('hybridauth');

    // initialize Hybrid_Auth class with the config file
    $hybridauth = new Hybrid_Auth( $this->config->item('hybridauth_config') );

    // try to authenticate with the selected provider
    $adapter = $hybridauth->authenticate( $provider );

    // then grab the user profile
    $user_contacts = $adapter->getUserContacts();

    $synced = [];
    foreach ($user_contacts as $uc) {
      $db_user = model('user')->get_by('email', $uc->email);
      if ($db_user) {
        model('user_friend')->save([
          'user_id'=>14,
          'friend_id'=>$db_user->id
        ]);
        $synced[] = $uc->email;
      }
    }
    if (count($synced)) {
      App\Alert::set_success('Contacts successfully synced : ' . implode(', ', $synced));
    }
    else {
      App\Alert::set_success('Your Contacts have not shared their emails via ' . $provider);
    }

    redirect('/user/sync-contacts');
  }

}
