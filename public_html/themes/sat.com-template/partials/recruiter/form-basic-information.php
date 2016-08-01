<?= form_open('/user/profile-post', 'class="form-strip"') ?>
  <div class="form-group">
    <label  class="col-xs-3 control-label">Profile</label>
    <div class="col-xs-9">
      <input type="text" class="form-control" disabled value="<?= $user->rec_type ?>">
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Name of Organisation </label>
    <div class="col-xs-9">
       <input name="org_name" value="<?= $user->org_name?>" class="form-control"  placeholder="School/College">
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">School’s Address </label>
    <div class="col-xs-9">
       <input name="org_addr[]" value="<?= $user->org_addr_1 ?>" class="form-control"  placeholder="Line 1">
       <input name="org_addr[]" value="<?= $user->org_addr_2 ?>" class="form-control"  placeholder="Line 2">
       <input name="org_addr[]" value="<?= $user->org_addr_3 ?>" class="form-control"  placeholder="Line 3 (Optional)">
       <input name="org_addr[]" value="<?= $user->org_addr_4 ?>" class="form-control"  placeholder="Line 4 (Optional)">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Location</label>
    <div class="col-xs-9">
      <?= form_dropdown('location', $locations, $user->location, 'data-plugin="select2" placeholder="Please Choose"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Borough</label>
    <div class="col-xs-9">
      <?= form_input('borough', $user->borough, 'placeholder="Borough" class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-3 control-label">Telephone </label>
    <div class="col-xs-9">
      <input name="org_tel" class="form-control" value="<?= $user->org_tel ?>" placeholder="Enter your telephone number">
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Fax </label>
    <div class="col-xs-9">
        <input name="org_fax" class="form-control" value="<?= $user->org_fax ?>" placeholder="Enter your fax number">
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Website address</label>
    <div class="col-xs-9">
      <input name="org_website" class="form-control" value="<?= $user->org_website ?>" placeholder="Enter your website Address">
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Logo</label>
    <div class="col-xs-9">
      <div class="box-white">
        <input type="file" name="org_logo">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">School photos</label>
    <div class="col-xs-9">
      <div class="box-white">
        <input type="file" multiple name="org_pics[]">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Maps</label>
    <div class="col-xs-9">
      <div class="box-white">
        <input type="file" name="org_map">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Organisation Type</label>
    <div class="col-xs-9">
      <?= form_dropdown('org_type', $job_organizations, $user->org_type, 'data-plugin="select2"') ?>
    </div>
  </div>


  <div class="form-group">
    <label class="col-xs-3 control-label">Age range</label>
    <div class="col-xs-4">
      <?= form_input('org_age_range_1', $user->org_age_range_1, 'class="form-control"') ?>
    </div>
    <div class="col-xs-1">
      <h3 class="mar-t-5 text-center font-regular">TO</h3>
    </div>

    <div class="col-xs-4">
      <?= form_input('org_age_range_2', $user->org_age_range_2, 'class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">Gender</label>
    <div class="col-xs-9">
      <?= form_dropdown('org_gender', ['Male'=>'Male', 'Female'=>'Female'], $user->org_gender, 'class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-3 control-label">School Information</label>
    <div class="col-xs-9">
      <?= form_textarea('org_about', $user->org_about, 'class="form-control" rows="3" placeholder="Description"') ?>
    </div>
  </div>

  <div class="text-center">
    <button class="btn btn-pink xs" data-loading-text="Please wait..." type="submit">Save</button>
  </div>
</form>
