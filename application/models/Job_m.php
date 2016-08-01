<?php

require_once __DIR__.'/Attach/Attach_trait.php';

class Job_m extends App\Model
{
    use Attach_trait;

    public $fsp = [
        'location' => ['', 'user_profile'],
        'post_code' => ['', 'city'],
        'search' => ['like:title|detail'],
    ];

    protected $__events_callbacks_always = [
//        'before_insert' => ['created_at'],
    ];

    public function attach_url($row)
    {
        $row->url = "/job/detail/$row->id";
        $row->edit_url = "/job/form-1/$row->id";
        $row->delete_url = "/job/delete/$row->id";
        $row->invite_url = "/job/matching-teachers/$row->id";
        $row->response_url = "/job/responses/$row->id";
        $row->email_url = 'mailto:someone@example.com?subject='
                            .urlencode('Check this job at SAT').'&body='
                            .urlencode('http://www.seekateacher.com/'.$row->url);
        $row->save_url = '/job/action/saved/'.$row->id.'/'.auth('id').'/1';
        $row->unsave_url = '/job/action/saved/'.$row->id.'/'.auth('id').'/0';
        $row->apply_url = '/job/action/applied/'.$row->id.'/'.auth('id').'/1';
        $row->unapply_url = '/job/action/applied/'.$row->id.'/'.auth('id').'/0';

        return $row;
    }

    public function attach_is_applied($row)
    {
        $row->is_applied = model('job_user')
                            ->get_by([
                              'job_id' => $row->id,
                              'user_id' => auth('id'),
                              'applied' => 1,
                            ]);

        return $row;
    }

    public function attach_is_saved($row)
    {
        $row->is_saved = model('job_user')
                            ->get_by([
                              'job_id' => $row->id,
                              'user_id' => auth('id'),
                              'saved' => 1,
                            ]);

        return $row;
    }

    public function attach_uploads($row)
    {
        $pics = explode(',', $row->pics);
        $row->upload_pics = model('upload')->get_many_by('id', $pics);
        $row->upload_video = model('upload')->get_by('id', $row->video);
        $row->upload_application_form = model('upload')->get_by('id', $row->application_form);

        return $row;
    }

    public function attach_user_profile($row)
    {
        if (!$row) {
            return;
        }
        $row->user_profile = model('user_profile')->get_by('user_id', $row->user_id);

        return $row;
    }

    public function attach_fsalary($row)
    {
        if (!$row) {
            return;
        }
        if ($row->salary == 'Daily Rate') {
            $row->fsalary = '£'.$row->salary_rate.' per day';
        } elseif ($row->salary == 'Hourly Rate') {
            $row->fsalary = '£'.$row->salary_rate.' per hour';
        } else {
            $row->fsalary = $row->salary;
        }

        return $row;
    }

    public function applied($user_id)
    {
        return $this
                ->select('*')
                ->join('job_user', 'job_id', 'id')
                ->where('job_user', 'user_id', $user_id)
                ->where('job_user', 'applied', true)
                ->attach();
    }

    public function attach_invited($row)
    {
        $row->invited = model('job_user')
                            ->map('user_id')
                            ->get_many_by([
                              'job_id' => $row->id,
                              'invited' => true,
                            ]);

        return $row;
    }

    public function attach_responses($row)
    {
        $row->responses = model('job_user')
                            ->map('user_id')
                            ->get_many_by([
                              'job_id' => $row->id,
                              'applied' => true,
                            ]);

        return $row;
    }

    public function attach_actions($row)
    {
        $saved = count(model('job_user')
                    ->get_by([
                      'job_id' => $row->id,
                      'user_id' => auth('id'),
                      'saved' => 1,
                    ])) ? 1 : 0;
        $row->action_saved = json_encode([
            'url' => '/action-btn/job_user',
            'status' => $saved,
            'field' => 'saved',
            'text-0' => 'Save Job',
            'text-1' => 'Saved',
            'job_id' => $row->id,
            'user_id' => auth('id'),
        ]);
        $row->action_saved_status = $saved;

        $applied = count(model('job_user')
                            ->get_by([
                              'job_id' => $row->id,
                              'user_id' => auth('id'),
                              'applied' => 1,
                            ])) ? 1 : 0;
        $row->action_apply = json_encode([
            'url' => '/action-btn/job_user',
            'status' => $applied,
            'field' => 'applied',
            'text-0' => 'Apply Job',
            'text-1' => 'Applied',
            'job_id' => $row->id,
            'user_id' => auth('id'),
        ]);
        $row->action_apply_status = $applied;

        return $row;
    }

    public function attach()
    {
        return $this->after_get('attach_user_profile', 'attach_user',
            'attach_uploads', 'attach_fsalary', 'attach_url', 'attach_invited',
            'attach_responses', 'attach_is_applied', 'attach_is_saved',
            'attach_actions', 'attach_timeline');
    }

    public function joined()
    {
        return $this
                ->select('*')
                ->join('user', 'id', 'user_id', 'left')
                ->join('user_profile', 'user_id', 'user_id', 'left')
                ->join_custom('cities', 'cities.name = user_profiles.location', 'left');
    }

    public function filter_key_vals()
    {
        return [
            'type' => model('option')->values('job_types', 'json', 'type'),
            'location' => model('city')->map('name')->get_all(),
            'organization' => model('option')->values('job_organizations'),
            'subject' => model('option')->values('job_subjects'),
            'contract_time' => model('option')->values('job_contract_time'),
            'contract_type' => model('option')->values('job_contract_types'),
            'salary' => model('option')->values('job_salaries'),
            'grade' => model('option')->values('job_grades'),
            'experience' => model('option')->values('job_experience'),
            'timeline' => ['New', 'Expiring'],
        ];
    }

    public function fsp_timeline()
    {
        $data = fsp('data', 'timeline');
        if ($data == 'New') {
            $this->where('start_date >', date('Y-m-d', strtotime('-2 day')));
        } elseif ($data == 'Expiring') {
            $this->where('end_date >', date('Y-m-d', strtotime('-2 day')));
        }
    }

    public function attach_timeline($row)
    {
        $sTime = strtotime($row->start_date);
        $eTime = strtotime($row->end_date);
        if ($sTime > strtotime('-2 day')) {
            $row->timeline = 'New ('.$this->time_elapsed_string($sTime).')';
        }
        else if ($eTime > strtotime('-2 day')) {
            $row->timeline = 'Expiring ('.$this->time_elapsed_string($eTime).')';
            $row->timeline = str_replace('ago', 'remaining', $row->timeline);
        }
        else {
            $row->timeline = '';
        }

        return $row;
    }

    public function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
                 30 * 24 * 60 * 60 => 'month',
                      24 * 60 * 60 => 'day',
                           60 * 60 => 'hour',
                                60 => 'minute',
                                 1 => 'second',
                );
        $a_plural = array('year' => 'years',
                       'month' => 'months',
                       'day' => 'days',
                       'hour' => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds',
                );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);

                return $r.' '.($r > 1 ? $a_plural[$str] : $str).' ago';
            }
        }
    }

    public function where_active()
    {
        $this->_set_where([['deleted'=>0, 'status'=>'publish']]);
        return $this;
    }

    public function where_timeline($data)
    {
        if ($data == 'New') {
            $this->where('start_date >', date('Y-m-d', strtotime('-2 day')));
        } elseif ($data == 'Expiring') {
            $this->where('end_date >', date('Y-m-d', strtotime('-2 day')));
        }
        return $this;
    }
}
