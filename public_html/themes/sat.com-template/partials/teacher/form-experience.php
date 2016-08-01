<?= form_open('/user/profile-post', 'class="form-strip"') ?>
  <div class="form-group">
    <label  class="col-xs-3 control-label">Main Subject</label>
    <div class="col-xs-9">
      <?= form_dropdown('subject_main', $job_subjects, $user->subject_main, 'class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Additional Subject</label>
    <div class="col-xs-9">
      <?= form_dropdown('additional_subjects[]', $job_subjects, $user->additional_subjects, 'multiple data-plugin="select2" style="width:100%"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Experience in years</label>
    <div class="col-xs-9">
      <?= form_input('experience', $user->experience, 'class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Acheivements</label>
    <div class="col-xs-9">
      <?= form_textarea('achievements', $user->achievements, 'class="form-control"') ?>
    </div>
  </div>
  <div class="text-center">
    <button class="btn btn-pink xs" type="submit">Save</button>
  </div>
</form>
