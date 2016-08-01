<div class="panel-pink-inverse">
  <h2>Apply to Job</h2>
  <div class="panel-body">
    <?php partial('kvs',['kvs'=>[
      'Contact'=>'{{contact_name}}',
      'Tel'=>'{{contact_tel}}',
      'Email'=>'{{contact_email}}',
      'Website'=>'{{contact_website}}'
      ]]); ?>

    <div class="font-12 m-b">
      <label class="rc-custom-3" data-label="Apply through Org">
        <input type="checkbox" ng-model="apply">
        <span></span>
      </label>
    </div>
    <div ng-show="apply" class="form-group">
      <?php if (isset($job->upload_application_form)): ?>
        <div class="thumbnail">
          <a href="<?=$job->upload_application_form->uri?>" target="_blank">Form</a>
          <div class="toolbar">
            <span class="glyphicon glyphicon-remove-sign"></span>
          </div>
        </div>
      <?php endif; ?>
      <input type="file" name="application_form">
    </div>
    <button type="button" class="btn btn-pink" data-toggle="modal" data-target="#modal-job-form-2">Edit information</button>
    <?= partial('job/modal-job-form-2') ?>
  </div>
</div>
