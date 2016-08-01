<?php layout('recruiter-profile-white') ?>

<div class="col-xs-12" ng-app ng-init="contact_name='<?=$job->contact_name?>';
	contact_tel='<?=$job->contact_tel?>';
	contact_email='<?=$job->contact_email?>';
	contact_website='<?=$job->contact_website?>';
	">
	<?= form_open(url('job-form-2-post'), '') ?>
	<h1>Summary</h1>

	<div class="flex-sb-h">
		<?php partial('job/panel-job-1') ?>
		<?php partial('job/panel-job-2') ?>
		<?php partial('job/panel-job-3') ?>
		<?php partial('job/panel-job-4') ?>
	</div>
	<div class="flex-sb-h">
		<?php partial('job/panel-job-5') ?>
	</div>

	<div class="flex-end">
		<button class="btn btn-pink m-r" type="submit" name="status" value="draft">Save</button>
		<button class="btn btn-pink" type="submit" name="status" value="publish">Publish Advertisement</button>
	</div>

	<?= form_close(); ?>
</div>
