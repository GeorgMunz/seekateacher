<?= form_open('/auth/dereg-post', '') ?>
<h2 class="heading2">Please don’t leave us!</h2>
<p class="heading3">Every time an account is deactivated, a team cries!</p>
<p class="heading4">Please mention a reason:</p>
<?php foreach ($profile_deactivate_reasons as $r): ?>
  <div class="m-y-10">
      <?= form_radio_custom('reason', $r, '', 'class="rc-custom-3" data-label="'.$r.'"') ?>
  </div>
<?php endforeach; ?>
<?= form_textarea('reason', '', 'class="form-control"') ?>
<br>
<button type="submit" name="button" class="btn btn-pink">Deactivate</button>
<?= form_close() ?>
