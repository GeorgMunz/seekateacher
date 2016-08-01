<?php layout('recruiter-profile') ?>

<div class="col-xs-12">
  <h1>Create a Course</h1>
  <?= alert() ?>
  <?= form_open(url('course-form-post'), 'class="form"') ?>
    <div class="row">
      <div class="col-xs-7">

        <div class="form-group">
          <label>Course Title <span class="subtitle"> (Max 100 Characters)</span></label>
          <?= form_input('title', $course->title, 'class="form-control"') ?>
        </div>

        <div class="form-group">
          <label>Subject</label>
          <?= form_dropdown('subject', $subjects, $course->subject, 'data-plugin="select2" class="form-control"') ?>
        </div>

        <div class="form-group">
          <label>Course Detail <span class="subtitle">(Max 100 Characters)</span></label>
          <?= form_textarea('detail', $course->detail, 'data-plugin="tinymce"') ?>
        </div>

        <button class="btn btn-pink pull-right btn-md mar-b-10" type="submit">Save</button>

      </div>

      <div class="col-xs-5">

        <div class="form-group">
          <label class="title">Add Price</label>
          <?= form_number('price', $course->price, 'class="form-control"') ?>
        </div>

        <div class="form-group">
          <label class="title">Duration</label>
          <div class="row">
            <div class="col-xs-6 p-r-0">
              <div class="input-group">
                <span class="input-group-addon">Start</span>
                <?= form_input('start_date', $course->start_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon">End</span>
                <?= form_input('end_date', $course->end_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Cover Pic</label>
          <input type="file" name="cover_pic">
        </div>

      </div>

    </div>
  </form>
</div>
