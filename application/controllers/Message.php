<?php

class Message extends App\Controller {

    public function compose($user_id = '') {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        $friends = model('user_friend')
        ->join('user_profile', 'user_id', 'friend_id')
        ->where('user_id', auth('id'))
        ->dropdown('friend_id', 'name');

        view('message/form', get_defined_vars());
    }

    public function compose_post() {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        App\Request::validate([
            'receiver_id' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $_POST['sender_id'] = auth('id');
        post('created_at', date('Y-m-d H:i:s'));
        model('message')->insert($_POST);

        alert('set_success', 'Sent Successfully!');
        redirect('/message/compose');
    }

    public function listing($type) {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        // paginate based upon type
        $messages = model('message')
        ->attach()
        ->query_listing($type, auth('id'))
        ->paginate(10, "message/listing/{$type}");

        $module_message_url = ($type == 'trash') ? '/message/delete-post' : '/message/trash-post';

        view('message/listing', get_defined_vars());
    }

    public function detail($id) {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        $message = model('message')
        ->after_get('attach_threads', 'attach_sender', 'attach_receiver')
        ->get($id);

        if ( ! $message) show_404();

        // set it to be seen
        if ( ! $message->viewed && $message->sender_id != auth('id'))
        model('message')->active($message->id, 'viewed');

        $sender = $message->sender;
        $receiver = $message->receiver;
        $threads = $message->threads;

        view()->form('message_id', $message->id);
        view()->form('redirect', "/message/detail/$id");
        view('message/detail', get_defined_vars());
    }

    public function thread_post() {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        App\Request::validate([
            'message_id' => 'required',
            'detail' => 'required',
        ]);
        $_POST['user_id'] = auth('id');
        post('created_at', date('Y-m-d H:i:s'));

        model('message_thread')->insert_only(post());
        redirect(post('redirect'));
    }

    public function delete_post() {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        foreach ($_POST['data'] as $id) {
            $key = model('message')->sender_or_receiver($id, auth('id')) . '_deleted';
            model('message')->update($id, [
                $key => 1
            ]);
        }
    }

    public function trash_post() {
        if (!auth('is','rec') && !auth('is','tch')) {
            redirect('/auth/login');
        }
        foreach ($_POST['data'] as $id) {
            $key = model('message')->sender_or_receiver($id, auth('id')) . '_trash';
            model('message')->update($id, [
                $key => 1
            ]);
        }
    }

}
