<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingFour">
    <h4 class="panel-title" data-parent="#accordion" data-toggle="collapse" data-target="#collapseFour">
       SOCIAL LINKS<span class="basic-style"> (WEBSITE & BLOGS)</span>
       <div class="small-box">
         <span class="glyphicon"></span>
       </div>
    </h4>
  </div>
  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="panel-body">
      <?= form_open('/user/profile-post', 'class="form-horizontal"') ?>
        <div class="form-group">
          <label  class="col-xs-3 control-label">Website</label>
          <div class="col-xs-9">
            <?= form_input('website', $profile->website, 'class="form-control"') ?>
          </div>
        </div>

        <div class="form-group">
          <label  class="col-xs-3 control-label">Blogs</label>
          <div class="col-xs-9">
            <?= form_input('blogs', $profile->blogs, 'class="form-control"') ?>
          </div>
        </div>

        <div class="text-center">
          <button class="btn btn-pink xs" type="submit">Save</button>
        </div>

      </form>
   </div>
  </div>
</div>
