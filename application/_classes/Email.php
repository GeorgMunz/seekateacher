<?php
namespace App;

class Email {

  public static function mail($config = []) {
    $mail = new \PHPMailer;

    if ( ! count($config)) $config = Load::config('email');

    if ($config['protocol'] == 'smtp') {
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->Host = $config['host'];
      $mail->Username = $config['username'];
      $mail->Password = $config['password'];
      $mail->SMTPSecure = $config['smtpsecure'];
      $mail->Port = $config['port'];
      $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
          ]
      ];
    }
    if ($config['protocol'] == 'sendmail') {
      $mail->isSendmail();
    }

    $mail->isHTML(true);
    $from_email = model('option')->get_by('key', 'site_email')->value;
    $from_name = model('option')->get_by('key', 'site_name')->value;
    $mail->setFrom($from_email, $from_name);

    return $mail;
  }

  public static function send($subject, $body, $to) {
    $mail = self::mail();
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    if (ENVIRONMENT == 'production') {
        return $mail->send();
    } else {
        return true;
    }
  }

  /* --------------------------------------------------------------
  * GENERAL METHODS
  * ------------------------------------------------------------ */

  /* --------------------------------------------------------------
  * Authe METHODS
  * ------------------------------------------------------------ */

  /**
  * Email at time of registering
  */
  public static function authe_activation($user_id) {
    $user = model('user')->get($user_id);

    // Setting message
    $link = site_url('auth/activate') . '/' . $user->activation_code;
    $body = get_instance()->load->view('emails/authe/activation', array('link'=>$link), TRUE);

    self::send('Account Activation', $body, $user->email);
  }

  public static function authe_forgot_password($user_id)
  {
    $user = $this->authe_m->get($user_id);

    $this->email->to($user->email);

    $this->email->subject('Forgot Password Code');

    // setting message
    $link = site_url('authe/reset-password-verify') . '/' . $user->forgot_password_code;
    $message = $this->load->view('email_template/authe/forgot_password', array('link'=>$link), TRUE);

    $this->email->message($message);

    // sending message
    if (ENVIRONMENT !== 'development')
    $this->email->send();
  }
}
