<?php

require_once __DIR__.'/Job/Job_creation.php';

class Job extends App\Controller
{
    use Job_creation;

    public function listing()
    {
        $jobs = model('job')
                  ->joined()
                  ->attach()
                  ->order_by('id', 'desc')
                  ->where('status', 'publish')
                  ->where('deactivated', false, 'user')
                  ->where('deleted', false)
                  ->paginate(model('option')->value('job_filters_paginate'));

        $job_filters = $this->get_job_filters();

        view('job/listing', get_defined_vars());
    }

    public function detail($job_id)
    {
        $job = model('job')
                  ->attach()
                  ->get($job_id);

        if (!$job) {
            build_404();
        }

        $user = $job->user;

        view('job/detail', get_defined_vars());
    }

    public function manage()
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $jobs = model('job')
                  ->attach()
                  ->where('user_id', auth('id'))
                  ->where('deleted', false)
                  ->paginate();

      $job_filters = $this->get_job_filters();

        view('job/manage', get_defined_vars());
    }

    public function delete($id)
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        model('job')->update($id, ['deleted' => 1]);

        alert('set_success', 'Deleted Successfully!');
        redirect('/job/manage');
    }

    public function matching_teachers($id)
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $job = model('job')->get($id);

        $teachers = model('user')
                      ->teachers()
                      ->attach()
                      ->where('subject_main', $job->subject, 'user_profile')
                      ->paginate(12, '/job/matching-teachers/'.$id);

        $invites = model('job_user')
                      ->map('user_id')
                      ->get_many_by([
                        'job_id' => $job->id,
                        'invited' => true,
                      ]);

        foreach ($teachers as $teacher) {
            $invited = in_array($teacher->id, $invites) ? 1 : 0;

            $teacher->action_invite = json_encode([
              'url' => '/action-btn/job_user',
              'status' => $invited,
              'field' => 'invited',
              'text-0' => 'Invite',
              'class-0' => 'btn-blue',
              'class-1' => 'btn-orange',
              'text-1' => 'Invited',
              'job_id' => $job->id,
              'user_id' => $teacher->id,
            ]);
            $teacher->action_invite_status = $invited;
        }

        view('job/invite-teacher', get_defined_vars());
    }

    public function responses($id)
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $job = model('job')->get($id);

        $teachers = model('user')
                      ->attach()
                      ->teachers()
                      ->join('job_user', 'user_id', 'id')
                      ->where('job_id', $id, 'job_user')
                      ->where('applied', 1, 'job_user')
                      ->paginate(10, '/job/responses/'.$id);

        view('job/response', get_defined_vars());
    }

    public function applied()
    {
        $jobs = model('job')
                  ->select('*')
                  ->join('job_user', 'job_id', 'id')
                  ->where('user_id', auth('id'), 'job_user')
                  ->where('applied', 1, 'job_user')
                  ->attach()
                  ->paginate(10, '/job/applied');

        $job_filters = $this->get_job_filters();

        view('job/applied', get_defined_vars());
    }

    public function get_job_filters()
    {
        $db_filters = model('option')->values('job_filters');
        $job_filters = [];
        $job_filter_key_vals = model('job')->filter_key_vals();
        foreach ($db_filters as $f) {
            $explode = explode('=>', $f);
            $key = trim($explode[0]);
            $v = trim($explode[1]);
            $explode = explode(',', $v);
            $title = trim($explode[0]);
            $open = isset($explode[1]) || fsp('data', $key);

            $job_filters[$key] = [
                'title' => $title,
                'values' => $job_filter_key_vals[$key],
                'open' => $open
            ];
        }
        return $job_filters;
    }
}
