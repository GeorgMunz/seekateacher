<?php layout('recruiter-profile') ?>

<div class="container" ng-app ng-init="job_type='<?=$job->type?>';
    contract_type='<?=$job->contract_type?>';
    salary='<?=$job->salary?>';
    job_subtype='<?=$job->subtype?>';
	primary_job='<?=$job->primary_job?>';
	job_subject='<?=$job->subject?>'; contract_time='<?=$job->contract_time?>'">
	<h1>Create a Job</h1>
	<?= form_open(url('job-form-1-post'), 'class="form form horizontal form-horizontal-blocks"') ?>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Type of Job</label>
			<ul class="list-reset flex">
				<?php foreach ($job_types as $jt): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('type', $jt->type, ($jt->type==$job->type), 'ng-model="job_type"') ?>
							<span><?= $jt->type ?></span>
						</label>
					</li>
				<?php endforeach;?>
			</ul>
		</div>

		<?php foreach ($job_types as $jt): ?>
			<div class="form-group" ng-show="job_type=='<?=$jt->type?>'">
				<label class="pink font-lg-regular font-22">Sub-Type</label>
				<ul class="list-reset flex-wrap">
					<?php foreach ($jt->subtypes as $jst): ?>
						<li>
							<label class="rc-custom-4">
								<?= form_radio('subtype', $jst, ($job->subtype==$jst), 'ng-model="job_subtype"') ?>
								<span><?= $jst ?></span>
							</label>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>

        <div class="form-group" ng-show="job_subtype=='Primary jobs'">
			<label class="pink font-lg-regular font-22">Primary job type</label>
			<ul class="list-reset flex-wrap">
				<?php foreach ($job_primary_jobs as $jpj): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('primary_job', $jpj, ($jpj==$job->primary_job), 'ng-model="primary_job"') ?>
							<span><?= $jpj?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

        <div class="form-group" ng-show="job_subtype=='Secondary jobs'">
			<label class="pink font-lg-regular font-22">Subject</label>
			<ul class="list-reset flex-wrap">
				<?php foreach ($job_subjects as $js): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('subject', $js, ($js==$job->subject), 'ng-model="job_subject"') ?>
							<span><?= $js?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">What type of organisation?</label>
			<ul class="list-reset flex-wrap">
				<?php foreach ($job_organizations as $jo): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('organization', $jo, ($jo==$job->organization)) ?>
							<span><?= $jo?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Contract Time</label>
			<ul class="list-reset flex-wrap">
				<?php foreach ($job_contract_time as $jct): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('contract_time', $jct, ($jct==$job->contract_time), 'ng-model="contract_time"') ?>
							<span><?= $jct?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="form-group sub-detail" ng-show="contract_time=='Part Time'">
	  	<label>Select days</label>
	  	<ul class="list-reset flex">
				<?php foreach($job_contract_days as $jcd): ?>
			    <li>
			      <label class="rc-custom-5">
			        <input type="checkbox" name="job_contract_days" value="<?=$jcd?>">
			        <span><?= $jcd ?></span>
			      </label>
			    </li>
				<?php endforeach; ?>
		  </ul>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Contract Type</label>
			<ul class="list-reset flex">
				<?php foreach ($job_contract_types as $jct): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('contract_type', $jct, ($jct==$job->contract_type), 'ng-model="contract_type"') ?>
							<span><?= $jct?></span>
						</label>
					</li>
				<?php endforeach;?>
			</ul>
		</div>

		<div class="form-group flex-center" style="width:58%" ng-show="contract_type=='Temporary'">
			<label class="m-r">Duration</label>
			<div>
				<select class="form-control" style="width:200px;" name="contract_duration">
					<?php for($i=1;$i<=12;$i++): ?>
						<option value="<?=$i?> Months"><?=$i?> Month</option>
					<?php endfor;?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Salary</label>
			<ul class="list-reset flex">
				<?php foreach ($job_salaries as $js): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('salary', $js, ($js==$job->salary), 'ng-model="salary"') ?>
							<span><?= $js ?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="form-group flex-center" style="width:60%" ng-show="salary=='Daily Rate'||salary=='Hourly Rate'">
			<label class="m-r">Set Rate</label>
			<?= form_input('salary_rate', $job->salary_rate, 'class="form-control" style="width:200px"') ?>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Grade</label>
			<ul class="list-reset flex">
				<?php foreach($job_grades as $jg): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('grade', $jg, ($jg==$job->grade)) ?>
							<span><?= $jg ?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="form-group">
			<label class="pink font-lg-regular font-22">Experience</label>
			<ul class="list-reset flex">
				<?php foreach ($job_experience as $je): ?>
					<li>
						<label class="rc-custom-4">
							<?= form_radio('experience', $je, ($je==$job->experience)) ?>
							<span><?= $je ?></span>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<h2 class="pink">Advertisement Validity</h2>
		<div class="row">
			<div class="col-xs-3">
				<label class="font-lg-regular font-18">Start Date</label>
				<?= form_input('start_date', $job->start_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
			</div>
			<div class="col-xs-3">
				<label class="font-lg-regular font-18">End Date</label>
				<?= form_input('end_date', $job->end_date, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
			</div>
		</div>


		<div class="form-group m-t" style="width:70%">
			<label class="pink font-lg-regular font-22">Job Title <span class="font-14 gray font-regular"> (Max 100 Characters)</span></label>
			<?= form_input('title', $job->title, 'class="form-control"') ?>
		</div>

		<div class="form-group" style="width:70%">
			<label class="pink font-lg-regular font-22">Job Detail <span class="font-14 gray font-regular"> (Max 500 Characters)</span></label>
			<?= form_textarea('detail', $job->detail, 'data-plugin="tinymce"') ?>
		</div>

		<div class="text-center" style="width:70%">
			<p><button class="btn btn-pink mar-t-60 mar-b-60 xs" type="submit">Next</button></p>
		</div>

	<?= form_hidden('job_id', $job->id); ?>
	<?= form_close(); ?>
</div>
