<?php
namespace XORLabs\XC\Helpers;

class Recaptcha {

  const URL = 'https://www.google.com/recaptcha/api/siteverify';

  public static function check() {
    $data = [
      'secret' => '6LcrNxUTAAAAABFh-FSE7Sz-mKmjnHpits8DKzmb',
      'response' => isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '',
      'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $response = json_decode(Curl::post(self::URL, $data));
    return $response->success == 'true';
  }

}
