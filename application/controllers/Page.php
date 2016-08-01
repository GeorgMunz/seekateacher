<?php

class Page extends App\Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $jobs = model('job')
                    ->attach()
                    ->joined()
                    ->limit(5)
                    ->get_all();

        $num_jobs = model('job')
                        ->where('status', 'publish')
                        ->count_all_results();

        $num_teachers = model('user')
                            ->teachers()
                            ->count_all_results();

        view('home', get_defined_vars());
    }

    public function jobs($id = '', $applied = '')
    {
        if ($applied) {
            echo json_encode(model('job')
                  ->join('job_user', 'job_id', 'id')
                  ->where('user_id', auth('id'), 'job_user')
                  ->where('applied', 1, 'job_user')
                  ->map('title')->get_all());
        } elseif ($id) {
            echo json_encode(model('job')->map('title')->get_many_by('user_id', $id));
        } else {
            echo json_encode(model('job')->map('title')->get_all());
        }
    }

    public function courses()
    {
        echo json_encode(model('course')->map('title')->get_all());
    }

    public function teachers()
    {
        echo json_encode(model('user')->teachers()->map('name')->get_all());
    }

    public function post_codes()
    {
        echo json_encode(model('city')->map('post_code')->get_all());
    }

    public function about()
    {
        view('about/about-us');
    }

    public function build_404()
    {
        view('404');
    }

    public function buttons()
    {
        view('_dev/buttons');
    }

    public function icons()
    {
        view('_dev/icons');
    }

    public function hybridauth_base()
    {
        require_once APPPATH.'/../vendor/hybridauth/hybridauth/hybridauth/index.php';
    }

    public function terms_conditions()
    {
        view('terms_conditions');
    }

    public function contact()
    {
        view('contact');
    }

    public function contact_post()
    {
        model('contact')->save($_POST);
        \App\Email::send('Contact Form', json_encode($_POST), model('option')->get_by('key', 'site_email')->value);
        alert('set_success', 'Thanks!!! for contacting us. We will reply you very soon.');
        redirect('/page/contact');
    }

    public function validUsername()
    {
        echo model('user')->get_by('username', $_POST['username']) ? false : true;
    }
}
