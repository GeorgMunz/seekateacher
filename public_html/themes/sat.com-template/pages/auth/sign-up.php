<?php layout('box') ?>

<h1>Sign-Up</h1>
<?= alert() ?>
<?= form_open(url('f-su'), 'data-module="validate" data-validate="signup"') ?>
	<p>Decide if you are signing-up as</p>

	<label class="rc-custom-lg m-r-30">
		<input type="radio" name="signup_as" ng-model="signup_as" value="rec">
		<span>Educational Recruiter</span>
	</label>

	<label class="rc-custom-lg">
		<input type="radio" name="signup_as" ng-model="signup_as" value="tch">
		<span>Teacher/Staff</span>
	</label>

	<div class="rec-type hide" ng-class="{hide: signup_as!='rec'}">
		<h2>Choose your profile</h2>

		<?php foreach ($recruiter_types as $key => $val): ?>
			<label class="rc-custom">
				<input type="radio" name="rec_type" value="<?= $key ?>">
				<span><?= $val ?></span>
			</label>
		<?php endforeach; ?>
	</div>

	<div>
		<button class="btn btn-pink m-y-30" type="submit">Next</button>
	</div>
	<p>Already have an account? <a href="<?=url('sign-in')?>">Log In</a></p>
</form>
