<?php
namespace App\Auth;
use App\Email;

class Authe {

  /**
  * Register the user with authorizations
  */
  public static function register($data, $autho_group_idx = []) {
      $data['last_login'] = date('Y-m-d H:i:s', time());
      $data['deactivated'] = true;
      $data['gender'] = 'Male';
      $data['location'] = '';
      $data['avail'] = 1;
      $data['additional_subjects'] = '';
      $data['about'] = '';
      $data['cv_file'] = 0;
      $data['ps_file'] = 0;
      $data['work_files'] = '';
      $data['experience'] = 0;
      $data['achievements'] = '';
      $data['website'] = '';
      $data['blogs'] = '';
      $data['job_title'] = '';
      $data['rec_email'] = '';
      $data['marketing_preferences'] = 0;
      $data['org_name'] = isset($data['org_name']) ? $data['org_name'] : '';
      $data['org_type'] = isset($data['org_type']) ? $data['org_type'] : '';
      $data['org_gender'] = isset($data['org_gender']) ? $data['org_gender'] : '';
      $data['org_loc'] = isset($data['org_loc']) ? $data['org_loc'] : '';
      $data['org_age_range'] = isset($data['org_age_range']) ? $data['org_age_range'] : '';
      $data['org_addr'] = isset($data['org_addr']) ? $data['org_addr'] : '';
      $data['org_tel'] = isset($data['org_tel']) ? $data['org_tel'] : '';
      $data['org_fax'] = isset($data['org_fax']) ? $data['org_fax'] : '';
      $data['org_website'] = isset($data['org_website']) ? $data['org_website'] : '';
      $data['org_about'] = isset($data['org_about']) ? $data['org_about'] : '';
      $data['org_logo'] = isset($data['org_logo']) ? $data['org_logo'] : 0;
      $data['org_pics'] = isset($data['org_pics']) ? $data['org_pics'] : '';
      $data['org_map'] = isset($data['org_map']) ? $data['org_map'] : 0;
      $data['views'] = isset($data['views']) ? $data['views'] : 0;
    $user_id = model('user')->insert_only($data, TRUE);

    // Add authorization
    foreach ($autho_group_idx as $group_idx) {
      $autho_group_id = model('autho_group')->id('idx', $group_idx);
      // don't allow admin to get registered
      if ($autho_group_id == 1) {
        // delete and redirect
        model('user')
        ->before_delete('delete_related')
        ->delete($user_id);
        redirect('/auth/sign-up');
      }
      model('user_autho_group')->insert([
        'user_id' => $user_id,
        'autho_group_id' => $autho_group_id
      ]);
    }

    // Add user profile
    $data['name'] = "{$data['first_name']} {$data['last_name']}";
    $user_profile = array_merge(['user_id'=>$user_id], $data);
    model('user_profile')->insert_only($user_profile, TRUE);

    // Add activation
    self::add_activation($user_id);

    // Send email
    Email::authe_activation($user_id);

    // Add
    return $user_id;
  }

  /**
  * add activation code to user
  */
  public static function add_activation($user_id) {
    $data['activation_code'] = self::_rand_string_with_id($user_id);
    $data['activation_status'] = 0;
    return model('user')->update($user_id, $data, TRUE);
  }

  /**
  * IF valid activation code THEN activate the account
  */
  public static function activate($code) {
    $user = model('user')->get_by('activation_code', $code);

    if (count($user)) {
      $data['activation_code'] = NULL;
      $data['activation_status'] = 1;
      model('user')->update($user->id, $data, TRUE);
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  public static function login($field, $callback) {
    $user = model('user')->get_by('username', post($field));
    if ( model('user')->password_verify(post('password'), $user->password) ) {
      if ($user->activation_status)
        $callback(true, $user, 'Success');
      else
        $callback(false, $user, 'Not yet activated!');
    }
    else {
      $callback(false, $user, 'Username/Password Mismatch!');
    }
  }

  /**
  * generate 60 characters random string with id
  * used for activation and forgot password
  */
  private static function _rand_string_with_id($id)
  {
    $rand_len = 60 - strlen($id) - 1;
    $rand = random_string('alnum', $rand_len);

    // prepend random string to $id with '-'
    return $rand . '-' . $id;
  }
}
