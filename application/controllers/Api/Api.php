<?php

class Api extends App\Rest {

  /**
   * return the public profile of logged in user
   */
  public function public_profile_get() {
    $this->response(App\Auth::profile(), REST_Controller::HTTP_OK);
  }

  public function public_profile_post() {
    model('user_profile')->update_only(App\Auth::profile('id'), $_POST);
  }

  public function friends_get() {
    $friends = model('user')
    ->select('email')
    ->join('user_profile', 'user_id', 'id')
    ->select('name, profile_pic', 'user_profile')
    ->get_all();
    foreach ($friends as $friend) {
      $friend->tokens = explode(' ', $friend->name);
    }
    $this->response($friends, REST_Controller::HTTP_OK);
  }
}
