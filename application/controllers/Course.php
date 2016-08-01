<?php

class Course extends App\Controller {

    public function form($id = '') {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        $course = model('course')->get_forced($id);
        $subjects = model('option')->values('job_subjects');

        view()
        ->form('xcf', serialize($course))
        ->build('course/form', get_defined_vars());
    }

    public function form_post() {
        App\Request::validate([
            'xcf' => 'required',
            'title' => 'required',
            'detail' => 'required'
        ]);
        $_POST['user_id'] = auth('id');
        $old = unserialize($_POST['xcf']);
        $id = model('course')->save($_POST, ['id'=>$old->id]);
        alert('set_success', 'Successfully Saved!');
        redirect("/course/form/{$id}");
    }

    public function manage() {
        if (!auth('is','rec')) {
            redirect('/auth/login');
        }
        model('course')
        ->after_get('attach_actions')
        ->where('user_id', auth('id'));
        $this->listing();
    }

    public function listing() {
        // fetching filtered courses
        $courses = model('course')
        ->attach()
        ->paginate(5);

        $subjects = model('option')->values('job_subjects');

        view('course/listing', get_defined_vars());
    }

    public function detail($id) {
        $course = model('course')
        ->attach()
        ->get($id);

        if ( ! $course) show_404();

        view('course/detail', [
            'course' => $course,
            'user' => $course->user,
        ]);
    }

}
