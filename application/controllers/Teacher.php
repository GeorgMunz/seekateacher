<?php

class Teacher extends App\Controller {

    public function dashboard() {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }

        $jobs = model('job')
        ->attach()
        ->where('status', 'publish')
        ->limit(10)
        ->where('subject', auth('profile', 'subject_main'))
        ->order_by('id', 'desc')
        ->get_all();

        $tch = model('user')
        ->user_profile()
        ->attach()
        ->get(auth('id'));

        view('teacher/dashboard', get_defined_vars());
    }

    public function profile() {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        $dummy_profile_pics = model('option')->values('user_dummy_profile_pics');
        $user = model('user')
        ->user_profile()
        ->attach()
        ->get(auth('id'));
        $user->additional_subjects = unserialize($user->additional_subjects);

        view_data();
        view('teacher/private-profile', get_defined_vars());
    }

    public function set_job_alerts() {
        view()->bc->add('page-teacher-set-job-alerts')
        ->set_layout('teacher-private-profile')
        ->build('teacher/set-job-alerts');
    }

    public function find_friends() {
        $teachers = model('user')->get_all();

        view()->set_layout('teacher-private-profile')
        ->bc->add('page-teacher-find-friends')
        ->build('teacher/find-friends', [
            'teachers' => $teachers
        ]);
    }

    // list all the teachers
    public function listing() {

        $tchs = model('user')
        ->teachers()
        ->attach()
        ->where('id!=', auth('id'))
        ->where('deactivated', false)
        ->paginate();

        $teacher_filters = $this->get_teacher_filters();

        view('teacher/listing', get_defined_vars());
    }

    public function get_teacher_filters()
    {
        $db_filters = model('option')->values('teacher_filters');
        $teacher_filters = [];
        $teacher_filter_key_vals = model('user')->filter_key_vals();
        foreach ($db_filters as $f) {
            $explode = explode('=>', $f);
            $key = trim($explode[0]);
            $v = trim($explode[1]);
            $explode = explode(',', $v);
            $title = trim($explode[0]);
            $open = isset($explode[1]) || fsp('data', $key);

            $teacher_filters[$key] = [
                'title' => $title,
                'values' => $teacher_filter_key_vals[$key],
                'open' => $open
            ];
        }
        return $teacher_filters;
    }


    public function watchlist() {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        // TODO: correct the logic
        $teachers = model('user')->after_get('attach_url')
        ->get_all();

        view('teacher/watchlist', [
            'teachers' => $teachers
        ]);
    }

    // show teacher public profile
    public function public_profile($id) {
        $tch = model('user')
        ->user_profile()
        ->attach()
        ->get($id);

        if ( ! $tch) show_404();

        // update profile view count
        $profile_id = model('user_profile')->get_by('user_id', $id)->id;
        model('user_profile')->increment($profile_id, 'views');

        view('teacher/public-profile', get_defined_vars());
    }

}
