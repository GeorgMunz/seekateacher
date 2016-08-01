<?php

require_once __DIR__.'/User_m/Authe_trait.php';
require_once __DIR__.'/Attach/Attach_trait.php';

class User_m extends App\Model
{
    use User_m\Authe_trait;
    use Attach_trait;

    public $fsp = [
        'location' => ['', 'user_profile'],
        'post_code' => ['', 'city'],
        'search' => ['like:name', 'user_profile'],
        'subject' => ['like:subject_main', 'user_profile'],
        'avail' => ['', 'user_profile'],
    ];

    public $__events_callbacks_always = [
        'before_insert' => ['created_at', 'updated_at', 'password_hash_before_create'],
        'before_update' => ['updated_at', 'password_hash_before_create'],
    ];

    public function attach_url($row)
    {
        if (auth('is', 'rec', $row->id)) {
            $row->public_profile = "/recruiter/public-profile/{$row->id}";
        } else {
            $row->public_profile = "/teacher/public-profile/{$row->id}";
        }

        return $row;
    }

    public function teachers()
    {
        $this->join('user_autho_group', 'user_id', 'id')
                ->where('autho_group_id', 6, 'user_autho_group');

        return $this->user_profile();
    }

    public function recruiters($type)
    {
        $this->join('user_autho_group', 'user_id', 'id')
                ->join_custom('autho_groups', 'autho_groups.id=user_autho_groups.autho_group_id')
                ->where('idx', $type, 'autho_group');

        return $this->user_profile();
    }

    public function friends($user_id)
    {
        return $this->join('user_friend', 'friend_id', 'id')
                    ->where('user_id', $user_id, 'user_friend')
                    ->user_profile();
    }

    public function user_profile()
    {
        return $this->select('*', 'user_profile')
                    ->select('id, email, username')
                    ->join('user_profile', 'user_id', 'id')
                    ->join_custom('cities', 'cities.name=user_profiles.location', 'left');
    }

    public function attach_age($row)
    {
        $row->age = ($row->dob) ? $this->getAge($row->dob) : '';

        return $row;
    }

    public function attach_rec_type($row)
    {
        $row->rec_type = model('user_autho_group')->rec_type($row->id);

        return $row;
    }

    public function attach_followers($row)
    {
        $ids = model('user_friend')
                ->map('user_id')
                ->get_many_by('friend_id', $row->id);

        $row->followers = [];
        $row->num_followers = 0;
        if (count($ids)) {
            $row->followers = model('user', true)
                                  ->user_profile()
                                  ->get_many_by('users.id', $ids);

            $row->num_followers = count($row->followers);
        }

        return $row;
    }

    public function attach_followings($row)
    {
        $ids = model('user_friend')
                ->map('friend_id')
                ->get_many_by('user_id', $row->id);

        $row->followings = [];
        $row->num_followings = 0;
        if (count($ids)) {
            $row->followings = model('user', true)
                                  ->user_profile()
                                  ->get_many_by('users.id', $ids);

            $row->num_followings = count($row->followings);
        }

        return $row;
    }

    public function attach_actions($row)
    {
        $status = count(model('watchlist_user')
                            ->get_by([
                              'self_id' => auth('id'),
                              'user_id' => $row->id,
                            ])) ? 1 : 0;
        $row->action_watchlist = json_encode([
          'url' => '/action-btn/save/watchlist_user',
          'self_id' => auth('id'),
          'user_id' => $row->id,
          'status' => $status,
          'text-0' => 'Add to Watchlist',
          'text-1' => 'Watching',
          'delete_by' => ['user_id' => $row->id, 'self_id' => auth('id')],
          'get_by' => ['user_id' => $row->id, 'self_id' => auth('id')],
        ]);

        $row->action_watchlist_status = $status;

        $status = count(model('user_friend')
                            ->get_by([
                              'user_id' => auth('id'),
                              'friend_id' => $row->id,
                            ])) ? 1 : 0;

        $row->action_follow = json_encode([
          'url' => '/action-btn/save/user_friend',
          'user_id' => auth('id'),
          'friend_id' => $row->id,
          'status' => $status,
          'text-0' => 'Follow',
          'text-1' => 'Followed',
          'delete_by' => ['user_id' => auth('id'), 'friend_id' => $row->id],
          'get_by' => ['user_id' => auth('id'), 'friend_id' => $row->id],
        ]);
        $row->action_follow_status = $status;

        return $row;
    }

    public function attach()
    {
        return $this->after_get('attach_url', 'attach_age', 'attach_followings', 'attach_followers', 'attach_actions', 'attach_rec_type');
    }

    public function getAge($then)
    {
        $then = date('Ymd', strtotime($then));
        $diff = date('Ymd') - $then;

        return substr($diff, 0, -4);
    }

    public function insert_related($post_array, $primary_key)
    {
        model('user_autho_group')->insert([
          'autho_group_id' => 11,
          'user_id' => $primary_key,
        ]);
        model('user_profile')->insert([
          'user_id' => $primary_key,
          'name' => 'teacher-'.$primary_key,
          'main_subject_id' => 1,
        ]);
    }

    public function delete_related($id)
    {
        model('community_comment')->delete_by('user_id', $id);
        model('community')->delete_by('user_id', $id);

        model('course')->delete_by('user_id', $id);

        model('group_comment')->delete_by('user_id', $id);
        model('group_member')->delete_by('user_id', $id);
        model('group')->delete_by('user_id', $id);

        model('job_user')->delete_by('user_id', $id);
        model('job')->delete_by('user_id', $id);

        model('message_thread')->delete_by('user_id', $id);
        model('message')->delete_by('sender_id', $id);
        model('message')->delete_by('receiver_id', $id);

        model('watchlist_course')->delete_by('self_id', $id);
        model('watchlist_user')->delete_by('self_id', $id);

        model('user_profile')->delete_by('user_id', $id);
        model('user_autho_group')->delete_by('user_id', $id);
    }

    public function retrieve($user_id)
    {
        if (!model('user_dereg')->get_by('user_id', $user_id)) return;
        $backup = json_decode(
            model('user_dereg')->get_by('user_id', $user_id)->user_id
        );

        model('community')->insert_many($backup->community);
        model('community_comment')->insert_many($backup->community_comment);

        model('course')->insert_many($backup->course);

        model('group')->insert_many($backup->group);
        model('group_member')->insert_many($backup->group_member);
        model('group_comment')->insert_many($backup->group_comment);

        model('job')->insert_many($backup->job);
        model('job_user')->insert_many($backup->job_user);

        model('message')->insert_many($backup->message);
        model('message_thread')->insert_many($backup->message_thread);

        model('watchlist_course')->insert_many($backup->watchlist_course);
        model('watchlist_user')->insert_many($backup->watchlist_user);

        model('user_profile')->insert($backup->user_profile);
        model('user_autho_group')->insert_many($backup->user_autho_group);
    }

    public function filter_key_vals()
    {
        return [
            'location' => model('city')->map('name')->get_all(),
            'subject_main' => model('option')->values('job_subjects'),
            'avail' => [1,2,3],
        ];
    }

}
