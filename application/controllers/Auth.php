<?php

class Auth extends App\Controller
{
    public function sign_up()
    {
        $recruiter_types = model('autho_group')->recs_kv();

        view('auth/sign-up', [
          'recruiter_types' => $recruiter_types,
        ]);
    }

    public function forgot_password()
    {
        view('auth/forgot-password');
    }

    public function forgot_password_post()
    {
        alert('set_success', 'Sent Successfully!');
        redirect('/auth/forgot-password');
    }

    public function basic_detail()
    {
        if (XORLabs\XC\Core\Url_session::prev() === '/auth/basic-detail-post') {
            App\Request::repopulate();
            unset($_POST['g-recaptcha-response']);
        }

        if (XORLabs\XC\Core\Url_session::prev() === '/auth/sign-up') {
            App\Request::validate([
            'signup_as' => 'required',
            'recruiter_type' => [function () {
              if (post('signup_as') != 'tch') {
                  if (post('rec_type') == '') {
                      return false;
                  }
              }

              return true;
            }],
          ]);
        }

        $autho_groups = ['reg'];
        $autho_groups[] = post('signup_as');
        if (post('signup_as') == 'rec') {
            $autho_groups[] = post('rec_type');
        }

        view()->form('ags', serialize($autho_groups));
        view()->form('signup_as', post('signup_as'));
        if (post('signup_as') == 'tch') {
            view('auth/basic-detail-teacher');
        } elseif (post('signup_as') == 'rec') {
            view('auth/basic-detail-recuriter', [
                'group_name' => model('autho_group')->get_by('idx', post('rec_type'))->name,
              ]);
        } else {
        }
    }

    public function basic_detail_post()
    {
        App\Request::validate([
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'valid_email',
          'username' => 'required|is_unique[users.username]',
          'password' => 'required',
          'g-recaptcha-response' => ['required', function () {
            return XORLabs\XC\Helpers\Recaptcha::check();
          }],
          'ags' => 'required',
        ]);

        post('profile_pic', model('option')->value('default_profile_pic'));
        post('complete', 20);
        App\Auth\Authe::register($_POST, unserialize(post('ags')));
        redirect('/auth/confirm-email');
    }

    public function activate($code)
    {
        if (App\Auth\Authe::activate($code)) {
            App\Alert::set_success('Success! Please Login to continue');
        } else {
            App\Alert::set_error('Authentication Code NOT Valid!');
        }
        redirect('/auth/login');
    }

    public function login()
    {
        view()->bc->add('page-authe-sign-in')
            ->build('auth/sign-in');
    }

    public function login_post()
    {
        App\Request::validate([
          'username' => 'required',
          'password' => 'required',
        ]);

        App\Auth\Authe::login('username', function ($status, $user, $msg) {
          if (!$status) {
              App\Alert::set_error($msg);
              redirect('/auth/login');
          } else {
              if ($user->deactivated) {
                  model('user')->retrieve($user->id);
                  model('user')->update($user->id, ['deactivated' => 0]);
              }

              App\Auth::set_session($user->id);

              if (auth('is', 'rec')) {
                  redirect('/recruiter/dashboard');
              } else if (auth('is','tch')) {
                  redirect('/teacher/dashboard');
              } else if (auth('is','admin')) {
                  redirect('/admin/dashboard');
              } else {
                  redirect('/');
              }
          }
        });
    }

    public function confirm_email()
    {
        view('auth/confirm-email');
    }

    public function resent()
    {
        alert('set_success', 'The mail has been resent!');
        redirect('/auth/confirm_email');
    }

    public function dereg_post()
    {
        $backup = [];

        $backup['community'] = model('community')
                                ->get_many_by('user_id', auth('id'));

        $backup['community_comment'] = model('community_comment')
                                            ->get_many_by('user_id', auth('id'));

        $backup['course'] = model('course')
                                ->get_many_by('user_id', auth('id'));

        $backup['group'] = model('group')
                                ->get_many_by('user_id', auth('id'));

        $backup['group_comment'] = model('group_comment')
                                        ->get_many_by('user_id', auth('id'));

        $backup['group_member'] = model('group_member')
                                    ->get_many_by('user_id', auth('id'));

        $backup['job'] = model('job')
                            ->get_many_by('user_id', auth('id'));

        $backup['job_user'] = model('job_user')
                                ->get_many_by('user_id', auth('id'));

        $backup['message'] = model('message')
                                ->where('sender_id', auth('id'))
                                ->or_where('receiver_id', auth('id'))
                                ->get_many_by('id >', 0);

        $backup['message_thread'] = model('message_thread')
                                        ->get_many_by('user_id', auth('id'));

        $backup['user'] = model('user')
                            ->get(auth('id'));

        $backup['user_autho_group'] = model('user_autho_group')
                                        ->get_many_by('user_id', auth('id'));

        $backup['user_friend'] = model('user_autho_group')
                                    ->get_many_by('user_id', auth('id'));

        $backup['user_profile'] = model('user_profile')
                                    ->get_by('user_id', auth('id'));

        $backup['watchlist_course'] = model('watchlist_course')
                                        ->get_many_by('self_id', auth('id'));

        $backup['watchlist_user'] = model('watchlist_user')
                                        ->get_many_by('self_id', auth('id'));

        model('user_dereg')
            ->insert([
                'user' => json_encode($backup),
                'user_id' => auth('id'),
                'reason' => post('reason'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

        model('user')->delete_related(auth('id'));
        model('user')->update(auth('id'), [
            'deactivated' => 1
        ]);

        echo 'logout';
    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }
}
