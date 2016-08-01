<?php

class Message extends App\Rest {

  public function listing_get() {
    $friends = model('message')->get_all();
    $this->response($friends, self::HTTP_OK);
  }

  public function delete_post() {
    dump($_POST);
    // model('message')->update_by(['id'=>$_POST['ids']]);
    foreach ($_POST['data'] as $arr) {
      $key = $arr['self'] . '_deleted';
      model('message')->update($arr['id'], [
        $key => 1
      ]);
    }
    $this->response('ok');
  }

  public function trash_post() {
    // model('message')->update_by(['id'=>$_POST['ids']]);
    foreach ($_POST['data'] as $arr) {
      $key = $arr['self'] . '_trash';
      model('message')->update($arr['id'], [
        $key => 1
      ]);
    }
    $this->response('ok');
  }


}
