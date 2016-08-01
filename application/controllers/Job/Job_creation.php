<?php

trait Job_creation
{
    public function form_1($id = '')
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $job = model('job')->get_forced($id);

        $job_types = model('option')->values('job_types', 'json');
        $job_organizations = model('option')->values('job_organizations');
        $job_subjects = model('option')->values('job_subjects');
        $job_contract_time = model('option')->values('job_contract_time');
        $job_contract_days = model('option')->values('job_contract_days');
        $job_contract_types = model('option')->values('job_contract_types');
        $job_salaries = model('option')->values('job_salaries');
        $job_grades = model('option')->values('job_grades');
        $job_experience = model('option')->values('job_experience');
        $job_primary_jobs = model('option')->values('job_primary_jobs');

        view('job/form-1', get_defined_vars());
    }

    public function form_1_post()
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        // additional fields
        if (post('contract_days')) {
            $_POST['contract_days'] = implode(',', $_POST['contract_days']);
        }
        $_POST['user_id'] = auth('id');
        $_POST['status'] = 'draft';
        $_POST['contact_name'] = auth('profile', 'name');
        $_POST['contact_tel'] = auth('profile', 'org_tel');
        $_POST['contact_email'] = auth('authe', 'email');
        $_POST['contact_website'] = auth('profile', 'org_website');

        $_POST['subject'] = isset($_POST['subject']) ? $_POST['subject'] : '';
        $_POST['contract_days'] = isset($_POST['contract_days']) ? $_POST['contract_days'] : '';
        $_POST['pics'] = isset($_POST['pics']) ? $_POST['pics'] : '';
        $_POST['video'] = isset($_POST['video']) ? $_POST['video'] : '';
        $_POST['application_form'] = isset($_POST['application_form']) ? $_POST['application_form'] : '';
        $_POST['deleted'] = isset($_POST['deleted']) ? $_POST['deleted'] : 0;
        $_POST['created_at'] = isset($_POST['created_at']) ? $_POST['created_at'] : date('Y-m-d H:i:s', time());

        // saving
        $id = model('job')->save($_POST, ['id' => post('job_id')]);

        redirect("/job/form-2/$id");
    }

    public function form_2($id)
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $job = model('job')
        ->after_get('attach_uploads')
        ->get($id);

        $user = model('user')
        ->user_profile()
        ->after_get('attach_url')
        ->get($job->user_id);

        $user->org_addr = $user->org_addr ? implode('<br>', unserialize($user->org_addr)) : '';

        if (!$job) {
            return;
        }

        view()->form('xcf', json_encode($job));
        view('job/form-2', get_defined_vars());
    }

    public function form_2_post()
    {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $job = json_decode(post('xcf'));

        $_POST['pics'] = $job->pics;
        foreach ($_FILES as $field => $file) {
            $id = upload()->do_upload($field);
            if (!$id) {
                continue;
            }
            if ($field == 'job_video') {
                $_POST['video'] = $id;
            } elseif ($field == 'application_form') {
                $_POST['application_form'] = $id;
            } else {
                $_POST['pics'] = $id.','.$_POST['pics'];
            }
        }
        model('job')->update_only($job->id, $_POST);

        alert('set_success', 'Saved Successfully!');
        redirect('/job/manage');
    }
}
