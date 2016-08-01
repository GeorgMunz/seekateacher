<?= form_open('/user/profile-post', 'class="form-strip"') ?>
<div class="form-group">
  <label  class="col-xs-3 control-label">Attach CV</label>
  <div class="col-xs-9">
    <div class="box-white">
      <input type="file" name="cv_file">
      <?php
      /* if ($user->resume):
        <h3>Previously added</h3>
        <button class="btn-glypicon" type="submit"><span class="glyphicon glyphicon-remove-sign"></span></button>
        <a href="<?= $user->upload_resume->uri ?>" target="_blank" class="glyphicon-title">Resume<a>
         */
        ?>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-xs-3">Attach Personal Statement</label>
    <div class="col-xs-9">
      <div class="box-white">
        <input type="file" name="ps_file">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label  class="col-xs-3 control-label">Some of my Works</label>
    <div class="col-xs-9">
      <div class="box-white">
        <input type="file" name="work_files[]" multiple>
        <?php
        /*if ($user->documents): ?>
          <h3>Previously added</h3>
          <?php foreach ($user->upload_documents as $key => $doc): ?>
            <button class="btn-glypicon" type="submit"><span class="glyphicon glyphicon-remove-sign"></span></button>
            <a href="<?= $doc->uri ?>" target="_blank" class="glyphicon-title">Doc: <?= $key + 1 ?><a>
              <br>
            <?php endforeach; ?>
          <?php endif;
          */
          ?>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button class="btn btn-pink xs" type="submit">Save</button>
    </div>
  </form>
