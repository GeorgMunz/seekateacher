<?php

class Group extends App\Controller
{
    public function listing($type)
    {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }

        if ($type == 'sc') {
            model('group')
              ->after_get('attach_actions')
              ->where('user_id', auth('id'));
        } elseif ($type == 'mi') {
            model('group')
              ->select('*')
              ->join('group_member', 'group_id', 'id')
              ->where('user_id', auth('id'), 'group_member');
        }
        $groups = model('group')
                    ->after_get('attach_user', 'attach_url', 'attach_comments_count')
                    ->paginate(5);

        view('group/listing', get_defined_vars());
    }

    public function form($id = '')
    {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        $group = model('group')->get_forced($id);

        view()
        ->form('xcf', serialize($group))
        ->build('group/form', get_defined_vars());
    }

    public function form_post()
    {
        App\Request::validate([
          'xcf' => 'required',
          'title' => 'required',
          'detail' => 'required',
        ]);
        $_POST['user_id'] = auth('id');
        $old = unserialize($_POST['xcf']);
        $id = model('group')->save($_POST, ['id' => $old->id]);
        alert('set_success', 'Successfully Saved!');
        redirect("/group/members/{$id}");
    }

    public function members($group_id)
    {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        $group = model('group')->get($group_id);

        $self_created = false;
        if (auth('id') == $group->user_id) {
            $self_created = true;

            model('user')
              ->friends(auth('id'));

            $data_module = json_encode([
                'group_id' => $group_id,
                'url' => url('group-member-add'),
            ]);
        } else {
            model('user')
              ->user_profile()
              ->join('group_member', 'user_id', 'id')
              ->where('group_id', $group_id, 'group_member');
        }

        $tchs = model('user')
                    ->after_get([model('group_member'), 'attach_is_member', $group_id])
                    ->get_all();

        view('group/members', get_defined_vars());
    }

    public function member_add($group_id, $user_id)
    {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        $where = ['group_id' => $group_id, 'user_id' => $user_id];
        $get = model('group_member')->get_by($where);

        if ($get) {
            model('group_member')->delete_by($where);
        } else {
            model('group_member')->insert($where);
        }
        redirect("/group/members/$group_id");
    }

    public function detail($group_id)
    {
        if (!auth('is','tch')) {
            redirect('/auth/login');
        }
        $group = model('group')
                    ->after_get('attach_user')
                    ->get($group_id);

        $comments = model('group_comment')
                        ->after_get('attach_user')
                        ->get_many_by('group_id', $group_id);

        view()
        ->form('xcf', serialize($group))
        ->build('group/detail', get_defined_vars());
    }

    public function comment_post_ajax()
    {
        $group = unserialize(post('xcf'));

        $id = model('group_comment')->insert([
                    'group_id' => $group->id,
                    'user_id' => auth('id'),
                    'comment' => post('comment'),
                ]);

        $comment = model('group_comment')->get($id);
        $user = model('user')
                    ->user_profile()
                    ->after_get('attach_url')
                    ->get($comment->user_id);

        partial('comments/comment', get_defined_vars());
    }
}
