<?php

class Recruiter extends App\Controller {

    public function dashboard() {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        // job subjects
        $job_subjects = model('job')
        ->select('subject')
        ->map('subject')
        ->group_by('subject')
        ->get_many_by('user_id', auth('id'));

        $temps = [];
        if (count($job_subjects)) {
            $temps = model('user')
            ->teachers()
            ->attach()
            ->limit(20)
            ->get_many_by('subject_main', $job_subjects);
        }

        $adv_tchs = [];
        for ($i = 0; $i < count($temps); $i = $i+4) {
            $adv_tchs[] = array_slice($temps, $i, 4);
        }

        $temps = model('user')
        ->teachers()
        ->attach()
        ->limit(20)
        ->where('avail',3,'user_profile')
        ->get_all();

        $supply_tchs = [];
        for ($i = 0; $i < count($temps); $i = $i+4) {
            $supply_tchs[] = array_slice($temps, $i, 4);
        }

        view('recruiter/dashboard', get_defined_vars());
    }

    public function watchlist($what) {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        view('recruiter/watch');
    }

    public function listing($type) {
        $recs = model('user')
        ->recruiters($type)
        ->after_get('attach_rec_type')
        ->attach()
        ->where('id!=', auth('id'))
        ->paginate(10, "/recruiter/listing/$type");

        if ($type == 'sa') {
            $sidebar_title = 'Supply Agencies';
        }
        else {
            $sidebar_title = 'Educational Companies';
        }

        $rec_type = model('autho_group')->get_by('idx', $type)->name;
        $locations = model('city')->dropdown('name', 'name');
        view('recruiter/listing', get_defined_vars());
    }

    public function public_profile($id) {
        $rec = model('user')
        ->user_profile()
        ->attach()
        ->get($id);

        $rec->org_addr = implode('<br>', unserialize($rec->org_addr));

        $jobs = model('job')->get_all();

        if ( ! $rec) show_404();
        // update profile view count
        $profile_id = model('user_profile')->get_by('user_id', $id)->id;
        model('user_profile')->increment($profile_id, 'views');

        view('recruiter/public-profile', get_defined_vars());
    }

    public function profile() {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $user = model('user')
        ->user_profile()
        ->get(auth('id'));
        $addrs = unserialize($user->org_addr);
        $user->org_addr_1 = isset($addrs[0]) ? $addrs[0] : '';
        $user->org_addr_2 = isset($addrs[1]) ? $addrs[1] : '';
        $user->org_addr_3 = isset($addrs[2]) ? $addrs[2] : '';
        $user->org_addr_4 = isset($addrs[3]) ? $addrs[3] : '';

        $range = explode('-', $user->org_age_range);
        $user->org_age_range_1 = isset($range[0]) ? $range[0] : '';
        $user->org_age_range_2 = isset($range[1]) ? $range[1] : '';

        $user->rec_type = 'REC';
        view_data();
        view('recruiter/private-profile', get_defined_vars());
    }
}
