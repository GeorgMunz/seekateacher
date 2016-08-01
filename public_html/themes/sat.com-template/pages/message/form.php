<?php layout(['rec'=>'recruiter-message','tch'=>'teacher-message']) ?>

<?= alert() ?>
<?= form_open(url('message-compose-post'), 'class="form"') ?>
  <div class="form-group">
    <label class="font-bold">To:</label>
    <br>
    <?= form_dropdown('receiver_id', $friends, $user_id, 'data-plugin="select2" style="width:200px"') ?>
  </div>

  <div class="form-group">
    <label class="font-bold">Subject</label>
    <?= form_input('subject', '', 'class="form-control"') ?>
  </div>

  <div class="form-group">
    <label class="font-bold">Message</label>
    <?= form_textarea('message', '', 'data-plugin="tinymce"') ?>
  </div>

  <button type="submit" class="btn btn-pink btn-md pull-right" type="submit">SEND</button>
</form>
