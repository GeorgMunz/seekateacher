<?= form_open('/user/profile-post', 'class="form-strip"') ?>
<div class="form-group">
  <label  class="col-xs-3 control-label">Full name</label>
  <div class="col-xs-9">
    <?= form_input('name', $user->name, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Available</label>
  <div class="col-xs-9">
    <?= form_dropdown('avail', ['1'=>'Not Available', '2'=>'Maybe Available', '3'=>'Available'], $user->avail, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label class="col-xs-3 control-label">Gender</label>
  <div class="col-xs-9">
    <?= form_dropdown('gender', ['Male'=>'Male', 'Female'=>'Female'], $user->gender, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label class="col-xs-3 control-label">Date of birth</label>
  <div class="col-xs-9">
    <?= form_input('dob', $user->dob, 'class="form-control" data-plugin="datetimepicker" data-date') ?>
  </div>
</div>


<div class="form-group">
  <label  class="col-xs-3 control-label">Ethnicity</label>
  <div class="col-xs-9">
    <?= form_input('ethnicity', $user->ethnicity, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Location</label>
  <div class="col-xs-9">
    <?= form_dropdown('location', $locations, $user->location, 'data-plugin="select2"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Borough</label>
  <div class="col-xs-9">
    <?= form_input('borough', $user->borough, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Profile Picture</label>
  <div class="col-xs-9">
    <div class="box-white">
      <input type="file" name="profile_pic_file">
    </div>
    <p class="image-meta">Or choose from these<p>
      <div class="flex">
        <?php foreach ($dummy_profile_pics as $pic): ?>
          <label class="rc-custom-5">
            <input type="radio" name="profile_pic" value="<?=$pic?>" <?= $pic == $user->profile_pic ? 'checked' : '' ?>>
            <span style="background-image: url('<?=$pic?>')"></span>
          </label>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="text-center">
    <button class="btn btn-pink xs" type="submit">Save</button>
  </div>

</form>
